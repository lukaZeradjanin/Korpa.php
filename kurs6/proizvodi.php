<?php

    $baza = new mysqli("localhost", "root", "", "web_shop");

    if($baza->error)
    {
        die("Greska pri povezivanju");
    }

    $idProizvoda = $_GET['id'];

    $query = "SELECT * from proizvodi where id=$idProizvoda";
  

    $rez = $baza->query($query);
   
   
    if($rez->num_rows==0)
    {
        die("Proizvod ne postoji");
    }

    $proizvodi = $rez->fetch_all(MYSQLI_ASSOC);

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
    <title>Proizvod</title>
  
</head>
<body>
<div>
            <a href="index.php">Glavna</a>
            <?php if(isset($_SESSION['ulogovan'])): ?>
            <a href="logout.php">Logout</a>
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
        <?php if(isset($_SESSION['ulogovan'])): ?>
            <form method="post" action="korpa.php">
            <input type="number" name="kolicina" placeholder="Unesite koliko zelite">
            <input type="hidden" name="id_proizvoda" value="<?= $proizvod['id'] ?>">
            <button>Dodaj u korpu</button>
            </form>
           
            <?php else: ?>
                <a href="login1.php">Uloguj se prvo</a>
                <?php endif; ?>
        <?php endforeach; ?>
</body>
</html>


