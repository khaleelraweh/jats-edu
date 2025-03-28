@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-folder"></i>
                    {{ __('panel.manage_teach_request') }}

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
                        {{ __('panel.show_teach_requests') }}
                    </li>
                </ul>
            </div>



        </div>

        <div class="card-body">
            {{-- filter form part  --}}
            @include('backend.teach_requests.filter.filter')

            {{-- table part --}}
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>{{ __('panel.applicants_name') }}</th>
                            <th>{{ __('panel.submission_status') }}</th>
                            <th>{{ __('panel.status') }}</th>
                            <th> {{ __('panel.created_at') }}</th>
                            <th class="text-center" style="width:30px;">{{ __('panel.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($teach_requests as $teach_request)
                            <tr>
                                <td>{{ $teach_request->full_name }}</td>
                                <td>{{ $teach_request->teach_request_status() }}</td>
                                <td>{{ $teach_request->status() }}</td>
                                <td>{{ $teach_request->created_at->format('Y-m-d h:i a') }}
                                </td>

                                <td>
                                    <div class="btn-group btn-group-sm">
                                        @ability('admin','show_teach_requests')
                                            <a href="{{ route('admin.teach_requests.show', $teach_request->id) }}"
                                                class="btn btn-primary">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        @endability
                                        @ability('admin','delete_teach_requests')
                                            <a href="javascript:void(0);"
                                                onclick=" if( confirm('Are you sure to delete this record?') ){document.getElementById('delete-teach_request-{{ $teach_request->id }}').submit();}else{return false;}"
                                                class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        @endability
                                    </div>
                                    <form action="{{ route('admin.teach_requests.destroy', $teach_request->id) }}"
                                        method="post" class="d-none" id="delete-teach_request-{{ $teach_request->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No teach requesgt found yet !!</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                <div class="float-right">
                                    {!! $teach_requests->appends(request()->all())->links() !!}
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
@endsection
