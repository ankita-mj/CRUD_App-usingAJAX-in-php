<?php
           $conn = mysqli_connect("localhost","root","padduu","ajax",3307);
           $sql = "SELECT * FROM stu;";
  $result = mysqli_query($conn,$sql);
  $output = "";
  if(mysqli_num_rows($result)>0){
    $output = "<table class='table table-striped table-bordered mt-3'>
                 <tr class='thead-dark'>
                   <th>ID</th>
                   <th>NAME</th>
                </tr>";
              while($row = mysqli_fetch_assoc($result)){
                 $output .= "<tr>
                               <td>{$row['id']}</td>    
                               <td>{$row['fname']} {$row['lname']}</td>    
                             </tr>";
              }
    $output .= "</table>";
    mysqli_close($conn);
    echo $output;
  }else{
    echo"file not found";
  }
?>