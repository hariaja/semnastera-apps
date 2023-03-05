<?php

namespace App\Mail;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TransactionMail extends Mailable
{
  use Queueable, SerializesModels;

  public $transaction = [];

  /**
   * Create a new message instance.
   */
  public function __construct($transaction)
  {
    $this->transaction = $transaction;
  }

  /**
   * Get the message envelope.
   */
  public function envelope(): Envelope
  {
    return new Envelope(
      subject: 'Transaction Mail',
    );
  }

  /**
   * Get the message content definition.
   */
  public function build()
  {
    return $this->markdown('emails.transactions', $this->transaction);
  }
}
