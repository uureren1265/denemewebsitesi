<?php
session_start();

if (!isset($_SESSION["kullanici_adi"])) {
    header("Location: giris.php");
    exit();
}

if (isset($_GET['cikis'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

include 'iceaktarmalar/ayar.php';

$ad = $soyad = $eposta = "";
$hata_mesaji = null;

$kullanici_adi = $_SESSION["kullanici_adi"];
$sql = "SELECT ad, soyad, eposta FROM uyeler WHERE kullanici_adi = ?";
$stmt = $baglanti->prepare($sql);
$stmt->bind_param("s", $kullanici_adi);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ad = htmlspecialchars($row["ad"]);
    $soyad = htmlspecialchars($row["soyad"]);
    $eposta = htmlspecialchars($row["eposta"]);
}

$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad = htmlspecialchars(trim($_POST["ad"]));
    $soyad = htmlspecialchars(trim($_POST["soyad"]));
    $eposta = htmlspecialchars(trim($_POST["eposta"]));
    $sifre = htmlspecialchars(trim($_POST["sifre"]));

    if (!empty($sifre)) {
        $hashed_sifre = password_hash($sifre, PASSWORD_DEFAULT);
        $sql = "UPDATE uyeler SET ad = ?, soyad = ?, eposta = ?, sifre = ? WHERE kullanici_adi = ?";
        $stmt = $baglanti->prepare($sql);
        $stmt->bind_param("sssss", $ad, $soyad, $eposta, $hashed_sifre, $kullanici_adi);
    } else {
        $sql = "UPDATE uyeler SET ad = ?, soyad = ?, eposta = ? WHERE kullanici_adi = ?";
        $stmt = $baglanti->prepare($sql);
        $stmt->bind_param("ssss", $ad, $soyad, $eposta, $kullanici_adi);
    }

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Veritabanı hatası: " . $stmt->error;
    }

    $stmt->close();
}

if (isset($baglanti)) {
    $baglanti->close();
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilim</title>
    <link rel="stylesheet" href="form.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="form-container">
        <h2>Profilim</h2>
        <form method="post">
            <div class="form-group">
                <label for="ad">Ad:</label>
                <input type="text" id="ad" name="ad" class="form-control" value="<?php echo $ad; ?>" required>
            </div>
            <div class="form-group">
                <label for="soyad">Soyad:</label>
                <input type="text" id="soyad" name="soyad" class="form-control" value="<?php echo $soyad; ?>" required>
            </div>
            <div class="form-group">
                <label for="eposta">E-posta:</label>
                <input type="email" id="eposta" name="eposta" class="form-control" value="<?php echo $eposta; ?>"
                    required>
            </div>
            <div class="form-group">
                <label for="sifre">Şifre Değiştir:</label>
                <input type="password" id="sifre" name="sifre" class="form-control" placeholder="Yeni şifreniz">
            </div>
            <button type="submit" class="btn btn-primary">Bilgileri Güncelle</button>
            <a href="denemeekle.php" class="btn btn-success">Deneme Ekle</a>
        </form>
        <br>
        <a href="profilim.php?cikis=true" class="btn btn-danger">Çıkış Yap</a>
        <a href="index.php" class="btn btn-secondary">Geri Dön</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>

</html>