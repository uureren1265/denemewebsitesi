<?php
include 'iceaktarmalar/navbar.php';
include 'iceaktarmalar/ayar.php';
session_start();

$sql = "SELECT baslik, icerik, tarih FROM duyurular ORDER BY tarih DESC";
$result = $baglanti->query($sql);
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duyurular</title>
    <link rel="stylesheet" href="denemeler.css">
    <link rel="stylesheet" href="navbar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5 pt-5">
        <h2 class="text-center">Duyurular</h2>
        <div class="deneme-container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="deneme">';
                    echo '<h3>' . htmlspecialchars($row["baslik"]) . '</h3>';
                    echo '<p>' . htmlspecialchars(mb_strimwidth($row["icerik"], 0, 100, "...")) . '</p>';
                    echo '<p><small>' . htmlspecialchars($row["tarih"]) . '</small></p>';
                    echo '</div>';
                }
            } else {
                echo '<p class="text-center">Henüz eklenmiş duyuru yok.</p>';
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>

</html>