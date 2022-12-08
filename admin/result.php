<?php
session_start();
if (!isset($_SESSION['AdminLoginId'])) {
  header("location: index.php");
}
if (isset($_GET['logout'])) {
  session_destroy();
  header("location: index.php");
}
setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
?>

<?php


?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Compte Administrateur - <?php echo $_SESSION['AdminLoginId'] ?></title>
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a27d6ed1ca.js" crossorigin="anonymous"></script>
  <link href="../assets/bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="icon" href="../assets/img/favicon.png">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@600&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400&display=swap" rel="stylesheet">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

</head>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans&display=swap');
  body{
    font-family: 'Nunito Sans', sans-serif;
    background-color: #f4f4f4;
    background-image: url("data:image/svg+xml,%3Csvg width='120' height='120' viewBox='0 0 120 120' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M9 0h2v20H9V0zm25.134.84l1.732 1-10 17.32-1.732-1 10-17.32zm-20 20l1.732 1-10 17.32-1.732-1 10-17.32zM58.16 4.134l1 1.732-17.32 10-1-1.732 17.32-10zm-40 40l1 1.732-17.32 10-1-1.732 17.32-10zM80 9v2H60V9h20zM20 69v2H0v-2h20zm79.32-55l-1 1.732-17.32-10L82 4l17.32 10zm-80 80l-1 1.732-17.32-10L2 84l17.32 10zm96.546-75.84l-1.732 1-10-17.32 1.732-1 10 17.32zm-100 100l-1.732 1-10-17.32 1.732-1 10 17.32zM38.16 24.134l1 1.732-17.32 10-1-1.732 17.32-10zM60 29v2H40v-2h20zm19.32 5l-1 1.732-17.32-10L62 24l17.32 10zm16.546 4.16l-1.732 1-10-17.32 1.732-1 10 17.32zM111 40h-2V20h2v20zm3.134.84l1.732 1-10 17.32-1.732-1 10-17.32zM40 49v2H20v-2h20zm19.32 5l-1 1.732-17.32-10L42 44l17.32 10zm16.546 4.16l-1.732 1-10-17.32 1.732-1 10 17.32zM91 60h-2V40h2v20zm3.134.84l1.732 1-10 17.32-1.732-1 10-17.32zm24.026 3.294l1 1.732-17.32 10-1-1.732 17.32-10zM39.32 74l-1 1.732-17.32-10L22 64l17.32 10zm16.546 4.16l-1.732 1-10-17.32 1.732-1 10 17.32zM71 80h-2V60h2v20zm3.134.84l1.732 1-10 17.32-1.732-1 10-17.32zm24.026 3.294l1 1.732-17.32 10-1-1.732 17.32-10zM120 89v2h-20v-2h20zm-84.134 9.16l-1.732 1-10-17.32 1.732-1 10 17.32zM51 100h-2V80h2v20zm3.134.84l1.732 1-10 17.32-1.732-1 10-17.32zm24.026 3.294l1 1.732-17.32 10-1-1.732 17.32-10zM100 109v2H80v-2h20zm19.32 5l-1 1.732-17.32-10 1-1.732 17.32 10zM31 120h-2v-20h2v20z' fill='%2380b49b' fill-opacity='0.4' fill-rule='evenodd'/%3E%3C/svg%3E");

  }
</style>

<?php
include("../dbconn.php");

