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
                    </tr>
                </thead>

                <tbody>
                    @forelse ($inst_page_visits as $inst_page_visit)
                        <tr>
                            <td>
                                {{ $inst_page_visit->page }}
                            </td>

                            <td>
                                {{ $inst_page_visit->views }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center">{{ __('panel.no_found_item') }}</td>
                        </tr>
                    @endforelse




                </tbody>
            </table>
        </div>

    </div>
@endsection
