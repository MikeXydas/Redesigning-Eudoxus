<?php

    //$lastAdded = null;
    //$action = '';
    include("../login.php");
    //debug_to_console("aaaaaaaaaaa");
    switch($_POST['action']) {
    case 'UpdateDeps':
        $dataReq = $_POST['uni'];
        UpdateDeps($dataReq);
        break;
    case 'UpdateCourses':
        $selUni = $_POST['uni'];
        $selDep = $_POST['dep'];
        $selSem = $_POST['sem'];
        UpdateCourses($selUni, $selDep, $selSem);
        break;
    case 'ShowBooks':
        $selCourse = $_POST['course'];
        ShowBooks($selCourse);
        break;
    case 'AddBook':
        $selCourse = $_POST['course'];
        $selBook = $_POST['book'];
        AddBook($selCourse, $selBook);
        break;
    case 'isStateCookieEmpty':
        isStateCookieEmpty();
        break;
    case 'DeleteStatedBook':
        debug_to_console("ADSADSA");
        $courseId = $_POST['course'];
        DeleteStatedBook($courseId);
        break;
    case 'RefreshCookie':
        RefreshCookie();
        break;
    case 'CompleteStatement':
        CompleteStatement();
        break;
    case 'UserType':
        UserType();
        break;
    default:
        // unknown / missing action
    }


    function UpdateDeps($chosenUni) {
        //include("login.php");
        $conn = OpenCon();
        //debug_to_console("reach");
        $depQuery = "SELECT DISTINCT(uniDepartment) FROM `Course` WHERE uniName = '$chosenUni'";

        $depResults = mysqli_query($conn, $depQuery);

        $optionsString = "";
        if (mysqli_num_rows($depResults) > 0) {
            while($row = mysqli_fetch_assoc($depResults)) {
                $optionsString .= '<option onclick="chooseDep(this.value)" value="' . htmlspecialchars($row['uniDepartment']) . '">' 
                . htmlspecialchars($row['uniDepartment']) 
                . '</option>'; 
                //debug_to_console($row['uniDepartment']);
            }
            
        }
        else {
            debug_to_console("NO DEPS");
        }
        CloseCon($conn);
        //debug_to_console($optionsString);
        echo $optionsString;
        return $optionsString;
    }
    
    function ShowBooks($chosenCourse) {
        $conn = OpenCon();
        $bookAdded = -1;
        if(isset($_COOKIE['statement'])) {
            $statements = json_decode($_COOKIE['statement'], false);
            foreach($statements as $whichState) {
                if($whichState->courseId == $chosenCourse) {
                    $bookAdded = $whichState->bookId;
                }
            }
        }

        $bookQuery = "SELECT * FROM `Book_has_Course`, `Book` 
                        WHERE Book_has_Course.Course_courseId = '$chosenCourse' 
                        and Book.bookId = Book_has_Course.Book_bookId";

        $bookResults = mysqli_query($conn, $bookQuery);

        $booksString = "";
        if (mysqli_num_rows($bookResults) > 0) {
            $counter = 0;
            while($row = mysqli_fetch_assoc($bookResults)) {
                
                $booksString .= '<li><div class="row bookRow">
                                    <div class="col-md-3">
                                    <img class="rounded" src="images/book.jpeg" alt="Book cover missing">
                                    </div>
                                    <div class="col-md-6">
                                    <p style="font-weight: bold; font-size: 120%; margin-top: 2%;">'. htmlspecialchars($row['title']) . '</p>
                                    <p>Συγγραφέας: '. htmlspecialchars($row['authors']) . '</p>
                                    <p>Σελίδες: '. htmlspecialchars($row['pages']) . '</p>
                                    </div>
                                    <div class="col-md-3">';
                if($bookAdded == -1) {
                    $booksString .= '<button id="addButton' . $counter . '" type="button" onclick="addBook(this.value)" value="'. htmlspecialchars($row['bookId']) . '"style="margin-top: 15%; box-shadow: 3px 3px 3px rgb(80, 78, 78);" class="btn shadow btn-success btn-lg">Προσθήκη</button>';
                }
                else if($bookAdded == $row['bookId']) {
                    $booksString .= '<button id="addButton' . $counter . '" type="button" onclick="removeBook(this.value)" value="'. htmlspecialchars($row['bookId']) . '"style="margin-top: 15%; box-shadow: 3px 3px 3px rgb(80, 78, 78);" class="btn shadow btn-danger btn-lg">Αφαίρεση</button>';
                }
                else {
                    $booksString .= '<button disabled id="addButton' . $counter . '" type="button" onclick="addBook(this.value)" value="'. htmlspecialchars($row['bookId']) . '"style="margin-top: 15%; box-shadow: 3px 3px 3px rgb(80, 78, 78);" class="btn shadow btn-success btn-lg">Προσθήκη</button>';
                }
                                
                $booksString .= '</div>
                                </div></li>';
                $counter++;
            }
            
        }
        else {
            debug_to_console("NO COURSES");
        }
        CloseCon($conn);
        echo $booksString;
        return $booksString;
    }

    function UpdateCourses($chosenUni, $chosenDep, $chosenSem) {
        $conn = OpenCon();
        $courseQuery = "SELECT * FROM `Course` WHERE uniName = '$chosenUni' AND uniDepartment='$chosenDep' AND semester = $chosenSem";

        $courseResults = mysqli_query($conn, $courseQuery);

        $optionsString = "";
        if (mysqli_num_rows($courseResults) > 0) {
            while($row = mysqli_fetch_assoc($courseResults)) {
                $optionsString .= '<option onclick="chooseCourse(this.value)" value="' . htmlspecialchars($row['courseId']) . '">' 
                . htmlspecialchars($row['courseName']) 
                . '</option>'; 
            }
            
        }
        else {
            debug_to_console("NO COURSES");
        }
        CloseCon($conn);
        echo $optionsString;
        return $optionsString;
    }

    class AddedBook {
        public $bookId;
        public $courseId;
    }

    function AddBook($selCourse, $selBook) {
        $newState = new AddedBook();
        $newState->bookId = $selBook;
        $newState->courseId = $selCourse;
        $conn = OpenCon();
        if(!isset($_COOKIE['statement'])) {
            setcookie('statement', json_encode(array($newState)), time()+360000, "/");
            getcookie('statement');
            $statements = array($newState);
        }
        else {
            $statements = json_decode($_COOKIE['statement'], false);
            $statements[] = $newState;
            setcookie('statement', json_encode($statements), time()+360000, "/");
            getcookie('statement');
        }
        //Case: User is not logged in
        $stateString = "";
        foreach($statements as $whichState) {
            $stateQuery = "SELECT Book.title, Course.courseName, Course.semester 
                            FROM Book, Course 
                            WHERE Book.bookId = '$whichState->bookId' and Course.courseId = '$whichState->courseId'";

            $stateResults = mysqli_query($conn, $stateQuery);
    
            if (mysqli_num_rows($stateResults) > 0) {
                while($row = mysqli_fetch_assoc($stateResults)) {
                    $stateString .= '<li>
                                    <div style="padding-bottom: 7%; border-bottom: 2px solid grey;" class="row">
                                    <div class="col-lg-2 d-md-none d-lg-block">
                                        <img class="mybookImage rounded" src="images/book.jpeg" alt="Book cover missing">
                                    </div>
                                    <div class="col-lg-1 d-md-none d-lg-block">
                                    </div>
                                    <div style="margin-top: 2%;" class="col-lg-6 col-md-9">
                                        <p style="font-size: 110%;">'. htmlspecialchars($row['title']) .'</p>
                                        <p>'. htmlspecialchars($row['courseName']) .'</p>
                                        <p>'. htmlspecialchars($row['semester']) .'ο εξάμηνο</p>
                                    </div>
                                    <div class="col-lg-3">
                                        <button onclick="deleteStatedBook(this.value)" value="' . $whichState->courseId .'" style="margin-top:60%;" class="btn btn-lg btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                    </div>
                                </li>'; 
                }
                
            }
            else {
                debug_to_console("NO COURSES");
            }
        }
        
        echo $stateString;

        CloseCon($conn);
        return $stateString;
    }

    function isStateCookieEmpty () {
        $retVal = -1;
        if(!isset($_COOKIE['statement'])) {
            $retVal = 1;
            echo $retVal;
            return $retVal;
        }
        else {
            $statements = json_decode($_COOKIE['statement'], false);
            if(empty($statements)) {
                $retVal = 1;
                echo $retVal;
                return $retVal;
            }
            else {
                $retVal = 0;
                echo $retVal;
                return $retVal;
            }
        }
    }

    function DeleteStatedBook($courseId) {
        $statements = json_decode($_COOKIE['statement'], true);
        
        for ($whichState = 0; $whichState < count($statements); $whichState++) {
            if($statements[$whichState]['courseId'] == $courseId) {
                debug_to_console("DELETED");
                unset($statements[$whichState]);
                $statements = array_values($statements);
                break;
            }
        }
        setcookie('statement', json_encode($statements), time()+360000, "/");

        if(empty($statements)) {
            echo '<p style=" font-size: 24px; text-align: center; margin-right: 10%; margin-top:10%;">Η δήλωση είναι κενή</p>';
        }
        else {
            $conn = OpenCon();
            $stateString = "";
            foreach($statements as $whichState) {
                $tempBookId = $whichState['bookId'];
                $tempCourseId = $whichState['courseId'];
                $stateQuery = "SELECT Book.title, Course.courseName, Course.semester 
                                FROM Book, Course 
                                WHERE Book.bookId = '$tempBookId' and Course.courseId = '$tempCourseId'";

                $stateResults = mysqli_query($conn, $stateQuery);
        
                if (mysqli_num_rows($stateResults) > 0) {
                    while($row = mysqli_fetch_assoc($stateResults)) {
                        $stateString .= '<li>
                                        <div style="padding-bottom: 7%; border-bottom: 2px solid grey;" class="row">
                                        <div class="col-lg-2 d-md-none d-lg-block">
                                            <img class="mybookImage rounded" src="images/book.jpeg" alt="Book cover missing">
                                        </div>
                                        <div class="col-lg-1 d-md-none d-lg-block">
                                        </div>
                                        <div style="margin-top: 2%;" class="col-lg-6 col-md-9">
                                            <p style="font-size: 110%;">'. htmlspecialchars($row['title']) .'</p>
                                            <p>'. htmlspecialchars($row['courseName']) .'</p>
                                            <p>'. htmlspecialchars($row['semester']) .'ο εξάμηνο</p>
                                        </div>
                                        <div class="col-lg-3">
                                            <button onclick="deleteStatedBook(this.value)" value="' . htmlspecialchars($tempCourseId) .'" style="margin-top:60%;" class="btn btn-lg btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                        </div>
                                    </li>'; 
                    }
                    
                }
                else {
                    debug_to_console("NO COURSES");
                }
            }
            CloseCon($conn);
            echo $stateString;
        }
    }

    function getcookie($name) {
        $cookies = [];
        $headers = headers_list();
        foreach($headers as $header) {
            if (strpos($header, 'Set-Cookie: ') === 0) {
                $value = str_replace('&', urlencode('&'), substr($header, 12));
                parse_str(current(explode(';', $value, 1)), $pair);
                $cookies = array_merge_recursive($cookies, $pair);
            }
        }
        return $cookies[$name];
    }

    function RefereshCookie() {
        $conn = OpenCon();
        setcookie('refreshCookie', "1", 360000, "/");
        return 0;
    }

    function CompleteStatement() {
        include("../classes/user.class.php");

        $statements = json_decode($_COOKIE['statement'], false);
        
        if(isset($_COOKIE['user'])) {
            $conn = OpenCon();
            $user = new User(0);
            $user  = unserialize($_COOKIE['user']);
            $oldStateId = -1;
            $userId = $user->getUserId();
            $sqlSelOldStatement = "SELECT statementId FROM Statement WHERE current=1 and User_userId='$userId'";
            $oldStatementRes = mysqli_query($conn, $sqlSelOldStatement);
            if (mysqli_num_rows($oldStatementRes) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($oldStatementRes)) {
                    $oldStateId = $row['statementId'];
                }
            } else {
                echo "0 results";
            }

            if($oldStateId != -1) {
                $sqlDelState = "DELETE FROM Statement where current=1 and User_userId='$userId'";
                $sqlDelStatedBooks = "DELETE FROM StatedBooks where Statement_statementId='$oldStateId'";

                $conn->query($sqlDelStatedBooks);
                $conn->query($sqlDelState);
            }
            
            
            $sqlInsState = "INSERT INTO Statement (semesterStatement, current, User_userId)
                        VALUES (5, 1, '$userId')";

            $conn->query($sqlInsState);
            $last_id = $conn->insert_id;

            foreach($statements as $whichState) {
                $insState = "INSERT INTO StatedBooks (bookId, courseId, Statement_statementId, Statement_User_userId)
                            VALUES ('$whichState->bookId', '$whichState->courseId', '$last_id', '$userId')";
                $conn->query($insState);
            }

            CloseCon($conn);

            $retVal = 1;
            echo $retVal;
            return $retVal;
        }
        else {
            $retVal = -1;
            echo $retVal;
            return $retVal;
        }

    }

    function UserType() {
        include("../classes/user.class.php");
        if(isset($_COOKIE['user'])) {
            $user = new User(0);
            $user  = unserialize($_COOKIE['user']);
            $userCat = $user->getCategory();
            echo $userCat;
            return $userCat;
        }
        else {
            $retVal = 0;
            echo $retVal;
            return $retVal;
        }
    }
?>