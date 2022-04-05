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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        #transcriptinput{
            display:none;
        }
    </style>
</head>
<body onload="checkEdits()">
<figure>
    <?php 
       $sql="SELECT * from topic where coursename='$course' and sectionname='$module' and title='$topic'";
       $result = mysqli_query($db,$sql);
       $row= mysqli_fetch_row($result);
    //    echo $row[3];
       $a= $row[4];
       $allfiles= $row[5];
       $name=".mp4";
       $transcript=$row[6];
       if($a==''){
           echo "<center><h2 style='margin-top:22px;'>Sorry no video uploaded to display</h2></center><br>";
       }
       else{
        //    echo $a;
       }
       $filenames = explode(':',$allfiles);
    ?>
        <div class="video">
            <h1 style='margin-left:30px;margin-top:40px;'><?php echo $topic; ?></h1>
            <video style="width:600px;height:300px;margin-left:20px;margin-top:102px;" id="main_video" controls >
                <source src="<?php if($a!=''){ echo $path.$a.$name;} else {echo "Sorry no video found";}?>" type="video/mp4">
            </video></br></br>
        </div>
        <details style="margin-left:40px;">
                    <summary aria-controls="transcript_content" tabindex="0" aria-expanded="false" id="show-hide-transcript" style='font-size:20px;' > Transcript </summary>                    
                    <div id="transcript_content" aria-live="off" 
                         aria-atomic="true" aria-relevant="all" 
                         tabindex="0" aria-expanded="false" 
                         role="article" style='font-size:20px;' >
                         <?php 
                            if($transcript){
                                echo '<div class="row"><div class="col-6"><textarea class="form-control"  id="'.$topic.'" name="transcript"  rows="3" id="transcript" >'.$transcript.'</textarea></div><div class="col-6">
                                      <a onclick="saveEdits('."'$module'".','."'$course'".','."'$topic'".');" style="text-decoration:none;color:green;">
                                      <i class="fa fa-save" aria-hidden="true"></i></a></div></div>';
                                
                            } 
                            else{
                                echo 'Not found';
                            } 
                        ?>
                    </div>
                </details><br><br>

         <strong style="font-size:20px;margin-left:40px;">Transcribe your video for free in <a href="https://app.getwelder.com/transcriptions" style="text-decoration:none;">Free Video Transcriber</a></strong><br><br> 
        <a 
            onclick="edit('<?php echo $a; ?>')"
            style="font-size:20px;
            text-decoration:none;"><svg style="margin-left:30px;margin-top:0px;"xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16" id="sectionid"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/></svg>Add Transcript</a> 
            <div id="transcriptinput">
                <form action="transcriptdb.php?course=<?php echo $course;?>&module=<?php echo $module; ?>&topic=<?php echo $topic; ?>" 
                method="POST" style="margin-left:20px;">
                    <div class="form-group">
                        <label for="transcipttextarea" style="font-size:20px;">Enter transcript</label>
                        <textarea class="form-control" name="transcript" style="width:500px;" id="transcript" rows="3"></textarea>
                    </div>
                    <button  name="save" type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div><br><br><br>
            <div>  
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
                        echo '<h3 style="margin-left:35px;color:red;">No documents uploaded</h3>';
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
            <script>
                function edit(value){
                    var element = document.getElementById('transcriptinput');
                    // alert(value); 
                    if(!value){
                         alert("No video found, you cannot add transcript");
                    }
                    else{
                        element.style.display='block';
                    }
                }
                function saveEdits(module,course,topic){
                    var element = document.getElementById(topic);
                    var temp =course+topic;
                    var userVersion = element.value;
                    // alert(userVersion);
                    localStorage[temp] = userVersion;
                    document.location = "edittranscript.php?course="+course+"&module="+module+"&text="+userVersion+"&topic="+topic; 
                }
                function checkEdits(){
                    var values = [],
                    keys = Object.keys(localStorage),
                    i = keys.length;
                    while(i--){
                        document.getElementById(keys[i]).innerHTML =localStorage.getItem(keys[i]) ;
                        values.push( localStorage.getItem(keys[i]) );
                    }
                    return values;
                }
            </script>
            
</body>
</html>