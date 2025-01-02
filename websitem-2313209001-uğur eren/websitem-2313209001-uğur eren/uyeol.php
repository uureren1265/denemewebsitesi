<?php
include 'iceaktarmalar/ayar.php';

$kullanici_adi = $sifre = $eposta = $ad = $soyad = "";
$hata_mesaji = null;
$basari_mesaji = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $kullanici_adi = htmlspecialchars(trim($_POST["kullanici_adi"]));
  $sifre = htmlspecialchars(trim($_POST["sifre"]));
  $eposta = htmlspecialchars(trim($_POST["eposta"]));
  $ad = htmlspecialchars(trim($_POST["ad"]));
  $soyad = htmlspecialchars(trim($_POST["soyad"]));

  if (empty($kullanici_adi) || empty($sifre) || empty($eposta) || empty($ad) || empty($soyad)) {
    $hata_mesaji = "Lütfen tüm alanları doldurunuz.";
  } else {
    $sql = "SELECT iduyeler FROM uyeler WHERE kullanici_adi = ? OR eposta = ?";
    try {
      $stmt = $baglanti->prepare($sql);
      $stmt->bind_param("ss", $kullanici_adi, $eposta);
      $stmt->execute();
      $stmt->store_result();

      if ($stmt->num_rows > 0) {
        $hata_mesaji = "Bu kullanıcı adı veya e-posta zaten kullanılıyor.";
      } else {
        $hashed_sifre = password_hash($sifre, PASSWORD_DEFAULT);
        $sql = "INSERT INTO uyeler (kullanici_adi, sifre, eposta, ad, soyad) VALUES (?, ?, ?, ?, ?)";
        $stmt = $baglanti->prepare($sql);
        $stmt->bind_param("sssss", $kullanici_adi, $hashed_sifre, $eposta, $ad, $soyad);

        if ($stmt->execute()) {
          header("Location: giris.php");
          exit();
        } else {
          $hata_mesaji = "Kayıt sırasında bir hata oluştu: " . $stmt->error;
        }
      }
      $stmt->close();
    } catch (Exception $e) {
      $hata_mesaji = "Veritabanı hatası: " . $e->getMessage();
    }
  }
}

if (isset($baglanti)) {
  $baglanti->close();
}
?>
<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Üye Ol</title>
  <link rel="stylesheet" href="form.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
  <div class="form-container">
    <h2>Üye Ol</h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <div class="form-group">
        <label for="kullanici_adi">Kullanıcı Adı:</label>
        <input type="text" id="kullanici_adi" name="kullanici_adi" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="sifre">Şifre:</label>
        <input type="password" id="sifre" name="sifre" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="eposta">E-posta:</label>
        <input type="email" id="eposta" name="eposta" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="ad">Ad:</label>
        <input type="text" id="ad" name="ad" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="soyad">Soyad:</label>
        <input type="text" id="soyad" name="soyad" class="form-control" required>
      </div>
      <?php
      if ($hata_mesaji) {
        echo '<div class="alert alert-danger" role="alert">' . $hata_mesaji . '</div>';
      }
      ?>
      <button type="submit" class="btn btn-primary">Üye Ol</button>
      <p class="text-center mt-3">
        Zaten hesabın var mı? <a href="giris.php">Giriş Yap</a>
      </p>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</body>

</html>