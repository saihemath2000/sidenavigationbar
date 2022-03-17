<?php 
 $course = $_GET['course'];
 $module = $_GET['module'];
 $db = mysqli_connect("localhost", "root", "", "course_info");
if (!$db) {
    die('connection failed:' . mysqli_connect_error());
}
else{
    $sql2 = "DELETE from module where coursename='$course' and title='$module'";
    $sql3 = "DELETE from topic where coursename='$course' and sectionname='$module'";
    $result2 = mysqli_query($db,$sql2);
    $result3 = mysqli_query($db,$sql3);
    if($result2){
        echo "<script>alert('module deleted successfully');";
        echo 'window.location.href="editmodule.php?course='.$course.'"';
        echo '</script>';
    }
    else{
        echo mysqli_error($db);
    }
    if($result3){
        //
    }
    else{
        echo mysqli_error($db);
    }
}
?>