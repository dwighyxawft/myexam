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
                        <li class="nav-item pb-2"><a href="myaccount.php" class="nav-link">ABOUT</a></li>
                        <li class="nav-item pb-2"><a href="logout.php" class="nav-link">CONTACT</a></li>
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
        <div class="container">
            <div class="row">
                <div class="col-md-3 mt-4">
                   <a href="exams.php" style="text-decoration: none;">
                   <div class="cards rounded bg-warning">
                        <div class="w-50 bg-light rounded border border-1 border-warning"><h5 class="text-center text-warning py-2">All Exams</h5></div>
                        
                        <div class="pt-5 pb-2">
                            <div class="row">
                                <div class="col"> <i class="fa fa-gift fa-3x ps-3"></i></div>
                                <div class="col d-flex justify-content-end"> <h1 class="cards-text d-inline text-end text-light pe-4">
                                    <?php
                                            $exam->query = "SELECT * FROM exam_table";
                                            $total = $exam->total_rows();
                                            $data = 0;
                                            if($total > 0){
                                                $exam_result = $exam->query_all();
                                                foreach($exam_result as $exam_row){
                                                    $exam_id = $exam_row["exam_id"];
                                                    $exam_status = $exam_row["exam_status"];
                                                    if($exam_status == 'Created'){
                                                        $exam->query = "SELECT * FROM user_enroll_exam_table WHERE (offerer_id = '$user_id' OR enroller_id = '$user_id') AND exam_id = '$exam_id') AND (acceptance_status = 'pending' OR acceptance_status = 'accepted')";
                                                        $tot = $exam->total_rows();
                                                        if($tot < 1){
                                                           $data = $data + 1;
                                                        }
                                                    }
                                                }
                                                echo $data;
                                            }
                                          
                                    ?>
                                </h1></div>
                            </div>
                        </div>
                    </div>
                   </a>
                </div>
                <div class="col-md-3 mt-4">
                <a href="your_exams.php" style="text-decoration: none;">
                <div class="cards rounded bg-success">
                        <div class="w-50 bg-light rounded border border-1 border-success"><h5 class="text-center text-success py-2">Your Exams</h5></div>
                        <div class="pt-5 pb-2">
                            <div class="row">
                                <div class="col"> <i class="fa fa-book fa-3x ps-3"></i></div>
                                <div class="col d-flex justify-content-end"> <h1 class="cards-text d-inline text-end text-light pe-4">
                                    <?php
                                    $exam->query = "SELECT * FROM user_enroll_exam_table WHERE (offerer_id = '$user_id' OR enroller_id = '$user_id') AND (acceptance_status = 'pending' OR acceptance_status = 'accepted')";
                                    echo $exam->total_rows();
                                    ?>
                                </h1></div>
                            </div>
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-md-3 mt-4">
                    <a href="todays_exams.php" style="text-decoration: none;">
                    <div class="cards rounded bg-primary">
                        <div class="w-50 bg-light rounded border border-1 border-primary"><h5 class="text-center text-primary py-2">Today Exams</h5></div>
                        <div class="pt-5 pb-2">
                            <div class="row">
                                <div class="col"> <i class="fa fa-leaf fa-3x ps-3"></i></div>
                                <div class="col d-flex justify-content-end"> <h1 class="cards-text d-inline text-end text-light pe-4">
                                    <?php
                                    $exam->query = "SELECT * FROM user_enroll_exam_table WHERE (offerer_id = '$user_id' OR enroller_id = '$user_id') AND acceptance_status = 'accepted'";
                                    $result = $exam->query_all();
                                    $data = 0;
                                    foreach($result as $row){
                                        $exam_id = $row["exam_id"];
                                        $exam->query = "SELECT * FROM exam_table WHERE exam_id = '$exam_id'";
                                        $sub_row = $exam->query_result();
                                        if($sub_row["exam_status"] == "Started"){
                                            $data = $data + 1;
                                        }
                                    }
                                    echo $data;
                                    ?>
                                </h1></div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-md-3 mt-4">
                    <a href="completed_exams.php" style="text-decoration: none;">
                    <div class="cards rounded bg-dark">
                        <div class="w-50 bg-light rounded border border-1 border-dark"><h6 class="text-center text-dark py-2">Completed Exams</h6></div>
                        
                        <div class="pt-5 pb-2">
                            <div class="row">
                                <div class="col"> <i class="fa fa-list-alt fa-3x ps-3"></i></div>
                                <div class="col d-flex justify-content-end"> <h1 class="cards-text d-inline text-end text-light pe-4">
                                <?php
                                    $exam->query = "SELECT * FROM user_exam_takers_table WHERE user_id = '$user_id' AND user_exam_status = 'Sitted'";
                                    $result = $exam->total_rows();
                                   
                                    echo $result;
                                    ?>
                                </h1></div>
                            </div>
                        </div>
                    </div>
                     </a>
                </div>
            </div>
        </div>


      <div class="container-fluid mt-5 bg-light">
      <div class="container">
       <div class="table-responsive">
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


       </div>
      </div>

    </main>
    

    <footer class="bg-dark container-fluid d-flex justify-content-center align-items-center">
        <p class="text-center text-light pt-2">Xawft Corporations &copy; Copyrights Reserved</p>
    </footer>
    <script>
        $(document).ready(function(){
            $.ajax({
                url: "ajax_action.php",
                type: "post",
                data: {
                    page: "exam",
                    action: "get_ten_exams",
                    user_id: <?php echo $user_id;?>
                },
                dataType: "json",
                success: function(data){
                    $("#exam_table").html(data);
                }
            })
        });
    </script>
</body>
</html>