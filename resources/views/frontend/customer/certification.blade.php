@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    {{ __('panel.confirm_certificate_data') }}
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('customer.create_certification') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="user_name">{{ __('panel.full_name') }}</label>
                            <input type="hidden" name="course_id" value="{{ $course_id }}">
                            <input name="full_name" type="text" class="form-control"
                                value="{{ Auth::user()->full_name }}">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-12 pt-3">
                            {{ __('panel.confirm_certificate_data_message') }}
                        </div>
                    </div>


                    <div class="form-group pt-3">
                        <button type="submit" name="submit" class="btn btn-primary">
                            {{ __('panel.save_data') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
