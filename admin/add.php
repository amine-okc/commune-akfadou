<?php

 include("../dbconn.php");

 session_start();
 if (!isset($_SESSION['AdminLoginId']))
 {
     header("location: index.php");
 }
 else{


  if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $table = $_POST['selected'];
    require("insertFile.php"); 
    
      $title = $_POST["title"];
      $author = $_POST["author"];
      $content = $_POST["content"];
      $stat = $_POST["radio"];
      $content = str_replace("'", "\'", $content);
      $title = str_replace('"', "\"", $title);
      if(isset($_POST['date_exp']))
        $date_exp = $_POST['date_exp'];
      if(isset($_POST['date_exp']))
        $date = $_POST['date'];
      if ($ImageName == '')
        $NewImageName = '';
      if ($table == "news")
        $sql = "INSERT INTO `news` (title, author, content, img) VALUES ('$title','$author', '$content', '$NewImageName')";
      else if ($table == "projects")
        $sql = "INSERT INTO `projects` (title, author,content, img, stat, date) VALUES ('$title', '$author', '$content', '$NewImageName', '$stat', '$date')";
      else if ($table == "scroll")
        $sql = "INSERT INTO `scroll` (title , author,content, img) VALUES ('$title', '$author','$content', '$NewImageName')";

      else if ($table == "com")
        $sql = "INSERT INTO `com` (title, author,img, content) VALUES ('$title', '$author', '$NewImageName', '$content')";
      else if ($table == "appels")
        $sql = "INSERT INTO `appels` (title, author,content, file, date_exp) VALUES ('$title', '$author', '$content', '$NewImageName', '$date_exp')";
      if ($table != "gallery" && $connection->query($sql) === TRUE){
        echo '<script type="text/JavaScript"> alert("Ajoutée !")  </script>';
      }else if ($table != "gallery" && $connection->query($sql) !== TRUE)
        echo '<script type="text/JavaScript"> alert("Erreur !")  </script>';
      echo "<script>location.href = 'admin_dash.php'</script>";
      
      //header("location: admin_dash.php");

      //header("location: admin_dash.php");

  }
  $connection->close();
}
?>


