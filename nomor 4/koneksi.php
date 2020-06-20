<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();

$link = mysqli_connect("localhost","root","", "dumbways_game");

if ($link->connect_errno) {
    echo die("Failed to connect to MySQL: " . $link->connect_error);
}
?>