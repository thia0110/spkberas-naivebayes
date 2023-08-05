<?php 
 
session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" type="image/x-icon" href="img/nbc.png" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css" />

  <!-- font awsome -->
  <link rel="stylesheet" href="css/fontawesome.css" />
  <link rel="stylesheet" href="css/brands.css" />
  <link rel="stylesheet" href="css/solid.css" />

  <link rel="stylesheet" href="css/gaya.css">

  <!-- google font -->
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700&display=swap" rel="stylesheet">

  <title>Logika Naive Bayes</title>
</head>
<body>

  <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">
            <img src="img/nbc.png" alt="" width=50 height=50>
          </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="analisis.php">Naive Bayes
                  <span class="sr-only">(current)</span>
                </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="data_simulasi.php">Data Latih</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

    <div class="container" style='margin-top:90px'>
      <div class="row">
        <div class="col-12 mt-5">
          <h2 class="tebal">Naive Bayes</h2>
          <p class="desc mt-4">Naïve Bayes Classifier merupakan sebuah metoda klasifikasi yang berakar pada teorema Bayes.
          Metode pengklasifikasian dengan menggunakan metode probabilitas dan statistik yg dikemukakan oleh ilmuwan Inggris Thomas Bayes,
          yaitu memprediksi peluang di masa depan berdasarkan pengalaman di masa sebelumnya sehingga dikenal sebagai Teorema Bayes.
          Ciri utama dr Naïve Bayes Classifier ini adalah asumsi yang sangat kuat (naïf) akan independensi dari masing-masing kondisi / kejadian.
          Menurut Olson Delen (2008) menjelaskan Naïve Bayes untuk setiap kelas keputusan, menghitung probabilitas dg syarat bahwa kelas keputusan adalah benar,
          mengingat vejitaior informasi obyek. Algoritma ini mengasumsikan bahwa atribut obyek adalah independen.
          Probabilitas yang terlibat dalam memproduksi perkiraan akhir dihitung sebagai jumlah frekuensi dari " master " tabel keputusan.</p>
        </div>
      </div>

    <div class="row">
      <div class="col-12 mt-4">
        <h3 class="tebal">Simulasi Probabilitas Pemilihan Beras Prioritas.</h3>
      </div>

      <div class="col-6">
          <form method="POST" class="mt-3">

          <div class="form-group">
            <label for="harga">Harga :</label>
            <select name="harga" id="harga" class="form-control selBox" required="required">
                      <option value="" disabled selected>-- pilih Harga--</option>
                      <?php
                      for($i=5 ; $i <= 10 ; $i++){
                        echo"<option value='$i'>$i</option>";
                      }
                      ?>
            </select>
          </div>

          <div class="form-group">
            <label for="harga">Bentuk Beras :</label>
            <select name="bentukberas" id="bentukberas" class="form-control selBox" required="required">
                <option value="" disabled selected>-- pilih Bentuk Beras--</option>
                <option value="jitai">Jitai</option>
                <option value="berassuper">Beras Super</option>
                <option value="beraskepala">Beras Kepala</option>
            </select>
          </div>

          <div class="form-group">
            <label for="harga">Wangi Beras :</label>
            <select name="wangi_beras" id="wangi_beras" class="form-control selBox" required="required">
                      <option value="" disabled selected>-- pilih Wangi Beras--</option>
                      <option value="bau">Bau</option>
                      <option value="tidakberbau">Tidak Berbau</option>
                      <option value="harum">Harum</option>
                  </select>
          </div>

          <div class="form-group">
            <label for="harga">Kebersihan</label>
            <select name="kebersihan" id="kebersihan" class="form-control selBox" required="required">
                      <option value="" disabled selected>-- pilih Kebersihan--</option>
                      <option value="tidak_bersih">Tidak Bersih</option>
                      <option value="bersih">Bersih</option>
                  </select>
          </div>

          <div class="form-group">
            <label for="harga">Warna :</label>
            <select name="warna" id="warna" class="form-control selBox" required="required">
                      <option value="" disabled selected>-- pilih warna--</option>
                      <option value="kekuningan">Kekuningan</option>
                      <option value="putih">Putih</option>
                      <option value="bening">Bening</option>
                  </select>
          </div>

          <div class="form-group">
            <input type="submit" value="Submit" class="btn btn-primary mt-3" id="dor" onclick="return simulasi()"/>
          </div>

          </form>
      </div>
    </div>
        
    <div class="row">
      <div class="col-12 mt-5 mb-5">
          <div id="hasilSIM" style="margin-bottom:30px;">

          </div>
      </div>
    </div>

    </div>

