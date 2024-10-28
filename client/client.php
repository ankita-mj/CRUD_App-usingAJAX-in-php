<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="jquery-3.7.1.js"></script>
    <link rel="stylesheet" href="style.css"/>
       
</head>
<body>
<div class="container mt-5">
    <!-- Table Header -->
    <table class="table table-striped table-bordered mt-3" cellspacing="0" cellpadding="2">
        <tr class="thead-dark">
            <th>First name</th>
            <th>Last name</th>    
        </tr>
            
        <tr>
            <th><input type="text" id="fname"/></th>
            <th><input type="text" id="lname"/></th>    
        </tr>
        <tr>
            <td colspan="2">
                <input type="button" id="save" value="save data"/>
            </td> 
        </tr> 
    </table> 
    <div id="alertmsg"></div>
    <h2 class="text-center">TABLE RECORDS ARE HERE</h2>
    <span id="search-bar">
        <form class="d-flex" role="search">
          <input class="form-control me-2" id= "search" style="width:300px" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="button" id="btn-search">Search</button>
        </form>
   </span>
    <!-- Bootstrap Table -->
       
    <div id="t-show"></div>
</div>    
    <div id="modal">
        <div id="modal-form" style=" width:380px; height:200px; border-radius:10px;">
            <h2>Edit</h2>
            <div id="edit-box">
            </div>   
            <button class="btn-close" id="close">X</button>
        </div>
    </div>
    <script>
    $(document).ready(function(){
        function loadData(page){
            $.ajax({
                url: "../server/ajax-load-file2.php",
                type: "POST",
                data: {pageno: page},
                success: function(data){
                    console.log(data)
                  $("#t-show").html(data); 
                }
            });
        }
        loadData(1);
    
    
        $("#save").click(function(){
            var fname = $("#fname").val();
            var lname = $("#lname").val();
            if(fname == "" || lname == ""){
                $("#alertmsg").css("color","red");
                $("#alertmsg").html("all fields are requiered..").slideDown();
            }else{
                $("#alertmsg").css("color","green");
                $("#alertmsg").html("saved successdully..").slideDown();
                $.ajax({
                   url: "../server/ajax-save-data2.php",
                   type: "POST",
                   data: {first_name: fname, last_name: lname},
                   success: function(data){
                      // $("#status").html(data);
                      loadData(1);  
                    }
                });
            }
        });
        $(document).on("click",".btn-danger",function(){
            if(confirm("do u really want to delete?")){
              var stuid = $(this).data("sid");
              var element = this;
              console.log($(this).data());
               $.ajax({
                   url: "../server/ajax-delete-data2.php",
                   type: "POST",
                   data: {id: stuid},
                   success: function(data){
                        if(data == 1){
                          $(element).closest("tr").fadeOut();
                          $("#alertmsg").css("color","green");
                          $("#alertmsg").html("deleted successfully...")
                        }else{
                          $("#alertmsg").css("color","red");
                          $("#alertmsg").html("not deleted...").slideDown();
                        }            
                    }
                });
            }
        });
        $(document).on("click",".btn-success",function(){
            $("#modal").show();
            var id = $(this).data('id');
            $.ajax({
                url: "../server/data-forupdate.php",
                type: "POST",
                data: {sid: id},
                success: function(data){
                   $("#edit-box").html(data);
                }
            });
             
        });
        $(document).on("click",".btn-close",function(){
            $("#modal").hide();
        });

        $(document).on("click",".btn-primary",function(){
           var id = $(".btn-primary").data('id');
           var f_n = $(".ff").val();
           var l_n = $(".ll").val();      
           console.log(f_n);
           console.log(l_n);
            $.ajax({
                url: "../server/ajax-update-data2.php",   
                type: "POST",
                data: {sid: id, first_name: f_n, last_name: l_n},
                success: function(data){
                    if(data == 1){
                       $("#modal").hide();
                    }
                }
            });
            loadData(1);
        });
        $("#search").on("keyup",function(){
            var search_item = $(".form-control").val();
             $.ajax({
                url: "../server/search-data.php",
                type: "POST",
                data: {search_item: search_item},
                success: function(data){
                    $("#t-show").html(data);
                }
             });
        });
        $("#btn-search").on("click",function(e){
            console.log(e)
            e.preventDefault();
            var search_item = $("#search").val();
            // console.log(search_item)
             $.ajax({
                url: "../server/search-data.php",
                type: "POST",
                data: {search_item: search_item},
                success: function(data){
                    $("#t-show").html(data);
                }
             });
               
        });
        $(document).on("click",".pagination .page-item .page-link",function(e){
            e.preventDefault();
            var page_no = $(this).attr("id");
            console.log(page_no)
            loadData(page_no);
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>