@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">

        {{-- breadcrumb part --}}
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-folder"></i>
                    {{ __('panel.manage_page_views') }}
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
                        {{ __('panel.show_pages') }}
                    </li>
                </ul>
            </div>
        </div>

        <div class="card-body">

            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>{{ __('panel.page_name') }}</th>
                        <th>{{ __('panel.views') }}</th>
                        <th>{{ __('panel.actions') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($inst_page_visits as $inst_page_visit)
                        {{-- Main Row --}}
                        <tr class="main-row" data-toggle="sub-row-{{ $inst_page_visit->id }}">
                            <td>
                                {{ $inst_page_visit->page }}
                            </td>
                            <td>
                                {{ $inst_page_visit->views }}
                            </td>
                            <td>
                                @if ($inst_page_visit->courses->isNotEmpty())
                                    <button class="btn btn-primary btn-sm toggle-sub-row"
                                        data-target="sub-row-{{ $inst_page_visit->id }}">
                                        <i class="fa fa-eye me-1"></i>
                                        {{ __('panel.view_courses_views') }}
                                    </button>
                                @endif
                                @if ($inst_page_visit->posts->isNotEmpty())
                                    <button class="btn btn-primary btn-sm toggle-sub-row"
                                        data-target="sub-row-{{ $inst_page_visit->id }}">
                                        <i class="fa fa-eye me-1"></i>
                                        {{ __('panel.view_posts_views') }}
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @if ($inst_page_visit->courses->isNotEmpty())
                            {{-- Hidden Sub-Row --}}
                            <tr id="sub-row-{{ $inst_page_visit->id }}" class="sub-row" style="display: none;">
                                <td colspan="3">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>{{ __('panel.view_courses_views') }}</th>
                                                <th>{{ __('panel.views') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($inst_page_visit->courses as $course)
                                                <tr>
                                                    <td>{{ $course->title }}</td>
                                                    <td>{{ $course->views }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>

                            </tr>
                        @endif
                        @if ($inst_page_visit->posts->isNotEmpty())
                            {{-- Hidden Sub-Row --}}
                            <tr id="sub-row-{{ $inst_page_visit->id }}" class="sub-row" style="display: none;">
                                <td colspan="3">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>{{ __('panel.view_posts_views') }}</th>
                                                <th>{{ __('panel.views') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($inst_page_visit->posts as $post)
                                                <tr>
                                                    <td>{{ $post->title }}</td>
                                                    <td>{{ $post->views }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>

                            </tr>
                        @endif

                    @empty
                        <tr>
                            <td colspan="3" class="text-center">{{ __('panel.no_found_item') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    {{-- JavaScript --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listener to toggle buttons
            document.querySelectorAll('.toggle-sub-row').forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.dataset.target;
                    const targetRow = document.getElementById(targetId);

                    // Toggle the display of the sub-row
                    if (targetRow.style.display === 'none') {
                        targetRow.style.display = '';
                    } else {
                        targetRow.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endsection
