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


$exam->query = "SELECT * FROM exam_table WHERE exam_id = '$exam_id'";
$res = $exam->query_result();
$total_questions = $res["total_questions"];
$exam->query = "SELECT * FROM question_table WHERE exam_id = '$exam_id'";
$total_questions_inserted = $exam->total_rows();
if($total_questions == $total_questions_inserted){
    $exam->query = "UPDATE exam_table SET exam_status = 'Created' WHERE exam_id = '$exam_id'";
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
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/home.css">
    <title>Xawft Quiz // View Questions</title>
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
                        <label>Question Title</label>
                        <input class="form-control" required type="text" name="question_title" id="question_title">
                    </div>
                    <div class="form-group mb-2">
                        <label>Option One</label>
                        <input class="form-control" required type="text" name="option_title_1" id="option_title_1">
                    </div>
                    <div class="form-group mb-2">
                        <label>Option Two</label>
                        <input class="form-control" required type="text" name="option_title_2" id="option_title_2">
                    </div>
                    <div class="form-group mb-2">
                        <label>Option Three</label>
                        <input class="form-control" required type="text" name="option_title_3" id="option_title_3">
                    </div>
                    <div class="form-group mb-2">
                        <label>Option Four</label>
                        <input class="form-control" required type="text" name="option_title_4" id="option_title_4">
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
                        <input type="hidden" name="exam_id" id="exam_id" value="<?php echo $exam_id;?>">
                        <input type="hidden" name="page" id="page" value="question">
                        <input type="hidden" name="action" value="add_question" id="action">
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






    <main>


    <div class="container-fluid">
        <div class="container mt-3">
        <?php
        if($total_questions > $total_questions_inserted){
            echo '<button class="btn btn-md btn-success bg-success mt-4" data-bs-toggle="modal" data-bs-target="#modal1">Add Question</button>';
        }
        ?>
          <div id="questions" class="mt-5 pb-5 pt-4">
           
          </div>
          <div class="w-50">
            <ul class="pagination pagination-md pb-5 pt-4" id="pagin">
                <?php
                $exam->query = "SELECT * FROM question_table WHERE exam_id = '$exam_id'";
                $total_row = $exam->total_rows();
                $link = $total_row / 5;
                $all_links = ceil($link);
                for($i=0; $i<$all_links; $i++){
                    $j = $i+1;
                    $data = '<li class="page-item"><button class="page-link link">'.$j.'</button></li>';
                    echo $data;
                }
                
               
                ?>
            </ul>
            </div>

        </div>
    </div>

    <div class="w-50">
   <ul class="pagination pagination-md pb-5 pt-4" id="pagin">
</ul>
   </div>



    </main>





    <footer class="bg-dark container-fluid d-flex justify-content-center align-items-center">
        <p class="text-center text-light pt-2">Xawft Corporations &copy; Copyrights Reserved</p>
    </footer>


    <script>
        $(document).ready(function(){
            function reset(){
                $("#question_title").val("");
                $("#option_title_1").val("");
                $("#option_title_2").val("");
                $("#option_title_3").val("");
                $("#option_title_4").val("");
                $("#correct_answer").val("");
               
            }
            
            $("#form1").on("submit", function(e){
                e.preventDefault();
                $.ajax({
                    url: "ajax_action.php",
                    type: "post",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(data){
                        alert(data.success)
                        if(data.status == true){
                            $("#modal1").modal("hide");
                            reset();
                        }
                        
                    }
                })
            })
            var exam_id = '<?php echo $_GET["exam_id"]; ?>';
            function load_questions(start){
                $.ajax({
                    url:"ajax_action.php",
                    type:"post",
                    data:{
                        exam_id: exam_id,
                        start: start,
                        page: "question",
                        action:"load_question"
                    },
                    dataType:"json",
                    success:function(data){
                        $("#questions").html(data);
                    }
                })
            }
            load_questions(0);
           
            $(".page-link").on("click", function(){
                var value = Number($(this).text());
                console.log(value);
                var actual = value - 1;
                var search = actual * 5;
                console.log(search);
                load_questions(search);
            });
        })
    </script>
   
</body>
</html>