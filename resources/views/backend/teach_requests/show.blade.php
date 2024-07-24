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
                            {{ __('panel.show_courses') }}
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
                                    <h2 class="text-warning" style="
        font-family: Times New Roman, sans-serif;">
                                        للتدريب واللغات</h2>
                                </div>
                                <div class="col-sm-4 d-flex align-items-center justify-content-center">
                                    <img style="width: 250px; padding-top: 10px; z-index: 4"
                                        src="{{ asset('backend/images/logo.jpg') }}" alt="" />
                                </div>
                                <div class="col-sm-4 d-flex flex-column align-items-center justify-content-center">
                                    <h1 class="text-success m-0" style="
        font-family: Times New Roman, sans-serif;">
                                        Youth Step Institute</h1>
                                    <h2 class="text-warning" style=" font-family: Times New Roman, sans-serif;">For Training
                                        Languages
                                    </h2>
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
                                    <span><span class="ww">تاريخ الطلب :</span>
                                        {{ $teach_request->created_at->format('Y/m/d') }}
                                    </span>
                                </div>
                                <div class="col-4"
                                    style="
                            border: 4px solid green;
                            padding: 5px;
                            margin-top: 20px;
                            display: inline-block;
                            justify-content: center;
                            text-align: center;
                            height: 50%;
                         
                          ">
                                    <h1
                                        style="
                              margin: 0;
                              font-size: 30px;
                              border: 1px solid green;
                              border-radius: 4px;
                              color:black;
                            ">
                                        استمارة طلب تقديم كمدرب /ة
                                    </h1>
                                </div>
                                <div class="col-4">
                                    <input type="file" id="file-input"
                                        style="display: none;
        
                              
                              " />
                                    <div id="image-container" class="col-4"
                                        style="
          border: 1px solid gray;
          margin-right: 100px;
          width: 50%;
          height: 181px;
          display: flex;
          justify-content: center;
          align-items: center;
          cursor: pointer;
      ">

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
                                        <span class="date-of-birth ww">تاريخ الميلاد : </span>
                                        <span class="date-of-birth-value">
                                            {{ optional($teach_request->date_of_birth)->format('Y/m/d') }}
                                        </span>
                                    </div>
                                    <div class="col-sm-12 pt-3 col-md-4">
                                        <span class="place-of-birth ww">محل الميلاد : </span>
                                        <span class="place-of-birth-value">{{ $teach_request->place_of_birth }}</span>
                                    </div>
                                    <div class="col-sm-12 pt-3 col-md-4">
                                        <span class="nationality ww">الجنسية : </span>
                                        <span class="nationality-value">{{ $teach_request->nationality }}</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 pt-3 col-md-4">
                                        <span class="residence-address ww">عنوان الإقامة \ السكن :
                                        </span>
                                        <span
                                            class="residence-address-value">{{ $teach_request->residence_address }}</span>
                                    </div>

                                    <div class="col-sm-12 pt-3 col-md-4">
                                        <span class="phone ww"> رقم الجوال :</span>
                                        <span class="phone-value"> {{ $teach_request->phone }} </span>
                                    </div>
                                    <div class="col-sm-12 col-md-4"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 pt-3 col-md-4">
                                        <span class="educational_qualification ww">
                                            المؤهل الدراسي :
                                        </span>
                                        <span
                                            class="educational-qualification-value">{{ $teach_request->educational_qualification }}</span>
                                    </div>
                                    <div class="col-sm-12 pt-3 col-md-4">
                                        <span class="specialization ww ">التخصص : </span>
                                        <span class="specialization-value"> {{ $teach_request->specialization }} </span>
                                    </div>
                                    <div class="col-sm-12 pt-3 col-md-4">
                                        <span class="years_of_training_experience ww">
                                            سنوات خبرة التدريب :
                                        </span>
                                        <span class="years_of_training_experience-value">
                                            {{ $teach_request->years_of_training_experience }} </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 pt-3">
                                        <div class="motivation ww">
                                            لماذا تريد الإلتحاق بالتدريب لدينا :
                                        </div>
                                        <div class="motivation-value">
                                            {!! $teach_request->motivation !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 pt-3 col-md-4">
                                        <span class="identity ww">
                                            صورة من الهوية / جواز السفر :
                                        </span>
                                        <span class="identity-value">
                                            @if ($teach_request->identity)
                                                <a href="#" data-toggle="modal" data-target="#identityModal">
                                                    <img src="{{ asset('assets/teach_requests/' . $teach_request->identity) }}"
                                                        alt="Identity Image" style="width: 50px; height: 50px;">
                                                </a>
                                            @else
                                                <p>No identity image available.</p>
                                            @endif
                                        </span>

                                    </div>
                                    <div class="col-sm-12 pt-3 col-md-4">
                                        <span class="biography ww"> إرفاق السيرة الذاتية : </span>
                                        <span class="biography-value"><a href="#">biography-link</a></span>
                                    </div>
                                    <div class="col-sm-12 pt-3 col-md-4">
                                        <span class="Certificates ww"> إرفاق الشهادات : </span>
                                        <span class="Certificates-value"><a href="#">Certificates-link</a></span>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 60px; margin-bottom: -10px;">
                                    <div class="col-sm-12 pt-3">
                                        <p>
                                            ملاحظة : سيتم اعتماد البيانات أعلاه عند الارسال ، لذا نرجو
                                            القيام ادخال كافة البيانات المطلوبة بشكل صحيح و دقيق و
                                            مراجعة البيانات قبل ارسالها الينا.
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
                            <div class="footer-item">
                                <i class="fa fa-home"></i>
                                <span>محافظة عدن-المنصورة-شارع القصر-فوق انيس فون</span>
                            </div>
                            <div class="footer-item">
                                <i class="fa fa-phone"></i>
                                <span> 02-350347 \ 734208108</span>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>



        {{-- <div class="col-xs-12 col-sm-4">
                @php
                    if ($teach_request->photos->first() != null && $teach_request->photos->first()->file_name != null) {
                        $teach_request_image = asset('assets/courses/' . $teach_request->photos->first()->file_name);

                        if (!file_exists(public_path('assets/courses/' . $teach_request->photos->first()->file_name))) {
                            $teach_request_image = asset('image/not_found/item_image_not_found.webp');
                        }
                    } else {
                        $teach_request_image = asset('image/not_found/item_image_not_found.webp');
                    }
                @endphp
                <img src="{{ $teach_request_image }}" style="display: block;width:100%;height:200px;"
                    alt="{{ $teach_request->title }}">
            </div> --}}


        <!-- Modal -->
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
