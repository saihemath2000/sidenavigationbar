<?php
$course = $_GET['course'];
$module = $_GET['module'];
$db = mysqli_connect("localhost", "root", "", "course_info");
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql1 = mysqli_query($db, "SELECT id,coursename,sectionname from topic where coursename='$course' and sectionname='$module' and id=(SELECT MAX(id) from topic where sectionname='$module' and coursename='$course')") or die(mysqli_error($db));
$sql2 = mysqli_query($db, "SELECT title from topic where coursename='$course' and sectionname='$module' and id=(SELECT MAX(id) from topic where sectionname='$module' and coursename='$course')") or die(mysqli_error($db));
if ($sql1) {
    $res1 = mysqli_fetch_row($sql1);
} else {
    echo mysqli_error($db);
}
if (!$sql2) {
    echo mysqli_error($db);
}
$res2 = mysqli_fetch_row($sql2);
if (isset($_POST['submittopic'])) {
    $topic = $_POST['topictitle'];
    $topicvideo = $_FILES['topicvideo']['name'];
    $tmp_video = $_FILES['topicvideo']['tmp_name'];
    // $tmp_name = $_FILES['file']['tmp_name'];
    $totalfiles = count($_FILES['file']['name']);
    $string='';
    for ($i = 0; $i < $totalfiles; $i++) {
        $filename = $_FILES['file']['name'][$i];
        $string=$string.':'.$filename; 
        if (move_uploaded_file($_FILES["file"]["tmp_name"][$i], 'topicdocuments/' . $filename)) {
            //echo 'uploaded;
        }
    }
    if (isset($topicvideo)) {
        if (move_uploaded_file($tmp_video, './topicvideos/' . $topicvideo)) {
            // echo 'uploaded';
        }
    } else {
        echo 'f**k';
    }

    if ($res1[0] and $res1[1] and $res1[2] and $res2[0]) {
        $k = $res1[0];
        $k = $k + 0.1;
        $insert = "INSERT into topic (id,coursename,sectionname,title,video,document) values('$k','$res1[1]','$res1[2]','$topic','$topicvideo','$string')";
        if(mysqli_query($db, $insert)) {
            //echo 'Data inserted successfully';
        }else{
            echo 'Error: ' . mysqli_error($db);
        }
        header('location:modulesdisplay.php?course='.$res1[1].'');
    } else {
            $h=$res1[0];
            $sql3 = "UPDATE topic set title='$topic',video='$topicvideo',document='$string' where coursename='$course' and sectionname='$module' and id='$h'";
            if (!(mysqli_query($db, $sql3))) {
                    echo "Error: " . $sql3 . "<br>" . mysqli_error($db);
                }
            
          header('location:modulesdisplay.php?course='.$res1[1].'');
    }
} else {
    echo 'funck';
}
?>
