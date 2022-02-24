<?php
$course = $_GET['course'];
$module = $_GET['module'];
$db = mysqli_connect("localhost", "root", "", "course_info");
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql1 = mysqli_query($db, "SELECT id,coursename,sectionname from topic where coursename='$course' and sectionname='$module'");
$sql2 = mysqli_query($db, "SELECT title from topic where coursename='$course' and sectionname='$module'");
if ($sql1) {
    $res1 = mysqli_fetch_row($sql1);
} else {
    echo mysqli_error($db);
}
$res2 = mysqli_fetch_row($sql2);
if (isset($_POST['submittopic'])) {
    $topic = $_POST['topictitle'];
    $topicvideo = $_FILES['topicvideo']['name'];
    $tmp_name = $_FILES['topicvideo']['tmp_name'];
    $r = 1;
    if (isset($topicvideo)) {
        if (move_uploaded_file($tmp_name, 'topicvideos/' . $topicvideo)) {
            // echo 'uploaded';
        }
    } else {
        echo 'f**k';
    }
    if ($res1[0] and $res1[1] and $res1[2] and $res2[0]) {
        $totalfiles = count($_FILES['file']['name']);
        $k = $res1[0];
        for ($i = 0; $i < $totalfiles; $i++) {
            $k = $k +0.1;
            $filename = $_FILES['file']['name'][$i];
            if (move_uploaded_file($_FILES["file"]["tmp_name"][$i], 'topicdocuments/' . $filename)) {
                $insert = "INSERT into topic (id,coursename,sectionname,title,video,document) values('$k','$res1[1]','$res1[2]','$topic','$topicvideo','$filename')";
                if (mysqli_query($db, $insert)) {
                    //echo 'Data inserted successfully';
                } else {
                    echo 'Error: ' . mysqli_error($db);
                }
            } else {
                // echo 'Error in uploading file - ' . $_FILES['file']['name'][$i] . '<br/>';
                $insert = "INSERT into topic (id,coursename,sectionname,title,video,document) values('$k','$res1[1]','$res1[2]','$topic','$topicvideo','')";
                if (mysqli_query($db, $insert)) {
                    //echo 'Data inserted successfully';
                } else {
                    echo 'Error: ' . mysqli_error($db);
                }
                header('location:modulesdisplay.php?course='.$res1[1].'');
            }
        }
         header('location:modulesdisplay.php?course='.$res1[1].'');
    } else {
        while ($r <= 2) {
            if ($r == 1) {
                $r = $r + 1;
                $m = $_FILES['file']['name'][0];
                $sql3 = "UPDATE topic set title='$topic',video='$topicvideo',document='$m' where coursename='$course' and sectionname='$module'";
                if (!(mysqli_query($db, $sql3))) {
                    echo "Error: " . $sql3 . "<br>" . mysqli_error($db);
                }
            } else {
                $totalfiles = count($_FILES['file']['name']);
                $k = $res1[0];
                $r=$r+1;
                for ($i = 1; $i < $totalfiles; $i++) {
                    $k = $k + 0.1;
                    $filename = $_FILES['file']['name'][$i];
                    if (move_uploaded_file($_FILES["file"]["tmp_name"][$i], 'topicdocuments/' . $filename)) {
                        $insert = "INSERT into topic(id,coursename,sectionname,title,video,document) values('$k','$res1[1]','$res1[2]','$topic','$topicvideo','$filename')";
                        if (mysqli_query($db, $insert)) {
                            //echo 'Data inserted successfully';
                        } else {
                            echo 'Error: ' . mysqli_error($db);
                        }
                    } else {
                        echo 'Error in uploading file - ' . $_FILES['file']['name'][$i] . '<br/>';
                    }
                }
            }
        }
         header('location:modulesdisplay.php?course='.$res1[1].'');
    }
}
else{
    echo 'funck';
}
?>
