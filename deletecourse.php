<?php 
 $course = $_GET['course'];
 $db = mysqli_connect("localhost", "root", "", "course_info");
if (!$db) {
    die('connection failed:' . mysqli_connect_error());
}
else{
    $sql1 = "DELETE from courseinstructors where title='$course'";
    $sql2 = "DELETE from module where coursename='$course'";
    $sql3 = "DELETE from topic where coursename='$course'";
    $result1 = mysqli_query($db,$sql1);
    $result2 = mysqli_query($db,$sql2);
    $result3 = mysqli_query($db,$sql3);
    if($result1){
        echo "<script>alert('course deleted successfully');";
        echo 'window.location.href="editcourse.php"';
        echo '</script>';
    }
    else{
        echo mysqli_error($db);
    }
    if($result2 and $result3){
        //
    }
    else{
        echo mysqli_error($db);
    }
}
?>