@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-folder"></i>
                    {{ __('panel.manage_users') }}
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
                        {{ __('panel.show_customers') }}
                    </li>
                </ul>
            </div>
            <div class="ml-auto">
                @ability('admin', 'create_customers')
                    <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus-square"></i>
                        </span>
                        <span class="text">{{ __('panel.add_new_customer') }}</span>
                    </a>
                @endability
            </div>

        </div>

        <div class="card-body">
            {{-- filter form part  --}}
            @include('backend.customers.filter.filter')

            {{-- table part --}}
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th class="d-none d-sm-table-cell">{{ __('panel.image') }}</th>
                            <th>{{ __('panel.customer_name') }}</th>
                            <th class="d-none d-sm-table-cell">{{ __('panel.email') }} {{ __('panel.and') }}
                                {{ __('panel.mobile') }} </th>
                            <th>{{ __('panel.status') }}</th>
                            <th class="d-none d-sm-table-cell">{{ __('panel.created_at') }}</th>
                            <th class="text-center" style="width:30px;">{{ __('panel.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($customers as $customer)
                            <tr>
                                <td class="d-none d-sm-table-cell">
                                    @php
                                        if ($customer->user_image != null) {
                                            $customer_img = asset('assets/users/' . $customer->user_image);

                                            if (!file_exists(public_path('assets/users/' . $customer->user_image))) {
                                                $customer_img = asset('image/not_found/avator1.webp');
                                            }
                                        } else {
                                            $customer_img = asset('image/not_found/avator1.webp');
                                        }
                                    @endphp
                                    <img src="{{ $customer_img }}" width="60" height="60"
                                        alt="{{ $customer->full_name }}">

                                </td>
                                <td>
                                    {{ $customer->full_name }} <br>
                                    <small>
                                        <span class="bg-info px-2 text-white rounded-pill">
                                            {{ __('panel.username') }}:
                                            <strong>{{ $customer->username }}</strong>
                                        </span>
                                    </small>

                                </td>
                                <td class="d-none d-sm-table-cell">
                                    {{ $customer->email }} <br>
                                    {{ $customer->mobile }}
                                </td>
                                <td>{{ $customer->status() }}</td>
                                <td class="d-none d-sm-table-cell">{{ $customer->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.customers.edit', $customer->id) }}"
                                            class="btn btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>



                                        @if ($customer->hasRole('instructor') && $customer->courses->count() > 0)
                                            <a href="javascript:void(0);" onclick="showInstructorAlert()"
                                                class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        @else
                                            <a href="javascript:void(0);" onclick="confirmDelete({{ $customer->id }})"
                                                class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form action="{{ route('admin.customers.destroy', $customer->id) }}"
                                                method="post" class="d-none" id="delete-customer-{{ $customer->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif


                                    </div>

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
                                    {!! $customers->appends(request()->all())->links() !!}
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>

    <div class="modal fade" id="deleteWarningModal" tabindex="-1" aria-labelledby="deleteWarningLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteWarningLabel">{{ __('panel.cannot_delete') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="warningMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('panel.close') }}</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        function showInstructorAlert() {
            Swal.fire({
                icon: 'warning',
                title: '{{ __('panel.customer_has_instructor_role') }}',
                text: '{{ __('panel.customer_must_be_removed_from_instructor_panel') }}',
                confirmButtonText: '{{ __('panel.ok') }}',
            });
        }

        function confirmDelete(customerId) {
            Swal.fire({
                title: '{{ __('panel.confirm_delete_message') }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '{{ __('panel.yes_delete') }}',
                cancelButtonText: '{{ __('panel.cancel') }}',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-customer-' + customerId).submit();
                }
            });
        }
    </script>
@endsection
