<?php
include("../Examination.php");
$exam = new Examination;
$exam->admin_session_public();
$admin_id = $_SESSION["admin_id"];
$exam->query = "SELECT * FROM admin_table WHERE admin_id = '$admin_id'";
$row = $exam->query_result();
if(!isset($_GET["question_id"])){
  echo $exam->redirect("admin/views_questions.php");
}
else{
    $question_id = $_GET["question_id"];
    $exam->query = "SELECT * FROM question_table WHERE question_id = '$question_id'";
    $result = $exam->query_result();
    $question_title = $result["question_title"];
    $correct_answer = $result["correct_answer"];
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
    <title>Xawft Quiz // Edit Question</title>
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
                        <li class="dropdown"><a href="#" data-bs-toggle="dropdown" class="dropdown-toggle"><img src="../images/<?php echo $row["admin_image"];?>g" alt="" class="img-fluid rounded-circle" width="40" height="40"></a>
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



<div id="main">
  <div class="container-fluid mt-5">
        <div class="row">
        <div class="col-md-5 col-sm-12 mt-3 mx-auto mb-5">
          <div class="header pt-4">
          <div class="mx-auto mb-2 bg-light text-center" style="width: 35%; border-radius: 34px;"><img src="../images/myexam.png" width="170" height="34" alt="XawftQuiz Logo"></div>
          <h4 class="text-center text-light pb-3 text-light signup_heading">XawftQuiz Edit Question</h4>
          </div>
          <div class="body ps-3 pe-3">
                <form method="post" id="edit_question" class="needs-validation pt-3">
                 
                <div class="form-group mb-2">
                        <label>Question Title</label>
                        <input class="form-control" required type="text" value="<?php echo $question_title;?>" name="question_title" id="question_title">
                    </div>
                    <div class="form-group mb-2">
                        <label>Option One</label>
                        <input class="form-control" required type="text" value="<?php  $exam->query = "SELECT * FROM option_table WHERE question_id = '$question_id' AND option_number = '1'";
                        $sub_result = $exam->query_result();
                        echo $sub_result["option_title"]; ?>" name="option_title_1" id="option_title_1">
                    </div>
                    <div class="form-group mb-2">
                        <label>Option Two</label>
                        <input class="form-control" required type="text" value="<?php  $exam->query = "SELECT * FROM option_table WHERE question_id = '$question_id' AND option_number = '2'";
                        $sub_result = $exam->query_result();
                        echo $sub_result["option_title"]; ?>" name="option_title_2" id="option_title_2">
                    </div>
                    <div class="form-group mb-2">
                        <label>Option Three</label>
                        <input class="form-control" required type="text" value="<?php  $exam->query = "SELECT * FROM option_table WHERE question_id = '$question_id' AND option_number = '3'";
                        $sub_result = $exam->query_result();
                        echo $sub_result["option_title"]; ?>" name="option_title_3" id="option_title_3">
                    </div>
                    <div class="form-group mb-2">
                        <label>Option Four</label>
                        <input class="form-control" required type="text" value="<?php  $exam->query = "SELECT * FROM option_table WHERE question_id = '$question_id' AND option_number = '4'";
                        $sub_result = $exam->query_result();
                        echo $sub_result["option_title"]; ?>" name="option_title_4" id="option_title_4">
                    </div>
                    <div class="form-group mb-2">
                        <label>Correct Answer</label>
                        <select name="correct_answer" id="correct_answer" class="form-control form-select">
                            <option>Select A Value</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <input type="hidden" name="question_id" id="question_id" value="<?php echo $question_id; ?>">
                        <input type="hidden" name="page" id="page" value="question">
                        <input type="hidden" name="action" value="edit_question" id="action">
                    </div>

                    <div class="form-group text-center mb-3">
                        <button type="submit" class="btn mb-3 text-light" name="edit_question">Edit</button>
                    </div>

                </form>
          </div>
        </div>
        </div>

        
    </div>
  </div>
  <script>
      $(document).ready(function(){
          $("#edit_question").on("submit", function(e){
              e.preventDefault();
              $.ajax({
                  url:"ajax_action.php",
                  type: "post",
                  data: $(this).serialize(),
                  dataType: "json",
                  success: function(data){
                      alert(data.success);
                     
                  }
              })
          })
      })
  </script>
</body>
</html>