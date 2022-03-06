<?php include('./dashboard.php');?>
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
    <link rel="stylesheet" href="mycourses.css"/>
    <style>
        .card-text{
            /* display: inline-block; */
            /* width: 180px; */
            white-space: nowrap;
            overflow: hidden !important;
            text-overflow: ellipsis;
        }
        .card-columns{
            column-count:2;
        }
    </style>
</head>
<body>
    <div class="col-4" style="margin-top:50px;">
       <input type="text" class="form-control" id="search"  placeholder="search" onchange="searchcourses()"></br>
    </div>
    <?php
$path = './courseimages/';
$g = 0;
$sql1 = "SELECT * from courseinstructors where instructor='$instructor'";
if ($result = mysqli_query($db, $sql1)) {
    $rowcount = mysqli_num_rows($result);
} else {
    echo mysqli_error($db);
}
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    echo '<div class="card-columns" style="height:400px;">';
    while ($row = mysqli_fetch_assoc($result)) {
        $fortitle=$row['title'];
        $fortitle=str_replace(' ', '', $fortitle);
        $fortitle=strtolower($fortitle);
        echo '<div class="card" name="hello"  id='.$fortitle.' style="width: 25rem;height:20rem;margin-left:10px;">';
        echo '<img class="card-img-top" src=' . $path . $row['image'] . ' style="height:150px;width:150px;margin-top:5px;" alt="course image">';
        echo '<div class="card-body" style="width:300px;"><h5 class="card-title">' . $row['title'] . '</h5><p class="card-text">' . $row['description'] . '</p>
                <a href="courseinformation.php?course='.$fortitle.'" class="btn btn-primary">Goto Course</a></div></div>';
        echo '&nbsp;';
    }
    echo '</div>';
} else {
    echo "0 results";
}
?>
 <script>
        function searchcourses(){
            let input = document.getElementById('search').value;
            input=input.toLowerCase();
            input=input.split(' ').join('');
            console.log(input);
            // let x = document.getElementsByClassName('card-title');
            // for (i = 0; i < x.length; i++) { 
            //     if (!x[i].innerHTML.toLowerCase().includes(input)) {
            //         x[i].style.display="none";
            //     }
            //     else {
            //         let g = document.querySelector('.card-title');
            //         let f = g.parentNode;
            //         let m = document.getElementById(input);
            //         m.style.display="block";
            //         console.log(m.id);
            //         // x[i].style.display="alert(x)";                 
            //     }
            // }
            const e = document.getElementsByName('hello');
            //console.log(e);
            if(input==""){
                for(i=0;i<e.length;i++){
                    e[i].style.display=="block";
                }
            }
            else{
                for(i=0;i<e.length;i++){
                    //console.log(e[i].id);
                    if(e[i].id==input){
                        e[i].style.display="block";
            //          console.log(e);
                    }
                // else if(e.id==""){
                
                // }
                    else{
                        e[i].style.display="none";
              //      console.log(e);
                    }
                }
            }
        }
    </script>
</body>
</html>
