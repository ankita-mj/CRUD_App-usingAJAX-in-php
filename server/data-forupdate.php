<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
$id = $_POST['sid'];
$conn = mysqli_connect("localhost","root","padduu","ajax",3307);
$sql = "SELECT * FROM stu WHERE id = {$id}";
$output = "";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$output = "<table width='100%' height='100%' cellpadding='10px'>
              <tr>
                 <th>First Name</th>
                 <td><input type='text' id='fname' class= 'ff' value='{$row['fname']}'/></td>
                 </tr>                            
                 <tr>
                 <th>Last Name</th>
                 <td><input type='text' id='lname' class= 'll' value='{$row['lname']}'/></td>
              </tr>                            
              <tr colspan = '2'>
                 <td><button class='btn btn-primary' data-id='{$row['id']}'> Save Update </button><td/>
              </tr>                            
           </table>";
echo $output;
?>