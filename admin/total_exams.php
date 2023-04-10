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


  

        <div class="container-fluid bg-light mt-3">
            <div class="container">
                <div class="row">
                    
                <div class="col-md-3 mt-4">
                   <a href="pending_exams.php" style="text-decoration: none;">
                   <div class="cards rounded bg-warning">
                        <div class="w-50 bg-light rounded border border-1 border-warning"><h5 class="text-center text-warning py-2">Pending Exams</h5></div>
                        
                        <div class="pt-5 pb-2">
                            <div class="row">
                                <div class="col"> <i class="fa fa-circle fa-3x ps-3"></i></div>
                                <div class="col d-flex justify-content-end"> <h1 id="pend_title" class="cards-text d-inline text-end text-light pe-4">
                                <?php
                                    $exam->query = "SELECT * FROM exam_table WHERE admin_id = '$admin_id' AND exam_status = 'Pending'";
                                    $total_row = $exam->total_rows();

                                    echo $total_row;
                                    
                                    ?>
                                </h1></div>
                            </div>
                        </div>
                    </div>
                   </a>
                </div>

                <div class="col-md-3 mt-4">
                   <a href="created_exams.php" style="text-decoration: none;">
                   <div class="cards rounded bg-success">
                        <div class="w-50 bg-light rounded border border-1 border-success"><h5 class="text-center text-success py-2">Created Exams</h5></div>
                        
                        <div class="pt-5 pb-2">
                            <div class="row">
                                <div class="col"> <i class="fa fa-square fa-3x ps-3"></i></div>
                                <div class="col d-flex justify-content-end"> <h1 id="create_title" class="cards-text d-inline text-end text-light pe-4">
                                <?php
                                    $exam->query = "SELECT * FROM exam_table WHERE admin_id = '$admin_id' AND exam_status = 'Created'";
                                    $total_row = $exam->total_rows();

                                    echo $total_row;
                                    
                                    ?>
                                </h1></div>
                            </div>
                        </div>
                    </div>
                   </a>
                </div>


                <div class="col-md-3 mt-4">
                   <a href="started_exams.php" style="text-decoration: none;">
                   <div class="cards rounded bg-primary">
                        <div class="w-50 bg-light rounded border border-1 border-primary"><h5 class="text-center text-primary py-2">Started Exams</h5></div>
                        
                        <div class="pt-5 pb-2">
                            <div class="row">
                                <div class="col"> <i class="fa fa-user fa-3x ps-3"></i></div>
                                <div class="col d-flex justify-content-end"> <h1 id="start_title" class="cards-text d-inline text-end text-light pe-4">
                                <?php
                                    $exam->query = "SELECT * FROM exam_table WHERE admin_id = '$admin_id' AND exam_status = 'Started'";
                                    $total_row = $exam->total_rows();

                                    echo $total_row;
                                    
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
                                    $exam->query = "SELECT * FROM exam_table WHERE admin_id = '$admin_id' AND exam_status = 'Completed'";
                                    $total_row = $exam->total_rows();

                                    echo $total_row;
                                    
                                    ?>
                                </h1></div>
                            </div>
                        </div>
                    </div>
                   </a>
                </div>

                </div>
            </div>
        <div class="container">
            

            <button class="btn btn-md btn-success bg-success mt-4" data-bs-toggle="modal" data-bs-target="#modal1">Add Exam</button>
            <div class="table-responsive">
                <table class="table table-bordered border-success mt-5 mb-5">
                    <thead>
                        <tr>
                            <th>Exam Title</th>
                            <th>Exam Date</th>
                            <th>Exam Time</th>
                            <th>Exam Duration</th>
                            <th>Total Questions</th>
                            <th>Enrolled Users</th>
                            <th>Marks Per Right Answer</th>
                            <th>Exam Status</th>
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
       
       $exam->query = "SELECT * FROM exam_table WHERE admin_id = '$admin_id'";
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
                action: "get_total_exams",
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