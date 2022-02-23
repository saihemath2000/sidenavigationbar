<?php
include '../registration/functions.php';
ob_start();
echo $_SESSION['user']['name'];
$instructor = ob_get_clean();
$db = mysqli_connect("localhost", "root", "", "course_info");
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mycourses</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        .card-text{
            /* display: inline-block; */
            /* width: 180px; */
            white-space: nowrap;
            overflow: hidden !important;
            text-overflow: ellipsis;
        }
    </style>
</head>
<body>
    <div class="col-4">
       <input type="text" class="form-control" id="search"  placeholder="search"></br>
    </div>
    <?php
    $path='./courseimages/';
$sql1 = "SELECT * from courseinstructors where instructor='$instructor'";
if ($result = mysqli_query($db, $sql1)) {
    $rowcount = mysqli_num_rows($result);
}
else{
    echo mysqli_error($db);
}
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    echo '<div class="card-group">';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="card" style="width: 25rem;height:20rem;">';
        echo '<img class="card-img-top" src='.$path.$row['image'].' style="height:250px;width:250px;" alt="course image">';
        echo '<div class="card-body" style="width:300px;"><h5 class="card-title">'.$row['title'].'</h5><p class="card-text">'.$row['description'].'</p>
                <a href="#" class="btn btn-primary">Goto Course</a></div></div>';
    }
    echo '</div>';
} else {
    echo "0 results";
}
?>
    <!-- <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="<?php ?>" alt="course image">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div> -->
</body>
</html>
