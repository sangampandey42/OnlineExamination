<?php
session_start();
if(isset($_POST['examid'])&& $_POST['examid'])
{
    $_SESSION['examid']=$_POST['examid'];
    echo json_encode(array("success"=>"1"));
}
else{
    echo json_encode(array("success"=>"0"));
}