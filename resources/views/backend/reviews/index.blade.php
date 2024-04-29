@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-folder"></i>
                    {{ __('panel.manage_reviews') }}
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            {{ __('panel.main') }}
                        </a>
                        <i class="fa fa-solid fa-chevron-left chevron"></i>
                    </li>
                    <li>
                        {{ __('panel.show_reviews') }}
                    </li>
                </ul>
            </div>
        </div>


        {{-- filter form part  --}}

        @include('backend.reviews.filter.filter')



        {{-- table part --}}
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="d-none d-sm-table-cell">{{ __('panel.name') }}</th>
                        <th>{{ __('panel.review_title') }}</th>
                        <th>{{ __('panel.review_rating') }}</th>
                        <th>{{ __('panel.review_type') }}</th>
                        <th class="d-none d-sm-table-cell">{{ __('panel.review_link_title') }}</th>
                        <th>{{ __('panel.status') }}</th>
                        <th class="d-none d-sm-table-cell">{{ __('panel.created_at') }}</th>
                        <th class="text-center" style="width:30px;">{{ __('panel.actions') }}</th>
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
                            <td class="d-none d-sm-table-cell">
                                @if ($review->reviewable_type === 'App\Models\Course')
                                    @if ($review->reviewable->section == 1)
                                        {{ __('panel.review_type_course') }}
                                    @endif
                                    @if ($review->reviewable->section == 2)
                                        {{ __('panel.review_type_event') }}
                                    @endif
                                @elseif ($review->reviewable_type === 'App\Models\Post')
                                    {{ __('panel.review_type_post') }}
                                @else
                                @endif
                            </td>
                            <td class="d-none d-sm-table-cell">
                                {{ $review->reviewable->title }}
                            </td>
                            <td>{{ $review->status }}</td>
                            <td class="d-none d-sm-table-cell">{{ $review->created_at }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.reviews.edit', $review->id) }}" class="btn btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);"
                                        onclick=" if( confirm('Are you sure to delete this record?') ){document.getElementById('delete-course-review-{{ $review->id }}').submit();}else{return false;}"
                                        class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                                <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="post"
                                    class="d-none" id="delete-course-review-{{ $review->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No Reviews found</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8">
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
