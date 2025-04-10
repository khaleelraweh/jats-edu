@extends('layouts.admin')

@section('style')
    <style>
        .outer {
            font-family: Times New Roman, sans-serif;
            color: black;
        }

        .header-line {
            display: block;
        }

        .ww {
            font-weight: bold;
            font-size: 21px;
        }

        .gold-line,
        .gray-line {
            height: 4px;
        }

        .gold-line {
            background-color: gold;
            width: 99%;
            margin: auto;
            margin-bottom: 3px;
        }

        .gray-line {
            margin-bottom: 20px;
            background-color: whitesmoke;
        }

        #image-container {
            /* border: 1px solid gray; */
            margin-right: 100px;
            margin-left: 100px;
            width: 50%;
            height: 181px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }
    </style>

    <!-- Custom CSS -->
    <style>
        .modal-custom {
            max-width: 100%;
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
    </style>
@endsection

@section('content')
    {{-- first section --}}
    <div class="card shadow mb-4">

        {{-- breadcrumb part  --}}
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
                <form action="{{ route('admin.teach_requests.update_teach_requests_status', $teach_request->id) }}"
                    method="post">
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


        <div class="outer bg-white p-4">
            <div class="inner" style="border: 1px solid #777777">
                <header>
                    <div class="row">
                        <div class="col-sm-10 offset-1 bg-white">
                            <div class="row">
                                <div class="col-sm-4 d-flex flex-column align-items-center justify-content-center">
                                    <h1 class="text-success m-0" style="
        font-family: Times New Roman, sans-serif;">
                                        معهد خطوة شباب</h1>
                                    <h3 class="text-warning" style="
        font-family: Times New Roman, sans-serif;">
                                        للتدريب واللغات</h3>
                                </div>
                                <div class="col-sm-4 d-flex align-items-center justify-content-center">
                                    <img style="width: 250px; padding-top: 10px; z-index: 4"
                                        src="{{ asset('backend/images/logo.jpg') }}" alt="" />
                                </div>
                                <div class="col-sm-4 d-flex flex-column align-items-center justify-content-center">
                                    <h1 class="text-success m-0" style="
        font-family: Times New Roman, sans-serif; font-size:1.43em; font-weight:800">
                                        Youth Step Institute</h1>
                                    <h3 class="text-warning" style=" font-family: Times New Roman, sans-serif;font-size:1em;font-weight:700;margin-top:0.25em">For Training
                                        &
                                        Languages
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="header-line"
                        style="
                      position: relative;
                      margin-top: -40px;
                      margin-bottom: 45px;
                      z-index: 2;
                    ">
                        <div class="gold-line"></div>
                        <div class="gray-line"></div>
                    </div>
                </header>

                <div class="section px-5 pb-3">
                    <div class="row" style="border: 6px double green; font-size: 19px">
                        <div class="col-sm-12 bg-white p-3">
                            <div class="row">
                                <div class="col-4" style="margin-top: 50px;">
                                    <span><span class="ww">{{ __('panel.request_date') }}:</span>
                                        {{ $teach_request->created_at->format('Y/m/d') }}
                                    </span>
                                </div>
                                <div class="col-4"
                                    style="
                            border: 4px solid green;
                            padding: 0.375em;
                            margin-top: 20px;
                            display: inline-block;
                            justify-content: center;
                            text-align: center;
                            height: 50%;

                          ">
                                    <h1
                                        style="
                              margin: 0;
                              font-size: 1.4em;
                              border: 1px solid green;
                              border-radius: 4px;
                              color:black;
                              padding:0.2em;
                            ">
                                        {{ __('panel.application_form_to_apply_as_a_trainer') }}
                                    </h1>
                                </div>
                                <div class="col-4">
                                    <input type="file" id="file-input"
                                        style="display: none;


                              " />
                                    <div id="image-container" class="col-4">

                                        @if ($teach_request->user_image && file_exists(public_path('assets/teach_requests/' . $teach_request->user_image)))
                                            <a href="#" data-toggle="modal" data-target="#identityModal">
                                                <img src="{{ asset('assets/teach_requests/' . $teach_request->user_image) }}"
                                                    alt="Identity Image" style="width: 100%; height: 181px;">
                                            </a>
                                        @else
                                            <img src="{{ asset('image/not_found/placeholder.jpg') }}" alt="Identity Image"
                                                style="width: 100%; height: 181px;">
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 pt-3">
                                        <span class="arabic-name ww">
                                            الإسم الكامل (باللغة العربية ) :
                                        </span>
                                        <span
                                            class="arabic-name-value">{{ $teach_request->getTranslation('full_name', 'ar') }}</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 pt-3 text-end">
                                        <bdo dir="ltr">
                                            <span class="english-name ww">
                                                Full Name (In English) :
                                            </span>
                                            <span
                                                class="english-name-value">{{ $teach_request->getTranslation('full_name', 'en') }}
                                            </span>
                                        </bdo>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 pt-3 col-md-4">
                                        <span class="date-of-birth ww"> {{ __('panel.date_of_birth') }} : </span>
                                        <span class="date-of-birth-value">
                                            {{ optional($teach_request->date_of_birth)->format('Y/m/d') }}
                                        </span>
                                    </div>
                                    <div class="col-sm-12 pt-3 col-md-4">
                                        <span class="place-of-birth ww"> {{ __('panel.place_of_birth') }} : </span>
                                        {{-- <span class="place-of-birth-value">{{ $teach_request->place_of_birth }}</span> --}}
                                        <?php $placeOfBirth = Altwaireb\World\Models\Country::where('id', $teach_request->place_of_birth)->first(); ?>
                                        <span class="place-of-birth-value">
                                            {{ app()->getLocale() == 'ar' ? $placeOfBirth->translations['ar'] : $placeOfBirth->name }}
                                        </span>
                                    </div>

                                    <div class="col-sm-12 pt-3 col-md-4">
                                        <span class="nationality ww">{{ __('panel.nationality') }} : </span>
                                        {{-- <span class="nationality-value">{{ $teach_request->nationality }}</span> --}}
                                        <?php $nationality = Altwaireb\World\Models\Country::where('id', $teach_request->nationality)->first(); ?>
                                        <span class="nationality-value">
                                            {{ app()->getLocale() == 'ar' ? $nationality->translations['ar'] : $nationality->name }}
                                        </span>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-sm-12 pt-3 col-md-4">
                                        <span class="residence-address ww"> {{ __('panel.address_of_residence') }} :
                                        </span>
                                        {{-- <span class="residence-address-value">
                                                {{ $teach_request->residence_address }}
                                            </span> --}}
                                        <?php $residenceAddress = Altwaireb\World\Models\Country::where('id', $teach_request->residence_address)->first(); ?>
                                        <span class="residence-address-value">
                                            {{ app()->getLocale() == 'ar' ? $residenceAddress->translations['ar'] : $residenceAddress->name }}
                                        </span>
                                    </div>

                                    <div class="col-sm-12 pt-3 col-md-4">
                                        <span class="phone ww">{{ __('panel.f_phone_number') }} :</span>
                                        <span class="phone-value"> {{ $teach_request->phone }} </span>
                                    </div>
                                    <div class="col-sm-12 col-md-4"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 pt-3 col-md-4">
                                        <span class="educational_qualification ww">
                                            {{ __('panel.academic_qualification') }} :
                                        </span>
                                        <span
                                            class="educational-qualification-value">{{ $teach_request->educational_qualification() }}</span>
                                    </div>
                                    <div class="col-sm-12 pt-3 col-md-4">
                                        <span class="specialization ww ">{{ __('panel.specialization') }} : </span>
                                        <span class="specialization-value"> {{ $teach_request->specialization->name }}
                                        </span>
                                    </div>
                                    <div class="col-sm-12 pt-3 col-md-4">
                                        <span class="years_of_training_experience ww">
                                            {{ __('panel.years_of_experience') }} :
                                        </span>
                                        <span class="years_of_training_experience-value">
                                            {{ $teach_request->years_of_training_experience }}
                                            {{ __('panel.year') }}
                                            /
                                            {{ __('panel.years') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 pt-3">
                                        <div class="motivation ww">
                                            {{ __('panel.motivation') }} :
                                        </div>
                                        <div class="motivation-value">
                                            {!! $teach_request->motivation !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Identity Image or File -->
                                    <div class="col-sm-12 pt-3 col-md-4">
                                        <span class="identity ww"> {{ __('panel.personal_identity_photo') }} :</span>
                                        <span class="identity-value">
                                            @if ($teach_request->identity)
                                                @php
                                                    $identityExtension = strtolower(
                                                        pathinfo($teach_request->identity, PATHINFO_EXTENSION),
                                                    );
                                                    $imageExtensions = ['jpg', 'jpeg', 'png'];
                                                @endphp
                                                @if (in_array($identityExtension, $imageExtensions))
                                                    <!-- Display as an image -->
                                                    <a href="#" data-toggle="modal" data-target="#identityModal2">
                                                        <img src="{{ asset('assets/teach_requests/' . $teach_request->identity) }}"
                                                            class="img-fluid" alt="Identity Image"
                                                            style="width: 50px; height: 50px;">
                                                    </a>

                                                @else
                                                    <!-- Display as a link (for PDF or Word) -->
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

                                    <!-- Biography PDF/Word or Image -->
                                    <div class="col-sm-12 pt-3 col-md-4">
                                        <span class="biography ww"> {{ __('panel.the_biography') }} :</span>
                                        <span class="biography-value">


                                            {{-- @if ($teach_request->biography && file_exists(public_path('assets/teach_requests/' . $teach_request->biography)))
                                                @php
                                                    $biographyExtension = strtolower(
                                                        pathinfo($teach_request->biography, PATHINFO_EXTENSION),
                                                    );
                                                @endphp
                                                @if (in_array($biographyExtension, $imageExtensions))
                                                    <!-- Display as an image -->
                                                    <a href="{{ asset('assets/teach_requests/' . $teach_request->biography) }}"
                                                        data-fancybox data-width="1400" data-height="900">
                                                        <img src="{{ asset('assets/teach_requests/' . $teach_request->biography) }}"
                                                            class="img-fluid" alt="Biography Image"
                                                            style="width: 50px; height: 50px;">
                                                    </a>
                                                @else
                                                    <!-- Display as a link (for PDF or Word) -->
                                                    <a href="{{ route('frontend.customer.teach_requests.view_file', pathinfo($teach_request->biography, PATHINFO_FILENAME)) }}"
                                                        target="_blank">
                                                        {{ pathinfo($teach_request->biography, PATHINFO_FILENAME) }}
                                                    </a>
                                                @endif
                                            @else
                                                <p>No biography found.</p>
                                            @endif --}}

                                            @if ($teach_request->biography && file_exists(public_path('assets/teach_requests/' . $teach_request->biography)))
                                            @php
                                                $biographyExtension = strtolower(
                                                    pathinfo($teach_request->biography, PATHINFO_EXTENSION),
                                                );
                                            @endphp
                                            @if (in_array($biographyExtension, $imageExtensions))
                                                <!-- Display as an image -->
                                                <a href="{{ asset('assets/teach_requests/' . $teach_request->biography) }}"
                                                    data-fancybox data-width="1400" data-height="900">
                                                    <img src="{{ asset('assets/teach_requests/' . $teach_request->biography) }}"
                                                        class="img-fluid" alt="biography Image"
                                                        style="width: 50px; height: 50px;">
                                                </a>
                                            @else
                                                <!-- Display as a link (for PDF or Word) -->
                                                <a href="{{ route('admin.view_file', pathinfo($teach_request->biography, PATHINFO_FILENAME)) }}"
                                                    target="_blank">
                                                    {{ pathinfo($teach_request->biography, PATHINFO_FILENAME) }}
                                                </a>
                                            @endif
                                        @else
                                            <p>No biography found. </p>
                                        @endif
                                        </span>
                                    </div>

                                    <!-- Certificates PDF/Word or Image -->
                                    <div class="col-sm-12 pt-3 col-md-4">
                                        <span class="Certificates ww"> {{ __('panel.certificates') }} :</span>
                                        <span class="Certificates-value">
                                            @if ($teach_request->Certificates && file_exists(public_path('assets/teach_requests/' . $teach_request->Certificates)))
                                                @php
                                                    $certificatesExtension = strtolower(
                                                        pathinfo($teach_request->Certificates, PATHINFO_EXTENSION),
                                                    );
                                                @endphp
                                                @if (in_array($certificatesExtension, $imageExtensions))
                                                    <!-- Display as an image -->
                                                    <a href="{{ asset('assets/teach_requests/' . $teach_request->Certificates) }}"
                                                        data-fancybox data-width="1400" data-height="900">
                                                        <img src="{{ asset('assets/teach_requests/' . $teach_request->Certificates) }}"
                                                            class="img-fluid" alt="Certificates Image"
                                                            style="width: 50px; height: 50px;">
                                                    </a>
                                                @else
                                                    <!-- Display as a link (for PDF or Word) -->
                                                    <a href="{{ route('admin.view_file', pathinfo($teach_request->Certificates, PATHINFO_FILENAME)) }}"
                                                        target="_blank">
                                                        {{ pathinfo($teach_request->Certificates, PATHINFO_FILENAME) }}
                                                    </a>
                                                @endif
                                            @else
                                                <p>No certificates found. </p>
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 60px; margin-bottom: -10px;">
                                    <div class="col-sm-12 pt-3">
                                        <p>
                                            {{ __('panel.note:_your_request_will_be_reviewed_and_responded_to_within_three_days_from_today’s_date') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <footer class="d-flex justify-content-center" style="text-align: center;margin-top: 50px;">
                        <div class="footer-line"
                            style="
            height: 3px;
          background-color: green;
          margin-bottom: 20px;
          margin-left: 20px;
          margin-right: 20px;
          margin-top: auto;
       width: 75.5%;
          position: absolute

                    ">
                        </div>
                        <div class="footer-content" style="margin-top: 10px;">
                            {{-- <div class="footer-item">
                                <i class="fa fa-home"></i>
                                <span>محافظة عدن-المنصورة-شارع القصر-فوق انيس فون</span>
                            </div> --}}
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
                            class="img-fluid modal-image">
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
                            class="img-fluid modal-image">
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
