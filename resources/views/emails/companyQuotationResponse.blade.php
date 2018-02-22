@component('mail::message')
# Quotation Request

Hi {{ $agentClientName }}

Udistro registered company send you quotation response.

@component('mail::button', ['url' => https://www.udistro.ca/movers/quotationresponse?agent_id=base64_encode({{$companyId}})&client_id=base64_encode({{$agentClientId}})&invitation_id=base64_encode({{$invitationId}}), 'color' => 'blue'])
View Quotation Response
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent


