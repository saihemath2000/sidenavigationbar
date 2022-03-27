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
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>    
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
      $photo = $_FILES['newphoto']['name'];
	    $tmp_photo = $_FILES['newphoto']['tmp_name'];
      $video = $_FILES['newvideo']['name'];
	    $tmp_video = $_FILES['newvideo']['tmp_name'];
      $string=$result1[11];
      $current_date = date("Y-m-d H:i:s");
      $files = array();
      $files = $_FILES['skilldocuments0'];
      foreach($_FILES['skilldocuments0']['name'] as $m=>$n){
        if (move_uploaded_file($_FILES['skilldocuments0']['tmp_name'][$m],'../teacherregistration/skilldocuments/' . $n)) {
            //  echo 'uploaded';
        } 
      }
      $browserIterator = 1;
      while(isset($_FILES['skilldocuments'.$browserIterator])) {
          //Files have same attribute structure, so grab each attribute and append data for each attribute from each file
          foreach($_FILES['skilldocuments'.$browserIterator] as $attr => $values) {//get each attribute
            foreach($_FILES['skilldocuments'.$browserIterator][$attr] as $fileValue){//get each value from attribute
                $files[$attr][] = $fileValue;//append value
            }
        }
        foreach($_FILES['skilldocuments'.$browserIterator]['name'] as $m=>$n){
            if (move_uploaded_file($_FILES['skilldocuments'.$browserIterator]['tmp_name'][$m],'../teacherregistration/skilldocuments/' . $n)) {
                //  echo $browserIterator;
            } 
        }
        $browserIterator++;
    }
    //Use $files like you would use $_FILES['browser'] -- It is as though all files came from one browser button!
    $fileIterator = 0;
    // echo count($files['name']);
    while($fileIterator < count($files['name'])) {
      if(strpos($string,$files['name'][$fileIterator]) !== false){
          //  echo "Word Found!";
          $fileIterator++;
      } else{
        $string = $string.':'.$files['name'][$fileIterator];
        $fileIterator++;
      }
    }
      if($photo){}
      else{
        $photo=$result1[5]; 
      }
      if($video){}
      else{
        $video= $result1[12];
      }
      if($string==':'){
        $string=$result1[11];
      }
      $pass = md5($pass);
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
          <label style="margin-left:17px;">Choose new Skill Documents</label>
          <input
            type="file"
            class="form-control-file"
            id="skilldocuments0"
            name="skilldocuments0[]"
            style="margin-left:17px;"
            value="<?php echo $result1[14]; ?>"
            multiple
          />
        </div>
        <span style="font-size: 10pt;margin-left:20px;">Click "+" for more files
            <a><i id="more_files" class='fa fa-plus'></i></a></span>
            <br><br>
        <button type="submit" name='save' class="btn btn-success" style="margin-left: 17px">
          Save Changes
        </button>
      </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <script type="text/javascript">   
    $(document).ready(function() {
        $(document).on('click','#more_files', function() {
            var numOfInputs = 1;
            while($('#skilldocuments'+numOfInputs).length) { numOfInputs++; }//once this loop breaks, numOfInputs is greater than the # of browse buttons
    
            $("<input type='file' multiple/>")
                .attr("style","font-size:20px;margin-left:17px;")
                .attr("id", "skilldocuments"+numOfInputs)
                .attr("name", "skilldocuments"+numOfInputs+"[]")
                .insertAfter("#skilldocuments"+(numOfInputs-1));
    
            // $("<br/>").insertBefore("#skilldocuments"+numOfInputs);
            $('#skilldocuments'+(numOfInputs-1)).hide();
        });
    });
    </script>
  </body>
</html>
