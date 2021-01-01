@component('mail::message')
# Dear {{$data['name']}},

Here is your invoice {{$data['invoice']}} amounting in IDR {{number_format($data['subtotal'] + $data['cost'],2)}} from JAGGS. Please remit payment at your earliest convenience. <br><br>
Do not hesitate to contact us if you have any questions.

@component('mail::button', ['url' => ''])
MAKE PAYMENT
@endcomponent

Thanks,<br>
JAGGS APPAREL
@endcomponent