$id = $_SESSION['id'];
$sql = "SELECT su from admins where id = '{$id}'";
$result = mysqli_query($connection, $sql);
$su = mysqli_fetch_array($result)[0];
if ($_SERVER["REQUEST_METHOD"] === "GET") {
  $table = $_GET['selectedDelete'];
  $stat = $_GET['radio'];
  if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
  } else {
    $pageno = 1;
  } ?>
  <?php
  $no_of_records_per_page = 10;
  $offset = ($pageno - 1) * $no_of_records_per_page;
  if ($su == "1") {
    if ($table == "projects") {  
        $total_pages_sql = "SELECT COUNT(*) FROM `{$table}` WHERE stat = '{$stat}' ORDER BY id DESC";
    } else {
        $total_pages_sql = "SELECT COUNT(*) FROM `{$table}` ORDER BY id DESC";
    }
  } else{
    if ($table == "projects") { 
        $total_pages_sql= "SELECT COUNT(*) FROM `{$table}` WHERE stat = '{$stat}' AND author = '$id' ORDER BY id DESC";
    } else {
        $total_pages_sql = "SELECT COUNT(*) FROM `{$table}` where author = '$id' ORDER BY id DESC";
    }
  }
  $result = mysqli_query($connection, $total_pages_sql);
  $total_rows = mysqli_fetch_array($result)[0];
  $total_pages = ceil($total_rows / $no_of_records_per_page);

  if ($su == "1") {
    if ($table == "projects") {  
      $query = "SELECT * FROM `{$table}` WHERE stat = '{$stat}' ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
    } else {
      $query = "SELECT * FROM `{$table}` ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
    }
  } else{
    if ($table == "projects") { 
      $query = "SELECT * FROM `{$table}` WHERE stat = '{$stat}' AND author = '$id' ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
    } else {
      $query = "SELECT * FROM `{$table}` where author = '$id' ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
    }
  }
  $result = mysqli_query($connection, $query);
  $titre = array("appels" => "Appels d'offre", "com" => "Communiqués", "gallery" => "Gallerie", "news" => "Actualités", "projects" => "Projets", "scroll" => "Infos défilées");
  $pro = array("pending" => "En cours", "achieved" => "achevés", "future" => "à venir");
?>
  <br><br>
  <div class="container py-5">
  <div class="p-5 bg-white rounded shadow mb-5" style="border-radius : 20px!important;">
    <a class="text-uppercase font-weight-bold rounded-0" style="font-size: 20pt"><?php echo $titre[$table];
                                                          if ($table == "projects") echo " " . $pro[$stat]; ?>
    </a>
    <div class="float-right"><a type="submit" onclick="return confirm('Êtes-vous sûr de vouloir tout supprimer ?')" href="deleteAll.php?table=<?php echo $table; if ($table == "projects") echo "&stat=".$stat ?>" style="text-decoration : none;color : red"><i class="fas fa-trash-alt"></i>&nbsp;Supprimer tout</a></div>
    <br><br><br>
    <?php if (mysqli_num_rows($result) == 0)
      echo "<center><b>Vide</b></center>";
    else {
      while ($row = mysqli_fetch_array($result)) {
    ?>
        <div class="list-group-item list-group-item-action flex-column align-items-start" style="padding: 18px; border-radius : 20px;" data-aos="zoom-in-up">
          <div class="d-flex w-100 justify-content-between" >
            <h6 class="mb-1"><a style="text-decoration: none; color : black;"><?php echo htmlentities($row['title']) ?></a></h6>
            <?php if ($table == "appels") $img = $row['file']; else $img=$row['img']; ?>
            <small><?php echo strftime('%d %h %Y' ,strtotime($row['date'])) ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="text-decoration: none;" href="delete.php?id=<?php echo $row['id']; ?>&table=<?php echo $table ?>&img=<?php echo $img ?>"><i class="far fa-trash-alt"></i>&nbsp;Supprimer</a></small>
          </div>
        </div><br>

    <?php }
    } $data = array('selectedDelete' => $table, 'radio' => $stat);?>
  </div>
  </div>
  
<?php } include("../assets/php/pagination.php") ?>
<script>
        AOS.init();
    </script>
<script src="../assets/bootstrap-5.0.0-beta3-dist/js/bootstrap.bundle.js"></script>
      
      <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
      <script src="../assets/js/jquery.min.js"></script>
      <script src="../assets/js/script.min.js"></script>
      <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>