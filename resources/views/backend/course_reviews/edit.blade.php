@extends('layouts.admin')
@section('content')
    {{-- main holder page  --}}
    <div class="card shadow mb-4">

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex justify-content-between">

            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-edit"></i>
                    تعديل تعليق
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            الرئيسية
                        </a>
                        <i class="fa fa-solid fa-chevron-left chevron"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.course_reviews.index') }}">
                            إدارة التعليقات
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        {{-- body part  --}}
        <div class="card-body">
            <form action="{{ route('admin.course_reviews.update', $courseReview->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-sm-12 col-md-4 pt-2">
                        <div class="form-group">
                            <label for="name">الاسم</label>
                            <input type="text" id="name" name="name"
                                value="{{ old('name', $courseReview->name) }}" class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 pt-2">
                        <div class="form-group">
                            <label for="email">الايميل</label>
                            <input type="text" id="email" name="email"
                                value="{{ old('email', $courseReview->email) }}" class="form-control">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 pt-2">
                        <label for="rating">التقييم</label>
                        <select name="rating" class="form-control">
                            <option value="">---</option>
                            <option value="1" {{ old('rating', $courseReview->rating) == '1' ? 'selected' : null }}>1
                            </option>
                            <option value="2" {{ old('rating', $courseReview->rating) == '2' ? 'selected' : null }}>2
                            </option>
                            <option value="3" {{ old('rating', $courseReview->rating) == '3' ? 'selected' : null }}>3
                            </option>
                            <option value="4" {{ old('rating', $courseReview->rating) == '4' ? 'selected' : null }}>4
                            </option>
                            <option value="5" {{ old('rating', $courseReview->rating) == '5' ? 'selected' : null }}>5
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4 pt-3">
                        <div class="form-group">
                            <label for="course_id">المنتج</label>
                            <input type="text" id="course_name" name="course_name"
                                value="{{ old('course_name', $courseReview->course->title) }}" class="form-control"
                                readonly>
                            <input type="hidden" id="course_id" name="course_id"
                                value="{{ old('course_id', $courseReview->course_id) }}" class="form-control" readonly>
                            @error('course_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 pt-3">
                        <div class="form-group">
                            <label for="user_id">العميل</label>
                            <input type="text" id="user_name" name="user_name"
                                value="{{ $courseReview->user_id != '' ? $courseReview->user->full_name : '' }}"
                                class="form-control" readonly>
                            <input type="hidden" id="user_id" name="user_id" value="{{ $courseReview->user_id ?? '' }}"
                                class="form-control" readonly>
                            @error('user_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 pt-3">
                        <label for="status">الحالة</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status', $courseReview->status) == '1' ? 'selected' : null }}>
                                مفعل</option>
                            <option value="0" {{ old('status', $courseReview->status) == '0' ? 'selected' : null }}>
                                غير مفعل</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 pt-3">
                        <div class="form-group">
                            <label for="title">عوان التعليق</label>
                            <input type="text" id="title" name="title"
                                value="{{ old('title', $courseReview->title) }}" class="form-control">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 pt-3">
                        <label for="message">الوصف</label>
                        <textarea name="message" rows="10" class="form-control summernote">
                            {!! old('message', $courseReview->message) !!}
                        </textarea>
                    </div>
                </div>



                <div class="form-group pt-2">
                    <button type="submit" name="submit" class="btn btn-primary">تعديل التعليق</button>
                </div>

            </form>
        </div>

    </div>
@endsection

@section('script')
    <script>
        $(function() {

            $('.summernote').summernote({
                tabSize: 2,
                height: 150,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });


        });
    </script>
@endsection
