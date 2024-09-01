@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    تاكيد بيانات الشهادة
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('customer.create_certification') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="user_name">الإسم</label>
                            <input name="full_name" type="text" class="form-control"
                                value="{{ Auth::user()->full_name }}">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-12 pt-3">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Culpa totam cupiditate nesciunt eaque
                            esse ut, dolorum optio est eligendi aspernatur aliquam eius odio minus quod illo ex accusantium
                            dignissimos voluptate.
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
