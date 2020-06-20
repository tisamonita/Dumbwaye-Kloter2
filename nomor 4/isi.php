<?php

$genre = $_GET['genre'];
if($genre=='all') {
    $query2 = $link->query("SELECT game.title, game.images, genre.name, transaction.price, transaction.id_trx, transaction.stock FROM game INNER JOIN genre on game.id_genre=genre.id INNER JOIN transaction ON transaction.id_game=game.id_game");
}
else {
    $query2 = $link->query("SELECT game.title, game.images, genre.name, transaction.price, transaction.id_trx, transaction.stock FROM game INNER JOIN genre on game.id_genre=genre.id INNER JOIN transaction ON transaction.id_game=game.id_game WHERE genre.id='$genre'");
}

?>


<div class="row">
    <?php 
        while($tampil = mysqli_fetch_array($query2)){
    ?> 
    <div class="col-sm-3">
        <div class="card"> 
                <img src="<?=$tampil['images']; ?>" >
            <p> Judul : <?= $tampil['title']; ?><br>  Harga : <?= $tampil['price']; ?>
            <br> Genre : <?= $tampil['name']; ?> <br> Stok  : <?= $tampil['stock']; ?></p>
           <a href="beli.php&id=<?= $tampil['id_trx']; ?>"> <button type="button" class="btn btn-warning">
        Beli
        </button> </a>
        </div>
       
    </div>
        <?php } ?>
</div>

<p>Some text..</p>
<p></p>
<br>