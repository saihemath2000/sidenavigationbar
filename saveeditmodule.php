<?php 
$course = $_GET['course'];
$module = $_GET['module'];
$text = $_GET['text'];
$db = mysqli_connect("localhost", "root", "", "course_info");
if (!$db) {
    die('connection failed:' . mysqli_connect_error());
}
else{
    $sql2 = "UPDATE module set title='$text' where coursename='$course' and title='$module'";
    $sql3 = "UPDATE topic set sectionname='$text' where coursename='$course' and sectionname='$module'";
    $result2 = mysqli_query($db,$sql2);
    $result3 = mysqli_query($db,$sql3);
    if($result2){
        echo "<script>alert('module updated successfully');";
        // header('location:editcourse.php');
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