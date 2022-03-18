<?php include('./dashboard.php');?>
<?php 
 $course = $_GET['course'];
 $db = mysqli_connect("localhost", "root", "", "course_info");
if (!$db) {
    die('connection failed:' . mysqli_connect_error());
}
else{
    $sql="SELECT title from module where coursename='$course'";
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
<body onload="checkEdits()">
 <a href="editcourse.php" style="margin-top:25px;">Back to Courses</a></br>  
 <a href="addmoduleseparate.php?course=<?php echo $course;?>"><svg style="margin-left:280px;margin-top:0px;"xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16" id="sectionid"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/></svg>Add Modules</a>
  
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
           $module=$row[0];
           echo '<tr>';
           echo '<td>'.$i.'</td>';
           echo '<td style="font-family:"Josefin Sans",sans-serif;"><a contenteditable="true" id="'.$row[0].'">'.$row[0].'</a></td>';
           echo '<td id="save" "><a onclick="saveEdits('."'$module'".','."'$course'".');"><i class="fa fa-save"></i></a></td>';
           echo '<td id="delete" "><a onclick="deletemodule('."'$module'".','."'$course'".');"><i class="fa fa-trash"></i></a></td>';
           echo '<td id="gotomodule" "><a href="edittopic.php?module='.$module.'&course='.$course.'"><i class="fa fa-arrow-right"></i></a></td>';           
           echo '</tr>';
          }
      ?>
    </tr>
  </table>
  <script>
    function saveEdits(module,course){
      var editElem = document.getElementById(module);
      var userVersion = editElem.innerHTML;
      localStorage[module] = userVersion;
      document.location = "saveeditmodule.php?course="+course+"&module="+module+"&text="+userVersion;  
    }
    function deletemodule(module,course){
      var editElem = document.getElementById(module);
      // var userVersion = editElem.innerHTML
      localStorage.removeItem(module);
      document.location = "deletemodule.php?course="+course+"&module="+module;  
    }
    function checkEdits(){
      var values = [],
      keys = Object.keys(localStorage),
      i = keys.length;
      while(i--){
        document.getElementById(keys[i]).innerHTML =localStorage.getItem(keys[i]) ;
        values.push( localStorage.getItem(keys[i]) );
      }
      return values;
    }
  </script>
</body>
</html>