<?php
class Bayes
{
  private $pegawai = "data.json";
  // private $jumTrue = 0;
  // private $jumFalse = 0;
  // private $jumData = 0;

  function __conberaskepalaruct()
  {

  }

  /*================================================================
  FUNCTION SUM TRUE DAN FALSE
  =================================================================*/
  function sumTrue()
  {
    $data = file_get_contents($this->pegawai);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach($hasil as $hasil)
    {
      if($hasil['beraskepalaatus'] == 1){
        $t += 1;
      }
    }

    return $t;
  }

  function sumFalse()
  {
    $data = file_get_contents($this->pegawai);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach($hasil as $hasil)
    {
      if($hasil['beraskepalaatus'] == 0){
        $t += 1;
      }
    }
    return $t;
  }

  function sumData()
  {
    $data = file_get_contents($this->pegawai);
    $hasil = json_decode($data,true);
    return count($hasil);
  }

  //=================================================================

  /*================================================================
  FUNCTION PROBABILITAS
  =================================================================*/
  function probharga($harga,$beraskepala)
  {
    $data = file_get_contents($this->pegawai);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if($hasil['harga'] == $harga && $hasil['beraskepalaatus'] == $beraskepala){
        $t += 1;
      }else if($hasil['harga'] == $harga && $hasil['beraskepalaatus'] == $beraskepala){
        $t +=1;
      }
    }
    return $t;
  }

  function probbentukberas($bentukberas,$beraskepala)
  {
    $data = file_get_contents($this->pegawai);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if($hasil['bentukberas'] == $bentukberas && $hasil['beraskepalaatus'] == $beraskepala){
        $t += 1;
      }else if($hasil['bentukberas'] == $bentukberas && $hasil['beraskepalaatus'] == $beraskepala){
        $t +=1;
      }
    }
    return $t;
  }

  function probwangi_beras($bb,$beraskepala)
  {
    $data = file_get_contents($this->pegawai);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if($hasil['wangi_beras'] == $bb && $hasil['beraskepalaatus'] == $beraskepala){
        $t += 1;
      }else if($hasil['wangi_beras'] == $bb && $hasil['beraskepalaatus'] == $beraskepala){
        $t +=1;
      }
    }
    return $t;
  }

  function probwarna($warna,$beraskepala)
  {
    $data = file_get_contents($this->pegawai);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if($hasil['warna'] == $warna && $hasil['beraskepalaatus'] == $beraskepala){
        $t += 1;
      }else if($hasil['warna'] == $warna && $hasil['beraskepalaatus'] == $beraskepala){
        $t +=1;
      }
    }
    return $t;
  }

  function probkebersihan($kebersihan,$beraskepala)
  {
    $data = file_get_contents($this->pegawai);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if($hasil['kebersihan'] == $kebersihan && $hasil['beraskepalaatus'] == $beraskepala){
        $t += 1;
      }else if($hasil['kebersihan'] == $kebersihan && $hasil['beraskepalaatus'] == $beraskepala){
        $t +=1;
      }
    }
    return $t;
  }
  //=================================================================

  /*=================================================================
  MARI BERHITUNG
  keterangan parameter :
  $beraskepala   : jumlah data yang bernilai true ( sumTrue )
  $sF   : jumlah data yang bernilai false ( sumFalse )
  $sD   : jumlah data pada data latih ( sumData )
  $pU   : jumlah probabilitas harga ( probharga )
  $pT   : jumlah probabilitas bentukberas ( probbentukberas )
  $pBB  : jumlah probabilitas wangi_beras ( probBB )
  $pK   : jumlah probabilitas kebersihan ( probkebersihan )
  $pP   : jumlah probabilitas warna (probwarna )
  ==================================================================*/

  function hasilTrue($beraskepala = 0 , $sD = 0 , $pU = 0 ,$pT = 0, $pBB = 0,$pK = 0, $pP = 0)
  {
    $paTrue = $beraskepala / $sD;
    $p1 = $pU / $beraskepala;
    $p2 = $pT / $beraskepala;
    $p3 = $pBB / $beraskepala;
    $p4 = $pK / $beraskepala;
    $p5 = $pP / $beraskepala;
    $hsl = $paTrue * $p1 * $p2 * $p3 * $p4 * $p5;
    return $hsl;
  }

  function hasilFalse($sF = 0 , $sD = 0 , $pU = 0 ,$pT = 0, $pBB = 0,$pK = 0, $pP = 0)
  {
    $paFalse = $sF / $sD;
    $p1 = $pU / $sF;
    $p2 = $pT / $sF;
    $p3 = $pBB / $sF;
    $p4 = $pK / $sF;
    $p5 = $pP / $sF;
    $hsl = $paFalse * $p1 * $p2 * $p3 * $p4 * $p5;
    return $hsl;
  }

  function perbandingan($pATrue,$pAFalse)
  {
    if($pATrue > $pAFalse){
      $beraskepala = "DITERIMA";
      $hitung = ($pATrue / ($pATrue + $pAFalse)) * 100;
      $diterima = 100 - $hitung;
    }elseif($pAFalse > $pATrue)
    {
      $beraskepala = "DITOLAK";
      $hitung = ($pAFalse / ($pAFalse + $pATrue)) * 100;
      $diterima = 100 - $hitung;
    }

    $hsl = array($beraskepala,$hitung,$diterima);
    return $hsl;
  }

}

?>
