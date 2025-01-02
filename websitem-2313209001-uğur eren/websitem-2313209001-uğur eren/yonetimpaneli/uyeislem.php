<?php
include '../iceaktarmalar/ayar.php';

if ($baglanti->connect_error) {
    die("Bağlantı hatası: " . $baglanti->connect_error);
}

$sql = "SELECT iduyeler, kullanici_adi, eposta, ad, soyad FROM uyeler";
$result = $baglanti->query($sql);

if (!$result) {
    die('Veritabanı hatası: ' . $baglanti->error);
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Üye İşlemleri</title>
    <link rel="stylesheet" href="../iceaktarmalar/yonetim.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-4">
        <h2>Üye İşlemleri</h2>
        <a href="admin.php" class="btn btn-secondary mb-3">Geri Dön</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Kullanıcı Adı</th>
                    <th scope="col">E-posta</th>
                    <th scope="col">Ad</th>
                    <th scope="col">Soyad</th>
                    <th scope="col">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['iduyeler']); ?></td>
                        <td><?php echo htmlspecialchars($row['kullanici_adi']); ?></td>
                        <td><?php echo htmlspecialchars($row['eposta']); ?></td>
                        <td><?php echo htmlspecialchars($row['ad']); ?></td>
                        <td><?php echo htmlspecialchars($row['soyad']); ?></td>
                        <td>
                            <a href="uyesil.php?id=<?php echo htmlspecialchars($row['iduyeler']); ?>"
                                class="btn btn-danger">Üye Sil</a>
                            <a href="uyeduzenle.php?id=<?php echo htmlspecialchars($row['iduyeler']); ?>"
                                class="btn btn-warning">Üye Düzenle</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>

</html>
<?php
$baglanti->close();
?>