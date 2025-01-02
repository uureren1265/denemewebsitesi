<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: giris.php');
    exit();
}

include '../iceaktarmalar/ayar.php';

?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli</title>
    <link rel="stylesheet" href="../yonetimpaneli/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="admin-panel">
        <h1>Admin Paneli</h1>
        <div class="menu">
            <ul>
                <li><a href="uyeislem.php">Üye İşlemleri</a></li>
                <li><a href="navbarekle.php">Menü Ekle</a></li>
                <li><a href="duyuruislem.php">Duyuru İşlemleri</a></li>
                <li><a href="denemeislem.php">Deneme İşlemleri</a></li>
                <li><a href="../index.php">Çıkış Yap</a></li>
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>

</html>