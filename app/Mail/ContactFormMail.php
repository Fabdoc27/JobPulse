<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable {
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $formData;
    public function __construct( $formData ) {
        $this->formData = $formData;

    }

    public function build() {
        return $this->from( $this->formData['email'] )
            ->subject( $this->formData['subject'] )
            ->view( 'email.visitorMail' )
            ->with( ['formData' => $this->formData] );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array {
        return [];
    }
}