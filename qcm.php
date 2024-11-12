<?php
session_start();
if(!isset($_SESSION["mail"])){
    header("location:connexion.php");
}
$id = mysqli_connect("localhost:3307","root","","qcm");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="bg-light">
<ul class="nav justify-content-end ">
  <li class="nav-item">   
    <a class="nav-link active " aria-current="page" href="deconnexion.php">Deconnexion</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="listeResultat.php">Liste des resultats</a>
  </li>

<?php 
    if($_SESSION["niveau"] == 2){
        echo '<a class="nav-link active " aria-current="page" href="ajoutQuestions.php">Ajouter une question</a>
              <a class="nav-link active " aria-current="page" href="listeQuestion.php">Liste des questions</a>';
    }
?>
</ul>
    <h1>Bienvenue au QCM <?php echo $_SESSION["pseudo"]?></h1>
    <form action="resultat.php" method="post">
    <?php
        include "connect.php";
        mysqli_query($id, "SET NAMES utf8");
        $req = "select * from questions order by rand() limit 10";
        $res = mysqli_query($id, $req);
        $cpt = 1;
        while($ligne = mysqli_fetch_assoc($res)){
            echo "<h4>$cpt : ".$ligne["libelleQ"]."</h4>";
            $idq = $ligne["idq"];
            $req2 = "select * from reponses where idq = $idq";
            $res2 = mysqli_query($id, $req2);
            while($ligne2 = mysqli_fetch_assoc($res2)){
                $idr = $ligne2["idr"];
                echo "<input type ='radio' name='$idq' value='$idr'>".$ligne2["libeller"]."<br/>";
            }
            $cpt++;
        }
    ?>
    <input class="btn btn-outline-success mt-3" type="submit" value="Envoyer">
    </form>
</body>
</html>