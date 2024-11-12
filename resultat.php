<?php
session_start();
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<ul class="nav justify-content-end ">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="deconnexion.php">Deconnexion</a><br>
    </li>
    <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="qcm.php">Retour au qcm</a><br>
    </li>
</ul>
<h1>Resultat du QCM</h1><hr>
<?php

include "connect.php";
mysqli_query($id, "SET NAMES utf8");
$idu = $_SESSION["idu"];
$note = 0;
foreach($_POST as $cle => $val){
    //echo "A la question $cle tu as répondu $val<br>";
    $req = "select * from reponses where idr = $val";
    $res = mysqli_query($id, $req);
    $ligne = mysqli_fetch_assoc($res);
    if($ligne["verite"] == 1){
        $note += 2;
    }else{
        $req2 = "select libelleQ
                 from questions
                 where idq=$cle"; 
        $res2 = mysqli_query($id, $req2);
        $ligne2 = mysqli_fetch_assoc($res2);
        $req3 = "select * from reponses where idq=$cle and verite=1";
        $res3 = mysqli_query($id, $req3);
        $ligne3 = mysqli_fetch_assoc($res3);
        echo "<p>Tu t'es planté à la question : ".$ligne2["libelleQ"].
              "<br>Il fallait répondre : <b>".$ligne3["libeller"]."</b>";
    }    
}
?>
<?php
echo "<br><br>Tu as <b> $note / 20</>";
if(isset($_POST["bout"])){
    $idu = $_SESSION["idu"];
    $pseudo = $_SESSION["pseudo"];
    $note = $note;
    $req5 = "insert into resultats (idqcm, idu, pseudo, note)
            values (null, '$idu', '$pseudo', '$note')";
    mysqli_query($id, $req5);
    mysqli_error($id);
}
?>
<?php
$req4 = "select * from user where idu = $idu";
$res4 = mysqli_query($id, $req4);
$ligne4 = mysqli_fetch_assoc($res4);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <form action="listeResultat.php" method="post">
        <input type="hidden" name="note" value="<?=$note?>">
        <input type="submit" value="Enregistrer" name="bout">
    </form>
</body>
</html>