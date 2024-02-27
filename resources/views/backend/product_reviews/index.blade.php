@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-folder"></i>
                    إدارة التعليقات
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            الرئيسية
                        </a>
                        <i class="fa fa-solid fa-chevron-left chevron"></i>
                    </li>
                    <li>
                        إدارة التعليقات
                    </li>
                </ul>
            </div>
        </div>

        {{-- filter form part  --}}

        @include('backend.product_reviews.filter.filter')

        {{-- table part --}}
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="d-none d-sm-table-cell">الاسم</th>
                        <th> عنوان التعليق</th>
                        <th>التقييم</th>
                        <th class="d-none d-sm-table-cell">المنتج</th>
                        <th>الحالة</th>
                        <th class="d-none d-sm-table-cell">تاريخ الانشاء</th>
                        <th class="text-center" style="width:30px;">الإعدادات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reviews as $review)
                        <tr>
                            <td class="d-none d-sm-table-cell">
                                {{ $review->name }} <br>
                                {{ $review->email }} <br>
                                <small>{!! $review->user_id != '' ? $review->user->full_name : '' !!}</small>
                            </td>
                            <td>
                                {{ $review->title }} <br>
                            </td>
                            <td>
                                <span class="badge bg-success"> {{ $review->rating }}</span>
                            </td>
                            <td class="d-none d-sm-table-cell">{{ $review->product->name }}</td>
                            <td>{{ $review->status() }}</td>
                            <td class="d-none d-sm-table-cell">{{ $review->created_at }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.product_reviews.edit', $review->id) }}"
                                        class="btn btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);"
                                        onclick=" if( confirm('Are you sure to delete this record?') ){document.getElementById('delete-product-review-{{ $review->id }}').submit();}else{return false;}"
                                        class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                                <form action="{{ route('admin.product_reviews.destroy', $review->id) }}" method="post"
                                    class="d-none" id="delete-product-review-{{ $review->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No Reviews found</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7">
                            <div class="float-right">
                                {!! $reviews->appends(request()->all())->links() !!}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
@endsection
