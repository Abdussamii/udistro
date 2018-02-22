@component('mail::message')
# Quotation Request

Hi {{ $companyName }}

@component('mail::button', ['url' => 'udistro.ca/movers/quotationresponse/' {{ $comapnyId }}, 'color' => 'blue'])
View Quotation Request
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
