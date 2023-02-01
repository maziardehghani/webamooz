@component('mail::message')
# خرید موفق

دوره شما توسط یکی از دانشجویان وبسایت وب اموز خریداری گردید سهم شما از فروش این محتوا به کیف پول شما واریز شد.
@component('mail::panel')
دوره آموزشی :: {{$paymentable}}
@endcomponent

با تشکر,<br>
{{ config('app.name') }}
@endcomponent
