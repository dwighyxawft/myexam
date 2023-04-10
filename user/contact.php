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
    <title>Xawft Web Designs // Services</title>
</head>
<body>
    <header>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <a href="#" class="navbar-brand ps-3"><img src="../images/myexam.png" width="170" height="34" alt="XawftQuiz Logo"></a>
            <button class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#links"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-end me-5">
            <ul class="navbar-nav nav nav-pills">
                        <li class="nav-item ps-2"><a href="about.php" class="nav-link">ABOUT</a></li>
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
                        <li class="nav-item pb-2"><a href="about.php" class="nav-link">ABOUT</a></li>
                        <li class="nav-item pb-2"><a href="home.php" class="nav-link">HOME</a></li>
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
            <div class="d-none align-items-center mt-3 alert alert-dismissible alert-success">
                <button class="btn-close" data-bs-dismiss="alert"></button>
                <p class="ps-4" id="text"></p>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card mt-4">
                        <div class="card-header"><h4 class="card-title ps-2 pt-2 pb-2">Full Stack Web Development</h4></div>
                        <div class="card-body">
                            <p class="card-text pt-3 px-4 pb-3">
                               We make websites that have a good user interface, and user rate us 5 star for the experience they have in the websites we build. 
                               <ul class="list-group">
                                   <li class="list-group-item">Web Design</li>
                                   <li class="list-group-item">Web Development</li>
                                   <li class="list-group-item">Web Hosting</li>
                               </ul>
                            </p>
                        </div>
                    </div>
    
                    <div class="card mt-3">
                        <div class="card-header">
                            <h4 class="card-title ps-2 pt-2 pb-2">Web Tutorials</h4>
                        </div>
                        <div class="card-body">
                            <p class="card-text pt-3 px-4 pb-3">We also offer website lectures for beginner, intermediate and advanced web developers. We Offer</p>
                            <ul class="list-group">
                                <li class="list-group-item">Frontend Web Development(HTML, CSS, Javascript, Bootstrap)</li>
                                <li class="list-group-item">Backend Web Development(PHP, Mysql)</li>
                                <li class="list-group-item">Backend Web Development(Nodejs, MongoDB)</li>
                                <li class="list-group-item">Web UI/UX Designing</li>
                                <li class="list-group-item">Web Hosting</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4">
                    <form action="" method="post" id="form1">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title ps-2 pt-2 pb-2">Send Us a Message</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group mt-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="mail">Email</label>
                                    <input type="email" name="mail" id="mail" class="form-control">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="msg">Message</label>
                                    <textarea name="msg" id="msg" cols="30" rows="4" class="form-control"></textarea>
                                </div>
                                <div class="form-group mt-4">
                                    <center><button type="submit" name="send" class="btn btn-success"><i class="fa fa-send"></i> Send</button></center>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
      </main>

      <footer class="d-flex align-items-center justify-content-center mt-4 bg-secondary text-light">
        <p>Xawft Companies Nigeria Ltd. &copy; Copyrights Reserved</p>
    </footer>

    <?php
    if(isset($_POST["send"])){
        $name = $_POST["name"];
        $mail = $_POST["mail"];
        $msgs = $_POST["msg"];
        $to = "amuooladipupo@gmail.com";
        $subject = "Message From ".$name."";
        mail($to, $subject, $msgs, $mail);
    }
    
    
    
    
    ?>
     
    
</body>
</html>