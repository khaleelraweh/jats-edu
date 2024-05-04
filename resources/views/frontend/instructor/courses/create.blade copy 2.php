@extends('layouts.app-instructor')

@section('style')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <style>
        /* CSS Document */
        div.joincontent {
            position: relative;
            width: 65%;
            min-height: 85vh;
            height: auto;
            margin-top: 2%;
            margin-left: auto;
            margin-right: auto;
            background-color: #fcfcfc;
            border-radius: 20px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 15px 0 rgba(0, 0, 0, 0.12);

        }

        div.progresscont {
            width: 98%;
            padding-top: 5.5%;
            margin-left: auto;
            margin-right: auto;

            height: 7rem;

        }

        div.joincontent h5 {
            font-family: 'Noto Serif JP', sans-serif;
            color: #34393f;
        }

        div.circulo {
            width: 5em;
            height: 5em;
            border: 2px solid #45597a;
            background-color: #fcfcfc;
            border-radius: 2.5em;
            padding-top: 30%;
            cursor: pointer;
        }

        .activecirculo {
            transition: .5s ease all;
            background-color: #45597a !important;
        }

        .activecirculo i {
            color: #fcfcfc !important;
        }

        div.circulo i {
            font-size: 1.75rem;
            color: #45597a;
        }

        div.circleblocks {
            width: 100%;
            position: absolute;
            top: 0;
            margin-top: 3.5%;
        }

        .progress-bar {
            background-color: #45597a !important;
        }

        .wizard-navigation {
            position: relative;
            bottom: 0;
            width: 98%;
            margin-left: auto;
            margin-right: auto;
            padding-bottom: 2.5%;
        }

        .wizard-navigation button {
            border-radius: 2rem;
            width: 10rem;
        }

        #submitForm {
            width: 15rem;
        }

        div.registration-content {
            width: 95%;
            min-height: 51vh;
            margin-left: auto;
            margin-right: auto;
            position: relative;
            margin-top: 5%;
            padding-top: 2.5%;
        }

        div.registration-content>div {
            width: 100%;
            min-height: inherit;

        }

        div.registration-content input {
            border-radius: 2rem;
        }

        #addrescont,
        #verifycont,
        #aboutcont {
            display: none;
        }

        #aboutcont {}

        #addrescont {}

        #verifycont {}

        #submitForm {
            display: none;
        }

        .btn-file {
            position: relative;
            overflow: hidden;
            background-color: #c5ccd8 !important;
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }

        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }

        #id-cont,
        #proof-cont {
            width: 100%;
            height: 18em;
            padding: 2.5%;
        }

        .uploadid {
            border: 1px solid #c9ced6;
            height: 40vh;
            position: relative;
        }

        .uploadid .form-group {
            height: inherit !important;
        }

        /*Extra small devices (portrait phones, less than 576px)*/
        @media (max-width: 575.98px) {
            div.joincontent {
                width: 98%;
                height: 155vh;

            }

            div.registration-content {
                padding-top: 17.5%;
            }
        }

        /* Medium devices (tablets, less than 992px)*/
        @media (max-width: 991.98px) {}

        /*Large devices (desktops, less than 1200px)*/
        @media (max-width: 1350px) {

            #id-cont,
            #proof-cont {
                height: 15em;

            }
        }

        /*Large devices (desktops, less than 1200px)*/
        @media (max-width: 1750px) {
            div.joincontent {

                height: 94vh;


            }
        }
    </style>
@endsection

