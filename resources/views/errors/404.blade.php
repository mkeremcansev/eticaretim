@extends('web.layouts.extends')
@section('title', '404')
@section('content')
<section class="error-part">
    <div class="container">
        <h1>404</h1>
        <h3>@lang('words.404_error_title')</h3>
        <p>@lang('words.404_error_content',['email'=>setting('mail')])</p>
        <a href="{{ route('web.index') }}">@lang('words.go_to_shopping')</a>
    </div>
</section>
@endsection