<?php
    include("../Examination.php");
    $exam = new Examination;
$user_id = $_SESSION["user_id"];
if(isset($_POST["chg_pic"])){
    $image = $_FILES["chg_pro"]["name"];
    $image_tmp = $_FILES["chg_pro"]["tmp_name"];
    $allowed = ["jpg", "png", "jpeg"];
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    if(in_array($ext, $allowed)){
        move_uploaded_file($image_tmp, "../images/$image");
        move_uploaded_file($image_tmp, "images/$image");
        $exam->query = "UPDATE user_table SET user_image = '$image' WHERE user_id = '$user_id'";
        if($exam->execute_query()){
            echo '<script>alert("Your Account Has been Updated")</script>';
            echo '<script>window.open("myaccount.php", "_self")</script>';
        }
    }




}


?>