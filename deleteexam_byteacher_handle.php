<?php
session_start();
include 'connection.php';
if(isset($_POST['examid']) && $_POST['examid'] && isset($_POST['from']) && $_POST['from']=="delete")
{
    $id=$_POST['examid'];

    $stmt= $conn->prepare("DELETE FROM createexam WHERE examid=? AND teacherid=?");
    $stmt->bind_param('ss',$id,$_SESSION['userid']);
    if($stmt->execute()){
        echo json_encode(array(
            'success' => 1
        ));
    }
    else{
        echo json_encode(array(
        'success' => 0
    ));
    }
    $stmt->close();

}
else{
    echo json_encode(array(
        'success' => 0
    ));
}
?>