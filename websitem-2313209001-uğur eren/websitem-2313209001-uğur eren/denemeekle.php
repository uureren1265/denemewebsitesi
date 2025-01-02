<?php
session_start();

if (!isset($_SESSION["kullanici_adi"])) {
    header("Location: giris.php");
    exit();
}

include 'iceaktarmalar/ayar.php';

$kullanici_adi = $_SESSION["kullanici_adi"];
$sql = "SELECT iduyeler FROM uyeler WHERE kullanici_adi = ?";
$stmt = $baglanti->prepare($sql);
$stmt->bind_param("s", $kullanici_adi);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $kullanici_id = $row["iduyeler"];
} else {
    echo "Kullanıcı bulunamadı.";
    exit();
}

$stmt->close();

$basari_mesaji = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $baslik = htmlspecialchars(trim($_POST["baslik"]));
    $icerik = htmlspecialchars(trim($_POST["icerik"]));

    $sql = "INSERT INTO denemeler (kullanici_id, baslik, icerik, tarih) VALUES (?, ?, ?, NOW())";
    $stmt = $baglanti->prepare($sql);
    $stmt->bind_param("iss", $kullanici_id, $baslik, $icerik);

    if ($stmt->execute()) {
        $basari_mesaji = "Deneme başarıyla eklendi.";
    } else {
        echo "Veritabanı hatası: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deneme Ekle</title>
    <link rel="stylesheet" href="form.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="form-container">
        <h2>Deneme Ekle</h2>
        <?php if ($basari_mesaji): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $basari_mesaji; ?>
            </div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="form-group">
                <label for="baslik">Başlık:</label>
                <input type="text" id="baslik" name="baslik" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="icerik">İçerik:</label>
                <textarea id="icerik" name="icerik" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Deneme Ekle</button>
        </form>
        <br>
        <a href="profilim.php" class="btn btn-secondary">Profilime Geri Dön</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>

</html>