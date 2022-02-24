<?php 
  $course = $_GET['course'];
  $db = mysqli_connect("localhost", "root", "", "course_info");
  if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CourseInfo</title>
  </head>
  <body>
    <?php 
       $path='./courseimages/';
       $sql1 = "SELECT * from courseinstructors where title='$course'";
       $result = mysqli_query($db,$sql1);
       if(!$result){
           echo mysqli_error($db);
       }
       $row = mysqli_fetch_row($result);   
    ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-10">
          <h1
            style="
              text-transform: uppercase;
              margin-top: 20px;
              margin-left:10px;
            "
          >
            <?php echo $course; ?>
          </h1>
        </div>
        <div class="col-2">
            <img src="<?php echo $path.$row[8]; ?>" alt="courseimage" width="180" height="180" style="margin-right:90px;float:right;"/>
        </div>
      </div>
    </div>
  </body>
</html>
