<?php 
$course = $_GET['course'];
$db = mysqli_connect("localhost", "root", "", "course_info");
if (!$db) {
    die('connection failed:' . mysqli_connect_error());
}
else{
    if(isset($_POST['submitnewmodule'])){
        $i=1;
        $max=0;
        $moduleno= $_POST['moduleno'];
        $modulename = $_POST['modulename'];
        $sql1 = "SELECT title from module where coursename='$course'";
        $result1=mysqli_query($db,$sql1);
        while ($row = mysqli_fetch_assoc($result1) and $i!=$moduleno) {
            $i=$i+1;
            $premodulename=$row['title'];
        }
        $sql2 = "SELECT id from module where coursename='$course' and title='$premodulename'";
        $result2 = mysqli_query($db,$sql2);
        $row1= mysqli_fetch_row($result2);
        $id1=$row1[0]+1;
        $sql3 = "SELECT id from topic where coursename='$course' and sectionname='$premodulename'";
        $result3 = mysqli_query($db,$sql3);
        while($row = mysqli_fetch_assoc($result3)){
            if($row['id']>$max)
               $max=$row['id'];
        }
        $id2=$max+1;
        $id2 = floor($id2);
        $sql4= "UPDATE module set id=id+1 where id>$row1[0]";
        $result4=mysqli_query($db,$sql4);
        if(!$result4){
            echo mysqli_error($db);
        }
        $sql5 = "INSERT into module values ('$id1','$course','$modulename')";
        $result5 = mysqli_query($db,$sql5);
        if(!$result5){
            echo mysqli_error($db);
        }
        $sql6 = "UPDATE topic set id=id+1 where id>$max";
        $result6 = mysqli_query($db,$sql6);
        if(!$result6){
            echo mysqli_error($db);
        }
        $sql7="INSERT into topic (id,coursename,sectionname) values ('$id2','$course','$modulename')";
        $result7 = mysqli_query($db,$sql7);
        if(!$result7){
            echo mysqli_error($db);
        }
        else{
            header('location:modulesdisplay.php?course='.$course.'');
        } 
    }
}
?>