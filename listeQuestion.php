<?php
session_start();
$id = mysqli_connect("localhost:3307","root","","qcm");
$idu = $_SESSION["idu"]
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
    <a class="nav-link active" aria-current="page" href="qcm.php">Accueil</a>
  </li>
  <li class="nav-item">   
    <a class="nav-link active " aria-current="page" href="ajoutQuestions.php">Ajouter une question</a>
  </li>
  <li class="nav-item">   
    <a class="nav-link active " aria-current="page" href="deconnexion.php">Deconnexion</a>
  </li>
  </ul>


   <h1>Liste des Questions </h1><hr>
    <table class="table">
        <tr>
            <th>N°</th><th>QUESTION</th>
            <th><img src="modif.png" width="30"></th>
            <th><img src="sup.png" width="30"></th>
        </tr>

        <?php
        $req = "select * from questions order by idq";
        $res = mysqli_query($id, $req);
        while($ligne = mysqli_fetch_assoc($res)){
        
            echo "<tr>
                    <td class='gauche'>".$ligne["idq"]."</td>
                    <td>".$ligne["libelleQ"]."</td>
                    <td><a href='modif.php?idq=".$ligne["idq"]."'><img src='modif.png' width='30'></a></td>
                    <td><a href='sup.php?idq=".$ligne["idq"]."'><img src='sup.png' width='30'></a></td>
                </tr>";
        }
        ?>
    </table>
</body>
</html>