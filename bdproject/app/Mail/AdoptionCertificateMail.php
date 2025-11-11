<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class AdoptionCertificateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $post;

    public function __construct($user, $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

    public function build()
    {
        $pdf = Pdf::loadView('pdf.certificate', [
            'user' => $this->user,
            'post' => $this->post
        ]);

        return $this->subject('Certificat de Adopție - Felicitări! ')
            ->view('emails.adoption.certificate')
            ->attachData($pdf->output(), 'certificat-adoptie.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
