<?php 
// $params = array(
//     'transaction_details' => array(
//         'order_id' => rand(),
//         'gross_amount' => 10000,
//     ),
//     'customer_details' => array(
//         'first_name' => 'budi',
//         'last_name' => 'pratama',
//         'email' => 'satriotol69@gmail.com',
//         'phone' => '08111222333',
//     ),
// );

// $snapToken = \Midtrans\Snap::getSnapToken($params);
// echo "snapToken = ".$snapToken;
?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{env('MIDTRANS_CLIENT_KEY')}}"></script>
</head>

<body>
    <button id="pay-button">Pay!</button>
    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        // For example trigger on button clicked, or any time you need
        payButton.addEventListener('click', function () {
            snap.pay('<?php echo $snapToken ?>'); // Replace it with your transaction token
        });

    </script>
</body>

</html>
