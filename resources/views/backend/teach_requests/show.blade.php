@extends('layouts.admin')

@section('style')
    <style>
        .outer {
            font-family: "Times New Roman", Times, serif;
            color: black;
            background-color: white;
            padding: 1rem;
        }

        .inner {
            border: 1px solid #777777;
        }

        .header-line {
            display: block;
            position: relative;
            z-index: 2;
        }

        .ww {
            font-weight: bold;
            font-size: 1.1rem;
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
            margin-bottom: 20px;
            background-color: whitesmoke;
        }

        /* Header styles */
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

        /* Main content styles */
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

        /* Image container */
        #image-container {
            width: 100%;
            max-width: 200px;
            height: auto;
            margin: 1rem auto;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #image-container img {
            max-width: 100%;
            height: auto;
            max-height: 181px;
        }

        /* Document fields */
        .document-field {
            margin-bottom: 1rem;
        }

        .document-field img {
            max-width: 50px;
            max-height: 50px;
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

        /* Modal styles */
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

        /* Responsive adjustments */
        @media (min-width: 576px) {
            .header-line {
                margin-top: -40px;
                margin-bottom: 45px;
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

            #image-container {
                margin: 0;
                max-width: 250px;
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
                    {{ __('transf.Course Landing Page') }}
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
                        <a href="{{ route('admin.teach_requests.index') }}">
                            {{ __('panel.show_teach_requests') }}
                        </a>
                    </li>
                </ul>
            </div>

            <div class="ml-auto mt-3 mt-sm-0">
                <form action="{{ route('admin.teach_requests.update_teach_requests_status', $teach_request->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-row align-items-center">
                        <label class="sr-only" for="inlineFormInputGroupOrderStatus">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">{{ __('panel.course_status') }}</div>
                            </div>
                            <select name="teach_request_status" style="outline-style:none;" onchange="this.form.submit()"
                                class="form-control">
                                <option value=""> {{ __('panel.course_choose_appropriate_event') }} </option>
                                @foreach ($teach_request_status_array as $key => $value)
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
                            <div class="col-12 col-md-4">
                                <span class="ww">{{ __('panel.request_date') }}:</span>
                                <span>{{ $teach_request->created_at->format('Y/m/d') }}</span>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-title">
                                    <h1>{{ __('panel.application_form_to_apply_as_a_trainer') }}</h1>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div id="image-container">
                                    @if ($teach_request->user_image && file_exists(public_path('assets/teach_requests/' . $teach_request->user_image)))
                                        <a href="#" data-toggle="modal" data-target="#identityModal">
                                            <img src="{{ asset('assets/teach_requests/' . $teach_request->user_image) }}"
                                                alt="User Image" style="width: 8em;height:8em;">
                                        </a>
                                    @else
                                        <img src="{{ asset('image/not_found/placeholder.jpg') }}" alt="User Image">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <span class="ww">الإسم الكامل (باللغة العربية ) :</span>
                                <span>{{ $teach_request->getTranslation('full_name', 'ar') }}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-end">
                                <bdo dir="ltr">
                                    <span class="ww">Full Name (In English) :</span>
                                    <span>{{ $teach_request->getTranslation('full_name', 'en') }}</span>
                                </bdo>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-4">
                                <span class="ww">{{ __('panel.date_of_birth') }} :</span>
                                <span>{{ optional($teach_request->date_of_birth)->format('Y/m/d') }}</span>
                            </div>
                            <div class="col-12 col-md-4">
                                <span class="ww">{{ __('panel.place_of_birth') }} :</span>
                                <?php $placeOfBirth = Altwaireb\World\Models\Country::where('id', $teach_request->place_of_birth)->first(); ?>
                                <span>{{ app()->getLocale() == 'ar' ? $placeOfBirth->translations['ar'] : $placeOfBirth->name }}</span>
                            </div>
                            <div class="col-12 col-md-4">
                                <span class="ww">{{ __('panel.nationality') }} :</span>
                                <?php $nationality = Altwaireb\World\Models\Country::where('id', $teach_request->nationality)->first(); ?>
                                <span>{{ app()->getLocale() == 'ar' ? $nationality->translations['ar'] : $nationality->name }}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-4">
                                <span class="ww">{{ __('panel.address_of_residence') }} :</span>
                                <?php $residenceAddress = Altwaireb\World\Models\Country::where('id', $teach_request->residence_address)->first(); ?>
                                <span>{{ app()->getLocale() == 'ar' ? $residenceAddress->translations['ar'] : $residenceAddress->name }}</span>
                            </div>
                            <div class="col-12 col-md-4">
                                <span class="ww">{{ __('panel.f_phone_number') }} :</span>
                                <span>{{ $teach_request->phone }}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-4">
                                <span class="ww">{{ __('panel.academic_qualification') }} :</span>
                                <span>{{ $teach_request->educational_qualification() }}</span>
                            </div>
                            <div class="col-12 col-md-4">
                                <span class="ww">{{ __('panel.specialization') }} :</span>
                                <span>{{ $teach_request->specialization->name }}</span>
                            </div>
                            <div class="col-12 col-md-4">
                                <span class="ww">{{ __('panel.years_of_experience') }} :</span>
                                <span>{{ $teach_request->years_of_training_experience }} {{ __('panel.year') }}/{{ __('panel.years') }}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="ww">{{ __('panel.motivation') }} :</div>
                                <div>{!! $teach_request->motivation !!}</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-4 document-field">
                                <span class="ww">{{ __('panel.personal_identity_photo') }} :</span>
                                <span>
                                    @if ($teach_request->identity)
                                        @php
                                            $identityExtension = strtolower(pathinfo($teach_request->identity, PATHINFO_EXTENSION));
                                            $imageExtensions = ['jpg', 'jpeg', 'png'];
                                        @endphp
                                        @if (in_array($identityExtension, $imageExtensions))
                                            <a href="#" data-toggle="modal" data-target="#identityModal2">
                                                <img src="{{ asset('assets/teach_requests/' . $teach_request->identity) }}"
                                                    class="img-fluid" alt="Identity Image">
                                            </a>
                                        @else
                                            <a href="{{ route('frontend.customer.teach_requests.view_file', pathinfo($teach_request->identity, PATHINFO_FILENAME)) }}"
                                                target="_blank">
                                                {{ pathinfo($teach_request->identity, PATHINFO_FILENAME) }}
                                            </a>
                                        @endif
                                    @else
                                        <p>No identity file available.</p>
                                    @endif
                                </span>
                            </div>

                            <div class="col-12 col-md-4 document-field">
                                <span class="ww">{{ __('panel.the_biography') }} :</span>
                                <span>
                                    @if ($teach_request->biography && file_exists(public_path('assets/teach_requests/' . $teach_request->biography)))
                                        @php
                                            $biographyExtension = strtolower(pathinfo($teach_request->biography, PATHINFO_EXTENSION));
                                        @endphp
                                        @if (in_array($biographyExtension, $imageExtensions))
                                            <a href="{{ asset('assets/teach_requests/' . $teach_request->biography) }}"
                                                data-fancybox data-width="1400" data-height="900">
                                                <img src="{{ asset('assets/teach_requests/' . $teach_request->biography) }}"
                                                    class="img-fluid" alt="biography Image">
                                            </a>
                                        @else
                                            <a href="{{ route('admin.view_file', pathinfo($teach_request->biography, PATHINFO_FILENAME)) }}"
                                                target="_blank">
                                                {{ pathinfo($teach_request->biography, PATHINFO_FILENAME) }}
                                            </a>
                                        @endif
                                    @else
                                        <p>No biography found.</p>
                                    @endif
                                </span>
                            </div>

                            <div class="col-12 col-md-4 document-field">
                                <span class="ww">{{ __('panel.certificates') }} :</span>
                                <span>
                                    @if ($teach_request->Certificates && file_exists(public_path('assets/teach_requests/' . $teach_request->Certificates)))
                                        @php
                                            $certificatesExtension = strtolower(pathinfo($teach_request->Certificates, PATHINFO_EXTENSION));
                                        @endphp
                                        @if (in_array($certificatesExtension, $imageExtensions))
                                            <a href="{{ asset('assets/teach_requests/' . $teach_request->Certificates) }}"
                                                data-fancybox data-width="1400" data-height="900">
                                                <img src="{{ asset('assets/teach_requests/' . $teach_request->Certificates) }}"
                                                    class="img-fluid" alt="Certificates Image">
                                            </a>
                                        @else
                                            <a href="{{ route('admin.view_file', pathinfo($teach_request->Certificates, PATHINFO_FILENAME)) }}"
                                                target="_blank">
                                                {{ pathinfo($teach_request->Certificates, PATHINFO_FILENAME) }}
                                            </a>
                                        @endif
                                    @else
                                        <p>No certificates found.</p>
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="row mt-4 mb-2">
                            <div class="col-12">
                                <p>{{ __('panel.note:_your_request_will_be_reviewed_and_responded_to_within_three_days_from_todays_date') }}</p>
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
                        <img src="{{ asset('assets/teach_requests/' . $teach_request->user_image) }}" alt="Identity Image"
                            class="modal-image">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Identity image -->
        <div class="modal fade" id="identityModal2" tabindex="-1" role="dialog" aria-labelledby="identityModalLabel"
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
                        <img src="{{ asset('assets/teach_requests/' . $teach_request->identity) }}" alt="Identity Image"
                            class="modal-image">
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
