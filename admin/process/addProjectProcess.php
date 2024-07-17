<?php

require "../../config/connection.php";

$staff = $_POST["s"];
$pname = $_POST["pn"];
$ptype = $_POST["pt"];
$pstart = $_POST["ps"];
$pend = $_POST["pe"];
$preq = $_POST["pr"];

if ($staff == 0) {
    echo ("Please  select staff !!!");
} else if (empty($pname)) {
    echo ("Please enter Project Name !!!");
} else if (strlen($pname) > 50) {
    echo ("Project Name must have less than 50 characters");
} else if ($ptype == 0) {
    echo ("Please  select Project Type !!!");
} else if (empty($pstart)) {
    echo ("Please enter Start Date !!!");
} else if (empty($pend)) {
    echo ("Please enter End Date !!!");
} else if (empty($preq)) {
    echo ("Please enter Requirements !!!");
} else {

    $project_rs = Database::search("SELECT * FROM `project` WHERE `name`='" . $pname . "' ");
    $project_num = $project_rs->num_rows;

    if ($project_num == 0) {

        $s_date_string = $pstart;
        $start_date = date('Y-m-d', strtotime($s_date_string));

        $e_date_string = $pend;
        $end_date = date('Y-m-d', strtotime($e_date_string));

        if (!empty($_FILES["file"])) {

            $res_file = $_FILES["file"];

            $allowed_image_ex = array("application/zip", "application/x-zip", "application/x-zip-compressed", "application/octet-stream");
            $file_ex = $res_file["type"];

            if (!in_array($file_ex, $allowed_image_ex)) {
                echo ("Please select a zip file.");
            } else {

                // Upload files process

                $new_file_extention = ".zip";

                $uniqid = uniqid();

                $file_name = "../../assets/src/Project_resources/" . $pname . "_" . $uniqid . $new_file_extention;
                $file_name2 = "../assets/src/Project_resources/" . $pname . "_" . $uniqid . $new_file_extention;

                move_uploaded_file($res_file["tmp_name"], $file_name);

                Database::iud("INSERT INTO `project` (`name`,`start_date`,`end_date`,`description`,`res_path`,`project_type_id`,`status_id`,`staff_email`) VALUES ('" . $pname . "', '" . $start_date . "', '" . $end_date . "', '" . $preq . "', '" . $file_name2 . "', '" . $ptype . "', '1', '" . $staff . "') ");
            }
        } else {

            Database::iud("INSERT INTO `project` (`name`,`start_date`,`end_date`,`description`,`project_type_id`,`status_id`,`staff_email`) VALUES ('" . $pname . "', '" . $start_date . "', '" . $end_date . "', '" . $preq . "', '" . $ptype . "', '1', '" . $staff . "' )");
        }

        echo ("Success");
    } else {
        echo ("There is already a project with this name. Please enter another name");
    }

}
