<?php 

$patch = dirname(__FILE__) . DIRECTORY_SEPARATOR;

require_once $patch . '/database.php';
require_once $patch . '/../admin/clases/cifrado.php';

$db = new Database();
$con = $db->conectar();

$sql = "SELECT nombre, valor FROM configuracion";
$resultado = $con->query($sql);
$datosConfig = $resultado->fetchAll(PDO::FETCH_ASSOC);

$config = [];

foreach($datosConfig as $datoConfig){
    $config[$datoConfig['nombre']] = $datoConfig['valor'];
}

//configuracion para el sistema
define("SITE_URL", "https://localhost/tiendaOnline");
define("KEY_TOKEN", "APR.wqc-354*");


//configuracion para paypal
define("CLIENT_ID", "ARCKna_14IG8yZPWqJHibA1FiGqUSl1x8bfjDazzcm7xQijdJzI9zRa8qA1lCXZuV4ICFmCy3Y9LeoCK");
//define("CURRENCY", "PEN");
define("MONEDA", "S/");


//configuracion para mercado Pago
define("TOKEN_MP", "TEST-517884722182097-111116-01c3a3d2172266ef0e1e4f92fb63ea99-1544320337");



//datos para envio de correo electronico
define("MAIL_HOST", $config['correo_smtp']);
define("MAIL_USER", $config['correo_email']);
define("MAIL_PASS", descifrar($config['correo_password']));
define("MAIL_PORT", $config['correo_puerto']);


session_start();

$num_cart = 0;
if(isset($_SESSION['carrito']['productos'])){
    $num_cart = count($_SESSION['carrito']['productos']);
}


?>