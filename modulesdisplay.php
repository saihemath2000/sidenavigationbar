<?php
   $db = mysqli_connect("localhost", "root", "", "course_info");
   if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
   }
?> 
   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        #hide{
            display:none;
        }
        svg path:hover + #hide{
            display:block;
        }
    </style>
</head>
<body>
    <a href="./moduletab.php" style="text-decoration:none;margin-left:10px;font-size:22px;">Back to Add module</a></br></br>
    <ul class="list-group" style="width:500px;height:75px;">
    <?php
        $module='module';
        $anchor='anchor';
        $m=1;
        $fer = $_GET['course'];
        $sql = "SELECT coursename,title from module where coursename='$fer' order by id";
        $res = mysqli_query($db, $sql);
        if($res){
           // echo 'oko';
        }
        else{
            echo mysqli_error($db);
        }
        if(mysqli_num_rows($res)>0){
            echo '<div class="row"><div class="col-6"><h3 style="margin-left:10px;">Modules</h3></div><div class="col-6"><h3 style="margin-left:60px;">Add topic</h3></div></div></br>'; 
            while($row = mysqli_fetch_assoc($res)){
              echo '<li id='."$module.$m".' class="list-group-item" style="font-size:20px;height:150px;width:300px;margin-left:10px;">'.$row["title"].'<a href="./topiccreation.php?coursename='.$row['coursename'].'&module='.$row['title'].'" id='."$anchor.$m".' style="margin-left:300px;"
              ><svg
                xmlns="http://www.w3.org/2000/svg"
                width="40"
                height="40"
                fill="currentColor"
                class="bi bi-plus"
                viewBox="0 0 16 16"
                id="sectionid"
              >
                <path
                  d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/></svg></a><div id="hide">Add topic</div></li>'; 
            } 
        }
    ?>
    </ul>
<?php 
   mysqli_close($db);
?>       
</body>
</html>