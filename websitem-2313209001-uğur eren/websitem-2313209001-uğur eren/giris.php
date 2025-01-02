<?php
include 'iceaktarmalar/ayar.php';
session_start();

$kullanici_adi = $sifre = "";
$hata_mesaji = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $hata_mesaji = "CSRF doğrulaması başarısız.";
  } else {
    $kullanici_adi = trim($_POST["kullanici_adi"]);
    $sifre = trim($_POST["sifre"]);

    if (empty($kullanici_adi) || empty($sifre)) {
      $hata_mesaji = "Lütfen tüm alanları doldurunuz.";
    } else {
      $sql = "SELECT kullanici_adi, sifre FROM uyeler WHERE kullanici_adi = ?";
      try {
        $stmt = $baglanti->prepare($sql);
        $stmt->bind_param("s", $kullanici_adi);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          if (password_verify($sifre, $row["sifre"])) {
            session_regenerate_id(true);
            $_SESSION["admin"] = true;
            $_SESSION["kullanici_adi"] = htmlspecialchars($kullanici_adi);
            header("Location: yonetimpaneli/admin.php");
            exit();
          } else {
            $hata_mesaji = "Şifre hatalı.";
          }
        } else {
          $hata_mesaji = "Kullanıcı adı bulunamadı.";
        }
        $stmt->close();
      } catch (Exception $e) {
        $hata_mesaji = "Veritabanı hatası: " . $e->getMessage();
      }
    }
  }
}

$csrf_token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $csrf_token;

if (isset($baglanti)) {
  $baglanti->close();
}
?>
<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Giriş Yap</title>
  <link rel="stylesheet" href="form.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
  <div class="form-container">
    <h2>Giriş Yap</h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
      <div class="form-group">
        <label for="kullanici_adi">Kullanıcı Adı:</label>
        <input type="text" id="kullanici_adi" name="kullanici_adi" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="sifre">Şifre:</label>
        <input type="password" id="sifre" name="sifre" class="form-control" required>
      </div>
      <?php
      if ($hata_mesaji) {
        echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($hata_mesaji) . '</div>';
      }
      ?>
      <button type="submit" class="btn btn-primary">Giriş Yap</button>
      <p class="text-center mt-3">
        Üye değilseniz? <a href="uyeol.php">Üye Ol</a>
      </p>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</body>

</html>