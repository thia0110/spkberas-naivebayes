<?php
require_once 'autoload.php';

$obj = new Bayes();

$jumTrue = $obj->sumTrue();
$jumFalse = $obj->sumFalse();
$jumData = $obj->sumData();

$a1 = $_POST['harga'];
$a2 = $_POST['bentukberas'];
$a3 = $_POST['wangi_beras'];
$a4 = $_POST['status_kebersihan'];
$a5 = $_POST['warna'];

//TRUE
$harga = $obj->probharga($a1,1);
$bentukberas = $obj->probbentukberas($a2,1);
$bb = $obj->probwangi_beras($a3,1);
$kebersihan = $obj->probkebersihan($a4,1);
$warna = $obj->probwarna($a5,1);

//FALSE
$harga2 = $obj->probharga($a1,0);
$bentukberas2 = $obj->probbentukberas($a2,0);
$bb2 = $obj->probwangi_beras($a3,0);
$kebersihan2 = $obj->probkebersihan($a4,0);
$warna2 = $obj->probwarna($a5,0);

//result
$paT = $obj->hasilTrue($jumTrue,$jumData,$harga,$bentukberas,$bb,$kebersihan,$warna);
$paF = $obj->hasilFalse($jumTrue,$jumData,$harga2,$bentukberas2,$bb2,$kebersihan2,$warna2);

if($a2 == "jitai"){
  $a2 = "jitai";
}else if($a2 == "beras super"){
  $a2 = "beras super";
}

echo "
<div class='jumbotron jumbotron-fluid' id='hslPrekdiksinya'>
  <div class='container'>
    <h1 class='display-4 tebal'>Hasil Prediksi</h1>
    <p class='lead'>Berikut ini adalah hasil prediksi berdasarkan masukan Kriteria Beras Prioritas menggunakan metode naive bayes.</p>
  </div>
</div>
";

echo "
<div class='card' style='width: 25rem;'>
  <div class='card-header' style='background-color:#17a2b8;color:#fff'>
    <b>Informasi Supply Beras</b>
  </div>
  <ul class='list-group list-group-flush'>
    <li class='list-group-item'>harga : &nbsp;&nbsp;<b>$a1</b></li>
    <li class='list-group-item'>bentukberas : &nbsp;&nbsp;<b>$a2</b></li>
    <li class='list-group-item'>wangi_beras : &nbsp;&nbsp;<b>$a3</b></li>
    <li class='list-group-item'>kebersihan : &nbsp;&nbsp;<b>$a4</b></li>
    <li class='list-group-item'>warna : &nbsp;&nbsp;<b>$a5</b></li>
  </ul>
</div><br>
<hr>
";

echo "<br>
<table class='table table-bordered' style='font-size:18px;text-align:center'>
  <tr style='background-color:#17a2b8;color:#fff'>
    <th>Jumlah True</th>
    <th>Jumlah False</th>
    <th>Jumlah Total Data</th>
  </tr>
  <tr>
    <td>$jumTrue</td>
    <td>$jumFalse</td>
    <td>$jumData</td>
  </tr>
</table>
";

echo "<br>
<table class='table table-bordered' style='font-size:18px;text-align:center'>
  <tr style='background-color:#17a2b8;color:#fff'>
    <th></th>
    <th>True</th>
    <th>False</th>
  </tr>
  <tr>
    <td>pA</td>
    <td>$jumTrue / $jumData</td>
    <td>$jumFalse / $jumData</td>
  </tr>
  <tr>
    <td>Harga</td>
    <td>$harga / $jumTrue</td>
    <td>$harga2 / $jumFalse</td>
  </tr>
  <tr>
    <td>Bentuk Beras</td>
    <td>$bentukberas / $jumTrue</td>
    <td>$bentukberas2 / $jumFalse</td>
  </tr>
  <tr>
    <td>Wangi</td>
    <td>$bb / $jumTrue</td>
    <td>$bb2 / $jumFalse</td>
  </tr>
  <tr>
    <td>Kebersihan</td>
    <td>$kebersihan / $jumTrue</td>
    <td>$kebersihan2 / $jumFalse</td>
  </tr>
  <tr>
    <td>Warna</td>
    <td>$warna / $jumTrue</td>
    <td>$warna2 / $jumFalse</td>
  </tr>
</table>
";

echo "<br>
  <table class='table table-bordered' style='font-size:18px;text-align:center;'>
    <tr style='background-color:#17a2b8;color:#fff'>
      <th>Presentasi Diterima</th>
      <th>Presentasi Ditolak</th>
    </tr>
    <tr>
      <td>$paT</td>
      <td>$paF</td>
    </tr>
  </table>
";

$result = $obj->perbandingan($paT,$paF);

if($paT > $paF){
  echo "<br>
  <h3 class='tebal'>PRESENTASI <span class='badge badge-success' style='padding:10px'><b>DITERIMA</b></span> LEBIH BESAR DARI PADA PRESENTASI DITOLAK</h3><br>";
  echo "<h4><br>Presentasi diterima sebanyak : <b>".round($result[1],2)." %</b> <br>Presentasi ditolak sebanyak : <b>".round($result[2],2)." % </b></h4>";
}else if($paF > $paT){
  echo "<br>
  <h3 class='tebal'>PRESENTASI <span class='badge badge-danger' style='padding:10px'><b>DITOLAK</b></span> LEBIH BESAR DARI PADA PRESENTASI DITERIMA</h3><br>";
  echo "<h4><br>Presentasi ditolak sebanyak : <b>".round($result[1],2)." %</b> <br>Presentasi diterima sebanyak : <b>".round($result[2],2)." % </b></h4>";
}


if($result[0] == "DITERIMA"){
  echo "
  <div class='alert alert-success mt-5' role='aler'>
    <h4 class='alert-heading'>Kesimpulan : $result[0] </h4>
    <p>Selamat ! berdasarkan hasil prediksi , anda dinyatakan <b>diterima!</b></p>
    <hr>
    <p class='mb-0'>- Have a nice day -</p>
  </div>
  <button onclick= window.print() >Cetak Data Hasil</button>";
}else{
  echo"
  <div class='alert alert-danger mt-5' role='aler'>
  <h4 class='alert-heading'>Kesimpulan : $result[0] </h4>
  <p>Maaf, berdasarkan hasil prediksi , anda dinyatakan <b>ditolak!</p>
  <hr>
  <p class='mb-0'>- Don't give up ! -</p>
  </div>
  <button onclick= window.print() >Cetak Data Hasil</button>";
}


 ?>
