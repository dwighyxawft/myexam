<?php
include("../Examination.php");
$exam = new Examination;


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

    if($_POST["page"] == "user"){


        if($_POST["action"] == "login"){
            $email = $_POST["email"];
            $password = $_POST["password"];
            $exam->query = "SELECT * FROM user_table WHERE user_email = '$email'";
            $total_rows = $exam->total_rows();
            $row =  $exam->query_result();
            if($total_rows > 0){

                    if(password_verify($password, $row["user_password"])){
                        $_SESSION["user_id"] = $row["user_id"];
                        $_SESSION["user_email"] = $row["user_email"];
                
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
            $exam->query = "SELECT * FROM user_table WHERE user_email = '$email'";
            $total_rows = $exam->total_rows();
            if($total_rows > 0){
                $output = ["success" => "Email Already Registered. Use another Email", "status" => false];
               echo json_encode($output);
            }
            else{
                $exam->query = "INSERT INTO user_table(user_name, user_email, user_mobile, user_address, user_gender, user_image, user_password, user_created_at)VALUES('$name', '$email', '$mobile', '$address', '$gender', '$image', '$password', NOW())";
            if($exam->execute_query()){
                $output = ["success" => "Registration Successful. You can now login", "status"=> true];
                echo json_encode($output);
              
            }
            }
            
        }
        
        if($_POST["action"] == "edit_account"){
            $name = $_POST["name"];
            $mobile = $_POST["mobile"];
            $address = $_POST["address"];
            $gender = $_POST["gender"];
            $id = $_POST["user_id"];
            $exam->query = "UPDATE user_table SET user_name = '$name', user_address = '$address', user_gender = '$gender', user_mobile = '$mobile' WHERE user_id = '$id'";
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
            $id = $_POST["user_id"];
            $exam->query = "SELECT * FROM user_table WHERE user_id = '$id'";
            $res = $exam->query_result();
            $user_password = $res["user_password"];
            if(password_verify($old_pass, $user_password)){
                if($new_pass == $con_pass){
                    $hash_pass = password_hash($new_pass, PASSWORD_DEFAULT);
                    $exam->query = "UPDATE user_table SET user_password = '$hash_pass' WHERE user_id = '$id'";
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

    if($_POST["page"] == "exam"){


        if($_POST["action"] == "get_ten_exams"){
            $user_id = $_POST["user_id"];
            
            if(isset($_POST["start"])){
                $start = $_POST["start"];
            }
            else{
                $start = 0;
            }
            $exam->query = "SELECT * FROM exam_table WHERE exam_status = 'Created' ORDER BY exam_created_on DESC LIMIT $start,10";
            $data = [];
                $result = $exam->query_all();
                foreach($result as $row){
                    $exam_id = $row["exam_id"];
                    $exam->query = "SELECT * FROM user_enroll_exam_table WHERE ((offerer_id = '$user_id' OR enroller_id = '$user_id') AND exam_id = '$exam_id') AND (acceptance_status = 'pending' OR acceptance_status = 'accepted')";
                    $tot = $exam->total_rows();
                    if($tot < 1){
                        $exam->query = "SELECT * FROM user_enroll_exam_table WHERE exam_id = '$exam_id' AND acceptance_status = 'accepted'";
                        $count_enroll = $exam->total_rows();
                        if($count_enroll > 0){
                            $enroll_rows = ' <td>'.$count_enroll.' Users</td>';
                        }
                        else{
                            $enroll_rows = ' <td>No Users</td>';
                        }
                       $data[] = ' <tr>
                       <td>'.$row["exam_title"].'</td>
                       <td>'.$row["exam_date"].'</td>
                       <td>'.$row["exam_time"].'</td>
                       <td>'.$row["exam_duration"].' Minutes</td>
                       <td>'.$row["total_questions"].' Questions</td>
                       '.$enroll_rows.'
                       <td>'.$row["marks_per_right_answer"].' Marks</td>
                       <td><a href="add_user.php?enroller_id='.$row["admin_id"].'&exam_id='.$row["exam_id"].'" class="btn btn-dark">Add User</a></td>
                   </tr>';
                    }
                   
                }
                $output = $data;
                echo json_encode($output);
               
            
        }

        if($_POST["action"] == "get_your_exams"){
            $user_id = $_POST["user_id"];
            
           
            $exam->query = "SELECT * FROM user_enroll_exam_table WHERE (offerer_id = '$user_id' OR enroller_id = '$user_id') AND (acceptance_status = 'pending' OR acceptance_status = 'accepted') ORDER BY enroll_id DESC LIMIT 0, 10";
            $data = [];
                $result = $exam->query_all();
                foreach($result as $sub_row){
                    $exam_id = $sub_row["exam_id"];
                    $exam->query = "SELECT * FROM exam_table WHERE exam_id = '$exam_id'";
                    $row = $exam->query_result();
                    $todays_date = date("Y-m-d");
                    $todays_time = date("H:i:s");
                    if($sub_row["acceptance_status"] == 'accepted' && ($row["exam_date"] == $todays_date && $row["exam_time"] == $todays_time)){
                        $button_status = ' <td><a href="start_exam.php?enroller_id='.$row["admin_id"].'&exam_id='.$row["exam_id"].'" class="btn btn-primary">Start Exam</a></td>';
                    }
                    elseif($sub_row["acceptance_status"] == 'pending'){
                        if($sub_row["offerer_id"] == $user_id){
                            $button_status = ' <td><a href="cancel_request.php?enroller_id='.$row["admin_id"].'&exam_id='.$row["exam_id"].'" class="btn btn-dark">Cancel</a></td>';
                           }
                           else{
                            $button_status = ' <td><a href="accept_request.php?enroller_id='.$row["admin_id"].'&exam_id='.$row["exam_id"].'" class="btn btn-primary">Accept</a><a href="cancel_request.php?enroller_id='.$row["admin_id"].'&exam_id='.$row["exam_id"].'" class="btn btn-dark">Cancel</a></td>';
                           }
                    }
                    $exam->query = "SELECT * FROM user_enroll_exam_table WHERE exam_id = '$exam_id' AND (acceptance_status = 'pending' OR acceptance_status = 'accepted')";
                    $count_enroll = $exam->total_rows();
                    if($count_enroll > 0){
                        $enroll_rows = ' <td>'.$count_enroll.' Users</td>';
                    }
                    else{
                        $enroll_rows = ' <td>No Users</td>';
                    }
                    $data[] = ' <tr>
                    <td>'.$row["exam_title"].'</td>
                    <td>'.$row["exam_date"].'</td>
                    <td>'.$row["exam_time"].'</td>
                    <td>'.$row["exam_duration"].' Minutes</td>
                    <td>'.$row["total_questions"].' Questions</td>
                    '.$enroll_rows.'
                    <td>'.$row["marks_per_right_answer"].' Marks</td>
                   '.$button_status.'
                </tr>';
                   
                }
                $output = $data;
                echo json_encode($output);
               
            
        }

        if($_POST["action"] == "get_the_exams"){
            $user_id = $_POST["user_id"];
            $request = $_POST["request"];
            $start = $_POST["start"];
            
           
            $exam->query = "SELECT * FROM user_enroll_exam_table WHERE (offerer_id = '$user_id' OR enroller_id = '$user_id') AND (acceptance_status = '$request') ORDER BY enroll_id DESC LIMIT $start, 10";
            $data = [];
                $result = $exam->query_all();
                foreach($result as $sub_row){
                    $exam_id = $sub_row["exam_id"];
                    $exam->query = "SELECT * FROM exam_table WHERE exam_id = '$exam_id'";
                    $row = $exam->query_result();
                    $date = new DateTime($row["exam_date"]);
                    $date->modify("+1 day");
                    $date->format("Y-m-d");
                    $todays_date = date("Y-m-d");
                    $todays_time = date("H:i:s");
                    if($sub_row["acceptance_status"] == 'accepted' && ($row["exam_date"] == $todays_date && $row["exam_time"] == $todays_time)){
                        $button_status = ' <td><a href="start_exam.php?enroller_id='.$row["admin_id"].'&exam_id='.$row["exam_id"].'" class="btn btn-primary">Start Exam</a></td>';
                    }
                    elseif($sub_row["acceptance_status"] == 'accepted' && $row["exam_status"] === "Created"){
                        $button_status = '<td></td>';
                    }
                    elseif($sub_row["acceptance_status"] == 'accepted' && $row["exam_status"] === "Started"){
                        $button_status = '<td><a href="start_exam.php?enroller_id='.$row["admin_id"].'&exam_id='.$row["exam_id"].'" class="btn btn-primary">Start Exam</a></td>';
                    }
                    elseif($sub_row["acceptance_status"] == 'accepted' && $row["exam_status"] === "Completed"){
                        $button_status = ' <td><a href="view_result.php?enroller_id='.$row["admin_id"].'&exam_id='.$row["exam_id"].'" class="btn btn-dark">View Result</a></td>';
                    }
                  
                    elseif($sub_row["acceptance_status"] == 'pending'){
                       if($sub_row["offerer_id"] == $user_id){
                        $button_status = ' <td><a href="cancel_request.php?enroller_id='.$row["admin_id"].'&exam_id='.$row["exam_id"].'" class="btn btn-dark">View Result</a></td>';
                       }
                       else{
                        $button_status = ' <td><a href="accept_request.php?enroller_id='.$row["admin_id"].'&exam_id='.$row["exam_id"].'" class="btn btn-success">Accept</a><a href="cancel_request.php?enroller_id='.$row["admin_id"].'&exam_id='.$row["exam_id"].'" class="btn btn-dark">Cancel</a></td>';
                       }
                    }
                    $exam->query = "SELECT * FROM user_enroll_exam_table WHERE exam_id = '$exam_id' AND acceptance_status = '$request'";
                    $count_enroll = $exam->total_rows();
                    if($count_enroll > 0){
                        $enroll_rows = ' <td>'.$count_enroll.' Users</td>';
                    }
                    else{
                        $enroll_rows = ' <td>No Users</td>';
                    }
                   
                    
                        $data[] = ' <tr>
                        <td>'.$row["exam_title"].'</td>
                        <td>'.$row["exam_date"].'</td>
                        <td>'.$row["exam_time"].'</td>
                        <td>'.$row["exam_duration"].' Minutes</td>
                        <td>'.$row["total_questions"].' Questions</td>
                        '.$enroll_rows.'
                        <td>'.$row["marks_per_right_answer"].' Marks</td>
                       '.$button_status.'
                    </tr>';
                     
                    
                   
                   
                }
                $output = $data;
                echo json_encode($output);
               
            
        }
        if($_POST["action"] == "get_todays_exams"){
            $user_id = $_POST["user_id"];
            $request = $_POST["request"];
            $start = $_POST["start"];
            
           
            $exam->query = "SELECT * FROM user_enroll_exam_table WHERE (offerer_id = '$user_id' OR enroller_id = '$user_id') AND (acceptance_status = '$request') ORDER BY enroll_id DESC LIMIT $start, 10";
            $data = [];
                $result = $exam->query_all();
                foreach($result as $sub_row){
                    $exam_id = $sub_row["exam_id"];
                    $exam->query = "SELECT * FROM exam_table WHERE exam_id = '$exam_id'";
                    $row = $exam->query_result();
                    $date = new DateTime($row["exam_date"]);
                    $date->modify("+1 day");
                    $date->format("Y-m-d");
                    $todays_date = date("Y-m-d");
                    $todays_time = date("H:i:s");
                    if($sub_row["acceptance_status"] == 'accepted' && (($row["exam_date"] == $todays_date && $row["exam_time"] == $todays_time) || $row["exam_status"] == "Started")){
                        $button_status = ' <td><a href="start_exam.php?enroller_id='.$row["admin_id"].'&exam_id='.$row["exam_id"].'" class="btn btn-primary">Start Exam</a></td>';
                    }
                   
                    $exam->query = "SELECT * FROM user_enroll_exam_table WHERE exam_id = '$exam_id' AND acceptance_status = '$request'";
                    $count_enroll = $exam->total_rows();
                    if($count_enroll > 0){
                        $enroll_rows = ' <td>'.$count_enroll.' Users</td>';
                    }
                    else{
                        $enroll_rows = ' <td>No Users</td>';
                    }
                    if( $row["exam_status"] == "Started"){
                        $data[] = ' <tr>
                        <td>'.$row["exam_title"].'</td>
                        <td>'.$row["exam_date"].'</td>
                        <td>'.$row["exam_time"].'</td>
                        <td>'.$row["exam_duration"].' Minutes</td>
                        <td>'.$row["total_questions"].' Questions</td>
                        '.$enroll_rows.'
                        <td>'.$row["marks_per_right_answer"].' Marks</td>
                       '.$button_status.'
                    </tr>';
                    }
                   
                   
                }
                $output = $data;
                echo json_encode($output);
               
            
        }

        if($_POST["action"] == "get_completed_exams"){
            $user_id = $_POST["user_id"];
            $start = $_POST["start"];
            $exam->query = "SELECT * FROM user_exam_takers_table WHERE user_id = '$user_id' AND user_exam_status = 'Sitted' ORDER BY sit_id DESC LIMIT $start, 10";
            $data = [];
                $result = $exam->query_all();
                foreach($result as $sub_row){
                    $exam_id = $sub_row["exam_id"];
                    $exam->query = "SELECT * FROM exam_table WHERE exam_id = '$exam_id'";
                    $row = $exam->query_result();
                    $date = new DateTime($row["exam_date"]);
                    $date->modify("+1 day");
                    $date->format("Y-m-d");
                    $todays_date = date("Y-m-d");
                    $todays_time = date("H:i:s");
                 
                    $exam->query = "SELECT * FROM user_exam_takers_table WHERE exam_id = '$exam_id' AND user_exam_status = 'Sitted'";
                    $count_enroll = $exam->total_rows();
                    if($count_enroll > 0){
                        $enroll_rows = ' <td>'.$count_enroll.' Users</td>';
                    }
                    else{
                        $enroll_rows = ' <td>No Users</td>';
                    }
                    $data[] = ' <tr>
                    <td>'.$row["exam_title"].'</td>
                    <td>'.$row["exam_date"].'</td>
                    <td>'.$row["exam_time"].'</td>
                    <td>'.$row["exam_duration"].' Minutes</td>
                    <td>'.$row["total_questions"].' Questions</td>
                    '.$enroll_rows.'
                    <td>'.$row["marks_per_right_answer"].' Marks</td>
                    <td><a href="view_result.php?enroller_id='.$row["admin_id"].'&exam_id='.$row["exam_id"].'" class="btn btn-dark">View Result</a></td>
                </tr>';
                   
                }
                $output = $data;
                echo json_encode($output);
               
            
        }

        if($_POST["action"] == "submit_exam"){
            $exam_id = $_POST["exam_id"];
            $user_id = $_POST["user_id"];
            $admin_id = $_POST["admin_id"];
            $exam->query = "UPDATE user_exam_takers_table SET user_exam_status = 'Sitted', completion_time = NOW() WHERE (user_id = '$user_id' AND user_exam_status = 'Sitting') AND (exam_id = '$exam_id' AND admin_id = '$admin_id')";
            if($exam->execute_query()){
                $output = ["status"=>true];
            }
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
     


    }

    if($_POST["page"] == "question"){


        if($_POST["action"] == "show_question"){
            $start = $_POST["start"];
            $user_id = $_POST["user_id"];
            $exam_id = $_POST["exam_id"];
            $exam->query = "SELECT * FROM exam_table WHERE exam_id = '$exam_id'";
            $exam_row = $exam->query_result();
            $exam->query = "SELECT * FROM question_table WHERE exam_id = '$exam_id'";
            $exam_results = $exam->total_rows();
            $admin_id = $exam_row["admin_id"];
            $exam->query = "SELECT * FROM question_table WHERE exam_id = '$exam_id' ORDER BY question_created_on DESC LIMIT $start, 1";
            $row = $exam->query_result();
            $correct_answer = $row["correct_answer"];
            $data = [];
            $question_id = $row["question_id"];
            $exam->query = "SELECT * FROM option_table WHERE (exam_id = '$exam_id' AND question_id = '$question_id') AND option_number = '1'";
            $res1 = $exam->query_result();
            $exam->query = "SELECT * FROM option_table WHERE (exam_id = '$exam_id' AND question_id = '$question_id') AND option_number = '2'";
            $res2 = $exam->query_result();
            $exam->query = "SELECT * FROM option_table WHERE (exam_id = '$exam_id' AND question_id = '$question_id') AND option_number = '3'";
            $res3 = $exam->query_result();
            $exam->query = "SELECT * FROM option_table WHERE (exam_id = '$exam_id' AND question_id = '$question_id') AND option_number = '4'";
            $res4 = $exam->query_result();

            $exam->query = "SELECT * FROM user_exam_question_answers_table WHERE (exam_id = '$exam_id' AND question_id = '$question_id') AND (user_id = '$user_id' AND admin_id = '$admin_id')";
            $ans_total = $exam->total_rows();
            if($ans_total >= 1){
                $ans_row = $exam->query_result();
                $user_answer = $ans_row["user_answer"];
                if($user_answer == 1){
                    $question = ' <div class="card-header">
                    <h3 class="card-title">'.$row["question_title"].'</h3>
                 </div>
             
             <div class="card-body">
                 <div class="form-group mt-5">
                     <input type="radio" name="option" value="'.$res1["option_number"].'" checked> '.$res1["option_title"].'
             </div>
                 <div class="form-group mt-5">
                     <input type="radio" name="option" value="'.$res2["option_number"].'"> '.$res2["option_title"].'
             </div>
                 <div class="form-group mt-5">
                     <input type="radio" name="option" value="'.$res3["option_number"].'"> '.$res3["option_title"].'
             </div>
                 <div class="form-group mt-5">
                     <input type="radio" name="option" value="'.$res4["option_number"].'"> '.$res4["option_title"].'
             </div>
             </div>
             <div class="card-footer mt-3">
                 <input type="hidden" name="exam_id" value="'.$exam_id.'">
                 <input type="hidden" name="question_id" value="'.$question_id.'">
                 <input type="hidden" name="start" value="'.$start.'">
                 <input type="hidden" name="user_id" value="'.$user_id.'">
                 <input type="hidden" name="admin_id" value="'.$admin_id.'">
                 <input type="hidden" name="correct_answer" value="'.$correct_answer.'">
                 <input type="hidden" name="page" value="question">
                 <input type="hidden" name="action" value="submit_question">

                 <button type="submit" class="btn btn-success bg-success next_question">Next</button>
             </div>';
                }
                elseif($user_answer == 2){
                    $question = ' <div class="card-header">
                    <h3 class="card-title">'.$row["question_title"].'</h3>
                 </div>
             
             <div class="card-body">
                 <div class="form-group mt-5">
                     <input type="radio" name="option" value="'.$res1["option_number"].'"> '.$res1["option_title"].'
             </div>
                 <div class="form-group mt-5">
                     <input type="radio" name="option" value="'.$res2["option_number"].'" checked> '.$res2["option_title"].'
             </div>
                 <div class="form-group mt-5">
                     <input type="radio" name="option" value="'.$res3["option_number"].'"> '.$res3["option_title"].'
             </div>
                 <div class="form-group mt-5">
                     <input type="radio" name="option" value="'.$res4["option_number"].'"> '.$res4["option_title"].'
             </div>
             </div>
             <div class="card-footer mt-3">
                 <input type="hidden" name="exam_id" value="'.$exam_id.'">
                 <input type="hidden" name="question_id" value="'.$question_id.'">
                 <input type="hidden" name="start" value="'.$start.'">
                 <input type="hidden" name="user_id" value="'.$user_id.'">
                 <input type="hidden" name="admin_id" value="'.$admin_id.'">
                 <input type="hidden" name="correct_answer" value="'.$correct_answer.'">
                 <input type="hidden" name="page" value="question">
                 <input type="hidden" name="action" value="submit_question">

                 <button type="submit" class="btn btn-success bg-success next_question">Next</button>
             </div>';
                }
                elseif($user_answer == 3){
                    $question = ' <div class="card-header">
                    <h3 class="card-title">'.$row["question_title"].'</h3>
                 </div>
             
             <div class="card-body">
                 <div class="form-group mt-5">
                     <input type="radio" name="option" value="'.$res1["option_number"].'"> '.$res1["option_title"].'
             </div>
                 <div class="form-group mt-5">
                     <input type="radio" name="option" value="'.$res2["option_number"].'"> '.$res2["option_title"].'
             </div>
                 <div class="form-group mt-5">
                     <input type="radio" name="option" value="'.$res3["option_number"].'" checked> '.$res3["option_title"].'
             </div>
                 <div class="form-group mt-5">
                     <input type="radio" name="option" value="'.$res4["option_number"].'"> '.$res4["option_title"].'
             </div>
             </div>
             <div class="card-footer mt-3">
                 <input type="hidden" name="exam_id" value="'.$exam_id.'">
                 <input type="hidden" name="question_id" value="'.$question_id.'">
                 <input type="hidden" name="start" value="'.$start.'">
                 <input type="hidden" name="user_id" value="'.$user_id.'">
                 <input type="hidden" name="admin_id" value="'.$admin_id.'">
                 <input type="hidden" name="correct_answer" value="'.$correct_answer.'">
                 <input type="hidden" name="page" value="question">
                 <input type="hidden" name="action" value="submit_question">

                 <button type="submit" class="btn btn-success bg-success next_question">Next</button>
             </div>';
                }
                elseif($user_answer == 4){
                    $question = ' <div class="card-header">
                    <h3 class="card-title">'.$row["question_title"].'</h3>
                 </div>
             
             <div class="card-body">
                 <div class="form-group mt-5">
                     <input type="radio" name="option" value="'.$res1["option_number"].'"> '.$res1["option_title"].'
             </div>
                 <div class="form-group mt-5">
                     <input type="radio" name="option" value="'.$res2["option_number"].'"> '.$res2["option_title"].'
             </div>
                 <div class="form-group mt-5">
                     <input type="radio" name="option" value="'.$res3["option_number"].'"> '.$res3["option_title"].'
             </div>
                 <div class="form-group mt-5">
                     <input type="radio" name="option" value="'.$res4["option_number"].'" checked> '.$res4["option_title"].'
             </div>
             </div>
             <div class="card-footer mt-3">
                 <input type="hidden" name="exam_id" value="'.$exam_id.'">
                 <input type="hidden" name="question_id" value="'.$question_id.'">
                 <input type="hidden" name="start" value="'.$start.'">
                 <input type="hidden" name="user_id" value="'.$user_id.'">
                 <input type="hidden" name="admin_id" value="'.$admin_id.'">
                 <input type="hidden" name="correct_answer" value="'.$correct_answer.'">
                 <input type="hidden" name="page" value="question">
                 <input type="hidden" name="action" value="submit_question">

                 <button type="submit" class="btn btn-success bg-success next_question">Next</button>
             </div>';
                }
            }
            else{
                $question = ' <div class="card-header">
                <h3 class="card-title">'.$row["question_title"].'</h3>
             </div>
         
         <div class="card-body">
             <div class="form-group mt-5">
                 <input type="radio" name="option" value="'.$res1["option_number"].'"> '.$res1["option_title"].'
         </div>
             <div class="form-group mt-5">
                 <input type="radio" name="option" value="'.$res2["option_number"].'"> '.$res2["option_title"].'
         </div>
             <div class="form-group mt-5">
                 <input type="radio" name="option" value="'.$res3["option_number"].'"> '.$res3["option_title"].'
         </div>
             <div class="form-group mt-5">
                 <input type="radio" name="option" value="'.$res4["option_number"].'"> '.$res4["option_title"].'
         </div>
         </div>
         <div class="card-footer mt-3">
         <input type="hidden" name="exam_id" value="'.$exam_id.'">
         <input type="hidden" name="question_id" value="'.$question_id.'">
         <input type="hidden" name="start" value="'.$start.'">
         <input type="hidden" name="user_id" value="'.$user_id.'">
         <input type="hidden" name="admin_id" value="'.$admin_id.'">
         <input type="hidden" name="correct_answer" value="'.$correct_answer.'">
          <input type="hidden" name="page" value="question">
                <input type="hidden" name="action" value="submit_question">
             <button type="submit" class="btn btn-success bg-success next_question">Next</button>
         </div>';
            }
            if($start == $exam_results){
                $question = ' <div class="card-header">
                <h3 class="card-title">Now You can submit Your Exam</h3>
             </div>
         
         <div class="card-body">
           <p class="card-text">You can submit your exam here or go back to the answered questions</p>
         </div>
         <div class="card-footer mt-3">
          <input type="hidden" name="page" value="question">
                <input type="hidden" name="action" value="submit_question">
             <button class="btn btn-success bg-success submit_exam">Submit Exam</button>
         </div>';
            }
            
            $data[] = $question;
            $output = ["question"=>$data, "start"=>$start];
            echo json_encode($output);
          
        }


        if($_POST["action"] == "submit_question"){
            $start = $_POST["start"];
            $exam_id = $_POST["exam_id"];
            $user_id = $_POST["user_id"];
            $admin_id = $_POST["admin_id"];
            $question_id = $_POST["question_id"];
            $user_answer = $_POST["option"];
            $correct_answer = $_POST["correct_answer"];
            $exam->query = "SELECT * FROM user_exam_question_answers_table WHERE (exam_id = '$exam_id' AND question_id = '$question_id') AND (user_id = '$user_id' AND admin_id = '$admin_id')";
            $ans_total = $exam->total_rows();
            if($ans_total >= 1){
                $exam->query = "UPDATE user_exam_question_answers_table SET user_answer = '$user_answer' WHERE (exam_id = '$exam_id' AND question_id = '$question_id') AND (user_id = '$user_id' AND admin_id = '$admin_id')";
                if($exam->execute_query()){
                    $output = ["start"=>$start, "success"=> "Answer Updated Succesfully"];
                }
            }
            else{
                $exam->query = "INSERT INTO user_exam_question_answers_table(user_id, admin_id, exam_id, question_id, user_answer, correct_answer) VALUES('$user_id', '$admin_id', '$exam_id', '$question_id', '$user_answer', '$correct_answer')";
                if($exam->execute_query()){
                    $output = ["start"=>$start, "success"=> "Answer Updated Succesfully"];
                }
            }
           
            echo json_encode($output);
        }








    }



}
/*
}*/

?>