<br><br>
<h4>{{ trans('emails.layout.contact_info') }}</h4>
<p>{{ trans('emails.layout.email') }}: {{ $system['email']['content'] ?? '' }}<p>
<p>{{ trans('emails.layout.phone') }}: {{ $system['phone']['content'] ?? '' }}<p>
<!-- <p>{{ trans('emails.layout.address') }}: {{ $system['address']['content'] ?? '' }}<p> -->