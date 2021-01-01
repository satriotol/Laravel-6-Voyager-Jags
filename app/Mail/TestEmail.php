<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$pdf)
    {
        $this->data =$data;
        $this->pdf = $pdf;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.emailtemplate')
        ->from('marketing@jaggs.id')
        ->subject('Hey Jags! This Is Your Invoice')
        // ->view('email.emailtemplate')
        ->with('data',$this->data)
        ->attachData($this->pdf->output(),"invoice_pdf.pdf");
    }
}
