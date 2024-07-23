@extends('layouts.admin')

@section('style')
    <style>
        .header-line {
            display: block;
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

            <div class="inner" style="border: 1px solid #777777 ;">
                <header>
                    <div class="row">
                        <div class="col-sm-10 offset-1 bg-white">
                            <div class="row">
                                <div class="col-sm-4 d-flex flex-column align-items-center justify-content-center">
                                    <h1 class="text-success m-0">معهد خطوة شباب</h1>
                                    <h2 class="text-warning">للتدريب واللغات</h2>
                                </div>
                                <div class="col-sm-4 d-flex  align-items-center justify-content-center">
                                    <img style="width: 250px;padding-top: 10px;z-index: 4;"
                                        src="{{ asset('backend/images/logo.jpg') }}" alt="">
                                </div>
                                <div class="col-sm-4 d-flex flex-column align-items-center justify-content-center">
                                    <h1 class="text-success m-0"> Youth Step Institute </h1>
                                    <h2 class="text-warning"> For Training Languages </h2>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="header-line" style="position: relative; margin-top: -40px;margin-bottom: 45px; z-index: 2;">
                        <div class="gold-line"></div>
                        <div class="gray-line"></div>
                    </div>


                </header>

                <div class="section  px-5 pb-3">
                    <div class="row" style="border: 6px double green;">
                        <div class="col-sm-12 bg-white p-3">
                            <div class="row">
                                <div class="col-4 ">
                                    <span>تاريخ الطلب : 5/5/2024</span>
                                </div>
                                <div class="col-4">
                                    <h1>استمارة طلب تقديم كمدرب /ة</h1>
                                </div>
                                <div class="col-4">
                                    <img class="face-identity" src="" alt="Image Preview" />
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-sm-12 pt-3  ">

                                    <span class="arabic-name"> الإسم الكامل (باللغة العربية ) : </span>
                                    <span class="arabic-name-value">وليد</span>


                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 pt-3 text-end">
                                    <bdo dir="ltr">
                                        <span class="english-name"> Full Name (In English) : </span>
                                        <span class="english-name-value">waled blua blau </span>
                                    </bdo>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 pt-3 col-md-4">
                                    <span class="date-of-birth">تاريخ الميلاد : </span>
                                    <span class="date-of-birth-value"> 2000/2/2</span>
                                </div>
                                <div class="col-sm-12 pt-3 col-md-4">
                                    <span class="place-of-birth">محل الميلاد : </span>
                                    <span class="place-of-birth-value">Ibb</span>
                                </div>
                                <div class="col-sm-12 pt-3 col-md-4">
                                    <span class="nationality">الجنسية</span>
                                    <span class="nationality-value">يمني</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 pt-3 col-md-4">
                                    <span class="residence-address">عنوان الإقامة \ السكن : </span>
                                    <span class="residence-address-value">دار القدسي</span>
                                </div>

                                <div class="col-sm-12 pt-3 col-md-4">
                                    <span class="phone"> رقم الجوال :</span>
                                    <span class="phone-value"> 772036131 </span>
                                </div>
                                <div class="col-sm-12 col-md-4"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 pt-3 col-md-4">
                                    <span class="educational_qualification"> المؤهل الدراسي : </span>
                                    <span class="educational-qualification-value">بكلوريوس</span>
                                </div>
                                <div class="col-sm-12 pt-3 col-md-4">
                                    <span class="specialization">التخصص : </span>
                                    <span class="specialization-value"> علوم حاسوب </span>
                                </div>
                                <div class="col-sm-12 pt-3 col-md-4">
                                    <span class="years_of_training_experience"> سنوات خبرة التدريب : </span>
                                    <span class="years_of_training_experience-value"> 4 </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 pt-3">
                                    <div class="motivation">لماذا تريد الإلتحاق بالتدريب لدينا : </div>
                                    <div class="motivation-value">
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                        Officiis, et aliquam perferendis quasi vitae eius nobis fugit enim excepturi
                                        sint,
                                        voluptate asperiores consequatur error deleniti fuga corrupti. Quidem, veniam
                                        aperiam?
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 pt-3 col-md-4">
                                    <span class="identity"> صورة من الهوية / جواز السفر : </span>
                                    <span class="identity-value"> <a href="#">identity-link</a> </span>
                                </div>
                                <div class="col-sm-12 pt-3 col-md-4">
                                    <span class="biography"> إرفاق السيرة الذاتية : </span>
                                    <span class="biography-value"><a href="#">biography-link</a></span>
                                </div>
                                <div class="col-sm-12 pt-3 col-md-4">
                                    <span class="Certificates"> إرفاق الشهادات : </span>
                                    <span class="Certificates-value"><a href="#">Certificates-link</a></span>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-12 pt-3">
                                    <p>
                                        ملاحظة : سيتم اعتماد البيانات أعلاه عند الارسال ،
                                        لذا نرجو القيام
                                        ادخال كافة البيانات المطلوبة بشكل صحيح و دقيق
                                        و مراجعة البيانات قبل ارسالها الينا.
                                    </p>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>

                <footer class="d-flex justify-content-center">
                    <div class="footer-line"></div>
                    <div class="footer-content">
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


    </div>
@endsection
