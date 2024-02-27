@extends('layouts.admin')


@section('style')
    <style> 
        .picker__select--month,.picker__select--year{
            padding: 0 !important;
        }
        .picker__list{
            list-style-type: none;
        }
        .x-title{
            border-bottom: 2px solid #E6E9ED;
            padding: 1px 5px 6px;
            margin-bottom: 10px;
        }
        .require.red{color:red;}
    </style>
@endsection

@section('content')

    {{-- main holder page  --}}
    <div class="card shadow mb-4">

        {{-- menu part  --}}
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">إضافة تصينف منتجات</h6>
            <div class="ml-auto">
                <a href="{{route('admin.product_categories.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">تصنيف المنتجات</span>
                </a>
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


            <form action="{{ route('admin.product_categories.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                {{-- links of tabs --}}
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="content-tab" data-toggle="tab" href="#content" role="tab" aria-controls="content" aria-selected="true">بيانات المحتوي</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="publish-tab" data-toggle="tab" href="#publish" role="tab" aria-controls="publish" aria-selected="false">بيانات النشر</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="other-tab" data-toggle="tab" href="#other" role="tab" aria-controls="other" aria-selected="false">اخري</a>
                    </li>
                </ul>

                {{-- contents of links tabs  --}}
                <div class="tab-content" id="myTabContent">
                    
                    {{-- تاب بيانات المحتوي --}}
                    <div class="tab-pane fade active show" id="content" role="tabpanel" aria-labelledby="content-tab">

                        <div class="row">
                            {{-- البيانات الاساسية --}}
                            <div class="col-md-7 col-sm-12 ">

                                {{-- تصنيفات المنتجات --}}
                                <div class="row pt-4">
                                    <label for="parent_id" class="control-label col-md-2 col-sm-12 ">
                                            التصنيف
                                        <span class="require red">*</span>
                                    </label>
                                    <div class="col-md-10 col-sm-12">
                                        <select name="parent_id" class="form-control">
                                            <option value="">تصنيف رئيسي__</option>
                                            @forelse ($main_categories as $main_category)
                                            <option value="{{$main_category->id}}" {{old('parent_id') == $main_category->id ? 'selected' : null }}>{{ $main_category->name }}</option>
                                            @empty 
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
    
                                {{-- عنوان التصنيف  --}}
                                <div class="row pt-4">
                                    <label for="name" class="control-label col-md-2 col-sm-12 ">
                                        العنوان  
                                        <span class="require red">*</span>
                                    </label>
                                    <div class="col-md-10 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" id="name" name="name" value="{{old('name')}}" class="form-control" placeholder="العنوان..">
                                            @error('name') <span class="text-danger">{{$message}}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- الوصف  --}}
                                <div class="row pt-4">
                                    <label for="description" class="control-label col-md-2 col-sm-12 ">
                                        <span>التفاصيل</span>
                                        <span class="require red">*</span>
                                    </label>
                                    <div class="col-md-10 col-sm-12">
                                        <div class="form-group">
                                            <textarea name="description"  rows="8" class="form-control summernote">
                                                {!!old('description')!!}
                                            </textarea>
                                            @error('description') <span class="text-danger">{{$message}}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
        
                            {{-- مرفق الصورة --}}
                            <div class="col-md-5 col-sm-12 ">

                                {{-- الصورة  --}}
                                <div class="row pt-4">
                                    <label for="images" class="control-label col-md-2 col-sm-12 ">
                                        <span>صورة</span>
                                        <span class="require red">*</span>
                                    </label>
                                    <div class="col-md-10 col-sm-12">
                                        <div class="file-loading">
                                            <input type="file" name="images[]" id="category_image" class="file-input-overview ">
                                            <span class="form-text text-muted">Image width should be 500px x 500px </span>
                                            @error('images')<span class="text-danger">{{$message}}</span>@enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
        
                        </div>

                    </div>


                    {{-- تاب بيانات النشر --}}
                    <div class="tab-pane fade" id="publish" role="tabpanel" aria-labelledby="publish-tab">

                        {{-- حالة التصنيف --}}
                        <div class="row">
                            <div class="col-md-12 col-sm-12 pt-4">
                                <label for="status" class="control-label col-md-2 col-sm-12 ">
                                    <span>الحالة</span>
                                    <span class="require red">*</span>
                                </label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status') == '1' ? 'selected' : null}}>مفعل</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : null}}>غير مفعل</option>
                                </select>
                                @error('status')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                        </div>

                        
                          {{-- publish_start publish time field --}}
                          <div class="row">
                            <div class="col-sm-12 col-md-12 pt-4">
                                <div class="form-group">
                                    <label for="published_on">تاريخ النشر</label>
                                    <input type="text" id="published_on" name="published_on" value="{{old('published_on' , now()->format('Y-m-d') )}}" class="form-control" >
                                    @error('published_on') <span class="text-danger">{{$message}}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-12 pt-4">
                                <div class="form-group">
                                    <label for="published_on_time">وقت النشر</label>
                                    <input type="text" id="published_on_time" name="published_on_time" value="{{old('published_on_time' , now()->format('h:m A'))}}" class="form-control" >
                                    @error('published_on_time') <span class="text-danger">{{$message}}</span> @enderror
                                </div>
                            </div>
                           
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 pt-4">
                                <label for="featured" class="control-label col-md-2 col-sm-12 ">
                                    <span>المفضلة</span>
                                    <span class="require red">*</span>
                                </label>
                                <select name="featured" class="form-control">
                                    <option value="1" {{ old('featured') == '1' ? 'selected' : null}}>نعم</option>
                                    <option value="0" {{ old('featured') == '0' ? 'selected' : null}}> لا</option>
                                </select>
                                @error('featured')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                        </div>

                    </div>

                    {{-- تاب لاي شي جديد --}}
                    <div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="other-tab">
                        any think you want
                    </div>

                </div>

                {{-- submit part --}}
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <div class="form-group pt-3 mx-3">
                            <button type="submit" name="submit" class="btn btn-primary">حفظ البيانات</button>
                        </div>
                    </div>
                </div>

            </form>

        </div>
        
    </div>

