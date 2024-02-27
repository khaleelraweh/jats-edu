@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">

        {{-- menu part  --}}
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">المنتجات</h6>
            <div class="ml-auto">
                @ability('admin','create_products')
                <a href="{{route('admin.products.create')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">إضافة منتج جديد</span>
                </a>
                @endability
            </div>
        </div>

        {{-- filter form part  --}}

        @include('backend.products.filter.filter')

        {{-- table part --}}
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>الصورة</th>
                        <th>العنوان</th>
                        <th>الكمية</th>
                        <th>سعر الحبة</th>
                        {{-- <th>Tags</th> --}}
                        <th>الكاتب</th>
                        <th>تاريخ النشر </th>
                        <th>عدد المشاهدات </th>
                        <th>الحالة</th>
                        <th class="text-center" style="width:30px;">الاعدادات</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($products as $product)
                    <tr>

                        {{-- To make code better by making laravel cal only first media using relation shap to low querys --}}
                        <td>
                            @if ($product->firstMedia)
                                {{-- <td><img src="{{asset('assets/products/'.$product->photos()->first()->file_name)}}" width="60" alt="product Image"> </td> --}}
                                <img src="{{asset('assets/products/'.$product->firstMedia->file_name)}}" width="60" height="60" alt="{{$product->name}}"> 
                            @else
                                <img src="{{asset('assets/No-Image-Found.png')}}"  width="60" height="60" alt="{{$product->name}}">
                            @endif
                        
                        </td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->created_by}}</td>
                        <td>{{$product->published_on}}</td>
                        <td>{{$product->views}}</td>
                        <td>{{$product->status()}}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('admin.products.edit', $product->id)}}" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a 
                                    href="javascript:void(0);" 
                                    onclick=" if( confirm('Are you sure to delete this record?') ){document.getElementById('delete-product-{{$product->id}}').submit();}else{return false;}" 
                                    class="btn btn-danger"
                                >
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{route('admin.products.destroy',$product->id)}}" method="post" class="d-none" id="delete-product-{{$product->id}}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No Products found</td>
                    </tr>
                @endforelse    
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="9">
                            <div class="float-right">
                                {!! $products->appends(request()->all())->links() !!}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
@endsection
