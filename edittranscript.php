<?php 
 $course= $_GET['course'];
 $module = $_GET['module'];
 $topic = $_GET['topic'];
 $text= $_GET['text'];
 $db = mysqli_connect("localhost", "root", "","course_info"); 
 if(!$db) {
    die('connection failed:' . mysqli_connect_error());
 }
 $sql="UPDATE topic set transcript='$text' where coursename='$course' and sectionname='$module' and title='$topic'";
 $result=mysqli_query($db,$sql);
 if($result){
      header('location:topicdetailsincourseinformation.php?course='.$course.'&module='.$module.'&topic='.$topic.'');  
 }
 else{
     echo mysqli_error($db);
 }
?>