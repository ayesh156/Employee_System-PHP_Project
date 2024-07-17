<?php

require "../../config/connection.php";

if (isset($_GET["id"])) {

    $id = $_GET["id"];

    $project_rs = Database::search("SELECT * FROM `project` WHERE `id`='" . $id . "' ");
    $project_num = $project_rs->num_rows;

    if ($project_num != 0) {
        $project_data = $project_rs->fetch_assoc();

        // Delete files process

        $file = "../" . $project_data["res_path"];

        if (file_exists($file)) {
            // Delete the file
            unlink($file);
        }
    } 

    $review_rs = Database::search("SELECT * FROM `review` INNER JOIN `uploaded_project` ON review.uploaded_project_id = uploaded_project.id WHERE uploaded_project.project_id ='" . $id . "' ");
    $review_num = $review_rs -> num_rows;
    $review_data = $review_rs -> fetch_assoc();

    if($review_num != 0) {
        Database::iud("DELETE FROM `review` WHERE `uploaded_project_id`='" . $review_data["uploaded_project_id"] . "'");
    }

    $up_project_rs = Database::search("SELECT * FROM `uploaded_project` WHERE `project_id`='" . $id . "' ");
    $up_project_num = $up_project_rs->num_rows;
    $up_project_data = $up_project_rs->fetch_assoc();

    if ($up_project_num != 0) {
        
        // Delete files process

        $file = "../" . $up_project_data["path"];

        if (file_exists($file)) {
            // Delete the file
            unlink($file);
        }

        Database::iud("DELETE FROM `uploaded_project` WHERE `project_id`='" . $id . "'");
    }

    Database::iud("DELETE FROM `project` WHERE `id`='" . $id . "'");

    echo ("Success");
} else {
    echo ("Something went wrong.");
}
