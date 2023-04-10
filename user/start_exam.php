<?php
include("../Examination.php");
$exam = new Examination;
$admin_id = $_GET["enroller_id"];
$exam_id = $_GET["exam_id"]; 
$exam->user_session_public();
$user_id = $_SESSION["user_id"];
$exam->query = "SELECT * FROM user_table WHERE user_id = '$user_id'";
$row = $exam->query_result();
$exam->query = "SELECT * FROM exam_table WHERE exam_id = '$exam_id'";
$res = $exam->query_result();
$todays_date = date("Y-m-d");
$todays_time = date("H:i:s");
$admin_id = $res["admin_id"];
$exam->query = "SELECT * FROM user_exam_takers_table WHERE user_id = '$user_id' AND exam_id = '$exam_id' AND (admin_id = '$admin_id')";
$takers_row = $exam->total_rows();
if($takers_row < 1){
    $exam->query = "INSERT INTO user_exam_takers_table(user_id, exam_id, admin_id, commencement_time, user_exam_status) VALUES('$user_id', '$exam_id', '$admin_id', NOW(), 'Sitting')";
    $exam->execute_query();
}
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
    <title>Xawft Quiz // User Start Exam</title>
</head>
<body>
<style>
        main{
            min-height: 100vh;
        }
    </style>
    <header>
        <nav class="navbar navbar-expand bg-dark navbar-dark">
            <a href="#" class="navbar-brand ps-3"><img src="../images/myexam.png" width="170" height="34" alt="XawftQuiz Logo"></a>
            <button class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#links"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-end me-5">
            <ul class="navbar-nav nav nav-pills">
                    <li class="nav-item ps-2">If you have taken the exam. Do not bother to take it again</li>
                        <li class="nav-item ps-2"><h6 id="timer" class="text-light"></h6></li>
                        <li class="nav-item ps-2"><button class="nav-link btn btn-success bg-success submit_exam">End Exam</button></li>
                    </ul>
            </div>
         
        </nav>
    </header>

       

        <main>


       <div class="container-fluid bg-light">
       <div class="container my-5 py-5">
            <div class="w-75 mx-auto" id="question">
                <div class="card">
                   <form id="question_form" method="post">
                
                   </form>
                </div>
            </div>
            <ul class="pagination pt-5 mt-5">
            <?php
                                            $exam->query = "SELECT * FROM question_table WHERE exam_id = '$exam_id'";
                                            $total_row = $exam->total_rows();
                                            $data = 0;
                                            if($total_row > 0){                                      
                                                $link = $total_row;
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
                <?php
                    if(($res["exam_date"] == $todays_date && $res["exam_time"] == $todays_time) || $res["exam_status"] == "Started"){
                        $exam_dur = $res["exam_duration"];
                    ?>
                    var mins = Number(<?php echo $exam_dur;?>);
                    var secs = 00;
                    var timer = setInterval(function(){
                       secs = secs - 1;
                       if(secs == -1){
                        secs = 59;
                        mins = mins - 1;
                       }
                       if(mins == 0 && secs == 0){
                        clearInterval(timer);
                       submit_exam();
                       }
                       $("#timer").text(mins + ":" + secs);
                    } ,1000);



                  
                    <?php
                    }

                    ?>
                     function question(start){
                        $.ajax({
                            url:"ajax_action.php",
                            type:"post",
                            data:{
                                page: "question",
                                action: "show_question",
                                exam_id : <?php echo $exam_id;?>,
                                user_id : <?php echo $user_id; ?>,
                                start: start
                            },
                            dataType: "json",
                            success: function(data){
                                $("#question_form").html(data.question);
                            }
                        })
                        } 
                        question(0);  
                        var input;
                      
                    $("#question_form").on("submit", function(e){
                        e.preventDefault();
                        $.ajax({
                            url : "ajax_action.php",
                            type:"post",
                            data: $(this).serialize(),
                            dataType: "json",
                            success: function(data){
                                input = Number(data.start)+1;
                                console.log(input);
                                question(input);
                            }
                        })
                    });
                    var admin_id = <?php echo $admin_id;?>;
                    var exam_id = <?php echo $exam_id;?>;
                    $(".page-link").on("click", function(){
                        var value = Number($(this).text());
                        var act_val = value - 1;
                        question(act_val);
                    })

                    $(".submit_exam").on("click", function(){
                       clearInterval(timer);
                       submit_exam();
                    })

                    var entries = {
                                exam_id: <?php echo $exam_id;?>,
                                user_id: <?php echo $user_id;?>,
                                admin_id: <?php echo $admin_id;?>
                    }
                    function submit_exam(){
                        $.ajax({
                            url: "ajax_action.php",
                            type: "post",
                            data: {
                                page:"exam",
                                action: "submit_exam",
                                exam_id: <?php echo $exam_id;?>,
                                user_id: <?php echo $user_id;?>,
                                admin_id: <?php echo $admin_id;?>
                            },
                            dataType: "json",
                            success: function(data){
                                if(data.status == true){
                                    location.href = "completed_exams.php";
                                }
                            }
                        })
                    }
                   
            })
        </script>







</body>
</html>