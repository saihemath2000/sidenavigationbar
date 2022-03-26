<?php include './dashboard.php';?>
<?php 
 $module = $_GET['module'];
 $course= $_GET['course'];
 $topic = $_GET['topic'];
 $db = mysqli_connect("localhost", "root", "","course_info");
if(!$db) {
    die('connection failed:' . mysqli_connect_error());
}
 $path='topicvideos/';
 $docpath='topicdocuments/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topic details</title>
</head>
<body>
<figure>
    <?php 
       $sql="SELECT * from topic where coursename='$course' and sectionname='$module' and title='$topic'";
       $result = mysqli_query($db,$sql);
       $row= mysqli_fetch_row($result);
    //    echo $row[3];
       $a= $row[4];
       $allfiles= $row[5];
       $name=".mp4";
       if($a==''){
           echo "<center><h2 style='margin-top:22px;'>Sorry no video uploaded to display</h2></center><br>";
       }
       else{
        //    echo $a;
       }
       $filenames = explode(':',$allfiles);
    ?>
            <div class="row">
                <div class="col-6">
                    <div class="video">
                        <h1 style='margin-left:30px;margin-top:40px;'><?php echo $topic; ?></h1>
                        <video style="width:600px;height:300px;margin-left:20px;margin-top:102px;" id="main_video" controls >
                            <source src="<?php if($a!=''){ echo $path.$a.$name;} else {echo "Sorry no video found";}?>" type="video/mp4">
                        </video></br></br>
                    </div>
                </div>
                <div class="col-4">  
                    <details style="margin-left:40px;">
                        <summary aria-controls="transcript_content" tabindex="0" aria-expanded="false" id="show-hide-transcript" style='font-size:20px;' > Transcript </summary>
                        <div id="transcript_content" aria-live="off" aria-atomic="true" aria-relevant="all" tabindex="0" aria-expanded="false" role="article" style='font-size:20px;' >andnndndn</div>
                    </details></br></br>
               </div>
               
        <!-- </figure> -->
            </div>
            <?php
                $newArr=array();
                // print_r(array_unique($filenames));
                foreach($filenames as $file) {
                    if(!in_array($file, $newArr)){
                        array_push($newArr, $file);
                    }
                 }
                echo '<h2 style="margin-left:25px;">Uploaded documents</h2><br><br>';
                foreach($newArr as $file){
                    if($file=='' and count($newArr)==1){
                        echo '<h3 style="margin-left:25px;color:red;">No documents uploaded</h3>';
                        break;
                    }
                    else if($file==''){
                        //
                    }
                    else{
                        echo "<a style='margin-left:25px;text-decoration:none;font-size:20px;' href='download.php?file=".$docpath.$file."'>$file</a>";
                        echo "<br><br>";
                    } 
                }
            ?>
            
</body>
</html>