<?php


$baza = new mysqli("localhost", "root","","web_shop");


if($baza->error)
{
    die("Baza ne radi");
}

$query="SELECT * from proizvodi";

$proizvodi = $baza->query($query);

if(session_status() == PHP_SESSION_NONE)
{
    session_start();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glavna strana</title>
</head>
<body>
        <div>
            <a href="index.php">Glavna</a>
            <?php if(isset($_SESSION['ulogovan'])): ?>
            <a href="logout.php">Logout</a>
            <a href="moja_korpa.php">korpa</a>
            <?php else:  ?>
            <a href="login1.php">Login</a>
            <?php endif;?>
        </div>

        <?php foreach($proizvodi as $proizvod): ?>
            <h1><?=$proizvod['ime']  ?></h1>
            <p><?= $proizvod['opis']?></p>
            <p>Cena proizvoda je:<?= $proizvod['cena']?></p>
            <p><?= $proizvod['kolicina']?></p>
            <p><?php if($proizvod['kolicina'] == 0):?></p>
                <p>Nema na stanju</p>
                <?php else:  ?>
                <p> Ima na stanju</p>
        <?php endif; ?>
        <a href="proizvodi.php?id=<?= $proizvod['id'] ?>">Pogledaj proizvod</a>
        <?php endforeach; ?>
       



</body>
</html>