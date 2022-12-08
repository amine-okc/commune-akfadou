<?php
include("../dbconn.php");
session_start();
if (!isset($_SESSION['AdminLoginId'])) {
    header("location: index.php");
} 
else 
{

    if ($_SERVER["REQUEST_METHOD"] === "POST") 
    {
        $table = "admins";
        $name = $_POST['name'];
        $func = $_POST['function'];
        if ($name == "" || $func == "") 
        {
            echo "<script>alert('Veuillez remplir les champs obligatoires')</script>";
            echo "<script>setTimeout(\"location.href = 'admin_dash.php';\",50);</script>";
        } 
        else 
        {
            $ImageName = $_FILES["image"]["name"][0];
            $id = $_POST['id'];
            $output_dir = "../assets/admins";
            $sql = "SELECT img from `admins` WHERE id = '$id'";
            $result = mysqli_query($connection, $sql);
            $row = mysqli_fetch_array($result);
            $oldimg = $row['img'];
            if (isset($_POST["deleteImage"]) && $oldimg != '') 
            {
                unlink($output_dir . "/" . $oldimg) ;
                $oldimg = '';
            }
            if ($ImageName != '') 
            {
                require("insertFile.php");
                if($oldimg != '')
                    unlink($output_dir."/".$oldimg);
            } else 
            {
                $NewImageName = $oldimg;
            }

            $sql = "UPDATE `admins` SET username = '$name', function = '$func', img = '$NewImageName' where id = '$id'";
            if ($connection->query($sql) === TRUE) 
            {
                echo '<script type="text/JavaScript"> alert("Utilisateur modifié !")  </script>';
                echo "<script>setTimeout(\"location.href = 'admin_dash.php';\",50);</script>";
                //header("location: admin_dash.php");
            } else 
            {
                echo $connection->error;
                $connection->close();
            }
        }
    }
}
