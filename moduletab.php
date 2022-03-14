<?php include('./dashboard.php');?>
<?php 
  error_reporting(E_ERROR | E_WARNING | E_PARSE);
  if(isset($_GET['course'])){
    $course= $_GET['course'];
  }
  else{
    $db = mysqli_connect("localhost", "root", "", "course_info");
    if(!$db){
      die("Connection failed: " . mysqli_connect_error());
    }
    $sql= mysqli_query($db,"SELECT coursename from module where id=(select max(id) from module)");
    if($sql){
      $res1 = mysqli_fetch_row($sql);
    } else {
      echo mysqli_error($db);
    }
    $course= $res1[0];
  }
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
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
      integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
      crossorigin="anonymous"
    />
    <style>
      body {
        font-size: 20px;
      }
    </style>    
  </head>
  <body>
    <div class="container" style="margin-top: 10px; margin-left: 10px">
      <a href="coursetab.php" style="text-decoration: none">Back to courses</a>
      <a href="modulesdisplay.php?course=<?php echo $course ?>" style="text-decoration: none;float:right;">Next to modules</a>
      
      <div class="container col-md-6">
        <form  action='./moduledb.php'>
          <input type="text" class="form-control" id="noofmodules" placeholder="enter no of modules" name="modulename" onchange="createinput(this.value)"/>
          </br> 
          <div id="appending_div">

          </div>
        </form>
      </div>
    </div>
    <script
      src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"
    ></script>
      <!-- <script> -->
      <!-- // $(document).ready(function () {
      //   var i = 1;
      //   $("#noofmodules").on("change", function () {
      //      while (i <= this.value) { 
      //       var field =
      //         '<br><label for="course">Module' +
      //         i +
      //         '</label><input type="text" name=i class="form-control" placeholder="enter module">';
      //       $(".appending_div").append(field);
      //       i = i + 1;
      //     }
      //     var c = '</br><button type="submit" name="save" class="btn btn-success col-md-4" style="margin-left:13px;">Save</button>';
      //     $(".appending_div").append(c);
      //   });
      // });
    </script> -->
  </body>
  <script>
      function createinput(value){

        // alert(value);
         var i=1;
         var div = document.getElementById('appending_div');
         var lineBreak = document.createElement('br');
         while(i<=value){
           var label = document.createElement('label');
           label.setAttribute('for','modulelabel');
           label.innerHTML='Module'+i;
           var input = document.createElement('input');
           input.setAttribute('type','text');
           input.setAttribute('name','module'+i);
           input.setAttribute('class','form-control');
           input.setAttribute('placeholder','enter module'+i);
           div.appendChild(label);
           div.appendChild(input);
           div.appendChild(lineBreak);
           i=i+1;
         }
         var button = document.createElement('button');
         button.setAttribute('type','submit');
         button.setAttribute('name','save');
         button.setAttribute('class','btn btn-success col-md-4');
         button.setAttribute('style','margin-left:13px;');
         button.innerHTML='Save';
         div.appendChild(button);       
      } 
    </script>
</html>
