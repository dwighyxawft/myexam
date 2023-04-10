<?php
include("../Examination.php");
$exam = new Examination;
$exam->admin_session_public();
$admin_id = $_SESSION["admin_id"];
$exam->query = "SELECT * FROM admin_table WHERE admin_id = '$admin_id'";
$row = $exam->query_result();
if(!isset($_GET["exam_id"])){
    echo $exam->redirect("admin/total_exams.php");
  }
  else{
      $exam_id = $_GET["exam_id"];
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
    <title>Xawft Quiz // Admin Home</title>
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
            <div class="row">
                <div class="col-md-3 mt-4">
                <button class="all_users w-100 border border-0">
                   <div class="cards rounded bg-primary">
                        <div class="w-50 bg-light rounded border border-1 border-primary"><h5 class="text-center text-primary py-2">All Users</h5></div>
                        
                        <div class="pt-5 pb-2">
                            <div class="row">
                                <div class="col"> <i class="fa fa-users fa-3x"></i></div>
                                <div class="col d-flex justify-content-end"> <h1 class="cards-text d-inline text-end text-light pe-4">
                                <?php
                                    $exam->query = "SELECT * FROM user_table";
                                    $total_row = $exam->total_rows();
                                    $query_row = $exam->query_all();
                                    $nums = 0;
                                    foreach($query_row as $q_row){
                                        $user_id = $q_row["user_id"];
                                        $exam->query = "SELECT * FROM user_enroll_exam_table WHERE (((offerer_id = '$user_id' AND enroller_id = '$admin_id') OR (offerer_id = '$admin_id' AND enroller_id = '$user_id')) AND exam_id = '$exam_id') AND (acceptance_status = 'pending' OR acceptance_status = 'accepted')";
                                        if($exam->total_rows() > 0){
                                            $nums = $nums;
                                        }
                                        else{
                                            $nums = $nums + 1;
                                        }
                                    }

                                    echo $nums;
                                    
                                    ?>
                                </h1></div>
                            </div>
                        </div>
                    </div>
</button>
                </div>
                <div class="col-md-3 mt-4">
                <button class="pend_users w-100 border border-0">
                <div class="cards rounded bg-warning">
                        <div class="w-50 bg-light rounded border border-1 border-warning"><h5 class="text-center text-warning py-2">Pended Users</h5></div>
                        <div class="pt-5 pb-2">
                            <div class="row">
                                <div class="col"> <i class="fa fa-user fa-3x"></i></div>
                                <div class="col d-flex justify-content-end"> <h1 class="cards-text d-inline text-end text-light pe-4">
                                <?php
                                    $exam->query = "SELECT * FROM user_enroll_exam_table WHERE enroller_id = '$admin_id' AND (acceptance_status = 'pending' AND exam_id = '$exam_id')";
                                    $total_row = $exam->total_rows();

                                    echo $total_row;
                                    
                                    ?>
                                </h1></div>
                            </div>
                        </div>
                    </div>
</button>
                </div>
                <div class="col-md-3 mt-4">
                <button class="pend_offers w-100 border border-0">
                <div class="cards rounded bg-danger">
                        <div class="w-50 bg-light rounded border border-1 border-danger"><h5 class="text-center text-danger py-2">Pended Offers</h5></div>
                        <div class="pt-5 pb-2">
                            <div class="row">
                                <div class="col"> <i class="fa fa-user fa-3x"></i></div>
                                <div class="col d-flex justify-content-end"> <h1 class="cards-text d-inline text-end text-light pe-4">
                                <?php
                                    $exam->query = "SELECT * FROM user_enroll_exam_table WHERE offerer_id = '$admin_id' AND (acceptance_status = 'pending' AND exam_id = '$exam_id')";
                                    $total_row = $exam->total_rows();

                                    echo $total_row;
                                    
                                    ?>
                                </h1></div>
                            </div>
                        </div>
                    </div>
</button>
                </div>
                <div class="col-md-3 mt-4">
               <button class="accepted_users w-100 border border-0">
               <div class="cards rounded bg-success">
                        <div class="w-50 bg-light rounded border border-1 border-success"><h5 class="text-center text-success py-2"> Accepted Users</h5></div>
                        
                        <div class="pt-5 pb-2">
                            <div class="row">
                                <div class="col"> <i class="fa fa-circle fa-3x"></i></div>
                                <div class="col d-flex justify-content-end"> <h1 class="cards-text d-inline text-end text-light pe-4">
                                <?php
                                    $exam->query = "SELECT * FROM user_enroll_exam_table WHERE (offerer_id = '$admin_id' OR enroller_id = '$admin_id') AND (acceptance_status = 'accepted' AND exam_id = '$exam_id')";
                                
                                    $total_row = $exam->total_rows();

                                    echo $total_row;
                                    
                                    ?>
                                </h1></div>
                            </div>
                        </div>
                    </div>
</button>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-5 bg-light">
      <div class="container">
          <h4 class="text-center pt-5 pb-2 text-secondary">Latest Updated Exams</h4>
       <div class="table-responsive">
            <table class="table table-hover table-bordered border-secondary mt-5 mb-5">
                <thead>
                    <tr>
                       
                        <th>User Image</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>User Address</th>
                        <th>Exam Title</th>
                        <th>Total Questions</th>
                        <th>Button Action</th>
                    </tr>
                </thead>
                <tbody id="table_data">
           
             
                </tbody>
            </table>
        </div>

        <ul class="pagination pagination-md pb-5 pt-4 all_users">
       <?php
       
       $exam->query = "SELECT * FROM user_table";
       $total_row = $exam->total_rows();
       $link = $total_row / 10;
       $all_links = ceil($link);
       for($i=0; $i<$all_links; $i++){
           $j = $i+1;
           $data = '<li class="page-item"><button class="page-link">'.$j.'</button></li>';
           echo $data;
       }?>
</ul>
<ul class="pagination pagination-md pb-5 pt-4 pend_users">
       <?php
       
       $exam->query = "SELECT * FROM user_enroll_exam_table WHERE enroller_id = '$admin_id' AND (acceptance_status = 'pending' AND exam_id = '$exam_id')";
       $total_row = $exam->total_rows();
       $link = $total_row / 10;
       $all_links = ceil($link);
       for($i=0; $i<$all_links; $i++){
           $j = $i+1;
           $data = '<li class="page-item"><button class="page-link">'.$j.'</button></li>';
           echo $data;
       }?>
</ul>
<ul class="pagination pagination-md pb-5 pt-4 pend_offers">
       <?php
       
       $exam->query = "SELECT * FROM user_enroll_exam_table WHERE offerer_id = '$admin_id' AND (acceptance_status = 'pending' AND exam_id = '$exam_id')";
       $total_row = $exam->total_rows();
       $link = $total_row / 10;
       $all_links = ceil($link);
       for($i=0; $i<$all_links; $i++){
           $j = $i+1;
           $data = '<li class="page-item"><button class="page-link">'.$j.'</button></li>';
           echo $data;
       }?>
</ul>
<ul class="pagination pagination-md pb-5 pt-4 accepted_users">
       <?php
       
       $exam->query = "SELECT * FROM user_enroll_exam_table WHERE (offerer_id = '$admin_id' OR enroller_id = '$admin_id') AND (acceptance_status = 'accepted' AND exam_id = '$exam_id')";
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
      </div>



    </main>
    <footer class="bg-dark container-fluid d-flex justify-content-center align-items-center">
        <p class="text-center text-light pt-2">Xawft Corporations &copy; Copyrights Reserved</p>
    </footer>
    <script>
        $(document).ready(function(){
           function get_stuff(start, action){
            $.ajax({
               url: "ajax_action.php",
               type: "post", 
               data: {
                page: "users",
                action: action,
                start: start,
                exam_id: <?php echo $_GET["exam_id"];?>
               },
               dataType: "json", 
               success: function(data){
                  $("#table_data").html(data.data);
                  console.log(data.data);
               }
            })
           }
           get_stuff(0, "all_users");
           $("ul.pagination").hide();
           $("button.all_users").click(function(){
               get_stuff(0, "all_users");
               $("ul.pagination").hide();
               $("ul.all_users").show();
           })
           $("button.pend_users").click(function(){
               get_stuff(0, "pend_users");
               $("ul.pagination").hide();
               $("ul.pend_users").show();
           })
           $("button.pend_offers").click(function(){
               get_stuff(0, "pend_offers");
               $("ul.pagination").hide();
               $("ul.pend_offers").show();
           })
           $("button.accepted_users").click(function(){
               get_stuff(0, "accepted_users");
               $("ul.pagination").hide();
               $("ul.accepted_users").show();
           });
           $("ul.all_users button").click(function(){
            var value = $(this).text();
                var actual = value - 1;
                var search = actual * 10;
                console.log(search);
                get_stuff(search, "all_users");
           })
           $("ul.pend_users button").click(function(){
            var value = $(this).text();
                var actual = value - 1;
                var search = actual * 10;
                console.log(search);
                get_stuff(search, "pend_users");
           })
           $("ul.pend_offers button").click(function(){
            var value = $(this).text();
                var actual = value - 1;
                var search = actual * 10;
                console.log(search);
                get_stuff(search, "pend_offers");
           })
           $("ul.accepted_users button").click(function(){
            var value = $(this).text();
                var actual = value - 1;
                var search = actual * 10;
                console.log(search);
                get_stuff(search, "aaccepted_users");
           })
        })
    </script>
</body>
</html>