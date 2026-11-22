@extends('layout')
@section('title', 'Contoh Halman Blade')
@section('header', $title)

@section('content')
    <ol>
        @foreach ($product as $value)
            <li>{{ $value }}</li>
        @endforeach
    </ol>
@endsection
