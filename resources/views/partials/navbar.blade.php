<!-- Start Header Area -->
<header class="header-area bg-white mb-4 rounded-10 border border-white" id="header-area">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="left-header-content">
                <ul
                    class="d-flex align-items-center ps-0 mb-0 list-unstyled justify-content-center justify-content-md-start">
                    <li class="d-xl-none">
                        <button class="header-burger-menu bg-transparent p-0 border-0 position-relative top-3"
                            id="header-burger-menu">
                            <span class="border-1 d-block for-dark-burger"
                                style="border-bottom: 1px solid #475569; height: 1px; width: 25px;">
                            </span>
                            <span class="border-1 d-block for-dark-burger"
                                style="border-bottom: 1px solid #475569; height: 1px; width: 25px; margin: 6px 0;">
                            </span>
                            <span class="border-1 d-block for-dark-burger"
                                style="border-bottom: 1px solid #475569; height: 1px; width: 25px;">
                            </span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="right-header-content mt-3 mt-md-0">
                <ul
                    class="d-flex align-items-center justify-content-center justify-content-md-end ps-0 mb-0 list-unstyled">
                    <li class="header-right-item light-dark-item">
                        <div class="light-dark">
                            <button class="switch-toggle dark-btn p-0 bg-transparent lh-0 border-0" id="switch-toggle">
                                <span class="dark">
                                    <i class="material-symbols-outlined">
                                        dark_mode
                                    </i>
                                </span>
                                <span class="light">
                                    <i class="material-symbols-outlined">
                                        light_mode
                                    </i>
                                </span>
                            </button>
                        </div>
                    </li>
                    <li class="header-right-item">
                        <div class="dropdown admin-profile">
                            <div class="d-xxl-flex align-items-center bg-transparent border-0 text-start p-0 cursor dropdown-toggle"
                                data-bs-toggle="dropdown">
                                <div class="flex-shrink-0 position-relative">
                                    <img alt="admin" class="rounded-circle admin-img-width-for-mobile"
                                        src="{{ asset('assets/images/user.png') }}"
                                        style="width: 50px; height: 50px;" />
                                    <span
                                        class="d-block bg-success-60 border border-2 border-white rounded-circle position-absolute end-0 bottom-0"
                                        style="width: 11px; height: 11px;">
                                    </span>
                                </div>
                            </div>
                            <div class="dropdown-menu border-0 bg-white dropdown-menu-end">
                                <div class="d-flex align-items-center info">
                                    <div class="flex-shrink-0">
                                        <img alt="admin" class="rounded-circle admin-img-width-for-mobile"
                                            src="{{ asset('assets/images/user.png') }}"
                                            style="width: 50px; height: 50px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-10">
                                        <h3 class="fw-medium fs-17 mb-0 whitespace-break-spaces">
                                            {{ Auth::user()->name }}
                                        </h3>
                                        <span class="fs-15 fw-medium">
                                            {{ Auth::user()->roles->first()->name }}
                                        </span>
                                    </div>
                                </div>
                                <ul class="admin-link mb-0 list-unstyled">

                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item admin-item-link d-flex align-items-center text-body">
                                                <i class="material-symbols-outlined">
                                                    logout
                                                </i>
                                                <span class="ms-2">
                                                    Logout
                                                </span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
<!-- End Header Area -->