@section('content')
    <div class="joincontent">
        <h5 class="text-center">{{ __('transf.course_generators') }}</h5>
        <div class="progresscont">

            <div class="progress" style="height: 5px;">
                <div id="progresswizard" class="progress-bar" role="progressbar" style="width: 15%;" aria-valuemin="0"
                    aria-valuemax="100"></div>
            </div>
            <div class="circleblocks">
                <div class="d-flex justify-content-around mb-3">
                    <div class="p-2">
                        <div class="aboutblock">
                            <div class="circulo activecirculo text-center"><i class="fas fa-user"></i></div>
                            <div class="title text-center">{{ __('transf.course_title') }}</div>
                        </div>
                    </div>
                    <div class="p-2 ">
                        <div class="addressblock">
                            <div class="circulo text-center"><i class="fas fa-location-arrow"></i></div>
                            <div class="title text-center">{{ __('transf.course_category_title') }}</div>
                        </div>
                    </div>
                    <div class="p-2 ">
                        <div class="verifyblock">
                            <div class="circulo text-center"><i class="far fa-id-card"></i></div>
                            <div class="title text-center">{{ __('transf.confirmation') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="registerUser" method="POST">
                <input type="hidden" name="_token" value="iJquRbgH4Np4OcWzjk8Bd03CaexHzse7gz2vHrml">

                <div class="registration-content">
                    <div id="aboutcont" data-progress="15%">
                        <h2 class="text-center">{{ __('transf.how_about_working_title') }} </h2>
                        <p class="text-center h6">
                            {{ __('transf.its_ok_if_you_cant_think_of_a_good_title_now_you_can_change_it_later') }}</p>
                        @foreach (config('locales.languages') as $key => $val)
                            <div class="row pt-4">
                                <div class="col-12">
                                    <div class="form-group">

                                        <label for="title[{{ $key }}]">{{ __('transf.course_title') }}
                                            {{ __('transf.in_language') }} {{ __('transf.' . $key) }}
                                            <span style="color: #cc1818;">*</span>
                                        </label>

                                        <input type="text" class="form-control form-control-lg"
                                            name="title[{{ $key }}]" id="title[{{ $key }}]"
                                            value="{{ old('title.' . $key) }}" required
                                            placeholder="{{ __('transf.ex_learn_photoshop_cs6_from_scratch_' . $key) }}">
                                        @error('title.' . $key)
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>

                                </div>

                            </div>
                        @endforeach



                    </div>
                    <div id="addrescont" data-progress="50%">

                        <h2 class="text-center">{{ __('transf.what_category_best_fits_the_knowledge_you_will_shire') }}
                        </h2>
                        <p class="text-center h6">
                            {{ __('transf.if_you_are_not_sure_about_the_right_category,you_can_change_it_later') }}</p>

                        <div class="row pt-4">
                            <div class="col-12 ">
                                <label for="category_id">{{ __('transf.course_category_title') }}</label>
                                <select name="course_category_id" class="form-control" id="course_category_id" required>
                                    <option value="">{{ __('transf.choose_a_category') }} __</option>
                                    @forelse ($course_categories as $course_category)
                                        <option value="{{ $course_category->id }}"
                                            {{ old('course_category_id') == $course_category->id ? 'selected' : null }}>
                                            {{ $course_category->title }}
                                        </option>

                                    @empty
                                    @endforelse
                                </select>
                                @error('course_category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>



                    </div>
                    <div id="verifycont" data-progress="85%">
                        <h6 class="text-center">
                            {{ __('transf.confirmation_message') }}
                        </h6>


                    </div>
                </div>

                <div class="d-flex justify-content-between mb-3 wizard-navigation ">
                    <div class="p-2"><button id="prevbtn" type="button"
                            class="btn btn-outline-dark btn-lg">{{ __('transf.previous') }}</button></div>

                    <div class="p-2"><button id="nextbtn" type="button"
                            class="btn btn-primary btn-lg text-center">{{ __('transf.next') }}</button>
                        <button id="submitForm" name="submitForm" style="" type="submit"
                            class="btn btn-primary btn-lg ">{{ __('transf.create_course') }}</button>
                    </div>
                </div>
            </form>


        </div>

    </div>
@endsection

@section('script')
    <script>
        // JavaScript Document
        (function() {

            var wizard = {
                formstate: 0,
                emptyInputs: 0,
                inactiveSections: [1, 2],
                setInactiveSections: function() {
                    if (this.formstate === 0) {
                        this.inactiveSections = [1, 2];
                    } else if (this.formstate === 1) {
                        this.inactiveSections = [0, 2];
                    } else {
                        this.inactiveSections = [0, 1];
                    }
                },
                setInactiveCircles: function() {
                    if (this.formstate === 0) {
                        var inactiveCirclea = document.querySelector(this.circlesections[this.inactiveSections[
                            0]]);
                        var inactiveCircleb = document.querySelector(this.circlesections[this.inactiveSections[
                            1]]);
                        inactiveCirclea.classList.remove("activecirculo");
                        inactiveCircleb.classList.remove("activecirculo");
                    } else if (this.formstate === 1) {
                        var inactiveCircles = document.querySelector(this.circlesections[this.inactiveSections[
                            1]]);
                        inactiveCircles.classList.remove("activecirculo");

                    }

                },
                formsections: ['#aboutcont', '#addrescont', '#verifycont'],
                circlesections: ['.aboutblock .circulo', '.addressblock .circulo', '.verifyblock .circulo'],
                prevbtn: 'prevbtn',
                nextbtn: 'nextbtn',

                initiateForm: function() {

                    var currsection = document.querySelector(this.formsections[this.formstate]);
                    var inactiveSecta = document.querySelector(this.formsections[this.inactiveSections[0]]);
                    var inactiveSectb = document.querySelector(this.formsections[this.inactiveSections[1]]);


                    var currcircle = document.querySelector(this.circlesections[this.formstate]);


                    var progressbar = document.querySelector('#progresswizard');
                    var currsectionprogress = currsection.getAttribute('data-progress');

                    progressbar.style.width = currsectionprogress;
                    currsection.style.display = "block";
                    inactiveSecta.style.display = "none";
                    inactiveSectb.style.display = "none";


                    if (this.formstate === 0) {
                        document.getElementById(this.prevbtn).style.display = "none";
                    } else {
                        document.getElementById(this.prevbtn).style.display = "inline-block";
                    }

                    currcircle.classList.add("activecirculo");
                    this.setInactiveCircles();


                    if (this.formstate === 2) {
                        document.querySelector("#nextbtn").style.display = "none";
                        document.querySelector("#submitForm").style.display = "inline-block";
                    } else {
                        document.querySelector("#nextbtn").style.display = "inline-block";
                        document.querySelector("#submitForm").style.display = "none";
                    }

                    this.checkInput();
                },
                nextSection: function() {
                    this.validateInput();
                    if (this.emptyInputs === 0) {
                        if (this.formstate < 2) {

                            this.formstate++;
                            this.setInactiveSections();
                            wizard.initiateForm();
                        }
                    }

                },
                prevSection: function() {
                    if (this.emptyInputs === 0) {
                        if (this.formstate > 0) {
                            this.formstate--;
                            this.setInactiveSections();
                            wizard.initiateForm();
                        }
                    }
                },
                validateInput: function() {

                    var currsection = this.formsections[this.formstate];


                    var inputfields = document.querySelectorAll(currsection + " input");
                    for (var i = 0; i < inputfields.length; i++) {
                        if (inputfields[i].value.length === 0) {
                            inputfields[i].classList.add("is-invalid");
                            this.emptyInputs++;
                        }
                    }


                },
                checkInput: function() {

                    var currsection = this.formsections[this.formstate];
                    var inputfields = document.querySelectorAll(currsection + " input");
                    for (var i = 0; i < inputfields.length; i++) {
                        var currElement = inputfields[i];
                        currElement.addEventListener('focusout', inputValidation, false);
                    }

                    function inputValidation(event) {
                        console.log(event.target.id);

                        var currentInput = document.getElementById(event.target.id);

                        if (currentInput.value.length > 3) {
                            currentInput.classList.remove("is-invalid");
                            if (wizard.emptyInputs > 0) {
                                wizard.emptyInputs--;
                            }
                        }
                        console.log(wizard.emptyInputs);
                    }
                }
            };


            wizard.initiateForm();

            document.getElementById(wizard.nextbtn).addEventListener("click", function() {
                wizard.nextSection();
            });
            document.getElementById(wizard.prevbtn).addEventListener("click", function() {
                wizard.prevSection();
            });




        })();
    </script>
@endsection
