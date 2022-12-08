<?php 
session_start();
if (!isset($_SESSION['AdminLoginId'])) {
    header("location: index.php");
}
$output_dir =  "../assets/doc";

$FileType      = $_FILES['file']['type'];
$FileName = $_FILES["file"]["name"];
$FileExt = substr($FileName, strrpos($FileName, '.'));
$FileExt       = str_replace('.', '', $FileExt);
$NewFile = "elus" .  '.' . $FileExt;
array_map('unlink', glob($output_dir . "/" . "elus.*"));

if(move_uploaded_file($_FILES["file"]["tmp_name"], $output_dir . "/" . $NewFile))
    echo "<script>alert('Fichier mis à jour !')</script>";
else 
    echo "<script>alert('Erreur.')</script>";
echo "<script>location.href = 'admin_dash.php'</script>";
?>