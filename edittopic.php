<?php 
 $course = $_GET['course'];
 $module = $_GET['module'];
 $db = mysqli_connect("localhost", "root", "", "course_info");
if (!$db) {
    die('connection failed:' . mysqli_connect_error());
}
else{
    $sql="SELECT distinct title from topic where coursename='$course' and sectionname='$module'";
    $result = mysqli_query($db,$sql);
    if(!$result){
        echo mysqli_error($db);
    }
    $count = mysqli_num_rows($result);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>editmodule</title>
    <style>
    th, td {
      padding: 15px;
      font-weight:bold;
    }
    body{
      font-size:24px;
    }
    a{
      text-decoration:none;
      color:black;
    }
    a:hover{
      color:blue;
    }
    table{
      margin-top:30px;
    }
  </style>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body>
 <a href='editmodule.php?course=<?php echo $course; ?>' style="margin-top:25px;">Back to Modules</a>   
<table>
    <tr>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
    <tr>
      <?php
         for($i=1;$i<=$count;$i++){
           $row = mysqli_fetch_row($result);
           $topic=$row[0];
           echo '<tr>';
           echo '<td>'.$i.'</td>';
           echo '<td style="font-family:"Josefin Sans",sans-serif;"><a id="'.$row[0].'" href="edittopicseparate.php?module='.$module.'&course='.$course.'&topic='.$topic.'">'.$row[0].'</a></td>';
           echo '<td id="delete"><a onclick="deletetopic('."'$module'".','."'$course'".','."'$topic'".');"><i class="fa fa-trash"></i></a></td>';
           echo '</tr>';
          }
      ?>
    </tr>
  </table>
  <script>
    function deletetopic(module,course,topic){
      document.location = "deletetopic.php?course="+course+"&module="+module+"&topic="+topic;  
    }
  </script>
</body>
</html>