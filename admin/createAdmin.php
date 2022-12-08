<?php
include("../dbconn.php");

session_start();
if (!isset($_SESSION['AdminLoginId'])) {
    header("location: index.php");
} else {


    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $table = "admins";
        $user = $_POST['username'];
        $sql = "SELECT username from admins where username = '$user'";
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) != 0)
        {
            echo "<script>alert('L\'utilisateur existe déjà !');location.href = '/admin/index.php'</script>";
            die();
        }
        require("insertFile.php");
        if($NewImageName != '')
            move_uploaded_file($_FILES["image"]["tmp_name"][0], $output_dir . "/" . $NewImageName);

            $func = strtoupper($_POST['function']);
            
            $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
            if ($ImageName == '')
                $NewImageName = '';
            if (!isset($_POST['superUser']))
                $su = 0;
            else 
                $su = 1;
            $id = time();
            $sql = "INSERT INTO `admins` (function, username, password, img, su, id) VALUES ('$func', '$user', '$pass', '$NewImageName', '$su', '$id')";

            if ($connection->query($sql) === TRUE) {

                echo "<script type=\"text/JavaScript\"> alert(\"Utilisateur créé ! Son numéro ID :  $id \")  </script>";
                echo "<script>setTimeout(\"location.href = 'admin_dash.php';\",50);</script>";
                //header("location: admin_dash.php");
            } else {
                echo "<script type=\"text/JavaScript\">alert(\"$connection->error\")</script>";
                echo "<script>setTimeout(\"location.href = 'admin_dash.php';\",10);</script>";
                $connection->close();
            }

    }
}
?>