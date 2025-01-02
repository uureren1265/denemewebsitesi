<?php
$db = new mysqli("localhost", "root", "1265", "websitem");
if ($db->connect_error) {
    die("Bağlantı hatası: " . $db->connect_error);
}

$sql = "SELECT * FROM menuler";
$result = $db->query($sql);
if ($result->num_rows > 0) {
    echo '<nav class="navbar">';
    echo '<ul>';
    while ($row = $result->fetch_assoc()) {
        echo '<li><a href="' . htmlspecialchars($row['gidilecekyer']) . '">' . htmlspecialchars($row['menu_adi']) . '</a></li>';
    }
    echo '</ul>';
    echo '</nav>';
} else {
    echo "Menü öğeleri bulunamadı.";
}
$db->close();
?>