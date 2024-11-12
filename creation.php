<?php
$id = mysqli_connect("localhost:3307","root","","qcm");
if(isset($_POST["bout"])){
    $pseudo = $_POST["pseudo"];
    $mail = $_POST["mail"];
    $mdp = $_POST["mdp"];
    $niveau = $_POST["niveau"];
    $req = "insert into user (idu, pseudo, mail, mdp, niveau)
            values (null, '$pseudo', '$mail', '$mdp', '$niveau')";
    mysqli_query($id, $req);
    echo "Le joueur $pseudo a bien été ajouté à la base, vous allez être redirigé....";
    header("refresh:3; url=connexion.php");
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
<body class="bg-secondary">

<div class="text-center bg-light rounded m-5 p-5">
    <h1>Inscription joueur</h1>
    <form action="" method="post">
        <p> <input class="form-control" type="text" name="pseudo" placeholder="Pseudo : " required></p>
        <p> <input class="form-control" type="text" name="mail" placeholder="Mail : " required></p>
        <p> <input class="form-control" type="password" name="mdp" placeholder="Mot de passe : " required></p>     
        <p> <input class="form-control" type="text" name="niveau" placeholder="Niveau : " required></p>
        <p> <input class="btn btn-outline-success mt-3" type="submit" value="Envoyer" name="bout"></p>
       
    </form>
</body>
</html>