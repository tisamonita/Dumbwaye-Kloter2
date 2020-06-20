<?php

//Program untuk melihat waktu bertemu Rafaela dan Nana
echo "Rafael berangkat pukul 14.00, dengan kecepatan 10m/detik, Lalu Nana berangkat pukul 15.00 dengan kecepatan 13 m/detik";


//Jarak waktu berangkat
$second_bertemu = 3600;
//Posisi Rafael pada pukul 15.00 (berarti 1 jam)
$posisi_R = 36000;
//posisi Nana pada pukul 15.00 (0 karena baru akan berangkat)
$posisi_N = 0;

//dilakukan perulangan dengan kondisi
while($posisi_N != $posisi_R) {
    $posisi_N = $posisi_N + 13;
    $posisi_R = $posisi_R + 10;

    $second_bertemu = $second_bertemu + 1;

}

//Dilakukan konvert ke jam:
$jam = intdiv($second_bertemu, 3600);

$second_sisa = $second_bertemu % 3600;
$menit_bertemu = intdiv($second_sisa, 60);
$second_sisa =  $second_sisa % 60;

$jam = 14 + $jam;

echo "<br> <br>  Maka, mereka akan bertemu di detik :  " . $second_bertemu . ' detik kemudian';
echo "<br> <br>  Pada <strong> pukul : ";
echo $jam.':'. $menit_bertemu. ':' .$second_sisa.  ' detik </strong> ' ;
echo '<br> dengan jarak tempuh: '. $posisi_N . 'Meter';

?>
