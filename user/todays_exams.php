<?php
include("../Examination.php");
$exam = new Examination;
$exam->user_session_public();
$user_id = $_SESSION["user_id"];
$exam->query = "SELECT * FROM user_table WHERE user_id = '$user_id'";
$row = $exam->query_result();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="admin, Signup, Login, XawftQuiz, Xawft, Quiz">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/popper2.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/user.css">
    <link rel="stylesheet" href="css/home.css">
    <title>Xawft Quiz // User Home</title>
</head>
<body>
    <style>
        main{
            min-height: 100vh;
        }
    </style>
    <header>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <a href="#" class="navbar-brand ps-3"><img src="../images/myexam.png" width="170" height="34" alt="XawftQuiz Logo"></a>
            <button class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#links"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-end me-5">
            <ul class="navbar-nav nav nav-pills">
                        <li class="nav-item ps-2"><a href="about.php" class="nav-link">ABOUT</a></li>
                        <li class="nav-item ps-2"><a href="contact.php" class="nav-link">CONTACT</a></li>
                        <li class="nav-item ps-2"><a href="dwighyxawft.github.io/port" class="nav-link">OTHER PROJECTS</a></li>
                        <li class="dropdown ps-2"><a href="#" data-bs-toggle="dropdown" class="dropdown-toggle"><img src="images/<?php echo $row["user_image"];?>" alt="" class="img-fluid rounded-circle" width="40" height="40"></a>
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
                        <li class="nav-item pb-2"><a href="contact.php" class="nav-link">CONTACT</a></li>
                        <li class="nav-item pb-2"><a href="dwighyxawft.github.io/port" class="nav-link">OTHER PROJECTS</a></li>
                        <li class="dropdown"><a href="#" data-bs-toggle="dropdown" class="dropdown-toggle"><img src="images/<?php echo $row["user_image"];?>" alt="" class="img-fluid rounded-circle" width="40" height="40"></a>
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
      

                            
      <div class="container-fluid mt-5 bg-light">
      <div class="container">
       <div class="table-responsive">
           <h2 class="py-3 text-center">If you have taken the exam, Do not bother to retake the exams</h2>
            <table class="table table-hover table-bordered border-primary mt-5 mb-5">
                <thead>
                   
                    <tr>
                        
                        <th>Exam Title</th>
                        <th>Exam Date</th>
                        <th>Exam Time</th>
                        <th>Exam Duration</th>
                        <th>Total Questions</th>
                        <th>Enrolled Users</th>
                        <th>Marks Per Right Answers</th>
                        <th>Button Status</th>
                    </tr>
                </thead>
                <tbody id="exam_table">
                   
                  
                </tbody>
            </table>
        </div>

       
       
<ul class="pagination pagination-md pb-5 pt-4 accepted_exam">
        <?php
                                            $exam->query = "SELECT * FROM user_enroll_exam_table WHERE (offerer_id = '$user_id' OR enroller_id = '$user_id') AND acceptance_status = 'accepted'";
                                            $total_row = $exam->total_rows();
                                            $data = 0;
                                            if($total_row > 0){
                                                $result = $exam->query_all();
                                              
                                                $link = $total_row / 10;
                                                $all_links = ceil($link);
                                                for($i=0; $i<$all_links; $i++){
                                                    $j = $i+1;
                                                    $data = '<li class="page-item"><button class="page-link">'.$j.'</button></li>';
                                                    echo $data;
                                                }
                                            }
                                    ?>
</ul>


       </div>
      </div>

    </main>
    

    <footer class="bg-dark container-fluid d-flex justify-content-center align-items-center">
        <p class="text-center text-light pt-2">Xawft Corporations &copy; Copyrights Reserved</p>
    </footer>
    <script>
        $(document).ready(function(){
        
            function get_exams(start, request){
                $.ajax({
                url: "ajax_action.php",
                type: "post",
                data: {
                    page: "exam",
                    action: "get_todays_exams",
                    request: request,
                    user_id: <?php echo $user_id;?>,
                    start: start
                },
                dataType: "json",
                success: function(data){
                    $("#exam_table").html(data);
                }
            })
            }
            get_exams(0, 'accepted');
            
           
           
            $("ul.accepted_exams button").click(function(){
                var value = $(this).text();
                var actual = value - 1;
                var search = actual * 10;
                console.log(search);
                get_exams(search, "accepted");
            })
        });
    </script>
</body>
</html>