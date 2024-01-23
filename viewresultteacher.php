<?php
session_start();
include 'connection.php';
if(isset($_SESSION['username']) && isset($_SESSION["usertype"]) && $_SESSION["usertype"]=="Teacher" && isset($_SESSION["examid"]) )
{
  $results=array();
  $eid=$_SESSION['examid'];
  $stmt= $conn->prepare("SELECT studentid FROM enrollexam WHERE examid=? ");
  $stmt->bind_param('s',$eid);
  if($stmt->execute())
  {
   
    $stmt->bind_result($sid);
    $stmt->store_result();
    if ($stmt->num_rows != 0){
      while ($stmt->fetch()) //fetching the contents of the row
      {
            $total=0;
          $stmt2= $conn->prepare("SELECT * FROM answerdata WHERE examid=? AND studentid=?");
          $stmt2->bind_param('ss',$eid,$sid);
          if($stmt2->execute()){
            $stmt2->bind_result($stuid,$eid,$qid,$qno,$correct,$answer,$mark,$status);
            $stmt2->store_result();
            $stmt3= $conn->prepare("SELECT s_name FROM studentdata WHERE s_id=?");
            $stmt3->bind_param('s',$sid);
            $stmt3->execute();
            $stmt3->bind_result($sname);
            $stmt2->store_result();
            if ($stmt2->num_rows != 0){
              while ($stmt3->fetch()){
                       
                    while($stmt2->fetch()){
                        if($status=="right"){
                        $total=$total+$mark;
                        }
                       
                    }
                         array_push($results,array("id"=>$sid,
                            "name"=>$sname,
                           "total"=>$total
                    ));
               
              }
           
            }
            else{
              $stmt2->close();
              header("location:viewExamsTeacher.php");
            }
          }
          else{
            $stmt2->close();
            header("location:viewExamsTeacher.php");
          }
            // array_push($questions,array("id"=>$id,
            //                           "text"=>$text,
            //                           "A"=>$A,
            //                           "B"=>$B,
            //                           "C"=>$C,
            //                           "D"=>$D,
            //                           "correctopt"=>$correctopt,
            //                           "mark"=>$mark,
            //                    "time"=>$time));
      }
      $stmt->close();
    }
    else{
      $stmt->close();
      header("location:viewExamsTeacher.php");
    }
  }
  else
  {  
      header("location:viewExamsTeacher.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="lib/bootstrap.min.css">
    <link rel="stylesheet" href="lib\fontawesome-free-5.15.1-web\css\all.css">
<title>Document</title>
</head>
<body>
    <div class="container">
      <a href="viewExamsTeacher.php">
      <button class="btn btn-primary">Back</button>
      </a>
      <button type="button" class="btn btn-danger loginbtn" id="logoutbtn" >Log Out  <i class="fas fa-sign-in-alt"></i></button>
    </div>
    <div class="container " style="border:2px solid black;margin-top:20px; ">
      <div class="row">
          <div class="col-6">
             Exam id:<strong> <?php echo $_SESSION['examid']?></strong>
          </div>
      </div>
      <br>
      <table class="table table-hover table-respponsive-sm" id="resulttable">
            <thead>
                <tr>
                <th scope="col">studentid</th>
                <th scope="col">Name</th>
                <th scope="col">Marks</th>
                </tr>
            </thead>
            <tbody>

            <?php
                foreach ($results as $result) {
            ?>
                <tr>
                <th scope="row"><?php echo $result['id'];?></th>
                <td><?php echo $result['name'];?></td>
                <td><?php echo $result['total'];?></td>
                </tr>
            <?php } ?>
            </tbody>
    </table>
    <button class="btn btn-secondary" onclick="exportexcel();">Export as .xml</button>
    </div>
      <br>
      <br>
      <br>
  <script type="text/javascript" src="lib\jquery-3.5.1.min.js"></script>
  <script type="text/javascript"src="lib\bootstrap.min.js"></script>
<script type="text/javascript" src="teachercontrol.js"></script>
    <script type="text/javascript" src="exportexcel.js"></script>

</body>
</html>
<?php
}
else{
  header("location:index.php");
}
?>