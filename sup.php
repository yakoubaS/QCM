<?php
$id = mysqli_connect("localhost:3307","root","","qcm");
$idq = $_GET["idq"];
$req = "delete from questions where idq = $idq";
//$req2 = "delete from reponses where idq = $idq";
mysqli_query($id, $req);
//mysqli_query($id, $req2);
header("location:listeQuestion.php");
?>