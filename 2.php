<?php
    if($_POST['input']){
        $password = $_POST['password'];

        if(cek_validasi($password)){
            echo "<strong> Password diperbolehkan </strong>";
        } 
        else {
            echo "<strong> Password tidak memenuhi syarat </strong> ";
        }
        
    }

?>


<form method="POST">
    <label for="">Password</label>
        <div class="form-group">
            <div class="form-line">
                <input type="text" name="password" class="form-control" value="">
            </div>
        </div>
        <br>
    <input type="submit" required="" name="input" value="Cek Password" class="btn btn-link waves-effect" >
 </form>

 <?php
        //fungsi cek validasi

  function cek_validasi($password) {
        $panjang_password = strlen($password);
        if($panjang_password < 8 ){
            return false;
        }
        else {
            for($x = 0; $x<=$panjang_password; $x++) {
               if(preg_match_all("/[a-z]/", $password, $matches)){
                    if(preg_match_all("/[A-Z]/", $password, $matches)) {
                        if(preg_match_all("/[0-9]/", $password, $matches)) {
                            if(preg_match_all("/[&@#\/%?=~_|!:,.;]/", $password, $matches)) {
                                return true;
                            }
                        }
                    }
                   
               } 
               else {
                   return false;
               }
            }
        }
    }    
 ?>