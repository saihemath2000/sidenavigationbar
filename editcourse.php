<?php include('./dashboard.php'); ?>
<?php include('../teacherregistration/validation.php');?>
<?php 
  $instructor = $_SESSION['user']['name']; 
  $db = mysqli_connect("localhost", "root", "", "course_info");
  if(!$db) {
    die('connection failed:' . mysqli_connect_error());
  } 
  $sql = "SELECT title from courseinstructors where instructor='$instructor'";
  $result=mysqli_query($db,$sql);
  if(!$result){
    echo "failed" . mysqli_error($db);
  }
  $count = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Course</title>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
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
</head>
<body onload="checkEdits()">
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
           $course=$row[0];
           echo '<tr>';
           echo '<td>'.$i.'</td>';
           echo '<td style="font-family:"Josefin Sans",sans-serif;"><a contenteditable="true" id="'.$row[0].'" href="./editmodule.php?coursename='.$row[0].'">'.$row[0].'</a></td>';
          //  echo '<td id="edit" onclick="saveEdits('.$row[0].')"><i style="font-size:26px" class="fas">&#xf044;</i></td>';
           echo '<td id="save" "><a onclick="saveEdits('."'$course'".');"><i class="fa fa-save"></i></a></td>';
           echo '</tr>';
          }
      ?>
    </tr>
  </table>
  <script>
    function saveEdits(course){
      var editElem = document.getElementById(course);
      var userVersion = editElem.innerHTML;
      localStorage[course] = userVersion;
      document.location = "saveeditcourse.php?course="+course+"&text="+userVersion;  
    }
    function checkEdits(){
      // if(localStorage.userEdits!=null)
      //   document.getElementById('java').innerHTML = localStorage.userEdits;
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