<?php
$search_item = $_POST['search_item'];
$conn = mysqli_connect("localhost","root","padduu","ajax",3307);
$sql = "SELECT * FROM stu WHERE fname LIKE '%{$search_item}%' OR lname LIKE '%{$search_item}%'";
$result = mysqli_query($conn, $sql);
$output = "";
if(mysqli_num_rows($result)>0){
    $output .= "
    <table class='table table-striped table-bordered mt-3' cellspacing='0px' cellpadding='10px'> 
     
        <tr class='thead-dark'>
           <th>ID</th>
           <th>NAME</th>
           <th>DELETE</th>
           <th>EDIT</th>
        </tr>
   ";
   while($row = mysqli_fetch_assoc($result)){
      $output .= "
        <tr>
          <td>{$row['id']}</td>
          <td>{$row['fname']} {$row['lname']}</td>
          <td><button class ='btn btn-danger' data-sid = '{$row['id']}'>Delete</button></td>
          <td><button class = 'btn btn-success' class='edit-btn' data-id = '{$row['id']}'>Edit</button></td>
        </tr>
    
    ";
   }
   $output .="</table>";
   mysqli_close($conn);
   echo $output;
}else{
    echo"empty....";
}
?>