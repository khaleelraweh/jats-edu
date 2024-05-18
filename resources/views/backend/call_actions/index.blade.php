@extends('layouts.admin')

@section('content')

    <div class="card shadow mb-4">
        {{-- {{ dd(Cookie::get('theme')) }} --}}

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex justify-content-between">

            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-folder"></i>
                    {{ __('panel.manage_call_actions') }}
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
                        {{ __('panel.show_call_actions') }}
                    </li>
                </ul>
            </div>

            <div class="ml-auto">
                @ability('admin', 'create_call_actions')
                    <a href="{{ route('admin.call_actions.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus-square"></i>
                        </span>
                        <span class="text">{{ __('panel.add_new_call_action') }}</span>
                    </a>
                @endability
            </div>

        </div>

        <div class="card-body">

            {{-- filter form part  --}}
            @include('backend.call_actions.filter.filter')

            {{-- table part --}}
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                        <tr>
                            <th>{{ __('panel.image') }}</th>
                            <th>{{ __('panel.title') }}</th>
                            <th class="d-none d-sm-table-cell">{{ __('panel.author') }}</th>
                            <th class="d-none d-sm-table-cell"> {{ __('panel.created_at') }} </th>
                            <th>{{ __('panel.status') }}</th>
                            <th class="text-center" style="width:30px;">{{ __('panel.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($callActions as $callAction)
                            <tr>
                                <td>
                                    @if ($callAction->firstMedia)
                                        <img src="{{ asset('assets/call_actions/' . $callAction->firstMedia->file_name) }}"
                                            width="60" height="60" alt="{{ $callAction->title }}">
                                    @else
                                        <img src="{{ asset('image/not_found/item_image_not_found.png') }}" width="60"
                                            height="60" alt="{{ $callAction->title }}">
                                    @endif

                                </td>
                                <td>{{ $callAction->title }}</td>
                                <td class="d-none d-sm-table-cell">{{ $callAction->created_by }}</td>
                                <td class="d-none d-sm-table-cell">{{ $callAction->created_at }}</td>
                                <td>{{ $callAction->status() }}</td>
                                <td>

                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.call_actions.edit', $callAction->id) }}"
                                            class="btn btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);"
                                            onclick=" if( confirm('{{ __('panel.confirm_delete_message') }}') ){document.getElementById('delete-product-{{ $callAction->id }}').submit();}else{return false;}"
                                            class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                    <form action="{{ route('admin.call_actions.destroy', $callAction->id) }}"
                                        method="post" class="d-none" id="delete-product-{{ $callAction->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center"> {{ __('panel.no_found_item') }} </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                <div class="float-right">
                                    {!! $callActions->appends(request()->all())->links() !!}
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>

    </div>
@endsection
