<?php


include('koneksi.php');
$id_trx = $_GET['id'];

$query_get = $link->query("SELECT * FROM transaction where id_trx ='$id_trx'");
$data = mysqli_fetch_array($query_get);
$stok = $data['stock'];
$stok = $stok-1;
$query = $link->query("UPDATE transaction set stock='$stock' WHERE id_trx='$id_trx'");

echo '<script>window.location="index.php"</script>';

?>