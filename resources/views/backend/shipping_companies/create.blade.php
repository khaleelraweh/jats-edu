@extends('layouts.admin')

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/vendor/select2/css/select2.min.css') }}">
    <style>
        .select2-container {
            width: 100% !important;
        }
    </style>
@endsection

@section('content')
    {{-- main holder page  --}}
    <div class="card shadow mb-4">

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-plus-square"></i>
                    إضافة شركة شحن جديدة
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            الرئيسية
                        </a>
                        <i class="fa fa-solid fa-chevron-left chevron"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.shipping_companies.index') }}">
                            إدارة شركات الشحن
                        </a>
                    </li>
                </ul>
            </div>
        </div>


        {{-- body part  --}}
        <div class="card-body">
            {{-- enctype used cause we will save images  --}}
            <form action="{{ route('admin.shipping_companies.store') }}" method="post">
                @csrf

                <div class="row">
                    <div class="col-sm-12 col-md-4 pt-4">
                        <div class="form-group">
                            <label for="name">إسم الشركة</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                class="form-control" placeholder="">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 pt-4">
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" id="code" name="code" value="{{ old('code') }}"
                                class="form-control" placeholder="">
                            @error('code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 pt-4">
                        <div class="form-group">
                            <label for="description">الوصف</label>
                            <input type="text" id="description" name="description" value="{{ old('description') }}"
                                class="form-control" placeholder="">
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-4 pt-4">
                        <label for="fast">توصيل سريع</label>
                        <select name="fast" class="form-control">
                            <option value="0" {{ old('fast') == '0' ? 'selected' : null }}>لا</option>
                            <option value="1" {{ old('fast') == '1' ? 'selected' : null }}>نعم</option>
                        </select>
                        @error('fast')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-4 pt-4">
                        <div class="form-group">
                            <label for="cost">التكلفة</label>
                            <input type="text" id="cost" name="cost" value="{{ old('cost') }}"
                                class="form-control" placeholder="">
                            @error('cost')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 pt-4">
                        <label for="status">الحالة</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status') == '1' ? 'selected' : null }}>مفعل</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : null }}>غير مفعل</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="row pt-4">
                    <div class="col-12">
                        <label for="countries">الدول التي تعمل بها الشركة</label>
                        <select name="countries[]" class="form-control select2" multiple="multiple">
                            @forelse ($countries as $country)
                                <option value="{{ $country->id }}"
                                    {{ in_array($country->id, old('countries', [])) ? 'selected' : null }}>
                                    {{ $country->name }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>


                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">إضافة شركة الشحن</button>
                </div>

            </form>
        </div>

    </div>
@endsection

@section('script')
    {{-- Call select2 plugin --}}
    <script src="{{ asset('backend/vendor/select2/js/select2.full.min.js') }}"></script>
    <script>
        //select2: code to search in data 
        function matchStart(params, data) {
            // If there are no search terms, return all of the data
            if ($.trim(params.term) === '') {
                return data;
            }

            // Skip if there is no 'children' property
            if (typeof data.children === 'undefined') {
                return null;
            }

            // `data.children` contains the actual options that we are matching against
            var filteredChildren = [];
            $.each(data.children, function(idx, child) {
                if (child.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
                    filteredChildren.push(child);
                }
            });

            // If we matched any of the timezone group's children, then set the matched children on the group
            // and return the group object
            if (filteredChildren.length) {
                var modifiedData = $.extend({}, data, true);
                modifiedData.children = filteredChildren;

                // You can return modified objects from here
                // This includes matching the `children` how you want in nested data sets
                return modifiedData;
            }

            // Return `null` if the term should not be displayed
            return null;
        }

        // select2 : .select2 : is  identifier used with element to be effected
        $(".select2").select2({
            tags: true,
            colseOnSelect: false,
            minimumResultsForSearch: Infinity,
            matcher: matchStart
        });
    </script>
@endsection
