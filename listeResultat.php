<?php
 session_start();
 $id = mysqli_connect("localhost:3307","root","","qcm");
if(isset($_POST["bout"])){
    $idu = $_SESSION["idu"];
    $pseudo = $_SESSION["pseudo"];
    $note = $_POST["note"];
    $req5 = "insert into resultats (idqcm, idu, pseudo, note)
            values (null, '$idu', '$pseudo', '$note')";
    mysqli_query($id, $req5);
    mysqli_error($id);
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

    <h1>Liste des resultat du QCM</h1><hr>
    <table class="table">
        <tr>
            <th>NUMERO</th><th>ID</th><th>PSEUDO</th><th>NOTE</th>
        </tr> 
        <?php 
        $idu = $_SESSION["idu"];
        mysqli_query($id, "SET NAMES utf8");
        if($_SESSION["niveau"] == 2){
            $req = "select * from resultats order by note DESC";
            $res = mysqli_query($id, $req); 
            while($ligne = mysqli_fetch_assoc($res)){?>
                <tr>
                        <td><?=$ligne["idqcm"]?></td>
                        <td><?=$ligne["idu"]?></td>
                        <td><?=$ligne["pseudo"]?></td>
                        <td><?=$ligne["note"]?></td>
                </tr>
            <?php        
            }
        }
            else{
            $req2 = "select * from resultats where idu = $idu order by note DESC";
            $res2 = mysqli_query($id, $req2); 
            while($ligne = mysqli_fetch_assoc($res2)){?>
            <tr>
                    <td><?=$ligne["idqcm"]?></td>
                    <td><?=$ligne["idu"]?></td>
                    <td><?=$ligne["pseudo"]?></td>
                    <td><?=$ligne["note"]?></td>
            </tr>
        <?php  
        }
        }
        ?>

     </table> 
</body>
</html>