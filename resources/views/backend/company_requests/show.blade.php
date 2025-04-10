@extends('layouts.admin')

@section('style')
    <style>
        /* Base Styles */
        body {
            font-family: "Times New Roman", Times, serif;
            color: #000;
        }

        .outer {
            background-color: white;
            padding: 1rem;
        }

        .inner {
            border: 1px solid #777;
        }

        .ww {
            font-weight: bold;
            font-size: 1.1rem;
        }

        /* Header Styles */
        .header-content {
            padding: 1rem 0;
        }

        .institute-name {
            text-align: center;
            margin: 0.5rem 0;
        }

        .institute-name-ar {
            color: green;
            font-size: 1.4rem;
            font-weight: 800;
            margin: 0;
        }

        .institute-subtitle-ar {
            color: gold;
            font-size: 1rem;
            font-weight: 700;
            margin: 0;
        }

        .institute-name-en {
            color: green;
            font-size: 1.4rem;
            font-weight: 800;
            margin: 0;
        }

        .institute-subtitle-en {
            color: gold;
            font-size: 0.9rem;
            font-weight: 700;
            margin: 0.25em 0 0;
        }

        .logo-img {
            width: 100%;
            max-width: 11em;
            padding-top: 10px;
            z-index: 4;
        }

        /* Header Lines */
        .header-line {
            position: relative;
            margin: -2rem 0 2.5rem;
            z-index: 2;
        }

        .gold-line,
        .gray-line {
            height: 4px;
        }

        .gold-line {
            background-color: gold;
            width: 99%;
            margin: 0 auto 3px;
        }

        .gray-line {
            margin-bottom: 1rem;
            background-color: whitesmoke;
        }

        /* Main Content */
        .main-section {
            border: 6px double green;
            font-size: 1rem;
            padding: 1rem;
        }

        .form-title {
            border: 4px solid green;
            padding: 0.375em;
            display: inline-block;
            text-align: center;
            margin: 1rem auto;
        }

        .form-title h1 {
            margin: 0;
            font-size: 1.2rem;
            border: 1px solid green;
            border-radius: 4px;
            color: black;
            padding: 0.2em;
        }

        /* Status Section */
        .status-section {
            padding: 1rem;
            text-align: center;
        }

        /* Footer */
        .footer-line {
            height: 3px;
            background-color: green;
            width: 100%;
            margin: 2rem auto;
        }

        .footer-content {
            text-align: center;
            margin-top: 1rem;
        }

        /* Modal Styles */
        .modal-custom {
            max-width: 95%;
            margin: 1rem auto;
        }

        .modal-image {
            width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        /* Responsive Adjustments */
        @media (min-width: 576px) {
            .header-line {
                margin-top: auto;
                margin-bottom: 3rem;
            }

            .ww {
                font-size: 1.2rem;
            }

            .main-section {
                font-size: 1.1rem;
            }

            .form-title h1 {
                font-size: 1.3rem;
            }
        }

        @media (min-width: 768px) {
            .ww {
                font-size: 1.3rem;
            }

            .main-section {
                font-size: 1.2rem;
            }

            .form-title h1 {
                font-size: 1.4rem;
            }

            .modal-custom {
                max-width: 80%;
            }
        }

        @media (min-width: 992px) {
            .modal-custom {
                max-width: 50%;
            }
        }

        @media (min-width: 1200px) {
            .ww {
                font-size: 1.4rem;
            }

            .main-section {
                font-size: 1.3rem;
            }
        }
    </style>
@endsection

@section('content')
    <div class="card shadow mb-4">
        {{-- breadcrumb part --}}
        <div class="card-header py-3 d-flex flex-column flex-sm-row justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-edit"></i>
                    {{ __('panel.show_company_requests') }}
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <a href="{{ route('admin.index') }}">{{ __('panel.main') }}</a>
                        @if (config('locales.languages')[app()->getLocale()]['rtl_support'] == 'rtl')
                            <i class="fa fa-solid fa-chevron-left chevron"></i>
                        @else
                            <i class="fa fa-solid fa-chevron-right chevron"></i>
                        @endif
                    </li>
                    <li>
                        <a href="{{ route('admin.company_requests.index') }}">
                            {{ __('panel.show_company_requests') }}
                        </a>
                    </li>
                </ul>
            </div>

            <div class="ml-auto mt-3 mt-sm-0">
                <form action="{{ route('admin.company_requests.update_company_requests_status', $company_request->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-row align-items-center">
                        <label class="sr-only" for="inlineFormInputGroupOrderStatus">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">{{ __('panel.company_status') }}</div>
                            </div>
                            <select name="status" style="outline-style:none;" onchange="this.form.submit()"
                                class="form-control">
                                <option value=""> {{ __('panel.course_choose_appropriate_event') }} </option>
                                @foreach ($company_request_status_array as $key => $value)
                                    <option value="{{ $key }}"> {{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="outer">
            <div class="inner">
                <header>
                    <div class="row">
                        <div class="col-12 col-sm-10 offset-sm-1 bg-white">
                            <div class="row align-items-center header-content">
                                <div class="col-12 col-md-4 d-flex flex-column align-items-center justify-content-center">
                                    <h1 class="institute-name-ar">معهد خطوة شباب</h1>
                                    <h3 class="institute-subtitle-ar">للتدريب واللغات</h3>
                                </div>
                                <div class="col-12 col-md-4 d-flex align-items-center justify-content-center">
                                    <img class="logo-img" src="{{ asset('backend/images/logo.jpg') }}" alt="Institute Logo" />
                                </div>
                                <div class="col-12 col-md-4 d-flex flex-column align-items-center justify-content-center">
                                    <h1 class="institute-name-en">Youth Step Institute</h1>
                                    <h3 class="institute-subtitle-en">For Training & Languages</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="header-line">
                        <div class="gold-line"></div>
                        <div class="gray-line"></div>
                    </div>
                </header>

                <div class="section px-3 px-sm-5 pb-3">
                    <div class="main-section">
                        <div class="row">
                            <div class="col-12 col-md-4 p-2 p-sm-4">
                                <span class="ww">تاريخ الطلب :</span>
                                <span>{{ $company_request->created_at->format('Y/m/d') }}</span>
                            </div>
                            <div class="col-12 col-md-4 p-2 text-center">
                                <div class="form-title">
                                    <h1>استمارة طلب تدريب لشركة</h1>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 p-2 p-sm-4 status-section">
                                <span class="ww me-2">حالة الطلب :</span>
                                <span>{{ $company_request->status() }}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 pt-3 pt-sm-5">
                                <span class="ww">إسم مقدم الطلب :</span>
                                <span>{{ $company_request->cp_user_name }}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6 pt-3">
                                <span class="ww">البريد الإلكتروني :</span>
                                <span>{{ $company_request->cp_user_email }}</span>
                            </div>
                            <div class="col-12 col-md-6 pt-3">
                                <span class="ww">رقم الجوال :</span>
                                <span>{{ $company_request->cp_user_phone }}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 pt-3">
                                <hr>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 pt-3">
                                <span class="ww">إسم الشركة :</span>
                                <span>{{ $company_request->cp_company_name }}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6 pt-3">
                                <span class="ww">المسمي الوظيفي :</span>
                                <span>{{ $company_request->cp_job_title }}</span>
                            </div>
                            <div class="col-12 col-md-6 pt-3">
                                <span class="ww">حجم الشركة :</span>
                                <span>{{ $company_request->cp_company_size }} شخص</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6 pt-3">
                                <span class="ww">الدولة :</span>
                                <span>{{ $company_request->country->name }} ({{ $company_request->country->name_native }})</span>
                            </div>
                            <div class="col-12 col-md-6 pt-3">
                                <span class="ww">المدينة :</span>
                                <span>{{ $company_request->cp_company_city }}</span>
                            </div>
                        </div>
                    </div>

                    <footer class="text-center mt-5">
                        <div class="footer-line"></div>
                        <div class="footer-content">
                            <div class="footer-item">
                                <i class="fa fa-phone"></i>
                                <span>
                                    {{ $siteSettings['site_phone']->value ?? '' }} \
                                    {{ $siteSettings['site_mobile']->value ?? '' }}
                                </span>
                            </div>
                        </div>
                    </footer>
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
                        <img src="{{ asset('assets/company_requests/' . $company_request->identity) }}"
                            alt="Identity Image" class="modal-image">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
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
