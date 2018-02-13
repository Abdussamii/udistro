<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\AgentPartner;
use App\AgentPartnerDigitalServiceRequest;

class Quotation extends Mailable
{
    use Queueable, SerializesModels;
	
	/**
     * The agentPartner instance.
     *
     * @var agentPartner
     */
    public $agentPartner;
	
	/**
     * The agentPartnerDigitalServiceRequest instance.
     *
     * @var agentPartnerDigitalServiceRequest
     */
    public $agentPartnerDigitalServiceRequest;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( AgentPartner $agentPartner, 
								 AgentPartnerDigitalServiceRequest $agentPartnerDigitalServiceRequest
								)								
    {
        $this->agentPartner 						= $agentPartner;
		$this->agentPartnerDigitalServiceRequest 	= $agentPartnerDigitalServiceRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('quotation@udistro.ca')
					->markdown('agentPartner.email.quotation');
    }
}
