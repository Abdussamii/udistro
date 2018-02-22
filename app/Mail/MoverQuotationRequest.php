<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Company;

class MoverQuotationRequest extends Mailable
{
    use Queueable, SerializesModels;
	
	/**
     * The agentClientName.
     *
     * @var agentClientName
     */
    public $agentClientName;
	
	/**
     * The agentClientId.
     *
     * @var agentClientId
     */
    public $agentClientId;
	
	/**
     * The invitationId.
     *
     * @var invitationId
     */
    public $invitationId;
	
	/**
     * The companyId.
     *
     * @var companyId
     */
    public $companyId;
	
	/**
     * The companyName.
     *
     * @var companyName
     */
    public $companyName;
	

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $agentClientName, $companyName, $companyId, $agentClientId, $invitationId)
																
    {
		$this->agentClientName	= $agentClientName;
		$this->companyName		= $companyName;
		$this->companyId		= $companyId;
		$this->agentClientId	= $agentClientId;
		$this->invitationId		= $invitationId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.moverQuotationRequest');
    }
}
