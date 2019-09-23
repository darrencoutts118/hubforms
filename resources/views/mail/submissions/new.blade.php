@component('mail::message')
# Order Shipped

You have had a new submission on <strong>{{ $form->title }}</strong>

@component('mail::button', ['url' => route('admin.submissions.show', [$form, $submission])])
View submission
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
