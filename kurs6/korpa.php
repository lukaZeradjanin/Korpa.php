<?php

if(session_status() == PHP_SESSION_NONE)
{
    session_start();
}

if(!isset($_POST['id_proizvoda']) || empty($_POST['id_proizvoda']))
{
    die("Morate uneti id");
}

if(!isset($_POST['kolicina']) || empty($_POST['kolicina']))
{
    die("Morate uneti kolicinu");
}

$idProizvoda = $_POST['id_proizvoda'];
$kolicina = $_POST['kolicina'];
$idKorisnika = $_SESSION['user_id'];
$baza = new mysqli("localhost", "root", "", "web_shop");

$query = "SELECT cena from proizvodi where id=$idProizvoda";

$rez = $baza->query($query);

$redBaza = $rez->fetch_assoc();
$cena = $redBaza['cena'];
$cena = $cena * $kolicina;

$idProizvoda= $baza->real_escape_string($idProizvoda);
$kolicina= $baza->real_escape_string($kolicina);
$idKorisnika= $baza->real_escape_string($idKorisnika);
$cena= $baza->real_escape_string($cena);




$rez= $baza->query("INSERT INTO narudzbine(id_proizvoda,id_korsinika,cena,kolcina) values ($idProizvoda, $idKorisnika, $cena, $kolicina)");
if (!$rez) {
    echo "Greška u upitu: " . $baza->error;
}












?>