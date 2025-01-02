<?php
include '../iceaktarmalar/ayar.php';
if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);


    $sql = "DELETE FROM uyeler WHERE iduyeler = ?";
    $stmt = $baglanti->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {

        header("Location: uyeislem.php");
        exit();
    } else {

        echo "Veritabanı hatası: " . $baglanti->error;
    }

    $stmt->close();
}

$baglanti->close();
?>