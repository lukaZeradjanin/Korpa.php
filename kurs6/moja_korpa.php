<?php
if(session_status() == PHP_SESSION_NONE)
{
    session_start();
}

if(!isset($_SESSION['ulogovan']))
{
    die("Morate biti ulogovani da biste videli ovu stranicu");
}


$baza = new mysqli("localhost", "root","","web_shop");



if($baza->error)
{
    die("Baza ne radi");
}

$usrID = $_SESSION['user_id'];

$rez = $baza->query("SELECT * from narudzbine where id_korsinika = $usrID");

$narudzbine = $rez->fetch_all(MYSQLI_ASSOC);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Korpa</title>
</head>
<body>
    <?php if($rez->num_rows==0): ?>
    <h1>Nemate nijedan proizvod u korpi</h1>
    <?php else: ?>
        <?php  foreach($narudzbine as $narudzbina):?>
        <div>
            <p>Kolicina: <?= $narudzbina['kolcina']  ?></p>
            <p>Cena: <?= $narudzbina['cena']  ?></p>
        </div>
        <?php endforeach;  ?>
    <?php endif; ?>
</body>
</html>