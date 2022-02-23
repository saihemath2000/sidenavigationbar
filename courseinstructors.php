<?php 
  include('../registration/functions.php');
?>
<?php
ob_start();
echo $_SESSION['user']['name'];
$instructor = ob_get_clean(); 
$db = mysqli_connect("localhost", "root", "", "course_info");
$instructor=  $_SESSION['user']['name']; 
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    if (isset($_POST['submitforcourse'])) {
        $i=1;
        $title = $_POST['coursetitle'];
        $category = $_POST['category'];
        $startdate = $_POST['startdate'];
        $enddate = $_POST['enddate'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $imagename = $_FILES['courseimage']['name'];
        $tmp_name = $_FILES['courseimage']['tmp_name'];
        if (isset($imagename)) {
            if (move_uploaded_file($tmp_name, 'courseimages/' . $imagename)) {
                // echo 'uploaded';
            }
        }
        $sql = mysqli_query($db,"SELECT MAX(id) AS max FROM `courseinstructors`;");
        $res = mysqli_fetch_array($sql);
        $i = $res['max']+1;
        $sql1 = "INSERT INTO courseinstructors (id,instructor,title,category,start_date,end_date,price,description,image)
          VALUES ('$i','$instructor','$title','$category','$startdate','$enddate','$price','$description','$imagename')";
        $sql3 = mysqli_query($db,"SELECT MAX(id) AS max FROM `module`;");  
        $res1=mysqli_fetch_array($sql3);
        $r=$res1['max']+1;      
        $sql2 = "INSERT INTO module (id,coursename,title) VALUES ('$r','$title','')";
        $result1 = mysqli_query($db, $sql1);
        $result2 = mysqli_query($db, $sql2);
        $sql4 = mysqli_query($db,"SELECT MAX(id) AS max FROM `topic`;");  
        $res3=mysqli_fetch_array($sql4);
        $m=$res3['max']+1;      
        $sql3 = "INSERT INTO topic (id,coursename,sectionname,title,video,document) VALUES ('$m','$title','','','','')";
        $result3 = mysqli_query($db, $sql3);
        if ($result1) {
            // echo data uploaded successfully;
            header('location:moduletab.php?course='.$title.'');
        } else {
            echo 'coursedata not uploaded successfully';
            echo mysqli_error($db);

        }
        if ($result2) {
            // echo data uploaded successfully;
            header('location:moduletab.php?course='.$title.'');
        } else {
            echo 'sectiondata not uploaded successfully';
            echo mysqli_error($db);
        }
        if ($result3) {
            // echo data uploaded successfully;
            header('location:moduletab.php?course='.$title.'');
        } else {
            echo 'topicdata not uploaded successfully';
            echo mysqli_error($db);
        }
    }
    mysqli_close($db);
}
