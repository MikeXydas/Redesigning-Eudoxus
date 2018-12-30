<head>
  <title>Εύδοξος - Σύνδεση</title>
  <link rel="icon" href="images/favicon.ico" type="image/ico">

  <link href="css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous"></head>
  <link href="css/gridLayouts.css" rel="stylesheet" type="text/css"  media="all">
  <link href="css/topPart.css" rel="stylesheet" type="text/css"  media="all">
  <link href="css/navBar.css" rel="stylesheet" type="text/css"  media="all">
  <link href="css/profileFoititi.css" rel="stylesheet" type="text/css"  media="all">
  <link href="css/footer.css" rel="stylesheet" type="text/css"  media="all">
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  
  
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/totop.js"></script>
  <script src="js/profileFoititi.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


  <!-- <script src="js/homepage.js"></script> -->

</head>

<body onload="setActive('profileManage', 'current', 'history')">
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-arrow-up"></i></button>
    <div class="container-fluid">
        <div class="row topPart">
            <div class="col-md-12">
                <div class="row topTopPart">
                    <div class="col-xl-1 col-lg-2">
                        <a class="logoDiv" href="homepageUrl"><img class="logo" src="images/logo.png" alt="Logo"><p class="logoText">Εύδοξος</p></a>
                    </div>
                    <div class="col-xl-8 d-lg-none d-xl-block">
                        <div class="row">
                        <div class="col">
                            <p class="tagline">Σύντομη πρόταση περιγραφής του ιστοχώρου</p>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col">
                        </div>
                        </div>
                    </div>
                    <div class="d-xl-none d-lg-block col-lg-4">
                    </div>
                    <div class="col-xl-1 col-lg-2">
                        <a href="Login" class="iconText" ><i class="fas fa-sign-in-alt topIcons"></i><p class="loginText">Είσοδος / Εγγραφή</p></a>
                    </div>
                    <div class="col-xl-1 col-lg-2">
                        <a class="iconText" href="Login"><i style="margin-left: 29%;" class="fas fa-user topIcons"></i><p class="loginText">Προφίλ</p></a>
                    </div>
                    <div class="col-xl-1 col-lg-2">
                        <a href="greekVersion"><img class="flag rounded" src="images/greek.png" alt="Greek flag"></a>
                        <a href="englishVersion"><img class="flag rounded" src="images/english.png" alt="Greek flag"></a>
                    </div>
                </div>
                <div class="row navBarRow">
                    <div class="col-12">
                        <nav class="navbar rounded navbar-expand-xl navbar-light bg-light">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                            <span style="color: black;" class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                            <ul class="navbar-nav mr-auto mt-2 mt-xl-0">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Αρχική</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Φοιτητής
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Δήλωση Συγγραμμάτων</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Αναζήτηση Συγγραμμάτων</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Επισκόπηση Δήλωσης</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Βοήθεια</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Εκδότης
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Καταχώρηση Συγγράμματος</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Διαχείρηση Συγγραμμάτων</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Βοήθεια</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Γραμματεία
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Σημεια Διανομής
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="#">Επικοινωνία</a>
                            </li>
                            </ul>
                            <form action="#" method="post" class="form-inline my-2 my-lg-0">
                            <input type="search" name="search" id="search" class="form-control mr-sm-2" placeholder="Τίτλος, πληροφορίες..." aria-label="Search">
                            <button class="btn btn-dark" type="submit">Αναζήτηση</button>
                            </form>
                        </div>
                        </nav>
                    </div>
                    </div>
                </div>
            </div>
        <div class="row breadcrumb">
            <div class="col-md-12">
                <ul class="breadcrumbT">
                <li><a href="#">Αρχική</a></li>
                <li><a href="#">Προφίλ</a></li>
                </ul>
            </div>
        </div>

        <div class="row">

            <div class="col-2"> </div>

            
            <div class="col-2" style="border-right: 1px solid grey"  >
                <div class="list-group menuCard" id="list-tab" role="tablist" >
                    <button onclick="activate(id, 'current', 'history')" class="list-group-item list-group-item-action active" id="profileManage" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Διαχείριση Προφίλ</button>
                    <button onclick="activate(id, 'profileManage', 'history')"class="list-group-item list-group-item-action" id="current" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Τρέχουσα Δήλωση</button>
                    <button onclick="activate(id, 'profileManage', 'current' )" class="list-group-item list-group-item-action"  id="history" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Ιστορικό Δηλώσεων</button>
                    
                </div>
            </div>
            <div class="col-1"></div>
            
            <div class="card profileCard">

                <div class="card-header"> Προφίλ </div>

                <div class="card-body">

                    <form>
                        <div class="form-group">
                            <label for="exampleInputName">Όνομα Χρήστη</label>
                            <input type="text" class="form-control" id="exampleInputName" value="AchilleasPap" autocomplete="off">
                            
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Νέος Κωδικός</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Νέος Κωδικός">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Επιβεβαίωση Νέου Κωδικού</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="">
                        </div>
                        <label for="selUni" >Σχολή:</label>
                        <select id="selUni" class="custom-select mb-3" >
                            <option id="defUni" value="0" selected>Εθνικό και Καποδιστριακό Πανεπιστήμιο Αθηνών - ΕΚΠΑ</option>
                            <option  value="1">Εθνικό Μετσόβιο Πολυτεχνείο -ΕΜΠ</option>
                            <option  value="2">Πανεπιστήμιο Πειραιώς</option>
                        </select>
                        <label for="selDep" >Τμήμα:</label>
                        <select id="selDep" class=" custom-select mb-3" >
                            <option id="defDep"  value="0" selected>Ιστορίας και Αρχαιολογίας</option>
                            <option  value="1">Πληροφορικής και Τηλεπικοινωνιών</option>
                            <option  value="2">Μαθηματικό</option>
                            <option  value="3">Φυσικό</option>
                        </select>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success saveBtn ">Αποθήκευση</button>
                        </div>
                    </form>


                </div>
                
            </div>

        </div>



    </div>


    <footer class="section footer-classic context-dark bg-image" style="background: #E7E7E7;">
        <div class="container">
          <div style="padding-top:5%; padding-bottom: 3%;" class="row row-30">
            <div style="border-right: 1px solid grey;" class="col-md-3 col-xl-4">
              <div class="pr-xl-3">
                <p class="footerHeader">Εύδοξος</p>
                <p class="rights"><span>©  </span><span class="copyright-year">2018</span><span> </span><span>Stavroula Iatropoulou, Mike Xydas</span><span>. </span><p>All Rights Reserved.</p></p>
              </div>
            </div>
            <div style="border-right: 1px solid grey; margin-left: 6%;" class="col-md-3">
              <h5>Επικοινωνία</h5>
              <dl class="contact-list">
                <dt>email επικοινωνίας:</dt>
                <dd><a href="mailto:#">help@eudoxos.com</a></dd>
              </dl>
              <dl class="contact-list">
                <dt>Τηλέφωνο:</dt>
                <dd><a href="tel:#">210-6711223</a>
                </dd>
              </dl>
            </div>
            <div style="margin-left: 5%;" class="col-md-4 col-xl-3">
              <h5>Σύνδεσμοι</h5>
              <ul class="nav-list">
                <li><a href="#">Φοιτητής</a></li>
                <li><a href="#">Εκδότης</a></li>
                <li><a href="#">Γραμματεία</a></li>
                <li><a href="#">Σημεία Διανομής</a></li>
                <li><a href="#">Πληροφορίες</a></li>
              </ul>
            </div>
          </div>
        </div>
    </footer>
</body>