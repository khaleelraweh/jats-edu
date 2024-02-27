@extends('layouts.admin')
@section('content')
    <div class="card_codes shadow mb-4">

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-folder"></i>
                    {{ __('panel.manage_card_codes') }}

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
                        {{ __('panel.show_card_codes') }}
                    </li>
                </ul>
            </div>
            <div class="ml-auto">
                @ability('admin', 'create_card_codes')
                    <a href="{{ route('admin.card_codes.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus-square"></i>
                        </span>
                        <span class="text">{{ __('panel.add_new_card_codes') }}</span>
                    </a>
                @endability
            </div>

        </div>

        <div class="card-body">
            {{-- filter form part 
            @include('backend.card_codes.filter.filter_avalible') --}}

            @php
                $index_used = 0;
                $active_used = false;
                $index_aval = 0;
                $active_aval = false;
                static $count = 0;

                if (isset($_GET['used_codes']) && isset($_GET['available_codes'])) {
                    foreach (request()->all() as $key => $value) {
                        if ($key == 'used_codes') {
                            $index_used = $count;
                        } elseif ($key == 'available_codes') {
                            $index_aval = $count;
                        }
                        $count++;
                    }
                    if ($index_used > $index_aval) {
                        $active_used = true;
                    } elseif ($index_aval > $index_used) {
                        $active_aval = true;
                    } else {
                        $active_aval = true;
                    }
                } elseif (isset($_GET['used_codes'])) {
                    $active_used = true;
                } elseif (isset($_GET['available_codes'])) {
                    $active_aval = true;
                } else {
                    $active_aval = true;
                }

            @endphp

            {{-- {{ $index_used }} --}}

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $active_aval ? 'active' : '' }} " id="cc_available_code-tab"
                        data-bs-toggle="tab" data-bs-target="#cc_available_code" type="button" role="tab"
                        aria-controls="cc_available_code" aria-selected="true">
                        <i class="fa fa-code"></i>
                        {{ __('panel.cc_available_code') }}
                    </button>
                </li>


                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $active_used ? 'active' : '' }}" id="cc_codes_used-tab" data-bs-toggle="tab"
                        data-bs-target="#cc_codes_used" type="button" role="tab" aria-controls="cc_codes_used"
                        aria-selected="false">
                        <i class="fa fa-code"></i>
                        {{ __('panel.cc_codes_used') }}
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link main-back-color" id="cc_codes_used_by_administration-tab" data-bs-toggle="tab"
                        data-bs-target="#cc_codes_used_by_administration" type="button" role="tab"
                        aria-controls="cc_codes_used_by_administration" aria-selected="false">
                        <i class="fa fa-code"></i>
                        {{ __('panel.cc_codes_used_by_administration') }}
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="cc_using_and_printing_codes-tab" data-bs-toggle="tab"
                        data-bs-target="#cc_using_and_printing_codes" type="button" role="tab"
                        aria-controls="cc_using_and_printing_codes" aria-selected="false">
                        <i class="fa fa-code"></i>
                        {{ __('panel.cc_using_and_printing_codes') }}
                    </button>
                </li>


            </ul>


            <div class="tab-content" id="myTabContent">

                {{-- {{ app('request')->input('used_codes') }} --}}
                {{-- {{ request()->used_codes }} --}}


                {{-- @foreach (request()->all() as $key => $item)
                    {{ $key }} => {{ $item }}
                @endforeach --}}

                <div class="tab-pane fade {{ $active_aval ? 'show active' : '' }} " id="cc_available_code" role="tabpanel"
                    aria-labelledby="cc_available_code-tab">

                    {{-- filter form part  --}}
                    @include('backend.card_codes.filter.filter_available')

                    {{-- table for available code   --}}
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th class="d-none d-sm-table-cell"> {{ __('panel.cc_code_type') }}</th>
                                    <th>{{ __('panel.cc_code') }}</th>
                                    <th> {{ __('panel.card_name') }}</th>
                                    <th>{{ __('panel.status') }}</th>
                                    <th class="d-none d-sm-table-cell"> {{ __('panel.created_at') }}</th>
                                    <th class="text-center" style="width:30px;">{{ __('panel.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($available_card_codes as $card_code)
                                    <tr>
                                        <td class="d-none d-sm-table-cell">
                                            <span class="btn btn-primary"> {{ $card_code->code_type() }}</span>
                                        </td>
                                        <td>{{ $card_code->code }}</td>
                                        <td>{{ $card_code->product->product_name }}</td>
                                        <td>
                                            <span class="btn btn-success "> {{ $card_code->status() }}
                                            </span>
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            {{ $card_code->created_at->format('Y-m-d h:i a') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.card_codes.show', $card_code->id) }}"
                                                    class="btn btn-primary">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="javascript:void(0);"
                                                    onclick=" if( confirm('Are you sure to delete this record?') ){document.getElementById('delete-order-{{ $card_code->id }}').submit();}else{return false;}"
                                                    class="btn btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                            <form action="{{ route('admin.card_codes.destroy', $card_code->id) }}"
                                                method="post" class="d-none" id="delete-order-{{ $card_code->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">{{ __('panel.no_found_item') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <div class="float-right">
                                            {!! $available_card_codes->appends(request()->all())->links() !!}
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>

                <div class="tab-pane fade {{ $active_used ? 'show active' : '' }}" id="cc_codes_used" role="tabpanel"
                    aria-labelledby="cc_codes_used-tab">

                    {{-- filter form part  --}}
                    @include('backend.card_codes.filter.filter_used')

                    {{-- table for codes used    --}}
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th class="d-none d-sm-table-cell"> {{ __('panel.cc_code_type') }}</th>
                                    <th>{{ __('panel.cc_code') }}</th>
                                    <th> {{ __('panel.card_name') }}</th>
                                    <th>{{ __('panel.status') }}</th>
                                    <th class="d-none d-sm-table-cell"> {{ __('panel.created_at') }}</th>
                                    <th class="text-center" style="width:30px;">{{ __('panel.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($used_card_codes as $card_code)
                                    <tr>
                                        <td class="d-none d-sm-table-cell">
                                            <span class="btn btn-primary"> {{ $card_code->code_type() }}</span>
                                        </td>
                                        <td>{{ $card_code->code }}</td>
                                        <td>{{ $card_code->product->product_name }}</td>
                                        <td>
                                            <span class="btn btn-success "> {{ $card_code->status() }}
                                            </span>
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            {{ $card_code->created_at->format('Y-m-d h:i a') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.card_codes.show', $card_code->id) }}"
                                                    class="btn btn-primary">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="javascript:void(0);"
                                                    onclick=" if( confirm('Are you sure to delete this record?') ){document.getElementById('delete-order-{{ $card_code->id }}').submit();}else{return false;}"
                                                    class="btn btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                            <form action="{{ route('admin.card_codes.destroy', $card_code->id) }}"
                                                method="post" class="d-none" id="delete-order-{{ $card_code->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">{{ __('panel.no_found_item') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <div class="float-right">
                                            {!! $used_card_codes->appends(request()->all())->links() !!}
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="cc_codes_used_by_administration" role="tabpanel"
                    aria-labelledby="cc_codes_used_by_administration-tab">
                    {{ __('panel.cc_codes_used_by_administration') }}
                </div>

                <div class="tab-pane fade" id="cc_using_and_printing_codes" role="tabpanel"
                    aria-labelledby="cc_using_and_printing_codes-tab">
                    {{ __('panel.cc_using_and_printing_codes') }}
                </div>

            </div>

        </div>

    </div>
@endsection
