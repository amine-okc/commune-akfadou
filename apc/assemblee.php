<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Assemblée Populaire Communale - Commune d'Akfadou</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/styles.min.css">
    <link rel="icon" href="../assets/img/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
</head>

<body>

    <?php $IPATH =  "../assets/php/";
    include($IPATH . "navbar.php") ?>


    <br><br><br>
    <!-- write here -->

    <div class="container">

        <div class="row news" style="margin-top: 4%">

            <div class="col-md-12">
                <div class="card mb-4 pagetitle p-3 rounded">
                    <h1 class="page-title">&nbsp;&nbsp;&nbsp;Assemblée Populaire</h1>
                </div>
<br><br>
                <div class="alert alert-success">
                    <?php foreach(glob("../assets/doc/elus.*") as $filename); ?>
                    <a style="text-decoration : none; color : #155724" href="<?php echo $filename ?>" target="__blank"><center>Consultez la liste des élus </center></a>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <hr>

    <!-- end -->


    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/script.min.js"></script>
    <?php include($IPATH . "footer.php") ?>
</body>

</html>