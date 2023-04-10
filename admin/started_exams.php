<?php
include("../Examination.php");
$exam = new Examination;
$exam->admin_session_public();
$admin_id = $_SESSION["admin_id"];
$exam->query = "SELECT * FROM admin_table WHERE admin_id = '$admin_id'";
$row = $exam->query_result();
$exam->query = "SELECT * FROM exam_table WHERE admin_id = '$admin_id'";
$res = $exam->query_all();
$todays_date = date("Y-m-d");
$todays_time = date("H:i:s");
foreach($res as $rrr){
    $exam_date = $rrr["exam_date"];
    $exam_time = $rrr["exam_time"];
    $date = new DateTime($exam_date);
    $date->format("Y-m-d");
    $time = new DateTime($exam_time);
    $time->modify("+3 hours");
    $endtime = $time->format("H:i:s");
    $id = $rrr["exam_id"];
    $exam->query = "SELECT * FROM question_table WHERE exam_id = '$id'";
    $exam_questions = $exam->total_rows();
    $total_questions = $rrr["total_questions"];
   if($exam_questions == $total_questions && $todays_date < $exam_date){
       $exam->query = "UPDATE exam_table SET exam_status = 'Created' WHERE exam_id = '$id'";
       $exam->execute_query();
   }
   else{
    if($exam_date == $todays_date && ($todays_time >= $exam_time && $todays_time < $endtime)){
        $exam->query = "UPDATE exam_table SET exam_status = 'Started' WHERE exam_id = '$id'";
        $exam->execute_query();
    }
    elseif($exam_date == $todays_date && $todays_time >= $endtime){
        $exam->query = "UPDATE exam_table SET exam_status = 'Completed' WHERE exam_id = '$id'";
        $exam->execute_query();
    }
    elseif($todays_date > $exam_date){
        $exam->query = "UPDATE exam_table SET exam_status = 'Completed' WHERE exam_id = '$id'";
        $exam->execute_query();
    }
   
   }
 
 
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
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/home.css">
    <title>Xawft Quiz // All Exams</title>
</head>
<body>
<header>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <a href="#" class="navbar-brand ps-3"><img src="../images/myexam.png" width="170" height="34" alt="XawftQuiz Logo"></a>
            <button class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#links"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-end me-5">
            <ul class="navbar-nav nav nav-pills">
                        <li class="nav-item ps-2"><a href="myaccount.php" class="nav-link">ABOUT</a></li>
                        <li class="nav-item ps-2"><a href="logout.php" class="nav-link">CONTACT</a></li>
                        <li class="nav-item ps-2"><a href="dwighyxawft.github.io/port" class="nav-link">OTHER PROJECTS</a></li>
                        <li class="dropdown ps-2"><a href="#" data-bs-toggle="dropdown" class="dropdown-toggle"><img src="images/<?php echo $row["admin_image"];?>" alt="" class="img-fluid rounded-circle" width="40" height="40"></a>
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
                        <li class="nav-item pb-2"><a href="https://dwighyxawft.github.io/port" class="nav-link">OTHER PROJECTS</a></li>
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


    

    <div class="modal fade" id="modal1">
        <div class="modal-dialog">
            <div class="modal-content">
               <form class="needs-validation" method="post" id="form1">
               <div class="modal-header">
                    <h4 class="modal-title">XawftQuiz</h4>
                     <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body pt-3">
                    <div class="form-group mb-2">
                        <label>Exam Title</label>
                        <input class="form-control" required type="text" name="exam_title" id="exam_title">
                    </div>
                    <div class="form-group mb-2">
                        <label>Exam Date</label>
                        <input class="form-control" required type="date" name="exam_date" id="exam_date">
                    </div>
                    <div class="form-group mb-2">
                        <label>Exam Time</label>
                        <input class="form-control" required type="time" name="exam_time" id="exam_time">
                    </div>
                    <div class="form-group mb-2">
                        <label>Exam Duration</label>
                        <input class="form-control" required type="number" name="exam_duration" id="exam_duration">
                    </div>
                    <div class="form-group mb-2">
                        <label>Total Questions</label>
                        <input class="form-control" required type="number" name="total_questions" id="total_questions">
                    </div>
                    <div class="form-group mb-2">
                        <input type="hidden" name="page" id="page" value="exams">
                        <input type="hidden" name="action" value="add_exam" id="action">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success bg-success">Submit</button>
                    <button class="btn-danger btn bg-danger" data-bs-dismiss="modal">Close</button>
                </div>
               </form>
            </div>
        </div>
    </div>


  

      
        <div class="container">
            

            <button class="btn btn-md btn-primary bg-primary mt-4" data-bs-toggle="modal" data-bs-target="#modal1">Add Exam</button>
            <div class="table-responsive">
                <table class="table table-bordered border-primary mt-5 mb-5">
                    <thead>
                        <tr>
                            <th>Exam Title</th>
                            <th>Exam Date</th>
                            <th>Exam Time</th>
                            <th>Exam Duration</th>
                            <th>Total Questions</th>
                            <th>Enrolled Users</th>
                            <th>Marks Per Right Answer</th>
                            <th>Button Action</th>
                        </tr>
                    </thead>
                    <tbody id="table_data">
                     
                       
                    </tbody>
                </table>
            </div>
            <nav>
   <div class="w-50">
   <ul class="pagination pagination-md pb-5 pt-4" id="pagin">
       <?php
       
       $exam->query = "SELECT * FROM exam_table WHERE admin_id = '$admin_id' AND exam_status = 'Started'";
       $total_row = $exam->total_rows();
       $link = $total_row / 10;
       $all_links = ceil($link);
       for($i=0; $i<$all_links; $i++){
           $j = $i+1;
           $data = '<li class="page-item"><button class="page-link">'.$j.'</button></li>';
           echo $data;
       }?>
</ul>
   </div>
    </nav>
        </div>

        </div>
    </main>



    <footer class="bg-dark container-fluid d-flex justify-content-center align-items-center">
        <p class="text-center text-light pt-2">Xawft Corporations &copy; Copyrights Reserved</p>
    </footer>
    <script>
       $(document).ready(function(){
           function get_start_end(start){
                $.ajax({
               url: "ajax_action.php",
               type: "post", 
               data: {
                page: "exams",
                action: "get_started_exams",
                start: start
               },
               dataType: "json", 
               success: function(data){
                  $("#table_data").html(data.data);
                  console.log(data.start);
               }
            })
            }
            get_start_end(0);
          
            $(".page-link").on("click", function(){
                var value = $(this).text();
                var actual = value - 1;
                var search = actual * 10;
                console.log(search);
                get_start_end(search);
            });

            $("#form1").on("submit", function(e){
                e.preventDefault();
                $.ajax({
                    url: "ajax_action.php",
                    type: "post",
                    data: $(this).serialize(),
                    dataType: "json",
                    beforeSend: function(){
                        $("#modal1").modal("hide");
                    },
                    success: function(data){
                        alert(data.success);
                        get_start_end(0);
                    }
                })
            })
          
           
        })
    </script>
    <script>
        
    </script>
</body>
</html>