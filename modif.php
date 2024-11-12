<?php
session_start();
$id = mysqli_connect("localhost:3307","root","","qcm");
if(isset($_POST["bout"])){
    $idq = $_POST["idq"];
    $libelleQ = $_POST["libelleQ"];
    $niveau = $_POST["niveau"];
    $req3 = "update questions set libelleQ = '$libelleQ',
                                  niveau = '$niveau'
            where idq = $idq";
    mysqli_query($id, $req3);

    $libeller1 = $_POST["libeller1"];
    $libeller2 = $_POST["libeller2"];
    $libeller3 = $_POST["libeller3"];
    $libeller4 = $_POST["libeller4"];
    $req4 = "update reponses set libeller = '$libeller1',
                                  
            where idq = $idq";
    mysqli_query($id, $req4);

    header("location:listeQuestion.php");
}
$idq = $_GET["idq"];
$req2 = "select * from questions where idq = $idq";
$res2 = mysqli_query($id, $req2);
$ligne2 = mysqli_fetch_assoc($res2);

$req5 = "select * from reponses where idq = $idq";
$res5 = mysqli_query($id, $req5);
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
    <h1>Modification de la question et des réponses <?=$ligne2["idq"]?></h1>
    <form action="" method="post">
        <input type="hidden" name="idq" value="<?=$ligne2["idq"]?>">

        <label for="">Question</label>
        <input class="form-control" type="text" name="libelleQ" value="<?=$ligne2["libelleQ"]?>" required>

        <label for="">Niveau</label>
        <input class="form-control" type="text" name="niveau" value="<?=$ligne2["niveau"]?>" required>        

        <label for="">Réponses</label>

        <?php
        $i = 1;
        while($ligne2 = mysqli_fetch_assoc($res5)){
            $libeller = $ligne2["libeller"];
            if($i == 1){
                echo" <input class='form-control' type='text' name='libeller$i' placeholder='Bonne Réponse : ' value='$libeller' required>";
            }else{
                echo" <input class='form-control' type='text' name='libeller$i' placeholder='Mauvaise Réponse  ".($i-1).":' value='$libeller'>";
            }
            $i++;
        }
        ?>
        <input type="submit" class="btn btn-outline-success mt-3" value="Enregistrer" name="bout">
        </div>
</form>
</body>
</html>