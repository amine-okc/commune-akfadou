<?php
    session_start();
    if (!isset($_SESSION['AdminLoginId']))
    {
        header("location: index.php");
    }
    else{
        include("../dbconn.php");
        $idUser = $_SESSION['id'];
        $id = $_GET['id'];
        $table = $_GET['table'];
        $userSql = mysqli_query($connection, "SELECT su from admins where id = '$idUser'");
        $su = mysqli_fetch_array($userSql)[0];
        $sql = mysqli_query($connection, "SELECT author from `{$table}` where id = '$id'");
        $author = mysqli_fetch_array($sql)[0];

        if ($su == "0" && $author != $idUser)
        {
            echo "<script>alert('Erreur !'); location.href = '/admin/index.php';</script>";
        }else{
        
            $dir = "../assets/". $table. "/";
            $img = $dir . $_GET['img'];

            
            

            
            if($_GET['img'] == '' || unlink($img))
            {
                $del = mysqli_query($connection,"delete from `{$table}` where id = '$id'"); // delete query
                if($del){
                    echo "<script type=\"text/JavaScript\">alert(\" Succès ! \")</script>";
                    echo "<script>window.history.back();</script>";
                }
                else{
                    echo "<script type=\"text/JavaScript\">alert(\" Erreur lors de la suppression ! \")</script>";
                    echo "<script>setTimeout(\"location.href = 'admin_dash.php';\",10);</script>";
                }	
            }
            else
            {
                
                echo "<script type=\"text/JavaScript\">alert(\" Erreur de suppression d'image ! \")</script>";
                echo "<script>setTimeout(\"location.href = 'admin_dash.php';\",10);</script>";
            }
        }
    }
