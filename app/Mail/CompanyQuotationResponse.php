<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompanyQuotationResponse extends Mailable
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
     * The serviceRequestId.
     *
     * @var serviceRequestId
     */
    public $serviceRequestId;
	
	/**
     * The companyId.
     *
     * @var companyId
     */
    public $companyId;
	
	/**
     * The companyCategoryId.
     *
     * @var companyCategoryId
     */
    public $companyCategoryId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
	 
    public function __construct( $agentClientName,
								 $serviceRequestId,
								 $companyId,
								 $companyCategoryId,
								 $agentClientId,
								 $invitationId
								)
    {
        $this->agentClientName 		= $agentClientName;
		$this->serviceRequestId 	= $serviceRequestId;
		$this->companyId 			= $companyId;
		$this->companyCategoryId 	= $companyCategoryId;
		$this->agentClientId 		= $agentClientId;
		$this->invitationId 		= $invitationId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.companyQuotationResponse');
    }
}
