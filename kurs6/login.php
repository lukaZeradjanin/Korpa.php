<?php
  $baza = new mysqli("localhost", "root", "", "web_shop");

  if($baza->error)
  {
      die("Greska pri povezivanju");
  }



if(!isset($_POST['email']) || empty($_POST['sifra']))
{
    die("Morate uneti email");
}
if(!isset($_POST['sifra']) || empty($_POST['sifra']))
{
    die("Morate uneti sifru");
}

$email = $_POST['email'];
$sifra = $_POST['sifra'];

$query = "SELECT * from korsinci where email like '" .$email."'";

$rez = $baza->query($query);

if($rez->num_rows > 0)
{
    $korisnik = $rez->fetch_assoc();
    $verifikovanasifra = password_verify($sifra,$korisnik['sifra']);
    if($verifikovanasifra==true)
    {
        if(session_status() == PHP_SESSION_NONE)
        {
    session_start();
        }
        $_SESSION['ulogovan'] = true;
        $_SESSION['user_id']= $korisnik['id'];

        header("Location: index.php");
    }
}
else
{
    die("Korisnik ne postoji");
}

?>