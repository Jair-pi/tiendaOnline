<?php

require 'vendor/autoload.php';


MercadoPago\SDK::setAccessToken('TEST-517884722182097-111116-01c3a3d2172266ef0e1e4f92fb63ea99-1544320337');

$preference = new MercadoPago\Preference();

$item = new MercadoPago\Item();
$item->id = '0001';
$item->title = 'Producto RC';
$item->quantity = 1;
$item->unit_price = 150.00;
$item->currency_id = "PEN";

$preference->items = array($item);

$preference->back_urls = array(
    "success" => "https://localhost/tiendaOnline/captura.php",
    "failure" => "https://localhost/tiendaOnline/fallo.php",
);

$preference->auto_return = "approved";
$preference->binary_mode = true;

$preference->save();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://sdk.mercadopago.com/js/v2"></script>

</head>
<body>
    
    <h3>Mercado pago</h3>

    <div class="checkout-btn"></div>

    <script>
        const mp = new MercadoPago('TEST-0e09380c-59b6-437a-abb1-8ef2ba4f67fa', {
            locale: 'es-PE'
        });

        mp.checkout({
            preference: {
                id: '<?php echo $preference->id; ?>'
            },
            render: {
                container: '.checkout-btn',
                label: 'Pagar con MP'
            }
        })
    </script>

</body>
</html>