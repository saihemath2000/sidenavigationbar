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
    <title>Edit topic details</title>
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
  if(isset($_POST['submittopic'])){
   $title = $_POST['topictitle'];
   $topicvideo = $_FILES['topicvideo']['name'];
   $tmp_topicvideo = $_FILES['topicvideo']['tmp_name'];
   $totalfiles = count($_FILES['file']['name']);
   if($topicvideo){}
   else{
       $topicvideo= $result1[4];
   }
   for ($i = 0; $i < $totalfiles; $i++) {
    $filename = $_FILES['file']['name'][$i];
    $string=$string.':'.$filename; 
    if (move_uploaded_file($_FILES["file"]["tmp_name"][$i], 'topicdocuments/' . $filename)) {
        //echo 'uploaded;
    }
   } 
   $k =$result1[5];
   $temp =$k.':'.$string;  
   if (isset($topicvideo)) {
        if (move_uploaded_file($tmp_topicvideo, './topicvideos/' . $topicvideo)) {
        // echo 'uploaded';
        }
    } else {
         echo 'f**k';
    }
   $edit = mysqli_query($db,"UPDATE topic set title='$title',video='$topicvideo',document='$temp' where coursename='$course' and sectionname='$module' and title='$topic'");
   if($edit){ 
       mysqli_close($db);
       header("location:edittopic.php?course=$course& module=$module"); 
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
          <form style="margin-top: 10px; margin-left: 10px"  enctype='multipart/form-data' method="POST">
            <div class="form-group col-md-8">
              <label for="course">Topic</label>
              <input
                type="text"
                class="form-control"
                id="course1"
                name="topictitle"
                placeholder="Enter topic"
                value="<?php echo $result1[3];?>"
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