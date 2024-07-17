<?php

require "../../config/connection.php";

if (!empty($_POST["id"])) {

    $id = $_POST["id"];
    $star = $_POST["s"];
    $review = $_POST["r"];

    if (empty($review)) {
        echo ("Please enter Review !!!");
    } else {

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d");

        Database::iud("INSERT INTO `review` (`rate`,`comment`,`date`,`uploaded_project_id`) VALUES ('" . $star . "','" . $review . "','" . $date . "','" . $id . "')");

        echo ("Success");

    }

} else {
    echo ("Something went wrong");
}
