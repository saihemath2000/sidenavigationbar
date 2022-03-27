<?php
if(isset($_POST['submit']) && !empty($_FILES)) {
    $files = array();
    $files = $_FILES['files0'];
    //var_dump($files);//this array will match the structure of $_FILES['browser']
    //Iterate through each browser button
    $browserIterator = 1;
    while(isset($_FILES['files'.$browserIterator])) {
        //Files have same attribute structure, so grab each attribute and append data for each attribute from each file
        foreach($_FILES['files'.$browserIterator] as $attr => $values) {//get each attribute
            foreach($_FILES['files'.$browserIterator][$attr] as $fileValue)     {//get each value from attribute
                $files[$attr][] = $fileValue;//append value
            }
        }
        $browserIterator++;
    }
    //Use $files like you would use $_FILES['browser'] -- It is as though all files came from one browser button!
    $fileIterator = 0;
    while($fileIterator < count($files['name'])) {
        echo $files['name'][$fileIterator]."<br/>";
        $fileIterator++;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiple files</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>                                                                                                            
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype='multipart/form-data'>
        Select files: <br/>
        <input type='file' name='files0[]' id="files0" multiple><br/><br/><br/>
        <span style="font-size: 10pt;">Click "+" for more files
            <a href="#"><i id="more_files" class='fa fa-plus'></i></a></span>
        <br/><br/><br/>
        <input type="submit" name="submit" value="Submit"/>    
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click','#more_files', function() {
            var numOfInputs = 1;
            while($('#files'+numOfInputs).length) { numOfInputs++; }//once this loop breaks, numOfInputs is greater than the # of browse buttons
    
            $("<input type='file' multiple/>")
                .attr("id", "files"+numOfInputs)
                .attr("name", "files"+numOfInputs+"[]")
                .insertAfter("#files"+(numOfInputs-1));
    
            $("<br/>").insertBefore("#files"+numOfInputs);
            $('#files'+(numOfInputs-1)).hide();
        });
    });
    </script>
</html>