<!-- Footer -->
<footer class="page-footer font-small abu1">

  <!-- Footer Elements -->
  <div class="container">

    <!-- Grid row-->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-12 py-5">
        <div class="mb-5 d-flex justify-content-center">
          
          <!--Instagram-->
          <a class="icn" href="https://www.instagram.com/rbayuojitai/" target="_blank">
            <i class="fab fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
          </a>

          <!-- Github -->
          <a class="icn" href="https://github.com/rbayuojitai" target="_blank">
            <i class="fab fa-github fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
          </a>

          <!--Linkedin -->
          <a class="icn" href="https://www.linkedin.com/in/rizky-bayu-ojitaiavian" target="_blank">
            <i class="fab fa-linkedin-in fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
          </a>

          <!--Pinterest-->
          <a class="icn" href="https://dribbble.com/rbayuojitai_" target="_blank">
            <i class="fab fa-dribbble fa-lg white-text fa-2x"> </i>
          </a>
        </div>

        <div class="text-center">
          Made with <i class="fa fa-heart" style="color:#dc3545"></i> in Cianjur
        </div>
      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row-->

  </div>
  <!-- Footer Elements -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3 abu2">© <?php echo date('Y'); ?> Copyright
    <a href="https://github.com/rbayuojitai">Andy</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.js"></script>
<script src="jspopper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- validasi -->
<script>
  $(document).ready(function(){
    $('.toggle').click(function(){
      $('ul').toggleClass('active');
    });
  });
</script>

<script>
  function simulasi()
  {
    var harga = $("#harga").val();
    var bentukberas = $("#bentukberas").val();
    var wangi_beras = $("#wangi_beras").val();
    var status_kebersihan = $("#kebersihan").val();
    var warna = $("#warna").val();

    //validasi
    var um = document.getElementById("harga");
    var tb = document.getElementById("bentukberas");
    var bb = document.getElementById("wangi_beras");
    var sk = document.getElementById("kebersihan");
    var pp = document.getElementById("warna");

    if(um.selectedIndex == 0){
      alert("harga Tidak Boleh Kosong");
      return false;
    }

    if(tb.selectedIndex == 0){
      alert("bentukberas Tidak Boleh Kosong");
      return false;
    }

    if(bb.selectedIndex == 0){
      alert("wangi_beras Tidak Boleh Kosong");
      return false;
    }

    if(sk.selectedIndex == 0){
      alert("Status kebersihan Tidak Boleh Kosong");
      return false;
    }

    if(pp.selectedIndex == 0){
      alert("warna Tidak Boleh Kosong");
      return false;
    }

    //batas validasi

      $.ajax({
        url :'simulasi.php',
        type : 'POST',
        dataType : 'html',
        data : {harga : harga , bentukberas : bentukberas , wangi_beras : wangi_beras , status_kebersihan : status_kebersihan , warna : warna},
        success : function(data){
          document.getElementById("hasilSIM").innerHTML = data;
        },
      });

      return false;

  }
</script>

<script>
$(document).ready(function(){
  $('#dor').click(function(){
    $('html, body').animate({
        scrollTop: $("#hasilSIM").offset().top
    }, 500);
  });
});
</script>
</body>
</html>
