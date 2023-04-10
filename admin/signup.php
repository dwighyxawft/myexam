<?php
include("../Examination.php");
$exam = new Examination;
$exam->admin_session_private();


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
    <title>Xawft Quiz // Admin Register</title>
</head>
<body>
<main>
  <div id="main">
  <div class="container-fluid mt-5">
        <div class="row">
        <div class="col-md-5 col-sm-12 mt-3 mx-auto mb-5">
          <div class="header pt-4">
          <div class="mx-auto mb-2 bg-light text-center" style="width: 35%; border-radius: 34px;"><img src="../images/myexam.png" width="170" height="34" alt="XawftQuiz Logo"></div>
          <h4 class="text-center text-light pb-3 text-light signup_heading">XawftQuiz Admin Signup</h4>
          </div>
          <div class="body ps-3 pe-3">
                <form action="" method="post" id="signup" class="needs-validation pt-3">
                    <div class="form-group mb-3">
                        <label>Name:</label>
                        <input type="text" name="admin_name" id="admin_name" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Email:</label>
                        <input type="email" name="admin_email" id="admin_email" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                    <label>Mobile No:</label>
                    <input type="tel" name="admin_mobile" id="admin_mobile" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                    <label>Address:</label>
                    <input type="text" name="admin_address" id="admin_address" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Gender:</label>
                        <select name="admin_gender" id="admin_gender" class="form-control form-select">
                            <option>Select Your Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                    <label>Password:</label>
                    <input type="password" name="admin_password" id="admin_password" class="form-control" required minlength="6">
                    </div>
                    <div class="form-group mb-3">
                    <label>Confirm Password</label>
                    <input type="password" name="admin_conf_password" id="admin_conf_password" class="form-control" required min-length="6">
                    </div>
                    <div class="alert alert-danger mb-3 d-none align-items-center" id="messageBox"><p class="text-center" id="messageText">Password not matching</p></div>

                    <div class="form-group text-center mb-3">
                        <button type="submit" class="btn mb-3 text-light" name="admin_register">Register</button>
                    </div>

                </form>
          </div>
        </div>
        </div>

        <div class="text-center"><h6>Already Have An Account <a href="login.php" class="btn text-primary">Login</a></h6></div>
    </div>
  </div>
</main> 
<script>
    $(document).ready(function(){
        function reset(){
           $("#admin_name").val("");
           $("#admin_email").val("");
           $("#admin_mobile").val("");
           $("#admin_address").val("");
           $("#admin_gender").val("");
           $("#admin_password").val("");
           $("#admin_conf_password").val("");
        }
       $("#signup").on("submit", function(e){
           e.preventDefault();
           var name = $("#admin_name").val();
            var email = $("#admin_email").val();
            var mobile = $("#admin_mobile").val();
            var address = $("#admin_address").val();
            var gender = $("#admin_gender").val();
            var password = $("#admin_password").val();
        if($("#admin_password").val() === $("#admin_conf_password").val()){
         $.ajax({
             url : "ajax_action.php",
             type: "post",
             data: {
                 name: name,
                 email: email,
                 mobile: mobile,
                 address: address,
                 gender: gender,
                 password: password,
                 page: "admin",
                 action: "signup"
             },
             dataType: "json",
             success: function(data){
                 console.log(data);
                 alert(data.success);
                 if(data.status == true){
                    reset();
                    window.open("login.php", "_self");
                 }
                
             }
         })   
        }
        else{
            $("#messageBox").removeClass("d-none");
            $("#messageBox").addClass("d-flex");
        }
       })
    });
</script>
</body>
</html>