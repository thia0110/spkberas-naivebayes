<?php
require_once 'autoload.php';

$obj = new Bayes();

// echo $obj->sumData()."<br>";
// echo $obj->sumTrue()."<br>";
// echo $obj->sumFalse()."<br>";
// echo $obj->probharga(21,0)."<br>";

$jumTrue = $obj->sumTrue();
$jumFalse = $obj->sumFalse();
$jumData = $obj->sumData();

$a1 = 20;
$a2 = "beraskepala";
$a3 = "bau";
$a4 = "bersih";
$a5 = "putih";

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

echo "
======================================<br>
harga : $a1<br>
bentukberas : $a2<br>
wangi_beras : $a3<br>
kebersihan : $a4<br>
warna : $a5<br>
=======================================<br><br>
";

echo "
======================================<br>
kemungkinan true : <br>
jumlah true : $jumTrue <br>
jumlah data : $jumData <br>
=======================================<br><br>
";

echo "
======================================<br>
kemungkinan false : <br>
jumlah false : $jumFalse <br>
jumlah data : $jumData <br>
=======================================<br><br>
";

echo "
======================================<br>
pATrue : $jumTrue / $jumData<br>
harga true : $harga / $jumTrue <br>
bentukberas true : $bentukberas / $jumTrue <br>
wangi_beras true : $bb / $jumTrue <br>
kebersihan true : $kebersihan / $jumTrue <br>
warna true : $warna / $jumTrue <br><br>
=======================================<br><br>
";

echo "
======================================<br>
pAFalse : $jumFalse / $jumData<br>
harga false : $harga2 / $jumFalse <br>
bentukberas false : $bentukberas2 / $jumFalse <br>
wangi_beras false : $bb2 / $jumFalse <br>
kebersihan false : $kebersihan2 / $jumFalse <br>
warna false : $warna2 / $jumFalse <br>
=======================================<br><br>
";

echo "
======================================<br>
presentasi yes : $paT<br>
presentasi no : $paF<br>
=======================================<br><br>
";

if($paT > $paF){
  echo "
  ======================================<br>
  PRESENTASI YES LEBIH BESAR DARI PADA PRESENTASI NO<br>
  =======================================
  <br><br>";
}else if($paF > $paT){
  echo "
  ======================================<br>
  PRESENTASI NO LEBIH BESAR DARI PADA PRESENTASI YES<br>
  =======================================
  <br><br>";
}

// echo $obj->hasilTrue($jumTrue,$jumData,$harga,$bentukberas,$bb,$kebersihan,$warna)."<br>";
// echo $obj->hasilFalse($jumTrue,$jumData,$harga2,$bentukberas2,$bb2,$kebersihan2,$warna2)."<br><br>";

$result = $obj->perbandingan($paT,$paF);
echo " beraskepalaatus : $result[0] <br>Presentasi diterima sebanyak : ".round($result[1],2)." % <br>Presentasi diolak sebanyak : ".round($result[2],2)." % ";
 ?>
