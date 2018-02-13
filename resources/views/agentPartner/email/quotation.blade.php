@component('mail::message')
# Quotation Request
Hi {{ $agentPartner->lname .' '. $agentPartner->fname}}

Udistro agent's client is requesting quotation from you.


@component('mail::button', ['url' => 'udistro.ca/agentpartner/' {{ $agentPartnerDigitalServiceRequest->id }}, 'color' => 'blue'])
View Quotation
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
