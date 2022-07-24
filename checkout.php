<?php
require 'vendor/autoload.php';

MercadoPago\SDK::setAccessToken('TEST-3413317611199759-031220-e7c6b3a54cd2a2363b04c47f4f46374b-301083843');


$preference = new MercadoPago\Preference();

// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->title = 'Revoque Texturizado';
$item->quantity = 2;
$item->unit_price = 1900.12;
$item->currency_id = "ARG";
$preference->items = array($item);
$preference->save();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Pro</title>

    <script src="https://sdk.mercadopago.com/js/v2"></script>
</head>

<body>

    <h3>MercadoPago</h3>

    <div class="checkout-pro"></div>


    <script>
        const mp = new MercadoPago('TEST-1ec07af6-03cf-4bc7-a2a4-a50ad3d087c7', {
            locale: 'es-AR',
        });

        mp.checkout({
            preference: {
                id: "<?php echo $preference->id; ?>",
            },
            render: {
                container: ".checkout-pro",
                label: "Pagar", 
            },
        });
    </script>

</body>

</html>