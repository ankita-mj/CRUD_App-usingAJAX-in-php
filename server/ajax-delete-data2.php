<?php
           $conn = mysqli_connect("localhost","root","padduu","ajax",3307);
           $sql = "DELETE FROM stu WHERE id = {$_POST['id']}";
   if(mysqli_query($conn,$sql)){
     echo 1;
   }else{
     echo 0;
   }

?>