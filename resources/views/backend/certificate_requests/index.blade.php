@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">

        {{-- breadcrumb part --}}
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-folder"></i>
                    {{ __('panel.manage_certificate_requests') }}
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
                        {{ __('panel.show_certificate_requests') }}
                    </li>
                </ul>
            </div>
            <div class="ml-auto">
                @ability('admin', 'create_certificate_requests')
                    <a href="{{ route('admin.certificate_requests.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus-square"></i>
                        </span>
                        <span class="text">{{ __('panel.add_new_content') }}</span>
                    </a>
                @endability
            </div>
        </div>

        {{-- @include('backend.certificate_requests.filter.filter') --}}

        <div class="card-body">

            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>{{ __('panel.full_name') }}</th>
                        <th class="d-none d-sm-table-cell">{{ __('panel.course_name') }}</th>
                        <th>{{ __('panel.status') }}</th>
                        <th class="d-none d-sm-table-cell">{{ __('panel.created_at') }}</th>
                        <th class="text-center" style="width:30px;">{{ __('panel.actions') }}</th>

                    </tr>
                </thead>


                <tbody>
                    @forelse ($certificate_requests as $certificate_request)
                        <tr>
                            <td>
                                {{ $certificate_request->full_name }}
                            </td>
                            <td class="d-none d-sm-table-cell">{{ $certificate_request->course->title }}</td>
                            <td>
                                <span class="btn btn-round rounded-pill btn-success btn-xs">
                                    {{ $certificate_request->status() }}
                                </span>
                            </td>

                            <td class="d-none d-sm-table-cell">{{ $certificate_request->created_at }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    @ability('admin', 'update_certificate_requests')
                                        <a href="{{ route('admin.certificate_requests.edit', $certificate_request->id) }}"
                                            class="btn btn-primary" title="Edit the certificate_request">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endability
                                    <a href="javascript:void(0);" class="btn btn-success copyButton"
                                        data-copy-text="certificate_requests/{{ $certificate_request->slug }}"
                                        title="Copy the link">
                                        <i class="far fa-copy"></i>
                                    </a>
                                    <span class="copyMessage" style="display:none;">{{ __('panel.copied') }}</span>

                                    @ability('admin', 'delete_certificate_requests')
                                        <a href="javascript:void(0);"
                                            onclick="if(confirm('{{ __('panel.confirm_delete_message') }}')){document.getElementById('delete-product-category-{{ $certificate_request->id }}').submit();}else{return false;}"
                                            class="btn btn-danger" title="Delete the certificate_request">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    @endability

                                </div>
                                <form action="{{ route('admin.certificate_requests.destroy', $certificate_request->id) }}"
                                    method="post" class="d-none"
                                    id="delete-product-category-{{ $certificate_request->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">{{ __('panel.no_found_item') }}</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

    </div>

    @endsection @section('script')
    <style>
        .copyButton {
            position: relative;
        }

        .copyMessage {
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            display: none;
            z-index: 1000;
            font-size: 12px;
            width: auto;
            /* Ensure width fits content */
            white-space: nowrap;
            /* Prevents line break to ensure width fits content */
        }
    </style>

    <script>
        document.querySelectorAll(".copyButton").forEach(function(button) {
            button.addEventListener("click", function(event) {
                event.preventDefault(); // Prevent form submission
                var textToCopy = button.getAttribute("data-copy-text"); // Get the dynamic text
                var tempInput = document.createElement("input");
                tempInput.value = textToCopy;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand("copy");
                document.body.removeChild(tempInput);

                var copyMessage = button.nextElementSibling; // Get the copyMessage span
                copyMessage.style.display = "inline";
                setTimeout(function() {
                    copyMessage.style.display = "none";
                }, 2000); // Hide the message after 2 seconds
            });
        });
    </script>
@endsection
