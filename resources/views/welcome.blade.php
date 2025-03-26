@extends('layouts.app')

@section('content')
    @include('welcome_page.hero')
    <main>
        @include('welcome_page.residents_section')
        @include('components.split-section')
        @include('welcome_page.event_section')
        @include('components.split-section')
        @include('welcome_page.artistic-performance-section')
        @include('components.split-section')
        @include('welcome_page.discovery')
        @include('components.split-section')
        @include('welcome_page.article-pages-section')
        @include('components.split-section')
        @include('welcome_page.from-section')
    </main>
@endsection

