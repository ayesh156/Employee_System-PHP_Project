<?php

require "../../config/connection.php";

if(!empty($_GET["email"])){

    $email = $_GET["email"];

    $staff_rs = Database::search("SELECT * FROM `staff` WHERE `email`='".$email."' ");
    $staff_num = $staff_rs -> num_rows;

    if($staff_num == 1){
        
        $staff_data = $staff_rs -> fetch_assoc();

        if($staff_data["option_id"] == 2){
            Database::iud("UPDATE `staff` SET `option_id`='1' WHERE `email`='".$email."' ");
            echo ("blocked");
        }else if($staff_data["option_id"] == 1){
            Database::iud("UPDATE `staff` SET `option_id`='2' WHERE `email`='".$email."' ");
            echo ("unblocked");
        }

    }else{
        echo ("Cannot find the staff. Please try again later.");
    }

}else{
    echo ("Something went wrong.");
}

?>