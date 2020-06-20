<?php

include('koneksi.php');

if (!isset($_GET['module']) || $_GET['module'] == ''){
    $_GET['module'] = 'isi';   
}

if (!isset($_GET['genre']) || $_GET['module'] == ''){
    $_GET['genre'] = 'all';   
}

if($_POST['genre_add']){
    $genre = $_POST['genre'];
    $query_addgenre = $link->query("INSERT INTO genre values('', '$genre')");
}

if($_POST['stock_add']){
  $price = $_POST['price'];
  $stock = $_POST['stock'];
  $games = $_POST['games'];

  $query_addgenre = $link->query("UPDATE transaction set stock='$stock', price='$price' WHERE id_game='$games'");
}

if($_POST['game_add']){

    $judul = $_POST['judul'];
    $genre = $_POST['genre'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];

    $allowed_ext    = array('jpg', 'jpeg', 'png', 'PNG');
    $foto_name      = $_FILES['foto']['name'];
    $tmp            = explode('.',$_FILES['foto']['name']);
    $foto_ext       = strtolower(end($tmp));

    $foto_tmp       = $_FILES['foto']['tmp_name'];

    if(in_array($foto_ext, $allowed_ext) === true){
        $lokasi = 'foto/'.$foto_name;
        move_uploaded_file($foto_tmp, $lokasi);

            $query_insert = $link->query("INSERT INTO game values('', '$judul', '$lokasi', '$genre')");
            $id_game = mysqli_insert_id($link);
            $query_trx = $link->query("INSERT into transaction values('', '$price','$id_game', '$stock')");

    }else{
        echo '<div class="error">ERROR: Ekstensi file tidak di izinkan!</div>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap 4 Website Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <style>


  .btn {
      margin-left: 15px;
  }
  </style>
</head>
<body>

<div class="jumbotron text-center" style="margin-bottom:0">
  <h1>Dumbways Game Center</h1>
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#stock">
        Add Stock
        </button>
      </li>
      <li class="nav-item"> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#genre">
        Add Genre
        </button>
      </li>
      <li class="nav-item">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#game">
            Add Game
            </button>
      </li>    
    </ul>
  </div>  
</nav>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-3">
      <h3>Daftar Genre</h3>
      <p>Daftar Genre Yang tersedia</p>
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a href="index.php?module=isi&genre=all" <?php if($_GET['genre'] == 'all' || $_GET['genre'] == '') { ?> class="nav-link active" <?php } else { ?> class="nav-link" <?php } ?> >All</a>
        </li>
        <?php
            $query1 = $link->query("SELECT * FROM genre");
            while($data1 = mysqli_Fetch_Array($query1)){

        ?>
        <li class="nav-item">
        <a href="index.php?module=isi&genre=<?=$data1['id']; ?>" <?php if($_GET['genre'] == $data1['id']) { ?> class="nav-link active" <?php } else { ?> class="nav-link" <?php } ?> ><?= $data1['name']; ?></a>
        </li> 
            <?php } ?> 
      </ul>
      <hr class="d-sm-none">
    </div>
    <div class="col-sm-9">
      <h2>Game</h2>
      <?php require_once($_GET['module'].'.php'); ?>
    </div>
  </div>
</div>

<div class="jumbotron text-center" style="margin-bottom:0">
  <p>Footer</p>
</div>

</body>
</html>


<!-- The Modal -->
<div class="modal" id="stock">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Ubah Stock dan Harga </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form method="POST">
            <label for="email_address">Games</label>
                <div class="form-group">
                    <div class="form-line">
                    <select name="games">
                        <?php $query4= $link->query("SELECT * FROM game");
                        while($datagame = mysqli_fetch_array($query4)){
                        ?>
                            <option value="<?=$datagame[id_game]; ?>"> <?=$datagame['title']; ?></option>
                        <?php } ?>
													</select>
                    </div>
                </div>
            <label for="email_address">Stok</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="stock" class="form-control" value="">
                    </div>
                </div>
            <label for="email_address">Harga</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="price" class="form-control" value="">
                    </div>
                </div>
            <br>
                    <input type="submit" required="" name="stock_add" value="Ubah Data" class="btn btn-primary waves-effect" >
         </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal" id="genre">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Genre</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form method="POST">
            <label for="email_address">Genre</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="genre" class="form-control" value="">
                    </div>
                </div>
            
            
            <br>
                    <input type="submit" required="" name="genre_add" value="Tambah Genre" class="btn btn-primary waves-effect" >
         </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal" id="game">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Game</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form method="POST" enctype="multipart/form-data">
            <label for="email_address">Genre</label>
                <div class="form-group">
                    <div class="form-line">
                    <select name="genre">
                        <?php $query5= $link->query("SELECT * FROM genre");
                        while($datagenre = mysqli_fetch_array($query5)){
                        ?>
                            <option value="<?=$datagenre['id']; ?>"><?=$datagenre['name']; ?></option>
                        <?php } ?>
													</select>
                    </div>
                </div>
                <label for="email_address">Judul Game</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="judul" class="form-control" value="">
                    </div>
                </div>
                <label for="email_address">Pilih Foto</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="file" name="foto" class="form-control" value="">
                    </div>
                </div>
                <label for="email_address">Stok</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="stock" class="form-control" value="">
                    </div>
                </div>
            <label for="email_address">Harga</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="price" class="form-control" value="">
                    </div>
                </div>
            
            <br>
                    <input type="submit" required="" name="game_add" value="Tambah Game" class="btn btn-primary waves-effect" >
         </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>