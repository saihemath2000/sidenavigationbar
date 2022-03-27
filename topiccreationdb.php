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
    // $totalfiles = count($_FILES['file']['name']);
    $string='';
    $files = array();
    $files = $_FILES['files0'];
    foreach($_FILES['files0']['name'] as $m=>$n){
        if (move_uploaded_file($_FILES['files0']['tmp_name'][$m],'topicdocuments/' . $n)) {
            //  echo 'uploaded';
        } 
    }
    $browserIterator = 1;
    while(isset($_FILES['files'.$browserIterator])) {
        //Files have same attribute structure, so grab each attribute and append data for each attribute from each file
        foreach($_FILES['files'.$browserIterator] as $attr => $values) {//get each attribute
            foreach($_FILES['files'.$browserIterator][$attr] as $fileValue){//get each value from attribute
                $files[$attr][] = $fileValue;//append value
            }
        }
        foreach($_FILES['files'.$browserIterator]['name'] as $m=>$n){
            if (move_uploaded_file($_FILES['files'.$browserIterator]['tmp_name'][$m],'topicdocuments/' . $n)) {
                //  echo $browserIterator;
            } 
        }
        $browserIterator++;
    }
    //Use $files like you would use $_FILES['browser'] -- It is as though all files came from one browser button!
    $fileIterator = 0;
    // echo count($files['name']);
    while($fileIterator < count($files['name'])) {
        $string = $string.':'.$files['name'][$fileIterator];
        // echo $files['name'][$fileIterator]."<br/>";
        $fileIterator++;
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
