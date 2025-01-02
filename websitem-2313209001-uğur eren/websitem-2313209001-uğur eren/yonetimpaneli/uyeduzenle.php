<?php
include '../iceaktarmalar/ayar.php';

$id = $kullanici_adi = $eposta = $ad = $soyad = "";
$hata_mesaji = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT kullanici_adi, eposta, ad, soyad FROM uyeler WHERE iduyeler = ?";
    $stmt = $baglanti->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $kullanici_adi = $row['kullanici_adi'];
        $eposta = $row['eposta'];
        $ad = $row['ad'];
        $soyad = $row['soyad'];
    } else {
        echo "Üye bulunamadı.";
    }

    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kullanici_adi = trim($_POST["kullanici_adi"]);
    $eposta = trim($_POST["eposta"]);
    $ad = trim($_POST["ad"]);
    $soyad = trim($_POST["soyad"]);

    if (empty($kullanici_adi) || empty($eposta) || empty($ad) || empty($soyad)) {
        $hata_mesaji = "Lütfen tüm alanları doldurunuz.";
    } else {
        $sql = "UPDATE uyeler SET kullanici_adi = ?, eposta = ?, ad = ?, soyad = ? WHERE iduyeler = ?";
        $stmt = $baglanti->prepare($sql);
        $stmt->bind_param("ssssi", $kullanici_adi, $eposta, $ad, $soyad, $id);

        if ($stmt->execute()) {
            header("Location: uyeislem.php");
            exit();
        } else {
            $hata_mesaji = "Veritabanı hatası: " . $baglanti->error;
        }

        $stmt->close();
    }
}

$baglanti->close();
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Üye Düzenle</title>
    <link rel="stylesheet" href="../iceaktarmalar/yonetim.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-4">
        <h2>Üye Düzenle</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?id=' . $id); ?>" method="post">
            <div class="mb-3">
                <label for="kullanici_adi" class="form-label">Kullanıcı Adı</label>
                <input type="text" class="form-control" id="kullanici_adi" name="kullanici_adi"
                    value="<?php echo htmlspecialchars($kullanici_adi); ?>" required>
            </div>
            <div class="mb-3">
                <label for="eposta" class="form-label">E-posta</label>
                <input type="email" class="form-control" id="eposta" name="eposta"
                    value="<?php echo htmlspecialchars($eposta); ?>" required>
            </div>
            <div class="mb-3">
                <label for="ad" class="form-label">Ad</label>
                <input type="text" class="form-control" id="ad" name="ad" value="<?php echo htmlspecialchars($ad); ?>"
                    required>
            </div>
            <div class="mb-3">
                <label for="soyad" class="form-label">Soyad</label>
                <input type="text" class="form-control" id="soyad" name="soyad"
                    value="<?php echo htmlspecialchars($soyad); ?>" required>
            </div>
            <?php
            if ($hata_mesaji) {
                echo '<div class="alert alert-danger" role="alert">' . $hata_mesaji . '</div>';
            }
            ?>
            <button type="submit" class="btn btn-primary">Üye Düzenle</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>

</html>