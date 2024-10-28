<?php
   $sid = $_POST['sid'];
  $fname = $_POST['first_name'];
  $lname = $_POST['last_name'];
  $conn = mysqli_connect("localhost","root","padduu","ajax",3307);
  $sql = "UPDATE stu SET fname = '{$fname}', lname = '{$lname}' WHERE id = {$sid}";
  if(mysqli_query($conn,$sql)){
   echo 1;
  }else{
    echo 0;
  }

?>