<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Midtrans\Snap;

class MidtransController extends Controller
{
    public function payment()
    {
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            ),
            'customer_details' => array(
                'first_name' => 'budi',
                'last_name' => 'pratama',
                'email' => 'budi.pra@example.com',
                'phone' => '08111222333',
            ),
            'enabled_payments' => ["bca_va", "bni_va","shopeepay"]
        );
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        // echo "snapToken = ".$snapToken;
        return view('coba',['snapToken' => $snapToken]);
    }
}
