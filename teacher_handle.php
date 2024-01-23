<?php
session_start();
include 'connection.php';
if(isset($_POST['duration']) && $_POST['duration'])
{
    $duration=$_POST['duration'];
    $duration=date("Y-m-d H:i:s", ($duration/1000));
    $duration=strtotime($duration);
    $user=$_SESSION['userid'];
    $stmt = $conn->prepare("SELECT * FROM createexam WHERE teacherid=$user ORDER BY createdon DESC");
    // $stmt->bind_param("s",$duration);
    if($stmt->execute())
    {
            $stmt->bind_result($eid,$tid,$date);
            $stmt->store_result();
            if ($stmt->num_rows != 0) //To check if the row exists
            { 
            
                $examids=array();
                $output=array(array('success'=>0,
                        'message'=>"No Result Found"));

                while($stmt->fetch()){
                   if(strtotime($date)>$duration){
                    array_push($examids,$eid);
                   }
                }
                $stmt->close();
                if(sizeof($examids)>0){
                    foreach ($examids as $examid) //fetching the contents of the row
                    {
                        $output[0]['success']=1;
                        $output[0]['message']="Result Found";
                        //getting examdetails
                        $stmt2=$conn->prepare("SELECT examid,examtitle,examtime,examdate FROM examdata WHERE examid=?");
                        $stmt2->bind_param("s",$examid);
                        $stmt2->execute();
                        $stmt2->bind_result($id,$title,$time,$date);
                        $stmt2->store_result();
                        
                        if($stmt2->num_rows!=0){
                            while($stmt2->fetch()){
                                array_push($output,array("id"=>$id,
                                "title"=>$title,
                               "time"=>$time,
                               "date"=>$date
                                ));
                            }
                           
                        }
                         
                    }
                    $stmt2->close();
                }
               
                echo json_encode($output);

            } 
            else
            {
            echo json_encode(array(array(
                'success' => 0,
                'message' =>"NO RESULT FOUND.")));
            }
        
    }
    else
    { 
    echo json_encode(array(array(
        'success' => 0,
        'message' =>"NO RESULT FOUND.")));
    }
}
else{
    echo json_encode(array(array(
        'success' => 0,
        'message' =>"NO RESULT FOUND.")));
}
?>