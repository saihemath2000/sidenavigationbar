<?php include('./dashboard.php');?>
<?php 
  error_reporting(E_ERROR | E_WARNING | E_PARSE);
  if(isset($_GET['course'])){
    $course= $_GET['course'];
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
      <div class="row" style="margin-top:25px;">
          <div class="col-4">
              <a style="text-decoration:none;margin-left:10px;" href="editmodule.php?course=<?php echo $course; ?>">Back to Modules</a>
          </div>
          <div class="col-8">
              <h4>Adding New Module</h4>
          </div>
      </div>
      <form style="margin-top: 10px; margin-left: 10px" method="POST"  action='addmoduleseparatedb.php?course=<?php echo $course;?>'>
      <div class="form-group col-4">
          <label for="moduleno">enter module no</label>
          <input
            type="text"
            class="form-control"
            id="moduleno"
            placeholder="index no of ur module"
            name="moduleno"
          />
      </div>
      <div class="form-group col-4">
          <label for="modulename">enter module name</label>
          <input
            type="text"
            class="form-control"
            id="modulename"
            placeholder="name of module"
            name="modulename"
          />
      </div>
       <button
          type="submit"
          style="margin-left: 12px"
          class="btn btn-primary"
          name="submitnewmodule"
        >
          Submit
        </button>    
    </form>
  </body>  
</html>
