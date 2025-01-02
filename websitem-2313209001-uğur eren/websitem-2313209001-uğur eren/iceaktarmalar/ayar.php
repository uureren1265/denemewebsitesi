<?php

$baglanti = new mysqli("localhost", "root", "1265", "websitem");

if ($baglanti->connect_error) {
    die("Bağlantı hatası: " . $baglanti->connect_error);
}
$baglanti->set_charset("utf8");

?>