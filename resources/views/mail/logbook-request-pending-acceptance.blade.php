@component('mail::message')
# Logbook Transfer Pending Acceptance

Your logbook transfer request is now pending acceptance.

| Field | Value |
| :--- | :--- |
| Application number | {{ $logbookRequest->ntsaApplicationNumber ?? 'N/A' }} |
| Chassis number | {{ $logbookRequest->chasisNumber ?? 'N/A' }} |
| Registration number | {{ $logbookRequest->regNumber ?? 'N/A' }} |

Kindly log in to the NTSA portal and accept the transfer.

Regards,<br>
{{ config('app.name') }}
@endcomponent