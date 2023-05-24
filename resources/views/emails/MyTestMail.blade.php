@component('mail::message')
Dear <strong> {{ isset($data['user_name'])  && !empty($data['user_name']) ? $data['user_name'] : '-'}}</strong>,


<strong>Congratulations!! </strong><br>
Your account has been verified now all your books are visible on website!
<br>

<blockquote>{{ucfirst("Keep uploading your books and enjoy using our website!")}}</blockquote>


Thanks,<br>
{{ config('app.name') }}
@endcomponent