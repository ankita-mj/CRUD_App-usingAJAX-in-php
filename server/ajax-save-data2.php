<?php
           $conn = mysqli_connect("localhost","root","padduu","ajax",3307);
           $f_name = $_POST['first_name'];
   $l_name = $_POST['last_name'];
   $sql = "INSERT INTO stu(fname,lname) VALUES('{$f_name}','{$l_name}')";
   if(mysqli_query($conn,$sql)){
     $output = "data saved successfully";
   mysqli_close($conn);
   }else{
    $output = "cann't save..";
   }
   echo $output;

?>