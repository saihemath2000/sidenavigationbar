<?php 
 $course = $_GET['course'];
 $module = $_GET['module'];
 $topic = $_GET['topic'];
 $db = mysqli_connect("localhost","root","","course_info");
 if (!$db) {
    die('connection failed:' . mysqli_connect_error());
}
else{
    $sql = "SELECT * from topic where title='$topic' and coursename='$course' and sectionname='$module'";
    $result = mysqli_query($db,$sql);
    if(!$result){
        echo mysqli_error($db);
    }
    else{
        $result1 = mysqli_fetch_row($result);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit course details</title>
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
    <style>
        body{
            font-size:20px;
        }
    </style>
</head>
<body>
<?php  
  if(isset($_POST['save'])){
   $title = $_POST['coursetitle'];
   $category = $_POST['category'];
   $startdate = $_POST['startdate'];
   $enddate = $_POST['enddate'];
   $price = $_POST['price'];
   $tags = $_POST['tags'];
   $description = $_POST['description'];
   $courseimage = $_FILES['courseimage']['name'];
   $tmp_courseimage = $_FILES['courseimage']['tmp_name'];
//    $current_date = date("Y-m-d H:i:s");
   if($courseimage){}
   else{
     $courseimage=$result1[9]; 
   }
   $edit = mysqli_query($db,"update courseinstructors set title='$title',category='$category',start_date='$startdate',end_date='$enddate',price='$price',tags='$tags',description='$description',image='$courseimage' where title='$course'");
   
   if(isset($courseimage)) {
     $folder= './courseimages/';
     if (!empty($courseimage)){
        if (move_uploaded_file($tmp_courseimage, $folder.$courseimage)) {
           //echo 'Uploaded!';
        }
     }
   }
   if($edit){ 
       mysqli_close($db);
       header("location:editcourse.php"); 
       exit;
   }
   else{
       echo mysqli_error($db);
   }
        
}
?>    
<div class="container">
    <div class="row">
      <div class="col-4">
        <a href="edittopic.php?course=<?php echo $course; ?>&module=<?php echo $module;?>" style="text-decoration:none;">Back to topics</a>
      </div>
      <div class="col-8">
        <h2 id="#adrin" style="color:green">Editing topic</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="login-form">
          <form style="margin-top: 10px; margin-left: 10px"  enctype='multipart/form-data' method="POST" action="./topiccreationdb.php?course=<?php echo $coursename?>&module=<?php echo $module?>">
            <div class="form-group col-md-8">
              <label for="course">Topic</label>
              <input
                type="text"
                class="form-control"
                id="course1"
                name="topictitle"
                placeholder="Enter topic"
              />
            </div>
            <div class="form-group col">
              <label for="exampleFormControlFile1">Upload video</label>
              <input
                type="file"
                class="form-control-file"
                id="exampleFormControlFile1"
                name="topicvideo"
              />
            </div>
            <div class="form-group col">
              <label for="exampleFormControlFile1">Upload documents<small>(can upload multiple)</small></label>
              <input
                type="file"
                class="form-control-file"
                id="exampleFormControlFile1"
                name="file[]"
                multiple
              />
            </div>
            <a href="" style="text-decoration:none;font-size:18px;margin-left:20px;">Click to add Quiz</a>
            <center><button
              type="submit"
              name="submittopic"
              style="margin-left: 12px"
              class="btn btn-primary col-md-6"
            >
              Update
            </button></center>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>