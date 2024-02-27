@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-folder"></i>
                    {{ __('panel.manage_orders') }}

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
                        {{ __('panel.show_orders') }}
                    </li>
                </ul>
            </div>



        </div>

        <div class="card-body">
            {{-- filter form part  --}}
            @include('backend.orders.filter.filter')

            {{-- table part --}}
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th class="d-none d-sm-table-cell"> {{ __('panel.ref_id') }}</th>
                            <th>{{ __('panel.customer_name') }}</th>
                            <th> {{ __('panel.payment_method') }}</th>
                            <th>{{ __('panel.qty') }}</th>
                            <th>{{ __('panel.status') }}</th>
                            <th class="d-none d-sm-table-cell"> {{ __('panel.created_at') }}</th>
                            <th class="text-center" style="width:30px;">{{ __('panel.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td class="d-none d-sm-table-cell">{{ $order->ref_id }}</td>
                                <td>{{ $order->user->full_name }}</td>
                                <td>{{ $order->payment_method?->name }}</td>
                                <td>{{ $order->currency() . $order->total }}</td>
                                <td>{!! $order->statusWithLabel() !!}</td>
                                <td class="d-none d-sm-table-cell">{{ $order->created_at->format('Y-m-d h:i a') }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="javascript:void(0);"
                                            onclick=" if( confirm('Are you sure to delete this record?') ){document.getElementById('delete-order-{{ $order->id }}').submit();}else{return false;}"
                                            class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="post"
                                        class="d-none" id="delete-order-{{ $order->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No Orders found</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <div class="float-right">
                                    {!! $orders->appends(request()->all())->links() !!}
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
@endsection
