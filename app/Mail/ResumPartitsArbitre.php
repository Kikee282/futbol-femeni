<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Collection;

class ResumPartitsArbitre extends Mailable
{
    use Queueable, SerializesModels;

    // Passem l'àrbitre i els seus partits al constructor
    public function __construct(
        public User $arbitre, 
        public Collection $partits
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '📋 Els teus pròxims partits assignats',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.resum_arbitre', // Aquesta serà la vista que crearem ara
        );
    }

    public function attachments(): array
    {
        return [];
    }
}