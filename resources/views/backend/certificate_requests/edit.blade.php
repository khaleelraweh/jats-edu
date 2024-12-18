@extends('layouts.admin')

@section('content')
    {{-- main holder certificate  --}}
    <div class="card shadow mb-4">

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex justify-content-between">

            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-edit"></i>
                    {{ __('panel.edit_existing_certificate') }}
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
                        <a href="{{ route('admin.certificate_requests.index') }}">
                            {{ __('panel.show_certificates') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>


        {{-- body part  --}}
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.certificate_requests.update', $certificate_request->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="content-tab" data-bs-toggle="tab" data-bs-target="#content"
                            type="button" role="tab" aria-controls="content"
                            aria-selected="true">{{ __('panel.content_tab') }}
                        </button>
                    </li>

                </ul>

                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="content-tab">


                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="user_id">{{ __('panel.student_account') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" class="form-control typeahead" name="customer_name" id="customer_name"
                                    value="{{ old('customer_name', $certificate_request->user->full_name) }}"
                                    placeholder="{{ __('panel.type_student_name_or_email') }}" readonly>
                                <input type="hidden" class="form-control" name="user_id" id="user_id"
                                    value="{{ old('user_id', $certificate_request->user_id) }}" readonly>
                                @error('user_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        @foreach (config('locales.languages') as $key => $val)
                            <div class="row ">
                                <div class="col-sm-12 col-md-2 pt-3">
                                    <label for="full_name[{{ $key }}]">
                                        {{ __('panel.full_name') }}
                                        {{ __('panel.in') }} ({{ __('panel.' . $key) }})
                                    </label>
                                </div>
                                <div class="col-sm-12 col-md-10 pt-3">
                                    <input type="text" name="full_name[{{ $key }}]"
                                        id="full_name[{{ $key }}]"
                                        value="{{ old('full_name.' . $key, $certificate_request->getTranslation('full_name', $key)) }}"
                                        class="form-control">
                                    @error('full_name.' . $key)
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                        @endforeach

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="date_of_birth">
                                    {{ __('panel.date_of_birth') }}
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="input-group flatpickr" id="flatpickr-date">
                                    <input type="text" name="date_of_birth"
                                        value="{{ old('date_of_birth', $certificate_request->date_of_birth ? \Carbon\Carbon::parse($certificate_request->date_of_birth)->format('Y/m/d') : '') }}"
                                        class="form-control" placeholder="Select date" data-input>
                                    <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                                @error('date_of_birth')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="nationality">
                                    {{ __('panel.address_of_residence') }}
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="row">
                                    <div class="col-sm-12 col-md-3">
                                        <select id="nationality" name="nationality" class="form-control">
                                            <option value="">{{ __('panel.nationality') }}</option>
                                            @foreach (getCountries() as $country)
                                                <option value="{{ $country->id }}"
                                                    {{ old('nationality', $certificate_request->nationality) == $country->id ? 'selected' : null }}>
                                                    {{ app()->getLocale() == 'ar' ? $country->translations['ar'] : $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('nationality')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-3">

                                        <select name="country" id="country" class="form-control">
                                            <option value="">{{ __('panel.country') }}</option>
                                            @forelse ($countries as $country)
                                                <option value="{{ $country->id }}"
                                                    {{ old('country') == $country->id ? 'selected' : null }}>
                                                    {{ app()->getLocale() == 'ar' ? $country->translations['ar'] : $country->name }}
                                                </option>
                                                <option value="{{ $country->id }}"
                                                    {{ old('country', $certificate_request->country) == $country->id ? 'selected' : null }}>
                                                    {{ app()->getLocale() == 'ar' ? $country->translations['ar'] : $country->name }}
                                                </option>
                                            @empty
                                            @endforelse
                                        </select>
                                        @error('country_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <input type="text" class="form-control " name="state" id="state"
                                            value="{{ old('state', $certificate_request->state) }}"
                                            placeholder="{{ __('panel.state') }}">
                                        @error('state')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <input type="text" class="form-control " name="city" id="city"
                                            value="{{ old('city', $certificate_request->city) }}"
                                            placeholder="{{ __('panel.city') }}">
                                        @error('city')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="nationality">
                                    {{ __('panel.phone_number') }}
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" class="form-control " name="phone" id="phone"
                                    value="{{ old('phone', $certificate_request->phone) }}"
                                    placeholder="{{ __('panel.phone') }}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="nationality">
                                    {{ __('panel.whatsup_phone') }}
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" class="form-control " name="whatsup_phone" id="whatsup_phone"
                                    value="{{ old('whatsup_phone', $certificate_request->whatsup_phone) }}"
                                    placeholder="{{ __('panel.whatsup_phone') }}">
                                @error('whatsup_phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="status" class="control-label">
                                    <span>{{ __('panel.identity_type') }}</span>
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="identity_type"
                                        id="identity_type_passport" value="1"
                                        {{ old('identity_type', $certificate_request->identity_type) == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="identity_type_passport">
                                        {{ __('panel.identity_type_passport') }}
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="identity_type"
                                        id="identity_type_personal_card" value="0"
                                        {{ old('identity_type', $certificate_request->identity_type) == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="identity_type_personal_card">
                                        {{ __('panel.identity_type_personal_card') }}
                                    </label>
                                </div>
                                @error('identity_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="nationality">
                                    {{ __('panel.identity_number') }}
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" class="form-control " name="identity_number" id="identity_number"
                                    value="{{ old('identity_number', $certificate_request->identity_number) }}"
                                    placeholder="{{ __('panel.identity_number') }}">
                                @error('identity_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="identity_expiration_date" class="control-label">
                                    <span>{{ __('panel.identity_expiration_date') }}</span>
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="input-group flatpickr" id="flatpickr-identityExpirationDate">
                                    <input type="text" name="identity_expiration_date"
                                        value="{{ old('identity_expiration_date', $certificate_request->identity_expiration_date ? \Carbon\Carbon::parse($certificate_request->identity_expiration_date)->format('Y/m/d') : '') }}"
                                        class="form-control" placeholder="Select date" data-input>
                                    <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                                @error('identity_expiration_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="identity_attachment"> {{ __('panel.identity_attachment') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="file-loading">
                                    <input type="file" name="identity_attachment" id="identity_attachment"
                                        value="{{ old('identity_attachment') }}" class="file-input-overview ">
                                    @error('identity_attachment')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>
                        </div>


                        <hr>




                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="course_id"> {{ __('panel.course_name') }} </label>
                            </div>

                            <div class="col-sm-12 col-md-10 pt-3">
                                <select name="course_id" id="course_id" class="form-control select2 child">
                                    <option value="">{{ __('panel.select_course') }}</option>
                                    @forelse ($courses as $course)
                                        <option value="{{ $course->id }}"
                                            {{ (old('course_id') ?? ($certificate_request->course_id ?? '')) == $course->id ? 'selected' : '' }}>
                                            {{ $course->title }}
                                        </option>
                                    @empty
                                        <option value="">{{ __('panel.no_courses_available') }}</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="certificate_name">
                                    {{ __('panel.certificate_name') }}
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" class="form-control " name="certificate_name"
                                    id="certificate_name"
                                    value="{{ old('certificate_name', $certificate_request->certificate_name) }}"
                                    placeholder="{{ __('panel.certificate_name') }}">
                                @error('certificate_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="certificate_code">{{ __('panel.certificate_code') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" class="form-control " name="certificate_code"
                                    id="certificate_code"
                                    value="{{ old('certificate_code', $certificate_request->certificate_code) }}">
                                @error('certificate_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="flatpickr-datetime"> {{ __('panel.certificate_release_date') }} </label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="input-group flatpickr" id="flatpickr-certificateReleaseDate">
                                    <input type="text" name="certificate_release_date"
                                        value="{{ old('certificate_release_date', $certificate_request->certificate_release_date ? \Carbon\Carbon::parse($certificate_request->certificate_release_date)->format('Y/m/d') : '') }}"
                                        class="form-control" placeholder="Select date" data-input>
                                    <span class="input-group-text input-group-addon" data-toggle>
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                </div>
                                @error('certificate_release_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="row ">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="certificate_file"> {{ __('panel.certification_file') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="file-loading">
                                    <input type="file" name="certificate_file" id="customer_image"
                                        value="{{ old('certificate_file') }}" class="file-input-overview ">
                                    @error('certificate_file')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="sponsor_id"> {{ __('panel.sponsor_name') }} </label>
                            </div>

                            <div class="col-sm-12 col-md-10 pt-3">
                                <select name="sponsor_id" id="sponsor_id" class="form-control select2 child">
                                    <option value="">{{ __('panel.select_sponsor') }}</option>
                                    @forelse ($sponsors as $sponsor)
                                        <option value="{{ $sponsor->id }}"
                                            {{ old('sponsor_id', $certificate_request->sponsor_id) == $sponsor->id ? 'selected' : '' }}>
                                            {{ $sponsor->name }}
                                        </option>
                                    @empty
                                        <option value="">{{ __('panel.no_sponsors_available') }}</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="certificate_status" class="control-label">
                                    <span>{{ __('panel.certificate_status') }}</span>
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="certificate_status"
                                        id="under_review" value="0"
                                        {{ old('certificate_status', $certificate_request->certificate_status) == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="under_review">
                                        {{ __('panel.under_review') }}
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="certificate_status"
                                        id="under_treatment" value="1"
                                        {{ old('certificate_status', $certificate_request->certificate_status) == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="under_treatment">
                                        {{ __('panel.under_treatment') }}
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="certificate_status"
                                        id="released" value="2"
                                        {{ old('certificate_status', $certificate_request->certificate_status) == '2' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="released">
                                        {{ __('panel.released') }}
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="certificate_status"
                                        id="rejected" value="3"
                                        {{ old('certificate_status', $certificate_request->certificate_status) == '3' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="rejected">
                                        {{ __('panel.rejected') }}
                                    </label>
                                </div>
                                @error('certificate_status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <hr>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="published_on" class="control-label">
                                    <span>{{ __('panel.published_on') }}</span>
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="input-group flatpickr" id="flatpickr-datetime">
                                    <input type="text" name="published_on"
                                        value="{{ old('published_on', $certificate_request->published_on ? \Carbon\Carbon::parse($certificate_request->published_on)->format('Y/m/d') : '') }}"
                                        class="form-control" placeholder="Select date" data-input>
                                    <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                                @error('published_on')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="status" class="control-label">
                                    <span>{{ __('panel.status') }}</span>
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="status" id="status_active"
                                        value="1"
                                        {{ old('status', $certificate_request->status) == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_active">
                                        {{ __('panel.status_active') }}
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="status" id="status_inactive"
                                        value="0"
                                        {{ old('status', $certificate_request->status) == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_inactive">
                                        {{ __('panel.status_inactive') }}
                                    </label>
                                </div>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <hr>

                    </div>


                    <div class="row">
                        <div class="col-sm-12 col-md-2 pt-3 d-none d-md-block">
                        </div>
                        <div class="col-sm-12 col-md-10 pt-3">

                            <button type="submit" name="submit" class="btn btn-primary">
                                <i class="icon-lg  me-2" data-feather="corner-down-left"></i>
                                {{ __('panel.save_data') }}
                            </button>

                            <a href="{{ route('admin.certificate_requests.index') }}" name="submit"
                                class=" btn btn-outline-danger">
                                <i class="icon-lg  me-2" data-feather="x"></i>
                                {{ __('panel.cancel') }}
                            </a>

                        </div>
                    </div>

                </div>

            </form>
        </div>



    </div>
@endsection

@section('script')
    <script>
        $(function() {
            $("#customer_image").fileinput({
                theme: "fa5",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                initialPreview: [
                    @if ($certificate_request->certificate_file != '')
                        "{{ asset('assets/certificate_requests/' . $certificate_request->certificate_file) }}",
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                    @if ($certificate_request->certificate_file != '')
                        {
                            caption: "{{ $certificate_request->certificate_file }}",
                            size: '1111',
                            width: "120px",
                            url: "{{ route('admin.certificate_requests.remove_certificate_file_image', ['certificate_request_id' => $certificate_request->id, '_token' => csrf_token()]) }}",
                            key: {{ $certificate_request->id }}
                        }
                    @endif
                ]
            });


            $("#identity_attachment").fileinput({
                theme: "fa5",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                initialPreview: [
                    @if ($certificate_request->identity_attachment != '')
                        "{{ asset('assets/certificate_requests/' . $certificate_request->identity_attachment) }}",
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                    @if ($certificate_request->identity_attachment != '')
                        {
                            caption: "{{ $certificate_request->identity_attachment }}",
                            size: '1111',
                            width: "120px",
                            url: "{{ route('admin.certificate_requests.remove_identity_attachment_image', ['certificate_request_id' => $certificate_request->id, '_token' => csrf_token()]) }}",
                            key: {{ $certificate_request->id }}
                        }
                    @endif
                ]
            });





        });
    </script>
@endsection
