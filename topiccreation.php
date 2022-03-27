<?php include('./dashboard.php');?>

<?php 
  $coursename = $_GET['coursename'];
  $module = $_GET['module'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topic creation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>    
    <style>
      body{
        font-size:20px;
      }
    </style>
</head>
<body>
  
  <div class="container">
    <div class="row">
      <div class="col-4">
        <a href="modulesdisplay.php?course=<?php echo $coursename ?>" style="text-decoration:none;">Back to module</a>
      </div>
      <div class="col-8">
        <h2 id="#adrin" style="color:green">Adding Topics</h2>
        <!-- <h2><?php echo $_GET['coursename'] ?></h2>
        <h2><?php echo $_GET['module'] ?></h2> -->
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="login-form">
          <form style="margin-top: 10px; margin-left: 10px"  enctype='multipart/form-data' method="POST" action="./topiccreationdb.php?course=<?php echo $coursename?>&module=<?php echo $module?>">
            <div class="form-group col-md-8">
              <label for="course">Topic</label>
              <input
                type="text"
                class="form-control"
                id="course1"
                name="topictitle"
                placeholder="Enter topic"
              />
            </div>
            <div class="form-group col">
              <label for="exampleFormControlFile1">Upload video</label>
              <input
                type="file"
                class="form-control-file"
                id="exampleFormControlFile1"
                name="topicvideo"
              />
            </div>
            <div class="form-group col">
              <label for="exampleFormControlFile1">Upload documents<small>(can upload multiple)</small></label>
              <input
                type="file"
                class="form-control-file"
                id="files0"
                name="files0[]"
                multiple
              />
            </div>
            <span style="font-size: 12pt;margin-left:18px;">Click "+" for more files
            <a><i id="more_files" class='fa fa-plus'></i></a></span><br><br>
            <a href="" style="text-decoration:none;font-size:20px;margin-left:20px;">Click to add Quiz</a>
            <center><button
              type="submit"
              name="submittopic"
              style="margin-left: 12px"
              class="btn btn-primary col-md-6"
            >
              Update
            </button></center>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <script type="text/javascript">   
    $(document).ready(function() {
        $(document).on('click','#more_files', function() {
            var numOfInputs = 1;
            while($('#files'+numOfInputs).length) { numOfInputs++; }//once this loop breaks, numOfInputs is greater than the # of browse buttons
    
            $("<input type='file' multiple/>")
                .attr("style","font-size:20px;")
                .attr("id", "files"+numOfInputs)
                .attr("name", "files"+numOfInputs+"[]")
                .insertAfter("#files"+(numOfInputs-1));
    
            // $("<br/>").insertBefore("#files"+numOfInputs);
            $('#files'+(numOfInputs-1)).hide();
        });
    });
    </script> 
</body>
</html>