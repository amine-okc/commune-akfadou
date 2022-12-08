<?php
include("../dbconn.php");
$pid = intval($_GET['pid']);
$sql = "SELECT views from news where id = '$pid'";
$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result))
        $views = $row['views'];
    $views = $views + 1;

    $sql = "UPDATE news SET views = '$views' where id = '$pid'";
    $connection->query($sql);
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <link rel="stylesheet" href="../assets/css/modern-business.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/styles.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <script src="https://kit.fontawesome.com/a27d6ed1ca.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../assets/img/favicon.png">

</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Questrial&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Merriweather+Sans&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Lora&display=swap');

    .row.news {
        font-family: 'Questrial', sans-serif;
    }

    .card-title {
        font-family: 'Merriweather Sans', sans-serif;
    }

    .card-text {
        font-family: 'Lora', serif;
    }
</style>

<body>
    <?php
    $IPATH =  "../assets/php/";
    include($IPATH . "navbar.php");

    ?>
    <div class="container">

        <div class="row news" style="margin-top: 4%">

            <div class="col-md-8">
                <br>
                <?php
                $pid = intval($_GET['pid']);
                include("../dbconn.php");
                $query = "SELECT * , DATE_FORMAT(date, \"%d/%m/%Y - %H:%i\") AS date  FROM `news` where id='$pid'";
                $result = mysqli_query($connection, $query);
                if (mysqli_num_rows($result) < 1) { ?>
                    <div class="card mb-4">

                        <div class="card-body">
                            <h2 class="card-title">ERREUR 404</h2>
                            <hr />
                            <br><br>
                            <hr><br>

                        </div>

                    </div>
                <?php } else { ?>

                    <?php $row = mysqli_fetch_array($result);
                        $id = $row['author'];
                        $authSql = "SELECT username from admins where id = '$id'";
                        $resAuth = mysqli_query($connection, $authSql);
                        if (mysqli_num_rows($resAuth) != 0)
                            $author = mysqli_fetch_array($resAuth)[0];
                        else 
                            $author = "";
                    ?>
                        <title><?php echo htmlentities($row['title']); ?> - Actualités d'Akfadou</title>
                        <div class="card mb-4 shadow p-3 mb-5 bg-white rounded">

                            <div class="card-body ">
                                <h2 class="card-title"><?php echo htmlentities($row['title']); ?></h2>
                                <label title="Date d'ajout"><i class="far fa-calendar-alt"></i>&nbsp;&nbsp;<?php echo htmlentities($row['date']); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
                <?php if ($author != ""){ ?> <label title="Auteur"><i class="far fa-user"></i></i>&nbsp;&nbsp;<?php echo $author; ?></label>&nbsp;&nbsp;&nbsp;&nbsp; <?php } ?>
                                <label class="float-right" title="Nombre de vues"><i class="far fa-eye"></i></i>&nbsp;<?php echo " " . $row['views']; ?></label>
                                <hr />
                                <?php if ($row['img'] != '') { ?>
                                    <img class="img-fluid rounded" src="../assets/news/<?php echo htmlentities($row['img']); ?>" alt="<?php echo htmlentities($row['title']); ?>">
                                    <br><br>
                                    <hr><br> <?php } ?>
                                <p class="card-text">
                                    <?php
                                    $pt = $row['content'];
                                    echo  nl2br($pt); ?></p>
                            </div>

                        </div>
                <?php }
                ?>
            </div>
            <?php include($IPATH . "sidebar.php"); ?>
        </div>
    </div>
    <br><br>
    <hr>
    <?php include($IPATH . "footer.php"); ?>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/script.min.js"></script>
</body>

</html>