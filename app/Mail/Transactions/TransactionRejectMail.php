<?php

namespace App\Mail\Transactions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TransactionRejectMail extends Mailable
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
      subject: 'Transaction Rejected By Admin',
    );
  }

  /**
   * Get the message content definition.
   */
  public function build()
  {
    return $this->markdown('emails.transactions.reject', $this->transaction);
  }
}
