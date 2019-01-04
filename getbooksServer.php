<?php

    //$action = '';
    include("login.php");
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
        //debug_to_console("reach");
        $bookQuery = "SELECT * FROM `Book_has_Course`, `Book` 
                        WHERE Book_has_Course.Course_courseId = '$chosenCourse' 
                        and Book.bookId = Book_has_Course.Book_bookId";

        $bookResults = mysqli_query($conn, $bookQuery);

        $booksString = "";
        if (mysqli_num_rows($bookResults) > 0) {
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
                                    <div class="col-md-3">
                                    <button type="button" onclick="addBook(this.value)" value="'. htmlspecialchars($row['bookId']) . '"style="margin-top: 15%; box-shadow: 3px 3px 3px rgb(80, 78, 78);" class="btn shadow btn-success btn-lg">Προσθήκη</button>
                                    </div>
                                </div></li>';
            }
            
        }
        else {
            debug_to_console("NO COURSES");
        }
        CloseCon($conn);
        //debug_to_console($booksString);
        echo $booksString;
        return $booksString;
    }

    function UpdateCourses($chosenUni, $chosenDep, $chosenSem) {
        $conn = OpenCon();
        //debug_to_console("reach");
        $courseQuery = "SELECT * FROM `Course` WHERE uniName = '$chosenUni' AND uniDepartment='$chosenDep' AND semester = $chosenSem";

        $courseResults = mysqli_query($conn, $courseQuery);

        $optionsString = "";
        if (mysqli_num_rows($courseResults) > 0) {
            while($row = mysqli_fetch_assoc($courseResults)) {
                $optionsString .= '<option onclick="chooseCourse(this.value)" value="' . htmlspecialchars($row['courseId']) . '">' 
                . htmlspecialchars($row['courseName']) 
                . '</option>'; 
                //debug_to_console($row['uniDepartment']);
            }
            
        }
        else {
            debug_to_console("NO COURSES");
        }
        CloseCon($conn);
        //debug_to_console($optionsString);
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
            setcookie('statement', json_encode(array($newState)), time()+360000);
            $statements = array($newState);
        }
        else {
            $statements = json_decode($_COOKIE['statement'], false);
            $statements[] = $newState;
            setcookie('statement', json_encode($statements), time()+360000);
        }
        //Case: User is not logged in
        $stateString = "";
        foreach($statements as $whichState) {
            //debug_to_console("aaaa " . $whichState->bookId);
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
                                        <p>'. htmlspecialchars($row['semester']) .'</p>
                                    </div>
                                    <div class="col-lg-3">
                                        <button style="margin-top:60%;" class="btn btn-lg btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                    </div>
                                </li>'; 
                    //debug_to_console($row['uniDepartment']);
                }
                
            }
            else {
                debug_to_console("NO COURSES");
            }
        }
        CloseCon($conn);
        //debug_to_console($stateString);
        echo $stateString;
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
?>