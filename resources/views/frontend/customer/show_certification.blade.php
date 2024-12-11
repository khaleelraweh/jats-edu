@extends('layouts.app')

@section('style')
    <!-- Custom CSS -->
    <style>
        .modal-custom {
            max-width: 60% !important;
        }

        @media (min-width: 992px) {
            .modal-custom {
                max-width: 50%;
            }
        }

        .modal-image {
            width: 100%;
            height: auto;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .modal-header {
            display: none;
        }

        .modal-footer {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    {{ __('panel.certificate_data') }}

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

                        <a href="#" data-toggle="modal" data-target="#identityModal" class="btn btn-primary">
                            {{ __('panel.certificate_review') }}

                        </a>

                        <a href="{{ asset('assets/certifications/' . $certificate->cert_file) }}" class="btn btn-primary"
                            download="certificate_{{ $certificate->id }}"> {{ __('panel.Download_the_certificate') }}</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Identity image -->
    <div class="modal fade" id="identityModal" tabindex="-1" role="dialog" aria-labelledby="identityModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-custom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="identityModalLabel">Identity Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('assets/certifications/' . $certificate->cert_file) }}" alt="Identity Image"
                        class="img-fluid modal-image">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
