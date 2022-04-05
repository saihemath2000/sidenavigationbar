<?php 
  $db = mysqli_connect("localhost", "root", "","course_info");
  if(!$db) {
      die('connection failed:' . mysqli_connect_error());
  }
 $course = $_GET['course'];
 $module = $_GET['module'];
 $topic = $_GET['topic'];
 echo $course.$module.$topic;
 if(isset($_POST['save'])){
     $transcript = $_POST['transcript'];
     $sql="UPDATE topic set transcript='$transcript' where coursename='$course' and sectionname='$module' and title='$topic'";
     $result=mysqli_query($db,$sql);
     if($result){
         header('location:topicdetailsincourseinformation.php?course='.$course.'&module='.$module.'&topic='.$topic.'');
     }
     else{
         mysqli_errno($db);
     }   
 }
?>
