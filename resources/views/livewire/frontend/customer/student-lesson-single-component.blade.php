<div>
    <!-- NAVBAR  -->
    <header class="bg-portgore py-3">
        <div class="px-5 px-lg-8 w-100">
            <div class="d-md-flex align-items-center">
                <!-- Brand -->
                <a class="navbar-brand mb-2 mb-md-0" href="{{ route('frontend.index') }}">
                    <img src="{{ asset('frontend/assets/img/brand-white.svg') }}" class="navbar-brand-img" alt="...">

                </a>

                <!-- Lesson Title -->
                <div class="mx-auto mb-5 mb-md-0">
                    <h3 class="mb-0 line-clamp-2 text-white">
                        {{ $course->title }}
                    </h3>
                </div>

                <!-- Back to Course -->
                <a href="{{ route('customer.courses') }}"
                    class="btn btn-sm btn-orange ms-md-6 px-6 mb-3 mb-md-0 flex-shrink-0">
                    {{ __('panel.back_to_courses') }}
                </a>
            </div>
        </div>
    </header>

    <!-- COURSE -->
    <div class="container container-wd">
        <div class="row pt-8 pb-10">
            <div class="col-lg-8">
                @if (!$showEvaluation)
                    {{-- video frame --}}
                    <iframe class="  rounded mb-8" style="width: 100%; height:500px;" src="{{ $videoUrl }}"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                @else
                    {{-- evaluation container --}}
                    <div class="evaluation-container">
                        @livewire('frontend.customer.evaluation.student-evaluation-component', ['selectedEvaluation' => $selectedEvaluation])

                    </div>
                @endif

            </div>

            <div class="col-lg-4">
                <div class="bg-portgore rounded p-6">
                    <!-- Search -->
                    <form class="mb-5">
                        <div class="input-group rounded">
                            <div class="input-group-prepend">
                                <button class="btn btn-sm text-secondary bg-dark" type="submit">
                                    <!-- Icon -->
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.80758 0C3.95121 0 0 3.95121 0 8.80758C0 13.6642 3.95121 17.6152 8.80758 17.6152C13.6642 17.6152 17.6152 13.6642 17.6152 8.80758C17.6152 3.95121 13.6642 0 8.80758 0ZM8.80758 15.9892C4.8477 15.9892 1.62602 12.7675 1.62602 8.80762C1.62602 4.84773 4.8477 1.62602 8.80758 1.62602C12.7675 1.62602 15.9891 4.8477 15.9891 8.80758C15.9891 12.7675 12.7675 15.9892 8.80758 15.9892Z"
                                            fill="currentColor" />
                                        <path
                                            d="M19.762 18.6121L15.1007 13.9509C14.7831 13.6332 14.2687 13.6332 13.9511 13.9509C13.6335 14.2682 13.6335 14.7831 13.9511 15.1005L18.6124 19.7617C18.7712 19.9205 18.9791 19.9999 19.1872 19.9999C19.395 19.9999 19.6032 19.9205 19.762 19.7617C20.0796 19.4444 20.0796 18.9295 19.762 18.6121Z"
                                            fill="currentColor" />
                                    </svg>

                                </button>
                            </div>
                            <input class="form-control form-control-sm border-0 ps-0 bg-dark" type="search"
                                placeholder="Search item" aria-label="Search">
                        </div>
                    </form>

                    <div id="accordionCurriculum" class="">

                        @foreach ($course->sections as $index => $section)
                            <div class="overflow-hidden bg-dark rounded mb-6">
                                <div class="d-flex align-items-center" id="curriculumheading{{ $index }}">
                                    <h5 class="mb-0 w-100">

                                        <button
                                            class="d-flex align-items-center p-5 min-height-80 text-white fw-medium collapse-accordion-toggle line-height-one"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#Curriculumcollapse{{ $index }}"
                                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                            aria-controls="Curriculumcollapse{{ $index }}">
                                            <span class="me-4 text-white d-flex">
                                                <!-- Icon -->
                                                <svg width="15" height="2" viewBox="0 0 15 2" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="15" height="2" fill="currentColor" />
                                                </svg>

                                                <svg width="15" height="16" viewBox="0 0 15 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0 7H15V9H0V7Z" fill="currentColor" />
                                                    <path d="M6 16L6 8.74228e-08L8 0L8 16H6Z" fill="currentColor" />
                                                </svg>

                                            </span>

                                            {{ $section->title }}
                                            @php
                                                $totalDuration = $totalDurations[$section->id];
                                                $hours = floor($totalDuration / 60);
                                                $minutes = $totalDuration % 60;
                                            @endphp

                                            <span class="ms-1">
                                                <small>
                                                    @if ($hours > 0)
                                                        ({{ $hours }} hr @if ($minutes > 0)
                                                            {{ $minutes }} min
                                                        @endif)
                                                    @else
                                                        ( {{ $minutes }} min)
                                                    @endif
                                                </small>
                                            </span>
                                        </button>
                                    </h5>
                                </div>


                                <div id="Curriculumcollapse{{ $index }}"
                                    class="collapse {{ $loop->first ? 'show' : '' }}"
                                    aria-labelledby="curriculumheading{{ $index }}"
                                    data-parent="#accordionCurriculum">

                                    @foreach ($section->lessons as $lesson)
                                        <div
                                            class="border-top px-5 border-color-20 py-4 min-height-70 d-md-flex align-items-center @if ($selectedLessonUrl == $lesson->url) bg-secondary text-white @endif">
                                            <div class="d-flex align-items-center me-auto mb-4 mb-md-0">
                                                <div class="text-secondary d-flex">
                                                    <svg width="14" height="18" viewBox="0 0 14 18"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.5717 0H4.16956C4.05379 0.00594643 3.94322 0.0496071 3.85456 0.124286L0.413131 3.57857C0.328167 3.65957 0.280113 3.77191 0.280274 3.88929V16.8514C0.281452 17.4853 0.794988 17.9988 1.42885 18H12.5717C13.1981 17.9989 13.7086 17.497 13.7203 16.8707V1.14857C13.7191 0.514714 13.2056 0.00117857 12.5717 0ZM8.18099 0.857143H10.6988V4.87714L9.80527 3.45214C9.76906 3.39182 9.71859 3.3413 9.65827 3.30514C9.45529 3.18337 9.19204 3.24916 9.07027 3.45214L8.18099 4.87071V0.857143ZM3.7367 1.46786V2.66143C3.73552 3.10002 3.38029 3.45525 2.9417 3.45643H1.74813L3.7367 1.46786ZM12.8546 16.86C12.8534 17.0157 12.7274 17.1417 12.5717 17.1429H1.42885C1.42665 17.1429 1.42445 17.143 1.42226 17.143C1.26486 17.1441 1.13635 17.0174 1.13527 16.86V4.32214H2.9417C3.85793 4.31979 4.60006 3.57766 4.60242 2.66143V0.857143H7.31527V5.23286C7.31345 5.42593 7.37688 5.61391 7.49527 5.76643C7.67533 5.99539 7.98036 6.08561 8.25599 5.99143L8.28813 5.98071C8.49272 5.89484 8.66356 5.7443 8.77456 5.55214L9.44099 4.48071L10.1074 5.55214C10.2184 5.7443 10.3893 5.89484 10.5938 5.98071C10.8764 6.0922 11.1987 6.00509 11.3867 5.76643C11.5051 5.61391 11.5685 5.42593 11.5667 5.23286V0.857143H12.5717C12.7266 0.858268 12.8523 0.982982 12.8546 1.13786V16.86Z"
                                                            fill="currentColor" />
                                                        <path
                                                            d="M10.7761 14.3143H3.22252C2.98584 14.3143 2.79395 14.5062 2.79395 14.7429C2.79395 14.9796 2.98584 15.1715 3.22252 15.1715H10.7761C11.0128 15.1715 11.2047 14.9796 11.2047 14.7429C11.2047 14.5062 11.0128 14.3143 10.7761 14.3143Z"
                                                            fill="currentColor" />
                                                        <path
                                                            d="M10.7761 12.2035H3.22252C2.98584 12.2035 2.79395 12.3954 2.79395 12.6321C2.79395 12.8687 2.98584 13.0606 3.22252 13.0606H10.7761C11.0128 13.0606 11.2047 12.8687 11.2047 12.6321C11.2047 12.3954 11.0128 12.2035 10.7761 12.2035Z"
                                                            fill="currentColor" />
                                                        <path
                                                            d="M10.7761 10.0928H3.22252C2.98584 10.0928 2.79395 10.2847 2.79395 10.5213C2.79395 10.758 2.98584 10.9499 3.22252 10.9499H10.7761C11.0128 10.9499 11.2047 10.758 11.2047 10.5213C11.2047 10.2847 11.0128 10.0928 10.7761 10.0928Z"
                                                            fill="currentColor" />
                                                        <path
                                                            d="M10.7761 7.98218H3.22252C2.98584 7.98218 2.79395 8.17407 2.79395 8.41075C2.79395 8.64743 2.98584 8.83932 3.22252 8.83932H10.7761C11.0128 8.83932 11.2047 8.64743 11.2047 8.41075C11.2047 8.17407 11.0128 7.98218 10.7761 7.98218Z"
                                                            fill="currentColor" />
                                                    </svg>

                                                </div>

                                                <div class="ms-4">
                                                    {{ $lesson->title }}
                                                </div>
                                            </div>

                                            <div
                                                class="d-flex align-items-center overflow-auto overflow-md-visible flex-shrink-all">
                                                <div
                                                    class="badge btn-orange-soft text-white-70 me-5 font-size-sm fw-normal py-2">
                                                    {{ $lesson->duration }}</div>
                                                <a href="#"
                                                    wire:click="updateContent('{{ $lesson->url }}', false)"
                                                    class="text-secondary d-flex">
                                                    <!-- Icon -->
                                                    <svg width="14" height="16" viewBox="0 0 14 16"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.8704 6.15374L3.42038 0.328572C2.73669 -0.0923355 1.9101 -0.109836 1.20919 0.281759C0.508282 0.673291 0.0898438 1.38645 0.0898438 2.18929V13.7866C0.0898438 15.0005 1.06797 15.9934 2.27016 16C2.27344 16 2.27672 16 2.27994 16C2.65563 16 3.04713 15.8822 3.41279 15.6591C3.70694 15.4796 3.79991 15.0957 3.62044 14.8016C3.44098 14.5074 3.05697 14.4144 2.76291 14.5939C2.59188 14.6982 2.42485 14.7522 2.27688 14.7522C1.82328 14.7497 1.33763 14.3611 1.33763 13.7866V2.18933C1.33763 1.84492 1.51713 1.53907 1.81775 1.3711C2.11841 1.20314 2.47294 1.21064 2.76585 1.39098L12.2159 7.21615C12.4999 7.39102 12.6625 7.68262 12.6618 8.01618C12.6611 8.34971 12.4974 8.64065 12.2118 8.81493L5.37935 12.9983C5.08548 13.1783 4.9931 13.5623 5.17304 13.8562C5.35295 14.1501 5.73704 14.2424 6.03092 14.0625L12.8625 9.87962C13.5166 9.48059 13.9081 8.78496 13.9096 8.01868C13.9112 7.25249 13.5226 6.55524 12.8704 6.15374Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach


                                    {{-- show evaluation link --}}
                                    @foreach ($section->evaluations as $evaluation)
                                        <div
                                            class="border-top px-5 border-color-20 py-4 min-height-70 d-md-flex align-items-center @if ($selectedLessonUrl == $evaluation->id) bg-secondary text-white @endif">
                                            <div class="d-flex align-items-center me-auto mb-4 mb-md-0">
                                                <div class="text-secondary d-flex">
                                                    <i class="fas fa-file-alt"></i>
                                                </div>

                                                <div class="ms-4">
                                                    {{ $evaluation->title }}
                                                </div>
                                            </div>

                                            <div
                                                class="d-flex align-items-center overflow-auto overflow-md-visible flex-shrink-all">
                                                {{-- evaluation director --}}
                                                <a href="#"
                                                    wire:click="updateContent('{{ $evaluation->id }}', true)"
                                                    class="text-secondary d-flex">
                                                    <!-- Icon -->
                                                    <i class="fas fa-file"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        <style>
                            .certificate-links {
                                border: 2px solid #2F2D51;
                                border-radius: 5px;
                            }

                            .certificate-links:hover {
                                background-color: #2F2D51;
                            }
                        </style>


                        @if ($isComplete)
                            @if ($studentScore >= 50)
                                @if (!$hasCertificate)
                                    <a href="{{ route('customer.certification', $course->id) }}"
                                        class="d-flex align-items-center p-5 mb-4 text-white fw-medium  line-height-one certificate-links">
                                        <span class="me-4 text-white d-flex">
                                            <!-- Icon -->
                                            <i class="fas fa-graduation-cap"></i>
                                        </span>
                                        {{ __('panel.obtain_a_certificate_of_participation') }}
                                    </a>
                                @else
                                    <a href="{{ route('customer.show_certification',Auth::user()->certifications()->where('course_id', $course->id)->first()->id) }}"
                                        class="d-flex align-items-center p-5 mb-4 text-white fw-medium  line-height-one certificate-links">
                                        <span class="me-4 text-white d-flex">
                                            <!-- Icon -->
                                            <i class="fas fa-graduation-cap"></i>
                                        </span>
                                        {{ __('panel.browse_the_certificate_of_participation') }}
                                    </a>
                                @endif
                            @else
                                failed The evaluation: {{ $studentScore }} percentage
                            @endif


                        @endif


                        {{-- <a href="#" style="border: 2px solid #2F2D51;border-radius: 5px; "
                            class="d-flex align-items-center p-5  text-white fw-medium  line-height-one certificate-links">
                            <span class="me-4 text-white d-flex">
                                <!-- Icon -->
                                <i class="fas fa-user-graduate"></i>
                            </span>
                            الحصول على شهادة رسمية
                        </a> --}}


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
