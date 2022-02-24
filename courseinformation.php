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
    <style>
        .sideinfo{
            background-color:#737067;
            height:60px;
        }
    </style>
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
      <div style="white-space:nowrap;">
          <h1
            style="
               text-transform:uppercase;
               margin-top: 20px;
               
            "
          >
            <?php echo $course; ?>
          </h1>
          <center><img src="<?php echo $path.$row[8]; ?>" alt="courseimage" width="150" height="150"/></center>
      </div></br>
    <div class="sideinfo">
        <svg width="60" height="60" style="margin-left:10px;" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" focusable="false" aria-hidden="true"><path d="M16.24 7.76A5.974 5.974 0 0012 6v6l-4.24 4.24c2.34 2.34 6.14 2.34 8.49 0a5.99 5.99 0 00-.01-8.48zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z" fill="currentColor"></path></svg>
    </div>
  </body>
</html>
