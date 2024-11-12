<?php
session_start();
$id = mysqli_connect("localhost:3307","root","","qcm");
if(isset($_POST["bout"])){
    $libelleQ = $_POST["libelleQ"];
    $niveau = $_POST["niveau"];
    $req = "insert into questions (idq, libelleQ, niveau)
            values (null, '$libelleQ', '$niveau')";
    mysqli_query($id, $req);

    $req = "select max(idq) as maxi from questions";
    $res = mysqli_query($id, $req);
    $ligne = mysqli_fetch_assoc($res);
    $idq = $ligne["maxi"];
    $libeller1 = $_POST["libeller1"];
    $libeller2 = $_POST["libeller2"];
    $libeller3 = $_POST["libeller3"];
    $libeller4 = $_POST["libeller4"];
    $req = "insert into reponses (idr, idq, libeller, verite)
            values (null, '$idq', '$libeller1', '1'),
                   (null, '$idq', '$libeller2', '0'),
                   (null, '$idq', '$libeller3', '0'),
                   (null, '$idq', '$libeller4', '0')";
    mysqli_query($id, $req);
    echo "La question $libelleQ et les réponse ont bien été ajouté à la base, vous allez être redirigé....";
    header("refresh:4; url=listeQuestion.php");
}
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
    <a class="nav-link active" aria-current="page" href="deconnexion.php">Deconnexion</a><br>
    </li>
    <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="qcm.php">Retour au qcm</a><br>
    </li>
    </ul>

    <h1>Ajouter la question</h1><hr>
    <form action="" method="post">
        <p> <input class="form-control" type="text" name="libelleQ" placeholder="Question : " required></p>
        <p> <input type="radio" name="niveau" value="0">Débutant</p>
        <p> <input type="radio" name="niveau" value="1">Intermédiaire</p>

    <h1>Ajouter les réponses</h1><hr>
        <p> <input class="form-control" type="text" name="libeller1" placeholder="Réponse : " required>*Bonne reponse</p>
        
    <br>
        <p> <input class="form-control" type="text" name="libeller2" placeholder="Réponse : " required></p>
       
    <br>
        <p> <input class="form-control" type="text" name="libeller3" placeholder="Réponse : " required></p>
        
    
    <br>
        <p> <input class="form-control" type="text" name="libeller4" placeholder="Réponse : " required></p>
       
        
        <p> <input class="btn btn-outline-success mt-3" type="submit" value="Envoyer" name="bout"></p>
    </form><hr>
</body>
</html>