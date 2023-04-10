<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="Admin, User, Signup, Login, XawftQuiz, Xawft, Quiz">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/popper2.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/user.css">
    <title>Xawft Quiz // User Login</title>
</head>
<body>
<main>
   <div id="main">
   <div class="container mt-5 mb-5">
     <div class="row">
     <div class="col-md-5 col-sm-12 mt-5 mx-auto mb-5">
          <div class="header pt-4">
          <div class="mx-auto mb-2 bg-light text-center" style="width: 35%; border-radius: 34px;"><img src="../images/myexam.png" width="170" height="34" alt="XawftQuiz Logo"></div>
          <h4 class="text-center text-light pb-3 text-light signup_heading">Login To XawftQuiz</h4>
          </div>
          <div class="body ps-3 pe-3">
                <form method="post" id="login" class="needs-validation pt-3">
                    <div class="form-group mb-3">
                        <label>Email:</label>
                        <input type="email" name="user_email" id="user_email" class="form-control" required>
                    </div>
                   
                    <div class="form-group mb-3">
                    <label>Password:</label>
                    <input type="password" name="user_password" id="user_password" class="form-control" required minlength="6">
                    </div>

                    <div class="alert alert-danger mb-3 d-none align-items-center" id="messageBox"><p class="text-center" id="messageText">Wrong Password</p></div>
                 

                    <div class="form-group text-center mb-3">
                        <button type="submit" class="btn mb-3 text-light" name="user_login">Login</button>
                    </div>

                </form>
          </div>
        </div>
     </div>

        <div class="text-center"><h6>Don't Have An Account <a href="signup.php" class="btn text-primary">Signup</a></h6></div>
    </div>
   </div>
</main> 
<script>
    $(document).ready(function(){
        function reset(){
           $("#user_email").val("");
           $("#user_password").val("");
        }
      $("#login").on("submit", function(e){
          e.preventDefault();
          var email = $("#user_email").val();
          var password = $("#user_password").val();
          $.ajax({
              url: "ajax_action.php",
              type: "POST",
              data: {
                  email: email,
                  password: password,
                  page: "user",
                  action: "login"
              },
              dataType: "json",
              success: function(data){
                  if(data.status == true){
                      alert(data.success);
                      reset();
                      window.open("home.php", "_self");
                  }
                  else{
                      if(data.success == "Wrong Password"){
                        $("#messageBox").removeClass("d-none");
                        $("#messageBox").addClass("d-flex");
                      }
                      else if(data.success == "Email Doesn't Exist. Signup"){
                          alert(data.success);
                          window.open("signup.php", "_self");
                      }
                      else{
                        alert(data.success);
                      }
                  }
              }
          })
      })
    });
</script>
</body>
</html>