@endsection


@section('script')
    {{-- pickadate calling js --}}
    <script src="{{asset('backend/vendor/datepicker/picker.js')}}"></script>
    <script src="{{asset('backend/vendor/datepicker/picker.date.js')}}"></script>
    <script src="{{asset('backend/vendor/datepicker/picker.time.js')}}"></script>
    <script>
        $(function(){

            //Category image 
            $("#category_image").fileinput({
                theme:"fa5",
                maxFileCount: 1 ,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial:false
            });


            $('#published_on').pickadate({
                format: 'yyyy-mm-dd',
                min: new Date(),
                selectMonths: true , // Creates a dropdown to control month
                selectYears: true, // creates a dropdown to control years
                clear: 'Clear',
                close: 'OK',
                colseOnSelect: true // Close Upon Selecting a date
            });

           
            var publishedOn = $('#published_on').pickadate('picker'); // set startdate in the picker to the start date in the #start_date elemet

            // when change date 
            $('#published_on').change(function(){
                selected_ci_date = ""; 
                selected_ci_date = $('#published_on').val(); 
                if(selected_ci_date != null){
                    var cidate = new Date(selected_ci_date); 
                    min_codate = "";
                    min_codate = new Date();
                    min_codate.setDate(cidate.getDate()+1);  
                    enddate.set('min',min_codate);
                }

            });

            $('#published_on_time').pickatime({
                clear: ''
            });

     

            //summernote for description 
            $('.summernote').summernote({
                tabSize:2,
                height:150,
                toolbar:[
                    ['style' ,['style']],
                    ['font',['bold','underline','clear']],
                    ['color',['color']],
                    ['para',['ul','ol','paragraph']],
                    ['table',['table']],
                    ['insert',['link','picture','video']],
                    ['view',['fullscreen','codeview','help']]
                ]
            });

        });
    </script>
    
@endsection
