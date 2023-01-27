@extends('front::layouts.master')
@section('content')
    <article class="container article">
{{--        @include('front::layouts.adds')--}}
        @include('front::layouts.top-info')
        @include('front::layouts.latest')
        @include('front::layouts.popular')
    </article>
    @include('front::layouts.latestArticle')
@endsection
