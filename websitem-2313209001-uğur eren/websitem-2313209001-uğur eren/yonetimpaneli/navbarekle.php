<?php
include '../iceaktarmalar/ayar.php';
$menu_adi = isset($_POST["menu_adi"]) ? htmlspecialchars(trim($_POST["menu_adi"])) : '';
$gidilecekyer = isset($_POST["gidilecekyer"]) ? htmlspecialchars(trim($_POST["gidilecekyer"])) : '';
$hata_mesaji = "";
if (empty($menu_adi) || empty($gidilecekyer)) {
    $hata_mesaji = "Lütfen Menü Adı ve Gidecek Yer alanlarını doldurun!";
} else {
    $sql = "INSERT INTO menuler (menu_adi, gidilecekyer) VALUES (?, ?)";
    $stmt = $baglanti->prepare($sql);
    $stmt->bind_param("ss", $menu_adi, $gidilecekyer);
    if ($stmt->execute()) {
        $basari_mesaji = "Menü başarıyla eklendi!";
        header('Location: admin.php');
        exit();
    } else {
        $hata_mesaji = "Hata: " . $baglanti->error;
    }
    $stmt->close();
}
$baglanti->close();
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menü Ekle</title>
    <link rel="stylesheet" href="yonetim.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="form-container">
        <h2>Menü Ekle</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="form-group">
                <label for="menu_adi">Menü Adı:</label>
                <input type="text" id="menu_adi" name="menu_adi" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="gidilecekyer">Uzantı:</label>
                <input type="text" id="gidilecekyer" name="gidilecekyer" class="form-control" required>
            </div>
            <div class="form-group d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-2">Menü Ekle</button>
                <a href="admin.php" class="btn btn-secondary">Geri Dön</a>
            </div>
        </form>

        <?php
        if (!empty($hata_mesaji)) {
            echo "<div class='alert alert-danger'>$hata_mesaji</div>";
        } elseif (!empty($basari_mesaji)) {
            echo "<div class='alert alert-success'>$basari_mesaji</div>";
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>

</html>