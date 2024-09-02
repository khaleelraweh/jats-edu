@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    بيانات الشهادة
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <img src="{{ asset('assets/certifications/' . $certificate->cert_file) }}" alt=""
                            style="width: 70%;display:block;margin: auto;">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <a class="btn btn-primary">استعراض الشهادة</a class="btn btn-primary">
                        <a class="btn btn-primary">تنزيل الشهادة</a class="btn btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
