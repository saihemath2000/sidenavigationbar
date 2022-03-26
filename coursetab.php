<?php include('./dashboard.php');?>
<?php include('../teacherregistration/validation.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create course</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
      integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
      crossorigin="anonymous"
    />
    <style>
        body{
        font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container" style="margin-left:10px;margin-top: 50px;">
    <div class="row">
        <div class="col-8">
            <h2>Enter Course Details</h2></br>
        </div>
        <div class="col-4">
            <a href="moduletab.php" style="text-decoration: none;">Next to module</a>
        </div>
    </div>    
    <form style="margin-top: 10px; margin-left: 10px" method="POST" enctype='multipart/form-data' action='./courseinstructors.php'>
        <div class="form-group col-md-6">
          <label for="course">Course title</label>
          <input
            type="text"
            class="form-control"
            id="course1"
            placeholder="Enter title"
            name="coursetitle"
          />
        </div>
        <div class="form-group col-md-6">
          <label for="exampleFormControlSelect1">Select category</label>
          <select class="form-control" id="exampleFormControlSelect1" name="category">
            <option>Choose category</option>
            <option>Computer science</option>
            <option>General</option>
          </select>
        </div>
        <div class="form-group col-md-6">
          <label for="course">Mention Schedule</label>
          <input
            type="text"
            class="form-control"
            id="startdate"
            name="startdate"
            placeholder="enter start date"
          />
        </br>
          <input
            type="text"
            class="form-control"
            id="enddate"
            name="enddate"
            placeholder="enter end date"
          />
        </div>
        <div class="form-group col-md-6">
          <label for="course">Enter price(</label>
          <small>in rupees)</small>
          <input
            type="number"
            step="any"
            class="form-control"
            id="price"
            name="price"
            placeholder="price in rupees"
          />
        </div>
        <div class="form-group col-md-6">
          <label for="course">Tags</label>
          <input
            type="text"
            class="form-control"
            id="tags"
            placeholder="#html#programming...."
            name="tags"
          />
        </div>
        <div class="form-group col-md-6">
          <label for="exampleFormControlTextarea1">Description</label>
          <textarea
            class="form-control"
            id="exampleFormControlTextarea1"
            rows="5"
            name="description"
          ></textarea>
        </div>
        <div class="form-group col-md-6">
          <label for="exampleFormControlFile1">Image for course</label>
          <input
            type="file"
            class="form-control-file"
            id="exampleFormControlFile1"
            name="courseimage"
          />
        </div>
        <div class="form-group col-md-6">
              <label for="exampleFormControlFile1">Video for course</label>
              <input
                type="file"
                class="form-control-file"
                id="exampleFormControlFile1"
                name="coursevideo"
              />
        </div>
        <button
          type="submit"
          style="margin-left: 12px"
          class="btn btn-primary"
          name="submitforcourse"
        >
          Submit
        </button>
      </form>
      </div>
</body>
</html>