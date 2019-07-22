<?php

require_once 'enterData.php';


$required_data = ['holder_name', 'dob', 'passport', 'email', 'start_date', 'end_date'];

$optional_data = ['telephone', 'option'];


if(isset($_POST['holder_name']) && $_POST['holder_name'] != "") {
}

$vars = new enterData();

$data = $vars->sanitizeData($_POST);
$vars->writeToDatabase();

header('Location: index.php');