@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-folder"></i>
                    {{ __('panel.manage_courses') }}
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
                        {{ __('panel.show_courses') }}
                    </li>
                </ul>
            </div>

            <div class="ml-auto">
                @ability('admin', 'create_courses')
                    <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus-square"></i>
                        </span>
                        <span class="text">{{ __('panel.add_new_course') }}</< /span>
                    </a>
                @endability
            </div>

        </div>

        <div class="card-body">
            {{-- filter form part  --}}
            @include('backend.courses.filter.filter')

            {{-- table part --}}
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>{{ __('panel.image') }}</th>
                            <th>{{ __('panel.title') }}</th>
                            <th>{{ __('panel.price') }}</th>
                            <th class="d-none d-sm-table-cell">{{ __('panel.author') }}</th>
                            <th class="d-none d-sm-table-cell">{{ __('panel.views') }}</th>
                            <th class="d-none d-sm-table-cell"> {{ __('panel.created_at') }} </th>
                            <th class="d-none d-sm-table-cell">{{ __('panel.status') }}</th>
                            <th class="text-center" style="width:30px;">{{ __('panel.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($courses as $course)
                            <tr>

                                <td>

                                    @php
                                        if ($course->firstMedia != null && $course->firstMedia->file_name != null) {
                                            $course_img = asset('assets/courses/' . $course->firstMedia->file_name);

                                            if (
                                                !file_exists(
                                                    public_path('assets/courses/' . $course->firstMedia->file_name),
                                                )
                                            ) {
                                                $course_img = asset('image/not_found/placeholder.jpg');
                                            }
                                        } else {
                                            $course_img = asset('image/not_found/placeholder.jpg');
                                        }
                                    @endphp
                                    <img src="{{ $course_img }}" width="60" height="60"
                                        alt="{{ $course->title }}">

                                </td>
                                <td>{{ $course->title }}</td>
                                <td>

                                    @if ($course->offer_price > 0)
                                        @if ($course->offer_price == $course->price)
                                            <del class="font-size-sm"><small>{{ currency_converter($course->price) }}</small>
                                            </del>
                                            <ins class="h5 mb-0 d-block mb-lg-n1" style="text-decoration: none">
                                                {{ __('transf.free') }}
                                            </ins>
                                        @else
                                            <del class="font-size-sm"><small>{{ currency_converter($course->price) }}</small>
                                            </del>
                                            <ins class="h5 mb-0 d-block mb-lg-n1"
                                                style="text-decoration: none">{{ currency_converter($course->price - $course->offer_price) }}
                                            </ins>
                                        @endif
                                    @else
                                        <ins class="h5 mb-0 d-block mb-lg-n1" style="text-decoration: none">
                                            @if ($course->price == 0)
                                                {{ __('transf.free') }}
                                            @else
                                                {{ currency_converter($course->price) }}
                                            @endif

                                        </ins>
                                    @endif




                                </td>
                                <td class="d-none d-sm-table-cell">{{ $course->created_by }}</td>
                                <td class="d-none d-sm-table-cell">{{ $course->views }}</td>
                                <td class="d-none d-sm-table-cell">{{ $course->created_at }}</td>
                                <td class="d-none d-sm-table-cell">{{ $course->status() }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.courses.show', $course->id) }}" class="btn btn-success">
                                            <i class="fa fa-eye"></i>
                                        </a>




                                        @if ($course->users->first()->hasRole('admin') || $course->users->first()->hasRole('supervisor'))
                                            <a href="{{ route('instructor.courses.edit', $course->id) }}"
                                                class="btn btn-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('admin.courses.edit', $course->id) }}"
                                                class="btn btn-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @endif




                                        <a href="javascript:void(0);"
                                            onclick=" if( confirm('Are you sure to delete this record?') ){document.getElementById('delete-product-{{ $course->id }}').submit();}else{return false;}"
                                            class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                    <form action="{{ route('admin.courses.destroy', $course->id) }}" method="post"
                                        class="d-none" id="delete-product-{{ $course->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No Product cards found</td>
                            </tr>
                        @endforelse
                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="9">
                                <div class="float-right">
                                    {!! $courses->appends(request()->all())->links() !!}
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>
@endsection
