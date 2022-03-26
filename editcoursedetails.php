<?php 
 $course = $_GET['coursename'];
 $db = mysqli_connect("localhost","root","","course_info");
 if (!$db) {
    die('connection failed:' . mysqli_connect_error());
}
else{
    $sql = "SELECT * from courseinstructors where title='$course'";
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
   $coursevideo = $_FILES['coursevideo']['name'];
   $tmp_video = $_FILES['coursevideo']['tmp_name'];
//    $current_date = date("Y-m-d H:i:s");
   if($courseimage){}
   else{
     $courseimage=$result1[9]; 
   }
   if($coursevideo){}
   else{
     $coursevideo=$result1[10]; 
   }
   $edit = mysqli_query($db,"update courseinstructors set title='$title',category='$category',start_date='$startdate',end_date='$enddate',price='$price',tags='$tags',description='$description',image='$courseimage',video='$coursevideo' where title='$course'");
   
   if(isset($courseimage)) {
     $folder= './courseimages/';
     if (!empty($courseimage)){
        if (move_uploaded_file($tmp_courseimage, $folder.$courseimage)) {
           //echo 'Uploaded!';
        }
     }
   }
   if(isset($coursevideo)) {
    $folder= './coursevideo/';
    if (!empty($coursevideo)){
       if (move_uploaded_file($tmp_video, $folder.$coursevideo)) {
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
      <b
        ><h1
          style="
            color: black;
            font-size: 40px;
            margin-left: 16px;
            margin-top:50px;
            font-family: 'Times New Roman', Times, serif;
          "
        >
          Edit Course Details
        </h1></b
      >
      <form style="margin-top: 10px; margin-left: 10px" method="POST" enctype='multipart/form-data'>
        <div class="form-group col-md-6">
          <label for="course">Course title</label>
          <input
            type="text"
            class="form-control"
            id="course1"
            placeholder="Enter title"
            name="coursetitle"
            value = "<?php echo $result1[2]; ?>"
          />
        </div>
        <div class="form-group col-md-6">
          <label for="exampleFormControlSelect1">Choose Category</label>
          <select class="form-control" id="exampleFormControlSelect1" name="category">
            <option><?php echo $result1[3]; ?></option>  
            <option>Choose category</option>
            <option>Computer science</option>
            <option>General</option>
          </select>
        </div>
        <div class="form-group col-md-6">
          <label for="course">Mention Schedule</label>
          <input
            type="text"
            class="form-control"
            id="startdate"
            name="startdate"
            placeholder="enter start date"
            value = "<?php echo $result1[4]; ?>"
          />
        </br>
          <input
            type="text"
            class="form-control"
            id="enddate"
            name="enddate"
            placeholder="enter end date"
            value = "<?php echo $result1[5]; ?>"
          />
        </div>
        <div class="form-group col-md-6">
          <label for="course">Enter price(</label>
          <small>in rupees)</small>
          <input
            type="number"
            step="any"
            class="form-control"
            id="price"
            name="price"
            placeholder="price in rupees"
            value = "<?php echo $result1[6]; ?>"
          />
        </div>
        <div class="form-group col-md-6">
          <label for="course">Tags</label>
          <input
            type="text"
            class="form-control"
            id="tags"
            placeholder="#html#programming...."
            name="tags"
            value = "<?php echo $result1[7]; ?>"
          />
        </div>
        <div class="form-group col-md-6">
          <label for="exampleFormControlTextarea1">Description</label>
          <textarea
            class="form-control"
            id="exampleFormControlTextarea1"
            rows="5"
            name="description"
          ><?php echo $result1[8]; ?></textarea>
        </div>
        <div class="form-group col-md-6">
          <label for="exampleFormControlFile1">Image for course</label>
          <input
            type="file"
            class="form-control-file"
            id="exampleFormControlFile1"
            name="courseimage"
          />
        </div>
        <div class="form-group col-md-6">
          <label for="exampleFormControlFile1">Video for course</label>
          <input
            type="file"
            class="form-control-file"
            id="exampleFormControlFile1"
            name="coursevideo"
          />
        </div>
        <button
          type="submit"
          style="margin-left: 12px"
          class="btn btn-primary"
          name="save"
        >
          Save Changes
        </button>
      </form>
    </div>
</body>
</html>