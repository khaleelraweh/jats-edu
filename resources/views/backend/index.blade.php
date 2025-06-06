@extends('layouts.admin')

@section('content')
    {{-- <h2>Unique Visitors</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>IP Address</th>
                <th>Last Page</th>
                <th>Visited At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($visitors as $visitor)
                <tr>
                    <td>{{ $visitor->id }}</td>
                    <td>{{ $visitor->ip_address }}</td>
                    <td>{{ $visitor->last_page }}</td>
                    <td>{{ $visitor->visited_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Page Visits</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Page</th>
                <th>Visits</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pageVisits as $pageVisit)
                <tr>
                    <td>{{ $pageVisit->page }}</td>
                    <td>{{ $pageVisit->visits }}</td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}



    <!-- start page title -->
    <div class="row ">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ __('panel.dashboard') }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('panel.youth_step_institute') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('panel.dashboard') }}</li>
                    </ol>
                </div>

            </div>
        </div>

    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">{{ __('panel.total_students') }}</p>
                            <h4 class="mb-2">{{ $total_students }}</h4>
                        </div>
                        <div class="avatar-sm">
                            <span class="avatar-title bg-light text-primary rounded-3">
                                <i class="ri-shopping-cart-2-line font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">{{ __('panel.total_instructors') }}</p>
                            <h4 class="mb-2">{{ $total_instructors }}</h4>
                        </div>
                        <div class="avatar-sm">
                            <span class="avatar-title bg-light text-success rounded-3">
                                <i class="mdi mdi-currency-usd font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">{{ __('panel.total_courses') }}</p>
                            <h4 class="mb-2">{{ $total_courses }}</h4>
                        </div>
                        <div class="avatar-sm">
                            <span class="avatar-title bg-light text-primary rounded-3">
                                <i class="ri-user-3-line font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">{{ __('panel.total_company_requests') }}</p>
                            <h4 class="mb-2">{{ $total_company_requests }}</h4>
                        </div>
                        <div class="avatar-sm">
                            <span class="avatar-title bg-light text-success rounded-3">
                                <i class="mdi mdi-currency-btc font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

    {{-- -------------------------------------- --}}
    <h6 class="mb-3">{{ __('panel.courses_information') }}</h6>

    {{-- Course Info  --}}
    <div class="row">
        <div class="col-xl-2 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">{{ __('panel.new_courses') }}</p>
                            <h4 class="mb-2">{{ $total_new_courses }}</h4>
                        </div>
                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-xl-2 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">{{ __('panel.courses_completed') }}</p>
                            <h4 class="mb-2">{{ $total_courses_completed }}</h4>
                        </div>
                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-xl-2 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">{{ __('panel.courses_under_proccess') }}</p>
                            <h4 class="mb-2">{{ $total_courses_under_proccess }}</h4>
                        </div>
                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-xl-2 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">{{ __('panel.courses_review_finished') }}</p>
                            <h4 class="mb-2">{{ $total_courses_review_finished }}</h4>
                        </div>
                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-xl-2 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">{{ __('panel.courses_published') }}</p>
                            <h4 class="mb-2">{{ $total_courses_published }}</h4>
                        </div>
                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-xl-2 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">{{ __('panel.courses_rejected') }}</p>
                            <h4 class="mb-2">{{ $total_courses_rejected }}</h4>
                        </div>
                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->


    {{-- -------------------------------------- --}}
    <h6 class="mb-3">{{ __('panel.orders_information') }}</h6>

    {{-- Course Info  --}}
    <div class="row">
        <div class="col-xl-2 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">{{ __('panel.new_orders') }}</p>
                            <h4 class="mb-2">{{ $total_new_orders }}</h4>
                        </div>
                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-xl-2 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">{{ __('panel.completed_orders') }}</p>
                            <h4 class="mb-2">{{ $total_completed_orders }}</h4>
                        </div>
                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-xl-2 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">{{ __('panel.under_proccess_orders') }}</p>
                            <h4 class="mb-2">{{ $total_under_proccess_orders }}</h4>
                        </div>
                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-xl-2 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">{{ __('panel.finished_orders') }}</p>
                            <h4 class="mb-2">{{ $total_finished_orders }}</h4>
                        </div>
                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-xl-2 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">{{ __('panel.rejected_orders') }}</p>
                            <h4 class="mb-2">{{ $total_rejected_orders }}</h4>
                        </div>
                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-xl-2 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">{{ __('panel.canceled_orders') }}</p>
                            <h4 class="mb-2">{{ $total_canceled_orders }}</h4>
                        </div>
                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->

    </div><!-- end row -->
@endsection
