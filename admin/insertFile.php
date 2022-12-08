<?php
if (!isset($_SESSION['AdminLoginId'])) {
    header("location: index.php");
}
$output_dir =  "../assets/" . $table;/* Path for file upload */
if (!file_exists($output_dir)) {
    @mkdir($output_dir, 0777);
}
$RandomNum   = time();
$ImageType      = $_FILES['image']['type'];
$ImageName = $_FILES["image"]["name"];
if(isset($ImageName))
    $total = count($ImageName);


if ($total == 1) {
    $ImageExt = substr($ImageName[0], strrpos($ImageName[0], '.'));
    $ImageExt       = str_replace('.', '', $ImageExt);
    if ($ImageName[0] != '')
        $NewImageName = $RandomNum . '.' . $ImageExt;
    else
        $NewImageName = '';
    $title = $NewImageName;
    move_uploaded_file($_FILES["image"]["tmp_name"][0], $output_dir . "/" . $NewImageName);
    if($table == "gallery" ){
        $author = $_POST['author'];
        $title = $_POST['title'];
        $sql = "INSERT INTO `gallery` (title, author,img) VALUES ('$title', '$author', '$NewImageName')";
        if ($connection->query($sql) === TRUE) {
            echo '<script type="text/JavaScript"> alert("Ajoutée !")  </script>';
            echo "<script>setTimeout(\"location.href = 'admin_dash.php';\",500);</script>";
        } else
            echo '<script type="text/JavaScript"> alert("Erreur !")  </script>';
    }
} else{
    
    for ($i = 0; $i < $total; $i++) {
        $ImageExt = substr($ImageName[$i], strrpos($ImageName[$i], '.'));
        $ImageExt       = str_replace('.', '', $ImageExt);
        if ($ImageName[$i] != '')
            $NewImageName = $RandomNum. $i . '.' . $ImageExt;
        else
            $NewImageName = '';
        if (!(move_uploaded_file($_FILES["image"]["tmp_name"][$i], $output_dir . "/" . $NewImageName)) && $NewImageName != '') {
            echo "error";
            die();
        }
        if ($table == "gallery" && $total > 1) {
            $author = $_POST['author'];
            $name = substr($ImageName[$i], 0, strrpos($ImageName[$i], "."));
            $sql = "INSERT INTO `gallery` (title, author,img) VALUES ('$name', '$author', '$NewImageName')";
            if (mysqli_query($connection, $sql) != TRUE) {
                echo '<script type="text/JavaScript"> alert("Erreur !")  </script>';
                die();
            }



            /* Try to create the directory if it does not exist */
        }

    }
    if ($table == "gallery" && $total > 1 )
    {
        echo '<script type="text/JavaScript"> alert("Ajoutés !")  </script>';
        echo "<script>setTimeout(\"location.href = 'admin_dash.php';\",500);</script>";
    }
}
