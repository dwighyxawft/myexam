<?php
include("../Examination.php");
$exam = new Examination;
$admin_id = $_SESSION["admin_id"];
$admin_email = $_SESSION["admin_email"];

if(isset($_POST["page"])){

    $output;
    $name;
    $email;
    $mobile;
    $gender;
    $password;
    $address;
    $image;
    $total_rows;
    $row;

    if($_POST["page"] == "admin"){


        if($_POST["action"] == "login"){
            $email = $_POST["email"];
            $password = $_POST["password"];
            $exam->query = "SELECT * FROM admin_table WHERE admin_email = '$email'";
            $total_rows = $exam->total_rows();
            $row =  $exam->query_result();
            if($total_rows > 0){

                    if(password_verify($password, $row["admin_password"])){
                        $_SESSION["admin_id"] = $row["admin_id"];
                        $_SESSION["admin_email"] = $row["admin_email"];
                
                        $output = ["success"=>"You are logged in", "status"=>true];
                        echo json_encode($output);
                    }
                    else{
                        $output = ["success"=>"Wrong Password", "status"=>false];
                        echo json_encode($output);
                    }
            
        }
            else{
                $output = ["success"=>"Email Doesn't Exist. Signup", "status"=>false];
                echo json_encode($output);
            }
            
            
           
        }

        

        if($_POST["action"] == "signup"){
            $name = $_POST["name"];
            $email = $_POST["email"];
            $mobile = $_POST["mobile"];
            $address = $_POST["address"];
            $gender = $_POST["gender"];
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            if($gender = "Male"){
                $image = "male.jpg";
            }
            else{
                $image = "female.jpg";
            }
            $exam->query = "SELECT * FROM admin_table WHERE admin_email = '$email'";
            $total_rows = $exam->total_rows();
            if($total_rows > 0){
                $output = ["success" => "Email Already Registered. Use another Email", "status" => false];
               echo json_encode($output);
               
               
            }
            else{
                $exam->query = "INSERT INTO admin_table(admin_name, admin_email, admin_mobile, admin_address, admin_gender, admin_image, admin_password, admin_created_at)VALUES('$name', '$email', '$mobile', '$address', '$gender', '$image', '$password', NOW())";
            if($exam->execute_query()){
                $output = ["success" => "Registration Successful. You can now login", "status"=> true];
                echo json_encode($output);
                echo $exam->redirect("admin/login.php");
                
              
            }
            }
            
        }

        if($_POST["action"] == "edit_account"){
            $name = $_POST["name"];
            $mobile = $_POST["mobile"];
            $address = $_POST["address"];
            $gender = $_POST["gender"];
            $id = $_POST["admin_id"];
            $exam->query = "UPDATE admin_table SET admin_name = '$name', admin_address = '$address', admin_gender = '$gender', admin_mobile = '$mobile' WHERE admin_id = '$id'";
            if($exam->execute_query()){
                $output = ["success"=>"Details changed successfully"];
            }
            else{
                $output = ["success"=>"Details not changed successfully"];
            }
            echo json_encode($output);


        }

        if($_POST["action"] == "change_pass"){
            $old_pass = $_POST["old_pass"];
            $new_pass = $_POST["new_pass"];
            $con_pass = $_POST["con_pass"];
            $id = $_POST["admin_id"];
            $exam->query = "SELECT * FROM admin_table WHERE admin_id = '$admin_id'";
            $res = $exam->query_result();
            $admin_password = $res["admin_password"];
            if(password_verify($old_pass, $admin_password)){
                if($new_pass == $con_pass){
                    $hash_pass = password_hash($new_pass, PASSWORD_DEFAULT);
                    $exam->query = "UPDATE admin_table SET admin_password = '$hash_pass' WHERE admin_id = '$id'";
                    if($exam->execute_query()){
                        $output = ["success"=>"Details changed successfully"];  
                    }
                    else{
                        $output = ["success"=>"Details not changed successfully"];
                    }

                }
                else{
                    $output = ["success"=>"Details not matching"];
                }
            }
          
    
          
            echo json_encode($output);


        }
        

    }

    if($_POST["page"] == "exams"){

       if($_POST["action"] == "get_exams"){
           $exam->query = "SELECT * FROM exam_table ORDER BY exam_created_on DESC LIMIT 0, 10";
          $result = $exam->query_all();
          $data = [];
          foreach($result as $row){
            $exam_id = $row["exam_id"];
            $exam->query = "SELECT * FROM user_enroll_exam_table WHERE exam_id = '$exam_id' AND acceptance_status = 'accepted'";
            $count_enroll = $exam->total_rows();
            if($count_enroll > 0){
                $enroll_rows = ' <td>'.$count_enroll.' Users</td>';
            }
            else{
                $enroll_rows = ' <td>No Users</td>';
            }



            if($row["exam_status"] == "Pending"){
                $status = '<td><div class="badge rounded-pill bg-warning">'.$row["exam_status"].'</div></td></tr>'; 
               }
               elseif($row["exam_status"] == "Created"){
                $status = '<td><div class="badge rounded-pill bg-success">'.$row["exam_status"].'</div></td></tr>'; 
               }
               elseif($row["exam_status"] == "Started"){
                $status = '<td><div class="badge rounded-pill bg-primary">'.$row["exam_status"].'</div></td></tr>'; 
               }
               else{
                $status = '<td><div class="badge rounded-pill bg-dark">'.$row["exam_status"].'</div></td>
                </tr>'; 
               }

          

           
            $data[] = '<tr>
            <td>'.$row["exam_title"].'</td>
            <td>'.$row["exam_date"].'</td>
            <td>'.$row["exam_time"].'</td>
            <td>'.$row["exam_duration"].' Minutes</td>
            <td>'.$row["total_questions"].' Questions</td>
            '.$enroll_rows.'
            <td>'.$row["marks_per_right_answer"].' Marks</td>
            '.$status.'';
          
          

          }
          $output = [
            "data"=>$data
        ];
          echo json_encode($output);

           
       }


       if($_POST["action"] == "get_all_exams"){
           $start = $_POST["start"];
        $exam->query = "SELECT * FROM exam_table ORDER BY exam_created_on DESC LIMIT $start, 10";
       $result = $exam->query_all();
       $data = [];
       foreach($result as $row){
         $exam_id = $row["exam_id"];
         $exam->query = "SELECT * FROM user_enroll_exam_table WHERE exam_id = '$exam_id' AND acceptance_status = 'accepted'";
         $count_enroll = $exam->total_rows();
         if($count_enroll > 0){
             $enroll_rows = ' <td>'.$count_enroll.' Users</td>';
         }
         else{
             $enroll_rows = ' <td>No Users</td>';
         }



         if($row["exam_status"] == "Pending"){
             $status = '<td><div class="badge rounded-pill bg-warning">'.$row["exam_status"].'</div></td></tr>'; 
            }
            elseif($row["exam_status"] == "Created"){
             $status = '<td><div class="badge rounded-pill bg-success">'.$row["exam_status"].'</div></td></tr>'; 
            }
            elseif($row["exam_status"] == "Started"){
             $status = '<td><div class="badge rounded-pill bg-primary">'.$row["exam_status"].'</div></td></tr>'; 
            }
            else{
             $status = '<td><div class="badge rounded-pill bg-dark">'.$row["exam_status"].'</div></td></tr>'; 
            }

       

        
         $data[] = '<tr>
         <td>'.$row["exam_title"].'</td>
         <td>'.$row["exam_date"].'</td>
         <td>'.$row["exam_time"].'</td>
         <td>'.$row["exam_duration"].' Minutes</td>
         <td>'.$row["total_questions"].' Questions</td>
         '.$enroll_rows.'
         <td>'.$row["marks_per_right_answer"].' Marks</td>
         '.$status.'';
       
       

       }
       $output = [
         "data"=>$data,
         "start"=>$start
     ];
       echo json_encode($output);

        
    }

    if($_POST["action"] == "view_result"){
        $user_id = $_POST["user_id"];
        $exam_id = $_POST["exam_id"];
        $exam->query = "SELECT * FROM exam_table WHERE exam_id = '$exam_id'";
        $sec_sub_row = $exam->query_result();
        $exam_title = $sec_sub_row["exam_title"];
        $admin_id = $sec_sub_row["admin_id"];
        $exam->query = "SELECT * FROM admin_table WHERE admin_id = '$admin_id'";
        $admin_row = $exam->query_result();
        $admin_image = $admin_row["admin_image"];
        $admin_name = $admin_row["admin_name"];
        $exam->query = "SELECT * FROM user_table WHERE user_id = '$user_id'";
        $user_row = $exam->query_result();
        $user_name = $user_row["user_name"];
        $marks;
        $user_mark = 0;
        $admin_id = $_POST["admin_id"];
        $exam->query = "SELECT * FROM user_exam_question_answers_table WHERE user_id = '$user_id' AND (exam_id = '$exam_id' AND admin_id = '$admin_id')";
        $result = $exam->query_all();
        $data = [];
        foreach($result as $row){
            $question_id = $row["question_id"];
            $exam_id = $row["exam_id"];
            $admin_id = $row["admin_id"];
            $user_answer = $row["user_answer"];
            $correct_answer = $row["correct_answer"];
            $exam->query = "SELECT * FROM option_table WHERE (question_id = '$question_id' AND exam_id = '$exam_id') AND option_number = '$user_answer'";
            $user_ans_row = $exam->query_result();
            $user_ans_title = $user_ans_row["option_title"];
            $exam->query = "SELECT * FROM option_table WHERE (question_id = '$question_id' AND exam_id = '$exam_id') AND option_number = '$correct_answer'";
            $correct_ans_row = $exam->query_result();
            $correct_ans_title = $correct_ans_row["option_title"];
            $code = '';
          for($i=1;$i<5;$i++){
            $exam->query = "SELECT * FROM option_table WHERE (question_id = '$question_id' AND exam_id = '$exam_id') AND option_number = '$i'";
            $option_row = $exam->query_result();
            $option_title = $option_row["option_title"];
            $code .= '<td>'.$option_title.'</td>';
          }
         
            $exam->query = "SELECT * FROM question_table WHERE question_id = '$question_id' AND exam_id = '$exam_id'";
            $sub_row = $exam->query_result();
            $question_title = $sub_row["question_title"];
            if($user_answer == $correct_answer){
                $user_answer_status = '<td><i class="fa fa-2x text-success fa-check"></td>';
                $marks = $sec_sub_row["marks_per_right_answer"];
                $user_mark = $user_mark + $sec_sub_row["marks_per_right_answer"];
            }
            else{
                $user_answer_status = '<td><i class="fa fa-2x text-danger fa-times"></td>';
                $marks = 0;
                $user_mark = $user_mark + 0;
            }
            $data[] = '<tr>
            <td>'.$question_title.'</td>
            '.$code.'
            <td>'.$user_ans_title.'</td>
            <td>'.$correct_ans_title.'</td>
            '.$user_answer_status.'
            <td>+ '.$marks.' Marks</td>
           </tr> ';
        }

        $result = '
        <div class="card">
        <div class="card-header">
            <h2 class="card-title text-center">'.$user_name.'</h2>
        </div>
        <div class="card-body ps-3 pt-4">
            <div class="text-center mb-2">
                <img src="../admin/images/'.$admin_image.'" width="100" height="100" alt="mentor image" class="rounded-circle mx-auto border border-1 border-success mb-3">
                <p class="card-text">'.$admin_name.'</p>
            </div>
            <h4 class="text-center pb-2">'.$exam_title.'</h4>
            <h5 class="text-center pb-4">'.$user_mark.'</h5>
            <input type="range" class="form-control-range" min="0" max="100" value="'.$user_mark.'">
        </div>
    </div>';

        $output = ["data"=>$data, "result"=>$result, "success"=>true];
        echo json_encode($output);
    }

    if($_POST["action"] == "get_total_exams"){
        $start = $_POST["start"];
     $exam->query = "SELECT * FROM exam_table WHERE admin_id = '$admin_id' ORDER BY exam_created_on DESC LIMIT $start, 10";
    $result = $exam->query_all();
    $data = [];
    foreach($result as $row){
      $exam_id = $row["exam_id"];
      $exam->query = "SELECT * FROM user_enroll_exam_table WHERE exam_id = '$exam_id' AND acceptance_status = 'accepted'";
      $count_enroll = $exam->total_rows();
      if($count_enroll > 0){
          $enroll_rows = ' <td>'.$count_enroll.' Users</td>';
      }
      else{
          $enroll_rows = ' <td>No Users</td>';
      }



      if($row["exam_status"] == "Pending"){
          $status = '
          <td><div class="badge rounded-pill bg-warning">'.$row["exam_status"].'</div></td>
          <td><a class="btn btn-warning btn-sm bg-warning text-light" href="view_questions.php?exam_id='.$row["exam_id"].'">Add Questions</a>
          </td>
          </tr>'; 
         }
         elseif($row["exam_status"] == "Created"){
          $status = '<td><div class="badge rounded-pill bg-success">'.$row["exam_status"].'</div></td>
          <td><a class="btn btn-success bg-success btn-sm text-light" href="view_questions.php?exam_id='.$row["exam_id"].'">View Questions</a>
          <button class="btn-danger bg-danger btn btn-sm delete_exam" data-exam="'.$row["exam_id"].'">Delete Exam</button>
          </td>
          </tr>'; 
         }
         elseif($row["exam_status"] == "Started"){
          $status = '<td><div class="badge rounded-pill bg-primary">'.$row["exam_status"].'</div></td>
          <td><a class="btn btn-primary btn-sm bg-primary text-light check_users" href="view_sitting_users.php?exam_id='.$row["exam_id"].'">Check Users</button>
          </td>
          </tr>'; 
         }
         else{
          $status = '<td><div class="badge rounded-pill bg-dark">'.$row["exam_status"].'</div></td>
          <td><a class="btn btn-dark btn-sm bg-dark text-light check_results" href="view_user_results.php?exam_id='.$row["exam_id"].'">Check User Results</button>
          </td>
          </tr>'; 
         }

    

     
      $data[] = '<tr>
      <td>'.$row["exam_title"].'</td>
      <td>'.$row["exam_date"].'</td>
      <td>'.$row["exam_time"].'</td>
      <td>'.$row["exam_duration"].' Minutes</td>
      <td>'.$row["total_questions"].' Questions</td>
      '.$enroll_rows.'
      <td>'.$row["marks_per_right_answer"].' Marks</td>
      '.$status.'';
    
    

    }
    $output = [
      "data"=>$data,
      "start"=>$start
  ];
    echo json_encode($output);

     
 }
 if($_POST["action"] == "get_pending_exams"){
    $start = $_POST["start"];
 $exam->query = "SELECT * FROM exam_table WHERE admin_id = '$admin_id' AND exam_status = 'Pending' ORDER BY exam_created_on DESC LIMIT $start, 10";
$result = $exam->query_all();
$data = [];
foreach($result as $row){
  $exam_id = $row["exam_id"];
  $exam->query = "SELECT * FROM user_enroll_exam_table WHERE exam_id = '$exam_id' AND acceptance_status = 'accepted'";
  $count_enroll = $exam->total_rows();
  if($count_enroll > 0){
      $enroll_rows = ' <td>'.$count_enroll.' Users</td>';
  }
  else{
      $enroll_rows = ' <td>No Users</td>';
  }



  if($row["exam_status"] == "Pending"){
      $status = '
      <td><a class="btn btn-warning btn-sm bg-warning text-light" href="view_questions.php?exam_id='.$row["exam_id"].'">Add Questions</a>
      </td>
      </tr>'; 
     }
  



 
  $data[] = '<tr>
  <td>'.$row["exam_title"].'</td>
  <td>'.$row["exam_date"].'</td>
  <td>'.$row["exam_time"].'</td>
  <td>'.$row["exam_duration"].' Minutes</td>
  <td>'.$row["total_questions"].' Questions</td>
  '.$enroll_rows.'
  <td>'.$row["marks_per_right_answer"].' Marks</td>
  '.$status.'';



}
$output = [
  "data"=>$data,
  "start"=>$start
];
echo json_encode($output);

 
}
if($_POST["action"] == "get_created_exams"){
    $start = $_POST["start"];
 $exam->query = "SELECT * FROM exam_table WHERE admin_id = '$admin_id' AND exam_status = 'Created' ORDER BY exam_created_on DESC LIMIT $start, 10";
$result = $exam->query_all();
$data = [];
foreach($result as $row){
  $exam_id = $row["exam_id"];
  $exam->query = "SELECT * FROM user_enroll_exam_table WHERE exam_id = '$exam_id' AND acceptance_status = 'accepted'";
  $count_enroll = $exam->total_rows();
  if($count_enroll > 0){
      $enroll_rows = ' <td>'.$count_enroll.' Users</td>';
  }
  else{
      $enroll_rows = ' <td>No Users</td>';
  }



  if($row["exam_status"] == "Created"){
      $status = '
      <td><a class="btn btn-success btn-sm bg-success text-light" href="view_questions.php?exam_id='.$row["exam_id"].'">Add Questions</a>
      <a class="btn btn-warning btn-sm bg-warning text-light" href="view_users.php?exam_id='.$row["exam_id"].'">View Users</a>
      </td>
      </tr>'; 
     }
  



 
  $data[] = '<tr>
  <td>'.$row["exam_title"].'</td>
  <td>'.$row["exam_date"].'</td>
  <td>'.$row["exam_time"].'</td>
  <td>'.$row["exam_duration"].' Minutes</td>
  <td>'.$row["total_questions"].' Questions</td>
  '.$enroll_rows.'
  <td>'.$row["marks_per_right_answer"].' Marks</td>
  '.$status.'';



}
$output = [
  "data"=>$data,
  "start"=>$start
];
echo json_encode($output);

 
}
if($_POST["action"] == "get_started_exams"){
    $start = $_POST["start"];
 $exam->query = "SELECT * FROM exam_table WHERE admin_id = '$admin_id' AND exam_status = 'Started' ORDER BY exam_created_on DESC LIMIT $start, 10";
$result = $exam->query_all();
$data = [];
foreach($result as $row){
  $exam_id = $row["exam_id"];
  $exam->query = "SELECT * FROM user_enroll_exam_table WHERE exam_id = '$exam_id' AND acceptance_status = 'accepted'";
  $count_enroll = $exam->total_rows();
  if($count_enroll > 0){
      $enroll_rows = ' <td>'.$count_enroll.' Users</td>';
  }
  else{
      $enroll_rows = ' <td>No Users</td>';
  }



  if($row["exam_status"] == "Started"){
      $status = '
      <td><a class="btn btn-primary btn-sm bg-warning text-light" href="view_sitting_users.php?exam_id='.$row["exam_id"].'">View Users</a>
      </td>
      </tr>'; 
     }
  



 
  $data[] = '<tr>
  <td>'.$row["exam_title"].'</td>
  <td>'.$row["exam_date"].'</td>
  <td>'.$row["exam_time"].'</td>
  <td>'.$row["exam_duration"].' Minutes</td>
  <td>'.$row["total_questions"].' Questions</td>
  '.$enroll_rows.'
  <td>'.$row["marks_per_right_answer"].' Marks</td>
  '.$status.'';



}
$output = [
  "data"=>$data,
  "start"=>$start
];
echo json_encode($output);

 
}
if($_POST["action"] == "get_completed_exams"){
    $start = $_POST["start"];
 $exam->query = "SELECT * FROM exam_table WHERE admin_id = '$admin_id' AND exam_status = 'Completed' ORDER BY exam_created_on DESC LIMIT $start, 10";
$result = $exam->query_all();
$data = [];
foreach($result as $row){
  $exam_id = $row["exam_id"];
  $exam->query = "SELECT * FROM user_enroll_exam_table WHERE exam_id = '$exam_id' AND acceptance_status = 'accepted'";
  $count_enroll = $exam->total_rows();
  if($count_enroll > 0){
      $enroll_rows = ' <td>'.$count_enroll.' Users</td>';
  }
  else{
      $enroll_rows = ' <td>No Users</td>';
  }



  if($row["exam_status"] == "Completed"){
      $status = '
      <td><a class="btn btn-dark btn-sm bg-dark text-light" href="view_user_results.php?exam_id='.$row["exam_id"].'">Check Sitted Users</a>
      </td>
      </tr>'; 
     }
  



 
  $data[] = '<tr>
  <td>'.$row["exam_title"].'</td>
  <td>'.$row["exam_date"].'</td>
  <td>'.$row["exam_time"].'</td>
  <td>'.$row["exam_duration"].' Minutes</td>
  <td>'.$row["total_questions"].' Questions</td>
  '.$enroll_rows.'
  <td>'.$row["marks_per_right_answer"].' Marks</td>
  '.$status.'';



}
$output = [
  "data"=>$data,
  "start"=>$start
];
echo json_encode($output);

 
}
 if($_POST["action"] == "get_examinees"){
    $start = $_POST["start"];
    $exam->query = "SELECT * FROM user_enroll_exam_table WHERE (offerer_id = '$admin_id' OR enroller_id = '$admin_id') LIMIT $start, 10";
    $result = $exam->query_all();
    $data = [];
    $total = $exam->total_rows();
    if($total > 0){
        foreach($result as $row){
            $enroller_id = $row["enroller_id"];
            $exam_id = $row["exam_id"];
            $exam->query = "SELECT * FROM exam_table WHERE exam_id = '$exam_id'";
            $sub_exam_result = $exam->query_result();
            $exam_title = $sub_exam_result["exam_title"];
            $exam_date = $sub_exam_result["exam_date"];
            $exam_time = $sub_exam_result["exam_time"];
            $offerer_id = $row["offerer_id"];
            $acceptance_status = $row["acceptance_status"];
            if($enroller_id == $admin_id){
                $user_id = $offerer_id;
            }
            else{
                $user_id = $enroller_id;
            }
            $exam->query = "SELECT * FROM user_table WHERE user_id = '$user_id'";
            $sub_user_result = $exam->query_result();
            $user_name = $sub_user_result["user_name"];
            $user_email = $sub_user_result["user_email"];
            $user_gender = $sub_user_result["user_gender"];
            $user_image = $sub_user_result["user_image"];
            $user_address = $sub_user_result["user_address"];
            if($acceptance_status == 'pending'){
                $status = '
                <td>Pending</td>
                <td><button class="add_user btn btn-success bg-success rounded" data-user="'.$user_id.'">Enroll User</button></td>';
            }
            else{
                $status = '
                <td>Enrolled</td>
                <td><button class="remove_user btn btn-danger bg-danger rounded" data-user="'.$user_id.'">Remove User</button></td>';
            }

            $data[] = '<tr>
            <td><img src="../images/'.$user_image.'" width="40" height="40" alt="user image" class="rounded-circle"></td>
            <td>'.$user_name.'</td>
            <td>'.$user_email.'</td>
            <td>'.$user_gender.'</td>
            <td>'.$user_address.'</td>
            <td>'.$exam_title.'</td>
            <td>'.$exam_date.'</td>
            <td>'.$exam_time.'</td>
            '.$status.'
        </tr>';
        }
    }
    else{
        $data[] = ' <tr>
        <td colspan="10"><h2 class="text-center pt-3">No Users Available</h2></td>
    </tr>';
    }
    $output = [
        "data"=>$data,
        "start"=>$start
    ];
   
      echo json_encode($output);
}


    if($_POST["action"] == "add_exam"){
        $exam_title = $_POST["exam_title"];
        $exam_date = $_POST["exam_date"];
        $exam_time = $_POST["exam_time"];
        $exam_duration = $_POST["exam_duration"];
        $total_questions = $_POST["total_questions"];
        $marks_per_right_answer = 100 / $total_questions;
        $exam_status = "Pending";
        $exam->query = "INSERT INTO exam_table(admin_id, exam_title, exam_date, exam_time, exam_duration, total_questions, marks_per_right_answer, exam_status) VALUES('$admin_id', '$exam_title', '$exam_date', '$exam_time', '$exam_duration', '$total_questions', '$marks_per_right_answer', '$exam_status')";
        if($exam->execute_query()){
            $output = ["success"=>"Exam was inserted successfully", "status"=>true];
        }
        else{
            $output = ["success"=>"Exam was not inserted successfully, please try again", "status"=>false];
        }
        echo json_encode($output);
    }

    }




    if($_POST["page"] == "question"){





        if($_POST["action"] == "add_question"){
            $question_title = $_POST["question_title"];
            $correct_answer = $_POST["correct_answer"];
            $exam_id = $_POST["exam_id"];
            $exam->query = "SELECT * FROM question_table WHERE exam_id = '$exam_id' ORDER BY question_created_on DESC LIMIT 0,1";
            $total_row = $exam->total_rows();
            if($total_row > 0){
                $result = $exam->query_result();
                $question_number = $result["question_number"];
                $question_num_ins = $question_number + 1;
                $exam->query = "INSERT INTO question_table(exam_id, question_title, correct_answer, question_number)VALUES('$exam_id', '$question_title', '$correct_answer', '$question_num_ins')";
                if($exam->execute_query()){
                    $exam->query = "SELECT question_id FROM question_table WHERE exam_id = '$exam_id' ORDER BY question_created_on DESC LIMIT 0,1";
                    $sub_result = $exam->query_result();
                    $question_id = $sub_result["question_id"];
                    for($i=1; $i<5;$i++){
                        $option_title = $_POST['option_title_'.$i.''];
                        $exam->query = "INSERT INTO option_table(question_id, exam_id, option_number, option_title)VALUES('$question_id', '$exam_id', '$i', '$option_title')";
                        $exam->execute_query();
                    }
                    $output = ["success"=>"question inserted successfully", "status"=>true];
                }
                else{
                    $output = ["success"=>"question not inserted successfully", "status"=>false];
                }
                
            }
            else{
                $exam->query = "INSERT INTO question_table(exam_id, question_title, correct_answer, question_number)VALUES('$exam_id', '$question_title', '$correct_answer', '1')";
                if($exam->execute_query()){
                    $exam->query = "SELECT question_id FROM question_table WHERE exam_id = '$exam_id' ORDER BY question_created_on DESC LIMIT 0,1";
                    $sub_res = $exam->query_result();
                    $question_id = $sub_res["question_id"];
                    for($i=1; $i<5;$i++){
                        $option_title = $_POST['option_title_'.$i.''];
                        $exam->query = "INSERT INTO option_table(question_id, exam_id, option_number, option_title)VALUES('$question_id', '$exam_id', '$i', '$option_title')";
                        $exam->execute_query();
                    }
                    $output = ["success"=>"question inserted successfully", "status"=>true];
                    
                }
                else{
                    $output = ["success"=>"question not inserted successfully", "status"=>false];
                    
                }
            }
            echo json_encode($output);
            

            
        }

        if($_POST["action"] == "load_question"){
            $start = $_POST["start"];
            $exam_id = $_POST["exam_id"];
            $data = [];
            $exam->query = "SELECT * FROM question_table WHERE exam_id = '$exam_id' ORDER BY question_created_on DESC LIMIT $start, 5";
            $total_row = $exam->total_rows();
            $status;
            if($total_row > 0){
                $result = $exam->query_all();
                foreach($result as $row){
                    $question_id = $row["question_id"];
                    $correct_ans = $row["correct_answer"];
                    $question_title = htmlentities($row["question_title"]);
                    $status = '
                    <div class="card w-75 mb-3">
                    <div class="card-header">
                        <h4 class="card-title">'.$question_title.'</h4>
                    </div>
                    <div class="card-body">
                    <div class="row">
                    <div class="col-md-9">
                    
                    ';
                    $exam->query = "SELECT * FROM option_table WHERE question_id = '$question_id'";
                    $sub_result = $exam->query_all();
                    foreach($sub_result as $sub_row){
                        $option_title = htmlentities($sub_row["option_title"]);
                        $option_number = $sub_row["option_number"];
                        $status .= '<div class="mt-4"><input type="radio" name="option" id="option_'.$option_number.'" value="'.$option_number.'"> '.$option_title.'</div>';
                    }
                    $status .= '</div>
                    <div class="col-md-3 d-flex align-items-center">
                        <h4 class="text-center">Option '.$correct_ans.' is the correct answer</h4>
                    </div>
                    </div></div>
                    <div class="card-footer">
                        <a href="edit_question.php?question_id='.$question_id.'" class="edit_question btn btn-warning text-light bg-warning">Edit Question</a>
                    </div>
                </div>';
                $data[] = $status;
                $output = $data;
                }
               
            }
            else{
                $status = '<div class="card w-75">
                <div class="card-header">
                    <h4 class="card-title">No Questions Available</h4>
                </div>
            </div>';
            $data[] = $status;
            $output = $data;
            }
            
            echo json_encode($output);
        }
        if($_POST["action"] == "edit_question"){
            $question_title = $_POST["question_title"];
            $correct_answer = $_POST["correct_answer"];
            $question_id = $_POST["question_id"];
            $exam->query = "UPDATE question_table SET question_title = '$question_title', correct_answer = '$correct_answer' WHERE question_id = '$question_id'";
            if($exam->execute_query()){
                for($i = 1; $i < 5; $i++){
                    $option_title = $_POST['option_title_'.$i.''];
                    $exam->query = "UPDATE option_table SET option_title = '$option_title' WHERE question_id = '$question_id' AND option_number = '$i'";
                    $exam->execute_query();
                }
                $output = ["success"=>"Question Edited Successfully", "status"=>true];
            }
            else{
                $output = ["success"=>"Question Not Edited Successfully", "status"=>false];
            }

            echo json_encode($output);
            
        }
     
       







    }

    if($_POST["page"] == "users"){
        
        if($_POST["action"] == "get_sitting_users"){
            $start = $_POST["start"];
            $exam_id = $_POST["exam_id"];
            $exam->query = "SELECT * FROM user_exam_takers_table WHERE exam_id = '$exam_id' AND user_exam_status = 'Sitting' LIMIT $start, 10";
            $total = $exam->total_rows();
            $data = [];
            if($total > 0){
                $result = $exam->query_all();
                foreach($result as $row){
                    $user_id = $row["user_id"];
                    $exam->query = "SELECT * FROM user_table WHERE user_id = '$user_id'";
                    $sub_res = $exam->query_result();
                    $exam_id = $row["exam_id"];
                    $exam->query = "SELECT * FROM exam_table WHERE exam_id = '$exam_id'";
                    $sub_row = $exam->query_result();
                    $exam_title = $sub_row["exam_title"];
                    $total_questions = $sub_row["total_questions"];
                    $data[] = ' <tr>
                    <td><img src="../images/'.$sub_res["user_image"].'" width="40" height="40" alt="user image" class="rounded-circle"></td>
                    <td>'.$sub_res["user_name"].'</td>
                    <td>'.$sub_res["user_email"].'</td>
                    <td><'.$sub_res["user_address"].'/td>
                    <td>'.$sub_row["exam_title"].'</td>
                    <td>'.$sub_row["total_questions"].'</td>
                    <td>'.$row["commencement_time"].'</td>
                    <td>'.$row["completion_time"].'</td>
                </tr>
                  ';
                }
            }
            else{
                $data[] = ' <tr>
                    <td colspan="8"><h2 class="pt-2 text-center">No User</h2></td>
                </tr>
                  ';
            }
            $output = [
             "data"=>$data,
             "start", $start];
            echo json_encode($output);
        }


        if($_POST["action"] == "get_sitted_users"){
            $start = $_POST["start"];
            $exam_id = $_POST["exam_id"];
            $exam->query = "SELECT * FROM user_exam_takers_table WHERE exam_id = '$exam_id' AND user_exam_status = 'Sitted' LIMIT $start, 10";
            $total = $exam->total_rows();
            $data = [];
            if($total > 0){
                $result = $exam->query_all();
                foreach($result as $row){
                    $user_id = $row["user_id"];
                    $exam->query = "SELECT * FROM user_table WHERE user_id = '$user_id'";
                    $sub_res = $exam->query_result();
                    $exam_id = $row["exam_id"];
                    $exam->query = "SELECT * FROM exam_table WHERE exam_id = '$exam_id'";
                    $sub_row = $exam->query_result();
                    $exam_title = $sub_row["exam_title"];
                    $total_questions = $sub_row["total_questions"];
                    $data[] = ' <tr>
                    <td><img src="../images/'.$sub_res["user_image"].'" width="40" height="40" alt="user image" class="rounded-circle"></td>
                    <td>'.$sub_res["user_name"].'</td>
                    <td>'.$sub_res["user_email"].'</td>
                    <td><'.$sub_res["user_address"].'/td>
                    <td>'.$sub_row["exam_title"].'</td>
                    <td>'.$sub_row["total_questions"].'</td>
                    <td><a href="view_result.php?user_id='.$row["user_id"].'&exam_id='.$row["exam_id"].'" class="btn btn-dark">View Result</a></td>
                   
                </tr>
                  ';
                }
            }
            else{
                $data[] = ' <tr>
                    <td colspan="8"><h2 class="pt-2 text-center">No User</h2></td>
                </tr>
                  ';
            }
            $output = [
             "data"=>$data,
             "start", $start];
            echo json_encode($output);
        }
        if($_POST["action"] == "all_users"){
            $start = $_POST["start"];
            $exam_id = $_POST["exam_id"];
            $exam->query = "SELECT * FROM user_table LIMIT $start, 10";
            $total = $exam->total_rows();
            $data = [];
            if($total > 0){
                $result = $exam->query_all();
                foreach($result as $row){
                    $user_id = $row["user_id"];
                    $exam->query = "SELECT * FROM user_enroll_exam_table WHERE (((offerer_id = '$user_id' AND enroller_id = '$admin_id') OR (offerer_id = '$admin_id' AND enroller_id = '$user_id')) AND exam_id = '$exam_id') AND (acceptance_status = 'pending' OR acceptance_status = 'accepted')";
                    $tot = $exam->total_rows();
                    if($tot < 1){
                        $exam->query = "SELECT * FROM exam_table WHERE exam_id = '$exam_id'";
                        $sub_row = $exam->query_result();
                        $data[] = ' <tr>
                    <td><img src="images/'.$row["user_image"].'" width="40" height="40" alt="user image" class="rounded-circle"></td>
                    <td>'.$row["user_name"].'</td>
                    <td>'.$row["user_email"].'</td>
                    <td>'.$row["user_address"].'</td>
                    <td>'.$sub_row["exam_title"].'</td>
                    <td>'.$sub_row["total_questions"].'</td>
                    <td><a href="add_user.php?user_id='.$row["user_id"].'&exam_id='.$sub_row["exam_id"].'" class="btn btn-dark">Add User</a></td>
                   
                </tr>';
                    }
                   
                    
                   /* */
                }
            }
         
            $output = [
             "data"=>$data,
             "start", $start];
            echo json_encode($output);
        }

        if($_POST["action"] == "pend_users"){
            $start = $_POST["start"];
            $exam_id = $_POST["exam_id"];
            $data = [];
            $exam->query = "SELECT * FROM user_enroll_exam_table WHERE enroller_id = '$admin_id' AND (acceptance_status = 'pending' AND exam_id = '$exam_id')";
            $result = $exam->query_all();
            foreach($result as $row){
                $user_id = $row["offerer_id"];
                $exam->query = "SELECT * FROM user_table WHERE user_id = '$user_id'";
                $sub_res = $exam->query_result();
                $exam->query = "SELECT * FROM exam_table WHERE exam_id = '$exam_id'";
                $sub_row = $exam->query_result();
                $data[] = ' <tr>
                <td><img src="images/'.$sub_res["user_image"].'" width="40" height="40" alt="user image" class="rounded-circle"></td>
                <td>'.$sub_res["user_name"].'</td>
                <td>'.$sub_res["user_email"].'</td>
                <td>'.$sub_res["user_address"].'</td>
                <td>'.$sub_row["exam_title"].'</td>
                <td>'.$sub_row["total_questions"].'</td>
                <td><a href="accept_request.php?user_id='.$sub_res["user_id"].'&exam_id='.$sub_row["exam_id"].'" class="btn btn-dark">Enroll</a></td>
               
            </tr>';
            }
            $output = [
                "data"=>$data,
                "start", $start];
               echo json_encode($output);
        }
       

        if($_POST["action"] == "pend_offers"){
            $start = $_POST["start"];
            $exam_id = $_POST["exam_id"];
            $data = [];
            $exam->query = "SELECT * FROM user_enroll_exam_table WHERE offerer_id = '$admin_id' AND (acceptance_status = 'pending' AND exam_id = '$exam_id')";
            $result = $exam->query_all();
            foreach($result as $row){
                $user_id = $row["enroller_id"];
                $exam->query = "SELECT * FROM user_table WHERE user_id = '$user_id'";
                $sub_res = $exam->query_result();
                $exam->query = "SELECT * FROM exam_table WHERE exam_id = '$exam_id'";
                $sub_row = $exam->query_result();
                $data[] = ' <tr>
                <td><img src="images/'.$sub_res["user_image"].'" width="40" height="40" alt="user image" class="rounded-circle"></td>
                <td>'.$sub_res["user_name"].'</td>
                <td>'.$sub_res["user_email"].'</td>
                <td>'.$sub_res["user_address"].'</td>
                <td>'.$sub_row["exam_title"].'</td>
                <td>'.$sub_row["total_questions"].'</td>
                <td><a href="cancel_request.php?user_id='.$sub_res["user_id"].'&exam_id='.$sub_row["exam_id"].'" class="btn btn-danger">Cancel Offer</a></td>
               
            </tr>';
            }
            $output = [
                "data"=>$data,
                "start", $start];
               echo json_encode($output);
        }

        if($_POST["action"] == "accepted_users"){
            $start = $_POST["start"];
            $exam_id = $_POST["exam_id"];
            $data = [];
            $exam->query = "SELECT * FROM user_enroll_exam_table WHERE (offerer_id = '$admin_id' OR enroller_id = '$admin_id') AND (acceptance_status = 'accepted' AND exam_id = '$exam_id')";
            $result = $exam->query_all();
            foreach($result as $row){
                if($row["offerer_id"] == $admin_id){
                    $user_id = $row["enroller_id"];
                }
                else{
                    $user_id = $row["offerer_id"];
                }
                $exam->query = "SELECT * FROM user_table WHERE user_id = '$user_id'";
                $sub_res = $exam->query_result();
                $exam->query = "SELECT * FROM exam_table WHERE exam_id = '$exam_id'";
                $sub_row = $exam->query_result();
                $data[] = ' <tr>
                <td><img src="images/'.$sub_res["user_image"].'" width="40" height="40" alt="user image" class="rounded-circle"></td>
                <td>'.$sub_res["user_name"].'</td>
                <td>'.$sub_res["user_email"].'</td>
                <td>'.$sub_res["user_address"].'</td>
                <td>'.$sub_row["exam_title"].'</td>
                <td>'.$sub_row["total_questions"].'</td>
                <td><a href="view_user.php?user_id='.$sub_res["user_id"].'" class="btn btn-dark">View User</a></td>
            </tr>';
            }
            $output = [
                "data"=>$data,
                "start", $start];
               echo json_encode($output);
        }


       





    }




}

?>