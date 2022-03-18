<?php 
 $course = $_GET['course'];
 $module = $_GET['module'];
 $topic = $_GET['topic'];
 $db = mysqli_connect("localhost", "root", "", "course_info");
if (!$db) {
    die('connection failed:' . mysqli_connect_error());
}
else{ 
    $sql3 = "DELETE from topic where coursename='$course' and sectionname='$module' and title='$topic'";
    $result3 = mysqli_query($db,$sql3);
    if($result3){
        echo "<script>alert('topic deleted successfully');";
        echo 'window.location.href="edittopic.php?course='.$course.'&module='.$module.'"';
        echo '</script>';
    }
    else{
        echo mysqli_error($db);
    }
}
?>