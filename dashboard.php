<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <style>
      html,
      body {
        margin: 0;
        /* padding: 3em;   */
      }
      .banner {
        /* background-color: yellow; */
        background-image: url(./bannerimage/bgimage_1.jpg);
        height: 50px;
      }
      .banner__content {
        height: 50px;
        width: 700px;
        max-width: 1000px;
        padding: 16px;
        /* margin: 0 auto; */
        /* float:left; */
      }
      .banner__text {
        flex-grow: 1;
        line-height: 1.4;
        font-family: "Quicksand", sans-serif;
        font-size: 23px;
        /* margin-left:400px;  */
        float: right;
        color: red;
      }
      .banner__text:hover {
        color: black;
      }
      .banner__image {
        float: left;
      }
      .button {
        background: burlywood;
        box-shadow: 0 0 0;
        /* display:inline-block; */
        font-size: 2em;
        padding: 0.5em 2em;
        text-decoration: none;
        float: left;
      }
      .button:hover {
        box-shadow: 10px 10px 0 rgba(0, 0, 0, 0.5);
      }

      .parallelogram {
        transform: skew(-30deg);
        float: left;
        width: 20px;
        height: 2px;
        padding-top: 3px;
        padding-right: 30px;
        padding-bottom: 20px;
        padding-left: 35px;
      }

      .skew-fix {
        display: inline-block;
        transform: skew(30deg);
        text-align: center;
      }
    </style>
  </head>
  <body>
    <div class="banner">
      <div class="banner__content">
        <!-- <a href="#" id="abc">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          OLS
        </a> -->
         <div class="banner__text">
          <strong style="font-family:'Josefin Sans', sans-serif">ONLINE LEARNING SYSTEM</strong>
        </div>
      </div>
    </div>
  </body>
</html>
