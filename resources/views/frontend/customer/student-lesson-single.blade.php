@extends('layouts.app')

@section('style')
    <style>
        .selected-lesson {
            background-color: #28a745;
            color: white;
        }
    </style>
@endsection

@section('content')
    @livewire('frontend.customer.student-lesson-single-component', ['slug' => $slug])
@endsection
