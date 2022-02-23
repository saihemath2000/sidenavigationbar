<?php 
    include('../registration/functions.php');
?>
<?php
        $db = mysqli_connect("localhost","root","","multi_login");
        if(!$db){
            die("Connection failed: " . mysqli_connect_error());
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
        $id = $_SESSION['user']['id'];
        $result= mysqli_query($db, "SELECT `name`,`email`,`password`,`phoneno`,`Address`,`City`,`State`,`Zipcode`,`photo` FROM users where id='$id'" );
        $result1 = mysqli_fetch_row($result);
    ?> 
    <section style="background-color: #eee">
      <div class="container py-5">
        <h1>My details</h1></br>  
        <div class="row">
          <div class="col-lg-4">
            <div class="card mb-4" style="height:294px;">
              <div class="card-body text-center">
                <img
                  src="<?php echo '../registration/images/'.$result1[8];?>"
                  alt="avatar"
                  class="rounded-circle img-fluid"
                  style="width: 300px"
                />
                <h5 class="my-3"><?php echo $result1[0]; ?></h5>
                <p class="text-muted mb-1">Instructor</p>
              </div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="card mb-4">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Full Name</p>
                  </div>
                  <div class="col-sm-9">
                    <?php  if (isset($_SESSION['user'])) : ?>
                    <p class="text-muted mb-0"><?php echo $result1[0]; ?></p>
                    <?php endif ?>
                  </div>
                </div>
                <hr />
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Email</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0"><?php echo $result1[1]; ?></p>
                  </div>
                </div>
                <hr />
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Phone</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0"><?php echo $result1[3]; ?></p>
                  </div>
                </div>
                <hr/>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Address</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0"><?php echo $result1[4]; ?></p>
                  </div>
                </div>
                <hr/>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">City</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0"><?php echo $result1[5]; ?></p>
                  </div>
                </div>
                <hr/>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">State</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0"><?php echo $result1[6]; ?></p>
                  </div>
                </div>
                <hr/>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Zip</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0"><?php echo $result1[7]; ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
