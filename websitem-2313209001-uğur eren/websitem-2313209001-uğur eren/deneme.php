<?php
session_start();

include 'iceaktarmalar/ayar.php';

if (isset($_GET['id'])) {
    $deneme_id = htmlspecialchars($_GET['id']);

    $sql = "SELECT baslik, icerik, tarih FROM denemeler WHERE id = ?";
    $stmt = $baglanti->prepare($sql);
    $stmt->bind_param("i", $deneme_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $baslik = htmlspecialchars($row["baslik"]);
        $icerik = htmlspecialchars($row["icerik"]);
        $tarih = htmlspecialchars($row["tarih"]);
    } else {
        $baslik = "Hata";
        $icerik = "Deneme bulunamadı.";
        $tarih = "";
    }

    $stmt->close();
} else {
    $baslik = "Hata";
    $icerik = "Deneme ID'si belirtilmedi.";
    $tarih = "";
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $baslik; ?></title>
    <link rel="stylesheet" href="deneme.css">
    <link rel="stylesheet" href="navbar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <?php include 'iceaktarmalar/navbar.php'; ?>
    <div class="container mt-5 pt-5">
        <h2 class="text-center"><?php echo $baslik; ?></h2>
        <div class="deneme-container">
            <div class="deneme">
                <p><?php echo $icerik; ?></p>
                <p><small><?php echo $tarih; ?></small></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>

</html>