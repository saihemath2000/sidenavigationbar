<?php
// session_start(); 
$db = mysqli_connect("localhost", "root", "","course_info");
if(!$db) {
    die('connection failed:' . mysqli_connect_error());
}
else{
    $sql= "SELECT title from module where coursename='$course' order by id";
    $result = mysqli_query($db,$sql); 
    if($result){}
    else{
        echo mysqli_error($db);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .topic{
           margin-left:100px;   
           font-size:23px;
        }
    </style>
</head>
<body>
    <?php
        $i=0;
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<p style="font-size:23px;margin-right:400px;">Module'.' '.$i.':'.' '.$row['title'].'</p>';
                $module=$row['title'];
                echo '<ol style="margin-right:400px;">';
                $sql1="SELECT title from topic where coursename='$course' AND sectionname='$module' order by id";
                $result1=mysqli_query($db,$sql1);
                if(mysqli_num_rows($result1)>0){
                    while($row1=mysqli_fetch_assoc($result1)){
                       echo '<li class="topic">'.$row1['title'].'</li>';      
                    }
                }
                echo '</ol>';
                $i=$i+1;
            }
        }else {
            echo "0 results";
        }
?>
</body>
</html>