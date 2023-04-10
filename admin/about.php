<?php
include("../Examination.php");
$exam = new Examination;
$exam->admin_session_public();
$admin_id = $_SESSION["admin_id"];
$exam->query = "SELECT * FROM admin_table WHERE admin_id = '$admin_id'";
$row = $exam->query_result();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/popper2.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Xawft Web Designs // About</title>
</head>
<body>
    <header>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <a href="#" class="navbar-brand ps-3"><img src="../images/myexam.png" width="170" height="34" alt="XawftQuiz Logo"></a>
            <button class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#links"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-end me-5">
            <ul class="navbar-nav nav nav-pills">
                        <li class="nav-item ps-2"><a href="home.php" class="nav-link">HOME</a></li>
                        <li class="nav-item ps-2"><a href="contact.php" class="nav-link">CONTACT</a></li>
                        <li class="nav-item ps-2"><a href="dwighyxawft.github.io/port" class="nav-link">OTHER PROJECTS</a></li>
                        <li class="dropdown ps-2"><a href="#" data-bs-toggle="dropdown" class="dropdown-toggle"><img src="../images/<?php echo $row["admin_image"];?>" alt="" class="img-fluid rounded-circle" width="40" height="40"></a>
                        <ul class="dropdown-menu">
                            <li><a href="myaccount.php" class="dropdown-item">ACCOUNT</a></li>
                            <li><a href="logout.php" class="dropdown-item">LOGOUT</a></li>
                        </ul>
                    </li>
                    </ul>
            </div>
            <div class="offcanvas offcanvas-end bg-dark" id="links">
                <div class="offcanvas-header">
                    <h4 class="offcanvas-title text-light">XawftQuiz</h4>
                    <button class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body ps-4 pt-2">
                    <ul class="navbar-nav nav">
                        <li class="nav-item pb-2"><a href="home.php" class="nav-link">HOME</a></li>
                        <li class="nav-item pb-2"><a href="contact.php" class="nav-link">CONTACT</a></li>
                        <li class="nav-item pb-2"><a href="dwighyxawft.github.io/port" class="nav-link">OTHER PROJECTS</a></li>
                        <li class="dropdown"><a href="#" data-bs-toggle="dropdown" class="dropdown-toggle"><img src="../images/<?php echo $row["admin_image"];?>" alt="" class="img-fluid rounded-circle" width="40" height="40"></a>
                        <ul class="dropdown-menu">
                            <li><a href="myaccount.php pb-2" class="dropdown-item">ACCOUNT</a></li>
                            <li><a href="logout.php pb-2" class="dropdown-item">LOGOUT</a></li>
                        </ul>
                    </li>
                    </ul>
                </div>
            </div>
        </nav>
    
      </header>

      <main>
          <div class="container">
              <div class="card mt-5">
                  <div class="card-header"><h3 class="card-title ps-3">Xawft Groups Ltd</h3></div>
                  <div class="card-body">
                      <div class="row">
                          <div class="col-md-4 col-sm-12">
                              <img id="image" src="images/IMG-20200116-WA0091.jpg" alt="No image">
                          </div>
                          <div class="col-md-8 col-sm-12">
                            <p class="card-text ps-3">
                                Xawft Groups Of Companies is a dedicated company of web developers that continue to work to grow the use of the internet. The world is a large place, and we figured out that a large number of people from far distances need to communicate with each other, though, there are large number of websites that help in communication but others lack lots of features. That is why we decided to introduce you to xawftchat: 
                                A website for chatting, video calling, voice calling, for watching youtube videos that are used in e-learning. We are interested in making the world a better and interesting place for all by making communications easier. So far, a total of 450 projects has been completed by the company. You can meet some of our <a href="#executives">executives</a>
                            </p>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="row">
                  <div class="col-md-10">
                    <div class="card mt-4">
                        <div class="card-header"><h3 class="card-title ps-4">Our Projects</h3></div>
                        <div class="card-body">
                           <div class="row">
                               <div class="col-md-4 col-sm-12">
                                <ul class="list-group">
                                    <li class="list-group-item">Grade Point Calculator</li>
                                    <li class="list-group-item">Calculator</li>
                                    <li class="list-group-item">WhiteBoard</li>
                                    <li class="list-group-item">Landing Page</li>
                                    <li class="list-group-item">Clock</li>
                                </ul>
                               </div>
                               <div class="col-md-4 col-sm-12">
                                <ul class="list-group">
                                    <li class="list-group-item">Snake Game</li>
                                    <li class="list-group-item">Messaging Website</li>
                                    <li class="list-group-item">Mailing Website</li>
                                    <li class="list-group-item">Shopping Website</li>
                                    <li class="list-group-item">Online Exam Website</li>
                                </ul>
                               </div>
                               <div class="col-md-4 col-sm-12">
                                <ul class="list-group">
                                    <li class="list-group-item">XawftChat Social Media</li>
                                    <li class="list-group-item">XawftChat Video Call</li>
                                    <li class="list-group-item">XawftChat Voice Call</li>
                                    <li class="list-group-item">XawftChat Group Call</li>
                                    <li class="list-group-item">XawftChat Messaging</li>
                                </ul>
                               </div>
                           </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-2"></div>
              </div>

              <div class="row mt-4" id="executives">
                  <div class="col-md-4">
                      <div class="card">
                         <img src="images/IMG-20200622-WA0038.jpg" alt="No Image" class="card-img-top">
                          <div class="card-body text-center">
                              <h4 class="pt-4">Timilehin Amu</h4>
                              <p class="pt-3">Web Developer</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="card">
                          <img src="images/IMG-20200622-WA0038.jpg" alt="No Image" class="card-img-top">
                          <div class="card-body text-center">
                            <h4 class="pt-4">Timilehin Amu</h4>
                            <p class="pt-3">Web Designer</p>
                        </div>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="card">
                          <img src="images/IMG-20200622-WA0038.jpg" alt="No Image" class="card-img-top">
                          <div class="card-body text-center">
                            <h4 class="pt-4">Timilehin Amu</h4>
                            <p class="pt-3">UI/UX Designer</p>
                        </div>
                      </div>
                  </div>
              </div>

          </div>
      </main>

      
      <footer class="d-flex align-items-center justify-content-center mt-4 bg-secondary text-light">
        <p>Xawft Companies Nigeria Ltd. &copy; Copyrights Reserved</p>
    </footer>
</body>
</html>