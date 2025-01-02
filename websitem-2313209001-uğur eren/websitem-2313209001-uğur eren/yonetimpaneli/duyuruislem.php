<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: giris.php');
    exit();
}
include '../iceaktarmalar/ayar.php';
$baslik = isset($_POST["baslik"]) ? htmlspecialchars(trim($_POST["baslik"])) : '';
$icerik = isset($_POST["icerik"]) ? htmlspecialchars(trim($_POST["icerik"])) : '';
$hata_mesaji = "";
if (empty($baslik) || empty($icerik)) {
    $hata_mesaji = "Lütfen Başlık ve İçerik alanlarını doldurun!";
} else {

    $sql = "INSERT INTO duyurular (baslik, icerik) VALUES (?, ?)";
    $stmt = $baglanti->prepare($sql);
    $stmt->bind_param("ss", $baslik, $icerik);
    if ($stmt->execute()) {
        $basari_mesaji = "Duyuru başarıyla eklendi!";
    } else {
        $hata_mesaji = "Hata: " . $baglanti->error;
    }

    $stmt->close();
}
$liste_sorgusu = "SELECT id, baslik, icerik FROM duyurular";
$liste_result = $baglanti->query($liste_sorgusu);
$baglanti->close();
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duyuru İşlemleri</title>
    <link rel="stylesheet" href="../iceaktarmalar/yonetim.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-4">
        <h2>Duyuru İşlemleri</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="mb-3">
                <label for="baslik" class="form-label">Başlık:</label>
                <input type="text" class="form-control" id="baslik" name="baslik" required>
            </div>
            <div class="mb-3">
                <label for="icerik" class="form-label">İçerik:</label>
                <textarea class="form-control" id="icerik" name="icerik" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Duyuru Ekle</button>
            <a href="admin.php" class="btn btn-secondary">Geri Dön</a>
        </form>

        <?php
        if (!empty($hata_mesaji)) {
            echo "<div class='alert alert-danger mt-3'>$hata_mesaji</div>";
        } elseif (!empty($basari_mesaji)) {
            echo "<div class='alert alert-success mt-3'>$basari_mesaji</div>";
        }
        ?>

        <h3 class="mt-5">Duyuru Listesi</h3>
        <div class="table-responsive">
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Başlık</th>
                        <th scope="col">İçerik</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($liste_result->num_rows > 0) {
                        while ($row = $liste_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['baslik']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['icerik']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>Henüz duyuru bulunmamaktadır.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>

</html>