@extends('layouts.app')

@section('content')
    @livewire('frontend.customer.student-lesson-single-component', ['slug' => $slug])
@endsection
