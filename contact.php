<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Contact - Commune d'Akfadou</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/styles.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
  <link rel="icon" href="assets/img/favicon.png">
  <script src="https://kit.fontawesome.com/a27d6ed1ca.js" crossorigin="anonymous"></script>
</head>
<style>

</style>

<body style="background-image: url(assets/img/contact_bg.jpg); background-size : cover;background-repeat : no-repeat">

  <?php $IPATH = "assets/php/";
  include($IPATH . "navbar.php") ?>





  <!-- write here -->
  <br><br><br><br><br>
  <div class="container">
  <div class="row">
    <div class="contact-clean col-md-6">
      <form name="frmContact" method="post" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return valid()">
        <h2 class="text-center">Contactez-nous</h2>
        <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Nom</label>
          <div class="col-sm-10">
            <input type="text" class="form-control form-control-sm" id="lname" name="lname" placeholder="Nom.." oninput="validn()">
          </div>
        </div>
        <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Prénom</label>
          <div class="col-sm-10">
            <input type="text" class="form-control form-control-sm" id="fname" name="fname" placeholder="Prénom.." oninput="validp()">
          </div>
        </div>
        <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Email.." oninput="validemail()">
            <small class="form-text text-danger" id="errormsg" style="display: none;">Adresse mail non valide.</small>
          </div>
        </div>
        <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Destinataire</label>
          <div class="col-sm-10">
            <select class="custom-select mb-3" name="destination" id="dest" onchange="validdest()">
              <option selected value="" disabled>Sélectionner ..</option> ">Sélectionner..</option>
              <?php include("dbconn.php");
              $sql = "SELECT function, username, id from `admins`";
              $result = mysqli_query($connection, $sql);
              while ($row = mysqli_fetch_array($result)) { ?>
                <option value="<?php echo $row['id'] ?>"><?php echo $row['username'] . " | " . $row['function'] ?></option>
              <?php } ?>
            </select>
            <small class="form-text text-danger" id="errormsgdest" style="display: none;">Veuillez choisir un destinataire.</small>
          </div>
        </div>

        <br><label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm">Votre message :</label>
        <div class="form-group">
          <textarea id="msg" class="form-control" name="message" placeholder="Message" rows="14" style="height:500px; resize: none;" oninput="validm()"></textarea>
        </div><br>
        <div class="form-group"><button type="submit" class="btn btn-primary" name="submit" style="border-radius: 25px;">Envoyer</button></div>
      </form>
    </div>
    <div class="contact-clean col-md-6">
      <form>
        <b><i class="fas fa-map-marked-alt"></i>&nbsp;&nbsp;Adresse de l'APC :</b> Tiniri, Akfadou, Béjaïa<br><br>
        <b><i class="fas fa-phone"></i>&nbsp;&nbsp;Téléphone Fixe : </b>034 86 97 13<br>
      </form>
    </div>
  </div>
  </div>
  <br><br><br>

  <?php
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $lname = $_POST["lname"];
    $fname = $_POST["fname"];
    $email = $_POST["email"];
    $content = $_POST["message"];
    $admin = $_POST["destination"];
    $content = str_replace("'", "\'", $content);
    $content = str_replace('"', "\"", $content);
    $content = str_replace("  ", "&nbsp;&nbsp;", $content);
    $content = nl2br($content);

    include("dbconn.php");
    $sql = "INSERT INTO `contact` (prenom, nom , email, message, admin) VALUES ('$fname', '$lname', '$email', '$content', '$admin')";
    if ($connection->query($sql) === TRUE)
      echo '<script type="text/JavaScript"> alert("Message envoyé !")  </script>';
    else
      echo '<script type="text/JavaScript"> alert("Erreur !")  </script>';
    $connection->close();
  }
  ?>

  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/script.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <!-- end -->
  <?php include($IPATH . "footer.php") ?>
</body>

</html>