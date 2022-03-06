<?php include('./dashboard.php');?>
<?php 
    include '../teacherregistration/validation.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
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
        $db = mysqli_connect("localhost","root","","multi_login");
        if(!$db){
            die("Connection failed: " . mysqli_connect_error());
        }
  ?>
    <?php 
        $id = $_SESSION['user']['id'];
        $result= mysqli_query($db, "SELECT `name`,`email`,`password`,`phone`,`address`,`photo`,`degree`,`institute`,`department`,`experience`,`skills`,`skilldocuments`,`video` FROM teachers where id='$id'");
        $result1 = mysqli_fetch_row($result);
    ?>
  <?php 
     if(isset($_POST['save'])){
      $id = $_SESSION['user']['id']; 
      $name = $_POST['name'];
      $email = $_POST['email'];
      $pass = $_POST['password'];
      $phone = $_POST['phone'];
      $address = $_POST['address'];
      $degree = $_POST['degree'];
      $institute = $_POST['institute'];
      $department = $_POST['department'];
      $experience = $_POST['experience'];
      $skills = $_POST['skills'];
      $skilldocuments = $_FILES['skilldocuments']['name'];
      $tmp_skilldocuments = $_FILES['skilldocuments']['tmp_name'];
      $photo = $_FILES['newphoto']['name'];
	    $tmp_photo = $_FILES['newphoto']['tmp_name'];
      $video = $_FILES['newvideo']['name'];
	    $tmp_video = $_FILES['newvideo']['tmp_name'];
      $string='';
      $current_date = date("Y-m-d H:i:s");
      $total_files = count($_FILES['skilldocuments']['name']);
      for ($i = 0; $i < $total_files; $i++) {
        $filename = $_FILES['skilldocuments']['name'][$i];
        $string=$string.':'.$filename; 
        if (move_uploaded_file($_FILES["skilldocuments"]["tmp_name"][$i], '../teacherregistration/skilldocuments/' . $filename)) {
            //echo 'uploaded;
        }
      }
      if($photo){}
      else{
        $photo=$result1[5]; 
      }
      if($video){}
      else{
        $video= $result1[15];
      }
      if($string==':'){
        $string=$result1[14];
      }
      $edit = mysqli_query($db,"update teachers set name='$name', email='$email', password='$pass',phone='$phone',address='$address',photo='$photo',degree='$degree',institute='$institute',department='$department',experience='$experience',skills='$skills',skilldocuments='$string',video='$video',created_at='$current_date' where id='$id'");
      
      if(isset($photo)) {
        $folder= '../teacherregistration/profilephotos/';
        if (!empty($photo)){
           if (move_uploaded_file($tmp_photo, $folder.$photo)) {
              //echo 'Uploaded!';
           }
        }
      }
      if(isset($video)) {
        $folder= '../teacherregistration/video/';
        if (!empty($video)){
           if (move_uploaded_file($tmp_video, $folder.$video)) {
              //echo 'Uploaded!';
           }
        }
      }
      if($edit){ 
          mysqli_close($db);
          header("location:teacher_profile.php"); 
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
          Edit Profile
        </h1></b
      >
      <form style="margin-top: 35px" method="POST" enctype="multipart/form-data">
        <div class="form-group col-md-6">
          <label for="title">Name</label>
          <input
            type="text"
            class="form-control"
            id="name"
            name="name"
            placeholder="Enter name"
            value = "<?php echo $result1[0]; ?>"
          />
        </div>
        <div class="form-group col-md-6">
          <label for="exampleInputEmail1">Email</label>
          <input
            type="email"
            class="form-control"
            id="exampleInputEmail1"
            aria-describedby="emailHelp"
            placeholder="Enter email"
            name="email"
            value="<?php echo $result1[1]; ?>"
          />
        </div>
        <div class="form-group col-md-6">
          <label for="exampleInputPassword1">Password</label>
          <input
            type="password"
            class="form-control"
            id="exampleInputPassword1"
            name="password"
            placeholder="Password"
          />
        </div>
        <div class="form-group col-md-6">
          <label for="phoneno">Phone no</label></br>
          <input
            type="text"
            class="form-control"
            name="phone"
            id="phone"
            placeholder="enter your phone no"
            pattern="[0-9]{10}"
            title="A phone no number must be 10 digits without any spaces and special characters"
            value="<?php echo $result1[3]; ?>" 
          />
        </div>
        <div class="form-group col-md-6">
          <label for="title">Address</label>
          <input
            type="text"
            class="form-control"
            id="address"
            placeholder="Enter address"
            name="address"
            value="<?php echo $result1[4];?>"
          />
        </div>
        <div class="form-group col-md-6">
          <label for="title">Qualification</label>
          <input
            type="text"
            class="form-control"
            id="degree"
            placeholder="Enter degree"
            name="degree"
            value="<?php echo $result1[6];?>"
          />
        </div>
        <div class="form-group col-md-6">
          <label for="title">Institute</label>
          <input
            type="text"
            class="form-control"
            id="institute"
            placeholder="Enter institute name"
            name="institute"
            value="<?php echo $result1[7];?>"
          />
        </div>
        <div class="form-group col-md-6">
          <label for="title">Department</label>
          <input
            type="text"
            class="form-control"
            id="department"
            placeholder="Enter department name"
            name="department"
            value="<?php echo $result1[8];?>"
          />
        </div>
        <div class="form-group col-md-6">
          <label for="title">Experience</label>
          <textarea class="form-control" name="experience" id="experience" rows="2" placeholder="enter ur experience as a teacher in 1 or 2 statements" style="width: 100%; max-width: 100%;font-size:18px;"><?php echo $result1[9]; ?></textarea>
        </div>
        <div class="form-group col-md-6">
          <label for="title">Skills</label>
          <textarea class="form-control" name="skills" id="skills" rows="2" placeholder="skills u pursue" style="width: 100%; max-width: 100%;font-size:18px;" ><?php echo $result1[10]; ?></textarea>
        </div>
        
        <div class="form-group col-md-6">
          <label>Choose new photo</label>
          <input
            type="file"
            name="newphoto"
            class="form-control-file"
            id="newphoto"
           />
        </div>  
        <div class="form-group col-md-6">
          <label>Choose new video</label>
          <input
            type="file"
            name="newvideo"
            class="form-control-file"
            id="newvideo"
            value="<?php echo $result1[15]; ?>"
           />
        </div> 
        <div class="form-group col-mmd-6">
          <label style="margin-left:20px;">Choose new Skill Documents</label>
          <input
            type="file"
            class="form-control-file"
            id="skilldocuments"
            name="skilldocuments[]"
            style="margin-left:20px;"
            value="<?php echo $result1[14]; ?>"
            multiple
          />
        </div>
        <button type="submit" name='save' class="btn btn-success" style="margin-left: 17px">
          Save Changes
        </button>
      </form>
    </div>
  </body>
</html>
