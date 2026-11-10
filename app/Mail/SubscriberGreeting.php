<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscriberGreeting extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /** @param array{subject:string,title:string,message:string,button:string} $greeting */
    public function __construct(public string $recipientEmail, public array $greeting)
    {
        $this->greeting = $greeting;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(subject: $this->greeting['subject']);
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(view: 'emails.subscriber-greeting', with: [
            'recipientEmail' => $this->recipientEmail,
            'greeting' => $this->greeting,
        ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
