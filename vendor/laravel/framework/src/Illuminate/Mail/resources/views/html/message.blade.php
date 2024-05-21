@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
@endslot

<h3 style="text-align: center">Welcome to Asian Food Museum!</h3>
<p>Thank you for registering  in Asian Food Museum!</p>
<br>
<p>Please click the button below to verify your account.</p>
{{-- Body --}}
{{ $slot }}
<div class="theme-logo">
    <a href="/">
        <img src="{{ asset('images/logos/logo_foodsh.png') }}" class="blur-up lazyload" alt="">
    </a>
</div>
{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
Feel free to adjust the design elements and text to better fit your website's branding and style.
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent
