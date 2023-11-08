<?php 

define("CLIENT_ID", "ARCKna_14IG8yZPWqJHibA1FiGqUSl1x8bfjDazzcm7xQijdJzI9zRa8qA1lCXZuV4ICFmCy3Y9LeoCK");
//define("CURRENCY", "PEN");
define("KEY_TOKEN", "APR.wqc-354*");
define("MONEDA", "S/");

session_start();

$num_cart = 0;
if(isset($_SESSION['carrito']['productos'])){
    $num_cart = count($_SESSION['carrito']['productos']);
}
?>