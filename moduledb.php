<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
$modules = array();
$noofmodules = $_GET['modulename'];
$db = mysqli_connect("localhost", "root", "", "course_info");
for ($i = 1; $i <= $noofmodules; $i++) {
    $module = $_GET['module' . $i];
    $modules[$i] = $module;
}
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    if (isset($_GET['save'])) {
        $i;
        $coursename;
        $title = $_POST['module1'];
        $sql1 = mysqli_query($db, "SELECT id,coursename from module where id=(SELECT MAX(id) from module);");
        $sql2 = mysqli_query($db, "SELECT title from module where id=(SELECT MAX(id) from module);");
        if ($sql1) {
            $res1 = mysqli_fetch_row($sql1);
        } else {
            echo mysqli_error($db);
        }
        $res2 = mysqli_fetch_row($sql2);
        if ($res1[0] and $res1[1] and $res2[0]) {
            $i = $res1[0];
            foreach ($modules as $x => $y) {
                $i = $i + 1;
                $sql3 = "INSERT INTO module (id,coursename,title)
              VALUES ('$i','$res1[1]','$y')";
                if (!(mysqli_query($db, $sql3))) {
                    echo "Error: " . $sql3 . "<br>" . mysqli_error($db);
                }
                $sql6 = mysqli_query($db, "SELECT MAX(id) AS maxtopic FROM `topic`;");
                $res3 = mysqli_fetch_array($sql6);
                $r = $res3['maxtopic'] + 1;
                $sql7 = "INSERT into topic (id,coursename,sectionname,title,video,document) VALUES ('$r','$res1[1]','$y','','','')";
                if (!(mysqli_query($db, $sql7))) {
                    echo "Error: " . $sql7 . "<br>" . mysqli_error($db);
                }
            }
            header('location:modulesdisplay.php?course='.$res1[1].'');
        } else {
            $i = $res1[0];
            foreach ($modules as $x => $y) {
                $sql8 = mysqli_query($db, "SELECT MAX(id) AS maxtopic FROM `topic` ");
                $res4 = mysqli_fetch_array($sql8);
                if ($x == 1) {
                    echo 'ho';
                    $h = $res4['maxtopic'];
                    echo 'ho'.$y;
                    $sql4 = "UPDATE module SET title='$y' where id='$res1[0]'";
                    $sql9 = "UPDATE topic SET sectionname='$y' where coursename='$res1[1]' ";
                    if (!(mysqli_query($db, $sql4))) {
                        echo "Error: " . $sql4 . "<br>" . mysqli_error($db);
                    }
                    if ((mysqli_query($db, $sql9))) {
                        echo 'hello';
                    }
                    
                } else {
                    $i = $i + 1;
                    $h = $res4['maxtopic'] + 1;
                    $sql5 = "INSERT INTO module (id,coursename,title)
                VALUES ('$i','$res1[1]','$y')";
                    $sql10 = "INSERT into topic (id,coursename,sectionname,title,video,document) VALUES ('$h','$res1[1]','$y','','','')";
                    if (!(mysqli_query($db, $sql5))) {
                        echo "Error: " . $sql5 . "<br>" . mysqli_error($db);
                    }
                    if (!(mysqli_query($db, $sql10))) {
                        echo "Error: " . $sql10 . "<br>" . mysqli_error($db);
                    }
                    
                }
            }
            header('location:modulesdisplay.php?course='.$res1[1].' ');
        }
        mysqli_close($db);
    }
}
