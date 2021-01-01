<?php
    namespace Midtrans;

    // require_once dirname(__FILE__) . '/../../Midtrans.php';
    //Set Your server key
    Config::$serverKey = "SB-Mid-server-9xwN7E-3Z97u382iMqioXTK3";
    // Uncomment for production environment
    // Config::$isProduction = true;
    Config::$isSanitized = Config::$is3ds = true;

    // Required
    $transaction_details = array(
        'order_id' => rand(),
        'gross_amount' => 94000, // no decimal allowed for creditcard
    );
    $billing_address = array(
    'first_name'   => "Andri",
    'last_name'    => "Setiawan",
    'address'      => "Karet Belakang 15A, Setiabudi.",
    'city'         => "Jakarta",
    'postal_code'  => "51161",
    'phone'        => "081322311801",
    'country_code' => 'IDN'
    );
    $shipping_address = array(
    'first_name'   => "John",
    'last_name'    => "Watson",
    'address'      => "Bakerstreet 221B.",
    'city'         => "Jakarta",
    'postal_code'  => "51162",
    'phone'        => "081322311801",
    'country_code' => 'IDN'
    );
    // Optional
    $item_details = array (
        array(
            'id' => 'a1',
            'price' => 94000,
            'quantity' => 1,
            'name' => "Apple"
        ),
    );
    // Optional
    $customer_details = array(
        'first_name'    => "Andri",
        'last_name'     => "Litani",
        'email'         => "andri@litani.com",
        'phone'         => "081122334455",
        'billing_address'  => $billing_address,
        'shipping_address' => $shipping_address
    );
    // Fill transaction details
    $transaction = array(
        'transaction_details' => $transaction_details,
        'customer_details' => $customer_details,
        'item_details' => $item_details,
    );

    $snapToken = Snap::getSnapToken($transaction);
    echo "snapToken = ".$snapToken;
    if ($transaction == 'capture') {
    // For credit card transaction, we need to check whether transaction is challenge by FDS or not
    if ($type == 'credit_card') {
        if ($fraud == 'challenge') {
            // TODO set payment status in merchant's database to 'Challenge by FDS'
            // TODO merchant should decide whether this transaction is authorized or not in MAP
            echo "Transaction order_id: " . $order_id ." is challenged by FDS";
        } else {
            // TODO set payment status in merchant's database to 'Success'
            echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
        }
    }
} else if ($transaction == 'settlement') {
    // TODO set payment status in merchant's database to 'Settlement'
    echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
} else if ($transaction == 'pending') {
    // TODO set payment status in merchant's database to 'Pending'
    echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
} else if ($transaction == 'deny') {
    // TODO set payment status in merchant's database to 'Denied'
    echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
} else if ($transaction == 'expire') {
    // TODO set payment status in merchant's database to 'expire'
    echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
} else if ($transaction == 'cancel') {
    // TODO set payment status in merchant's database to 'Denied'
    echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
}
?>


<!DOCTYPE html>
<html>

<body>
    <button id="pay-button">Pay!</button>
    <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{env('MIDTRANS_CLIENT_KEY')}}">
    </script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            // SnapToken acquired from previous step
            snap.pay('<?php echo $snapToken?>');
        };

    </script>
</body>

</html>
