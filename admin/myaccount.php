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
    <title>Xawft Quiz // Admin Account</title>
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
                        <li class="nav-item pb-2"><a href="dwighyxawft.github.io/port" class="nav-link">OTHER PROJECTS</a></li>
                        <li class="dropdown"><a href="#" data-bs-toggle="dropdown" class="dropdown-toggle"><img src="../images/male.jpg" alt="" class="img-fluid rounded-circle" width="40" height="40"></a>
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
        <div class="container mt-5">
            <div class="w-50 mx-auto mt-5">
                <div class="card">
                    <div class="card-header">
                        <img src="images/<?php echo $row["admin_image"];?>" alt="" class="card-img-top img-thumbnail">
                    </div>
                    <div class="card-body ps-3">
                        <h4 class="pt-4"><?php echo $row["admin_name"];?></h4>
                        <h5 class="pt-5"><?php echo $row["admin_email"];?></h5>
                        <h4 class="pt-4"><?php echo $row["admin_address"];?></h4>
                        <h3 class="pt-3"><?php echo $row["admin_mobile"];?></h3>
                        <h6 class="pt-2"><?php echo $row["admin_gender"];?></h6>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-warning bg-warning" data-bs-toggle="modal" data-bs-target="#edit">Edit Account</button>
                        <button class="btn btn-danger bg-danger" data-bs-toggle="modal" data-bs-target="#chg_pass">Change Password</button>
                        <button class="btn btn-warning bg-warning" data-bs-toggle="modal" data-bs-target="#chg_image">Change Profile Image</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="edit">
            <div class="modal-dialog">
                <div class="modal-content">
                   <form method="post" id="edit_account"> <div class="modal-header">
                        <h4 class="modal-title"><?php echo $row["admin_name"];?></h4>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body pt-3">
                        <div class="form-group mb-2">
                            <label>Name:</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo $row["admin_name"];?>" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Mobile No:</label>
                            <input type="tel" name="mobile" id="mobile" class="form-control" value="<?php echo $row["admin_mobile"];?>" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Address:</label>
                            <input type="text" name="address" id="address" class="form-control" value="<?php echo $row["admin_address"];?>" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Gender:</label>
                            <select name="gender" class="form-control form-select" id="gender">
                                <option>Select Your Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                       
                        <div class="form-group">
                            <input type="hidden" name="page" value="admin">
                            <input type="hidden" name="action" value="edit_account">
                            <input type="hidden" name="admin_id" value="<?php echo $admin_id;?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button data-bs-dismiss="modal" class="btn btn-danger">Close</button>
                    </div>
                </form>
                </div>
            </div>
        </div>


            <div class="modal fade" id="chg_pass">
            <div class="modal-dialog">
                <div class="modal-content">
                   <form method="post" id="chg_pass_form"> 
                    <div class="modal-header">
                        <h4 class="modal-title"><?php echo $row["admin_name"];?></h4>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body pt-3">
                        <div class="form-group mb-2">
                            <label>Old Password:</label>
                            <input type="password" class="form-control" name="old_pass" id="old_pass" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>New Password:</label>
                            <input type="password" name="new_pass" class="form-control" id="new_pass" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Confirm New Password:</label>
                            <input type="password" name="con_pass" class="form-control" id="con_pass" required>
                        </div>
                      
                        <div class="form-group">
                            <input type="hidden" name="page" class="form-control" value="admin">
                            <input type="hidden" name="action" class="form-control" value="change_pass">
                            <input type="hidden" name="admin_id" class="form-control" value="<?php echo $admin_id;?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button data-bs-dismiss="modal" class="btn btn-danger">Close</button>
                    </div>
                </form>
                </div>
            </div>
        </div>


        <div class="modal fade" id="chg_image">
            <div class="modal-dialog">
                <div class="modal-content">
                   <form method="post" enctype="multipart/form-data" action="edit_image.php"> <div class="modal-header">
                        <h4 class="modal-title"><?php echo $row["admin_name"];?></h4>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body pt-3">
                        <div class="form-group mb-2">
                            <input type="file" name="chg_pro" id="name" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                           <img src="images/<?php echo $row["admin_image"];?>" height="250" alt="No admin">
                        </div>
                    
                       
                       
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="chg_pic">Submit</button>
                        <button data-bs-dismiss="modal" class="btn btn-danger">Close</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

    </main>
    <script>
        $(document).ready(function(){
            $("#edit_account").on("submit", function(e){
                e.preventDefault();
                $.ajax({
                    url: "ajax_action.php",
                    type: "post",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(data){
                        alert(data.success);
                    }
                })
            })
            $("#chg_pass_form").on("submit", function(e){
                e.preventDefault();
                $.ajax({
                    url: "ajax_action.php",
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