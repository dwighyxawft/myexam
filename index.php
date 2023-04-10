


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="Admin, User, Signup, Login, XawftQuiz, Xawft, Quiz">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Xawft Quiz</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <a href="#" class="navbar-brand ps-3 pt-3 pb-3"><img src="images/myexam.png" width="170" height="34" alt="XawftQuiz Logo"></a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navLinks"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse me-5 justify-content-end" id="navLinks">
                <ul class="navbar-nav nav">
                    <li class="nav-item"><a href="#about" class="nav-link">ABOUT</a></li>
                    <li class="nav-item"><a href="#admin" class="nav-link">ADMIN</a></li>
                    <li class="nav-item"><a href="#users" class="nav-link">LOGIN </a></li>
                    <li class="nav-item"><a href="#users" class="nav-link">SIGNUP</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <div id="about" class="container-fluid d-flex align-items-center justify-content-center">
            <div class="carousel slide w-50" data-bs-ride="carousel" id="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <p class="text-center">Xawft Corporations founded by Amu Oladipupo Oluwatimilehin is a group of companies that deals with development of softwares, websites and desktop applications. One of our latest Web applications happens to be XawftQuiz.</p> 
                    </div>
                    <div class="carousel-item">
                        <p class="text-center">XawftQuiz is an online exam platform where teachers can set exam questions
                        and set an online examination for students to participate. You can also enroll for other schools or corporations exam form for free.</p> 
                    </div>
                    <div class="carousel-item">
                        <p class="text-center">No cost applies for registration and login. No cost applies for setting exam questions for admins. and no cost applies for enrolling for exams and taking part in exams. It is all free of cost and charge. No cost apply</p> 
                    </div>
                
                </div>
            </div>
        </div>
        <div id="users">
            <div class="rgba container-fluid d-flex justify-content-center">
               <div class="w-50">
               <h5 class="text-center pt-5">We are what we are. You can signup or login to our website to enjoy unlimited experience of examinations and quizzes. Enjoy</h5>

               <div class="links mt-5">
                   <p class="text-center pt-5"><a href="user/login.php" class="user_login">LOGIN</a>&nbsp;&nbsp;&nbsp;<a href="user/signup.php" class="user_signup">SIGNUP</a></p>
               </div>
               </div>

            </div>
        </div>
        <div id="admin" class="container-fluid d-flex justify-content-center">
        <div class="w-50">
               <h5 class="text-center pt-5">You can also signup as an admin. Make Exams and grade your students
                according to the marks they obtained</h5>

               <div class="links mt-5">
                   <p class="text-center pt-5"><a href="admin/login.php" class="admin_login">LOGIN</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="admin/signup.php" class="admin_signup">SIGNUP</a></p>
               </div>
               </div>
        </div>


    </main>

    <footer class="bg-dark container-fluid d-flex justify-content-center align-items-center">
        <p class="text-center text-light pt-2">Xawft Corporations &copy; Copyrights Reserved</p>
    </footer>
</body>
</html>