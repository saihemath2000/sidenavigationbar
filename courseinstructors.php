<html>
<head>
<link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
</head>
<body>

  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<?php
include '../registration/functions.php';
?>
<?php
$temp = '';
ob_start();
echo $_SESSION['user']['name'];
$instructor = ob_get_clean();
$db = mysqli_connect("localhost", "root", "", "course_info");
$Db = mysqli_connect("localhost", "root", "", "multi_login");
// mysqli_select_db($db,"course_info");
// mysqli_select_db($Db,"multi_login");
if (!$Db) {
    die('connection failed:' . mysqli_connect_error());
} else {
    $Sql = "SELECT * from teachers where name='$instructor'";
    $result = mysqli_query($Db, $Sql);
    if ($result) {
        $row = mysqli_fetch_row($result);
        $providedskills = $row[11];
        // echo $providedskills;
    } else {
        echo "failed" . mysqli_error($Db);
    }
}

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    if (isset($_POST['submitforcourse'])) {
        $i = 1;
        $temp = $_POST['coursetitle'];
        $temp = str_replace(' ', '', $temp);
        $temp = strtolower($temp);
        $providedskills = str_replace(' ', '', $providedskills);
        $providedskills = strtolower($providedskills);
        echo "<script>console.log('$providedskills');</script>";
        echo "<script>console.log('$temp');</script>";
        $title = $_POST['coursetitle'];
        if ((strpos($providedskills, $temp)+1) == false) {
            echo "<script>$(document).ready(function(){ $('#mymodal').modal('show'); });</script>";
        } else {
            $category = $_POST['category'];
            $startdate = $_POST['startdate'];
            $enddate = $_POST['enddate'];
            $price = $_POST['price'];
            $tags = $_POST['tags'];
            $description = $_POST['description'];
            $imagename = $_FILES['courseimage']['name'];
            $tmp_name = $_FILES['courseimage']['tmp_name'];
            $videoname= $_FILES['coursevideo']['name'];
            $tmp_video = $_FILES['coursevideo']['tmp_name'];
            if (isset($imagename)) {
                if (move_uploaded_file($tmp_name, 'courseimages/' . $imagename)) {
                    // echo 'uploaded';
                }
            }
            if (isset($videoname)) {
                if (move_uploaded_file($tmp_video, 'coursevideo/' . $videoname)) {
                    // echo 'uploaded';
                }
            }
            $sql = mysqli_query($db, "SELECT MAX(id) AS max FROM courseinstructors");
            $res = mysqli_fetch_array($sql);
            $i = $res['max'] + 1;
            $sql1 = mysqli_query($db,"INSERT INTO courseinstructors 
            (id,instructor,title,category,`start_date`,end_date,price,tags,`description`,`image`,video) 
            VALUES 
            ('$i','$instructor','$title','$category','$startdate','$enddate','$price','$tags','$description','$imagename','$videoname')")or die(mysqli_error($db));
            $sql3 = mysqli_query($db, "SELECT MAX(id) AS max FROM module;");
            $res1 = mysqli_fetch_array($sql3);
            if (!$res1) {
                echo mysqli_error($db);
            }

            $r = $res1['max'] + 1;
            $sql2 = mysqli_query($db,"INSERT INTO module (id,coursename,title) VALUES ('$r','$title','')") or die(mysqli_error($db));
            // $result1 = mysqli_query($db, $sql1);
            // $result2 = mysqli_query($db, $sql2);
            $sql4 = mysqli_query($db, "SELECT MAX(id) AS max FROM topic;");
            $res3 = mysqli_fetch_array($sql4);
            if (!$res3) {
                echo mysqli_error($db);
            }

            $m = $res3['max'] + 1;
            $m=floor($m);
            $sql3 = mysqli_query($db,
            "INSERT INTO topic (id,coursename,sectionname,title,video,document) VALUES ('$m','$title','','','','')");
            // $result3 = mysqli_query($db, $sql3);
            if ($sql1) {
                // echo data uploaded successfully;
                header('location:moduletab.php?course=' . $title . '');
            } else {
                // echo 'coursedata not uploaded successfully';
                echo mysqli_error($db);

            }
            if ($sql2) {
                // echo data uploaded successfully;
                header('location:moduletab.php?course=' . $title . '');
            } else {
                // echo 'sectiondata not uploaded successfully';
                echo mysqli_error($db);
            }
            if ($sql3) {
                // echo data uploaded successfully;
                 header('location:moduletab.php?course=' . $title . '');
            } else {
                echo 'topicdata not uploaded successfully';
                echo mysqli_error($db);
            }
        }
    }
    mysqli_close($db);
}
?>
<div class="modal" id="mymodal">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Want to edit your skills</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='./edit_teacher_profile.php'">YES</button>
                    <button type="button" class="btn btn-success" onclick="window.location.href='./coursetab.php'">NO</button>
                  </div>
                </div>
              </div>
            </div>

</body>
</html>
