<?php include('../teacherregistration/validation.php'); ?>
<?php 
  $path="../teacherregistration/profilephotos/";
  $db = mysqli_connect("localhost", "root", "", "multi_login");
  if (!$db) {
      die("Connection failed: " . mysqli_connect_error());
  }
  $id = $_SESSION['user']['id'];
  $result = mysqli_query($db, "SELECT `photo` FROM teachers where id='$id'");
  $result1 = mysqli_fetch_row($result); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="teacherprofileincourseinformation.css">
</head>
<body> 
    <div class="box">
      <div id="overlay">
        <div class="image">
          <img src=<?php echo $path.$result1[0]; ?>  style="border-radius:50%;height:200px;width:200px;"/>  
          <div class="trick"></div>
        </div>
        <ul class="text"><?php echo $_SESSION['user']['name']; ?></ul></br>
        <div class="text1">Teacher</div>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading " role="tab" id="headingOne">
                    <h4 class="panel-title ">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="./teacher_profile.php" aria-expanded="" aria-controls="collapseOne" id="yoyo">
                        <div style="border:none;" class="title  btn btn-danger btn-outline btn-lg">ABOUT</div>
                        </a>
                    </h4>
                </div>
            </div>
        </div>
       </div>
    </div>
</body>
</html>