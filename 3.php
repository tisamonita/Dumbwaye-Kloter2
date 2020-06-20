<?php
    if($_POST['input']){
      $garis = $_POST['garis'];
        buat_garis($garis);
    }

?>

<form method="POST">
    <label for="">Buat Garis</label>
        <div class="form-group">
            <div class="form-line">
                <input type="text" name="garis" class="form-control" value="">
            </div>
        </div>
        <br>
    <input type="submit" required="" name="input" value="Buat Garis" class="btn btn-link waves-effect" >
 </form>

 <?php
        //fungsi buat garis

  function buat_garis($garis) {
        $panjang = strlen($garis);
            //PERULANGAN UNTUK TIAP KARAKTER
            for($x = 0; $x<=$panjang; $x++){
                    //perulangan untuk spasi
                for($y=0; $y<=$x; $y++){
                    echo "&nbsp;&nbsp;&nbsp;";
                }
                echo $garis[$x];
                echo "<br>";
            }
    }    
 ?>