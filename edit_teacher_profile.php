<?php 
    include('../registration/functions.php');
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
        $result= mysqli_query($db, "SELECT `name`,`email`,`password`,`phoneno`,`Address`,`City`,`State`,`Zipcode`,`photo` FROM users where id='$id'" );
        $result1 = mysqli_fetch_row($result);
    ?>
  <?php 
     if(isset($_POST['save'])){
      $id = $_SESSION['user']['id']; 
      // $path = '../registration/images/'.$_POST['photo'];
      // echo $_POST['photo'];
      // unlink($path);
      // if (file_exists($path)) {
      //   chmod($path, 0644);
      //       unlink($path);
      //       echo 'Deleted old image';
      //   } 
      //   else {
      //       echo 'Image file does not exist';
      //   }
      $name = $_POST['name'];
      $email = $_POST['email'];
      $pass = $_POST['pass'];
      $phone = $_POST['phoneno'];
      $address = $_POST['Address'];
      $state = $_POST['State'];
      $city = $_POST['City'];
      $zip = $_POST['Zipcode'];
      $a = $_FILES['newphoto']['name'];
	    $b = $_FILES['newphoto']['tmp_name'];
      // $photoname = $_POST['photo'];
      // $tmp_name= $_POST['photo'];
      $edit = mysqli_query($db,"update users set name='$name', email='$email', password='$pass',phoneno='$phone',Address='$address',State='$state',City='$city',Zipcode='$zip',photo='$a' where id='$id'");
      if(isset($a)) {
        $folder= '../registration/images/';
        if (!empty($a)){
           if (move_uploaded_file($b, $folder.$a)) {
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
            font-family: 'Times New Roman', Times, serif;
          "
        >
          Edit Profile
        </h1></b
      >
      <form style="margin-top: 15px" method="POST" enctype="multipart/form-data">
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
            name="pass"
            placeholder="Password"
          />
        </div>
        <div class="form-group col-md-6">
          <label for="phoneno">Phone no</label></br>
          <input
            type="text"
            class="form-control"
            name="phoneno"
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
            name="Address"
            value="<?php echo $result1[4];?>"
          />
        </div>
        <div class="form-group col-md-6">
          <label for="title">City</label>
          <input
            type="text"
            class="form-control"
            id="city"
            name="City"
            placeholder="Enter city name"
            value="<?php echo $result1[5]; ?>"
          />
        </div>
        <div class="form-group col-md-6">
          <label for="title">State</label>
          <input
            type="text"
            class="form-control"
            id="state"
            name="State"
            placeholder="Enter state name"
            value="<?php echo $result1[6]; ?>"
          />
        </div>
        <div class="form-group col-md-6">
          <label for="title">Zip</label>
          <input
            type="text"
            class="form-control"
            id="zip"
            placeholder="Enter zipcode"
            name="Zipcode"
            value="<?php echo $result1[7]; ?>"
          />
        </div>
        <div class="form-group col-md-6">
          <label>Choose new photo</label>
          <input
            type="file"
            name="newphoto"
            class="form-control-file"
            id="exampleFormControlFile1"
           />
        </div>  
        <button type="submit" name='save' class="btn btn-success" style="margin-left: 17px">
          Save Changes
        </button>
      </form>
    </div>
  </body>
</html>
