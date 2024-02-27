@extends('layouts.admin')
{{-- @section('style')

    <!-- DataTables -->
    <link href="{{asset('backend/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css')}}" />
    <link href="{{asset('backend/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css')}}" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('backend/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />         

@endsection --}}

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">تصنيف المنتجات</h4>

                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{route('admin.product_categories.index')}}">الاقسام</a></li>
                          <li class="breadcrumb-item active" aria-current="page">عرض</li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->


    
    {{-- save is  --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                {{-- menu part  --}}
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">تصنيف المنتجات</h6>
                    <div class="ml-auto">
                        @ability('admin','create_product_categories')
                        <a href="{{route('admin.product_categories.create')}}" class="btn btn-primary">
                            <span class="icon text-white-50">
                                <i class="fa fa-plus"></i>
                            </span>
                            <span class="text">إضافة تصنيف جديد</span>
                        </a>
                        @endability
                    </div>
                </div>


                <div class="card-body">

                    {{-- filter form part  --}}
                    @include('backend.product_categories.filter.filter')

                    {{-- table part --}}
                    <div class="table-responsive">
                        <table  class="table table-hover table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>اسم الصنف</th>
                                    <th>عدد المنتجات</th>
                                    <th>الكاتب</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th class="text-center" style="width:30px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>
                                        {{-- <img src="{{asset('assets/product_categories/girls-s-electronies_16999441521.jpg')}}" alt="not found"> --}}
                                        {{$category->name}}
                                    </td>
                                    <td>{{$category->products_count}}</td>
                                    <td>{{$category->created_by}}</td>
                                    <td><span class="btn btn-round  rounded-pill btn-success btn-xs">{{$category->status()}}</span></td>
                                    <td>{{$category->created_at}}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{route('admin.product_categories.edit', $category->id)}}" class="btn btn-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a 
                                                href="javascript:void(0);" 
                                                onclick=" if( confirm('Are you sure to delete this record?') ){document.getElementById('delete-product-category-{{$category->id}}').submit();}else{return false;}" 
                                                class="btn btn-danger"
                                            >
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                        <form action="{{route('admin.product_categories.destroy',$category->id)}}" method="post" class="d-none" id="delete-product-category-{{$category->id}}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No categories found</td>
                                </tr>
                            @endforelse    
                            </tbody>
                            
                        </table>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <div class="float-right">
                                        {!! $categories->appends(request()->all())->links() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div> 
    <!-- end row -->

    
    
@endsection

{{-- @section('script')
      <!-- Buttons examples -->
      <script src="{{asset('backend/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
      <script src="{{asset('backend/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
      <script src="{{asset('backend/libs/jszip/jszip.min.js')}}"></script>
      <script src="{{asset('backend/libs/pdfmake/build/pdfmake.min.js')}}"></script>
      <script src="{{asset('backend/libs/pdfmake/build/vfs_fonts.js')}}"></script>
      <script src="{{asset('backend/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
      <script src="{{asset('backend/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
      <script src="{{asset('backend/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>

      <script src="{{asset('backend/libs/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
      <script src="{{asset('backend/libs/datatables.net-select/js/dataTables.select.min.js')}}"></script>
@endsection --}}