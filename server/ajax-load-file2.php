<html>
   <head>
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>
</html>   
<?php
           $conn = mysqli_connect("localhost","root","padduu","ajax",3307);
           $limit = 5;
if($_POST['pageno']){
   $page_no = (int)($_POST['pageno']);
}else{
   $page_no = 1;
}
$offset = ($page_no - 1) * $limit;

$sql = "SELECT * FROM stu LIMIT $offset,$limit";
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
   $output .= "
   </table>";
   $sql1 = "SELECT * FROM STU";
   $result1 = mysqli_query($conn,$sql1);
   $totaldata = mysqli_num_rows($result1);
   $totalpage = ceil($totaldata/$limit);

   $output .= "
<nav aria-label='Page navigation example'>
   <ul class='pagination'>";
if($page_no > 1){
   $p = $page_no -1;
   $output .= "<li class='page-item'>
   <a class='page-link'  id='{$p}'href='' aria-label='Previous'>
   <span aria-hidden='true'>&laquo;</span>
   </a>
   </li>";
}    
for($i = 1; $i <= $totalpage; $i++){
   $output .= "<li class='page-item'><a class='page-link' id='{$i}' href=''>{$i}</a></li>";
}

if($page_no < $totalpage){
   $p = $page_no +1;
   $output .="
    <li class='page-item'>
      <a class='page-link' id='{$p}' href='' aria-label='Next'>
        <span aria-hidden='true'>&raquo;</span>
      </a>
    </li>";
   }
   $output .="
  </ul>
</nav>
   ";
   mysqli_close($conn);
   echo $output;
}else{
    echo'empty....';
}
?>