<?php
 include("../dbconn.php");

 session_start();
 if (!isset($_SESSION['AdminLoginId']))
 {
     header("location: index.php");
 } 
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Commune d'Akfadou - Site Officiel</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/styles.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="icon" href="../assets/img/favicon.png">
</head>

<body>



    <br><br><br>
    <!-- write here -->

    <div class="contact-clean col-md-6 mx-auto">
        <form name="frmContact" method="post" enctype="multipart/form-data" action="send.php" onsubmit="return valid()">
            <h2 class="text-center">Envoyer un message</h2>
            <div class="form-group row">
                <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">De </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="lname" name="lname" placeholder="Nom.." oninput="validn()">
                </div>
            </div>
            <div class="form-group row">
                <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Vers</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Email.." oninput="validemail()" value="<?php echo $_GET['email'] ?>" readonly>
                    <small class="form-text text-danger" id="errormsg" style="display: none;">Adresse mail non valide.</small>
                </div>
            </div>
            <div class="form-group row">
                <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Objet</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="subject" name="subject" placeholder="Objet..">
                    <small class="form-text text-danger" id="errormsg" style="display: none;">Adresse mail non valide.</small>
                </div>
            </div>

            <br><label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm">Votre message :</label>
            <div class="form-group">
                <textarea id="msg" class="form-control" name="message" placeholder="Message" rows="14" style="height:500px; resize: none;" oninput="validm()"></textarea>
            </div><br>
            <div class="form-group"><button type="submit" class="btn btn-primary" name="submit" style="border-radius: 25px;">Envoyer</button></div>
        </form>
    </div>


    <!-- end -->


    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/script.min.js"></script>
</body>

</html>

