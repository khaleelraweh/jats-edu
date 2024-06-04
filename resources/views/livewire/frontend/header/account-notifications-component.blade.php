<div>
    <li class="nav-item border-0 px-0">
        <a href="#"
            class="nav-link d-flex px-3 px-md-4 position-relative {{ !request()->routeIs('frontend.index') ? 'text-secondary' : 'text-white-all' }}  icon-xs "
            id="navbarDocumentation" id="page-header-notifications-dropdown" data-bs-toggle="dropdown"
            aria-expanded="false">
            <i class="ri-notification-3-line"></i>
            <span class="badge badge-coral text-white rounded-circle fw-bold badge-float mt-n1 ms-n2 px-0 w-16"
                style="font-size: 8px;">2</span>
        </a>

        <div class="dropdown-menu border-xl shadow-none dropdown-menu-md dropdown-menu-end p-0"
            aria-labelledby="page-header-notifications-dropdown">
            <div class="p-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-0"> Notifications</h6>
                    </div>
                    <div class="col-auto">
                        <a href="#!" class="small"> View All</a>
                    </div>
                </div>
            </div>
            <div data-simplebar style="max-height: 230px;">

                <div class="dropdown-item text-center">No notification found</div>
            </div>
            <div class="p-2 border-top">
                <div class="d-grid">
                    <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                        <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                    </a>
                </div>
            </div>
        </div>
    </li>
</div>
