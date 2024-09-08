<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                    id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
                {{-- App Search --}}
                <form class="app-search d-none d-md-block">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search..." autocomplete="off"
                            id="search-options" value="" />
                        <span class="mdi mdi-magnify search-widget-icon"></span>
                        <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                            id="search-close-options"></span>
                    </div>
                </form>
            </div>

            <div class="d-flex align-items-center">
                {{-- fullscreen --}}
                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        data-toggle="fullscreen">
                        <i class="bx bx-fullscreen fs-22"></i>
                    </button>
                </div>

                {{-- darkmode --}}
                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button"
                        class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class="bx bx-moon fs-22"></i>
                    </button>
                </div>

                {{-- Nav Links --}}
                <div>
                    <a href="{{ route('homepage') }}" class="btn btn-primary d-inline-block ms-2">Home</a>
                </div>
                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            @if (auth()->user()->role == 'owner')
                                <img class="rounded-circle header-profile-user"
                                    src="{{ $user->ownerDetails && $user->ownerDetails->img_url ? asset('uploads/' . $user->ownerDetails->img_url) : asset('assets/images/users/user-dummy-img.jpg') }}"
                                    alt="Header Avatar" />
                            @elseif(auth()->user()->role == 'company')
                                <img class="rounded-circle header-profile-user"
                                    src="{{ $user->companyDetails && $user->companyDetails->img_url ? asset('uploads/' . $user->companyDetails->img_url) : asset('assets/images/users/user-dummy-img.jpg') }}"
                                    alt="Header Avatar" />
                            @elseif(auth()->user()->role == 'candidate')
                                <img class="rounded-circle header-profile-user"
                                    src="{{ $user->candidateDetails && $user->candidateDetails->img_url ? asset('uploads/' . $user->candidateDetails->img_url) : asset('assets/images/users/user-dummy-img.jpg') }}"
                                    alt="Header Avatar" />
                            @endif
                            <span class="text-start ms-xl-2">
                                @if (auth()->user()->role == 'owner')
                                    <span
                                        class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ optional($user->ownerDetails)->name ? ucwords(optional($user->ownerDetails)->name) : auth()->user()->email }}
                                    </span>
                                    <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">Owner</span>
                                @elseif(auth()->user()->role == 'company')
                                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">
                                        {{ optional($user->companyDetails)->name ? ucwords(optional($user->companyDetails)->name) : auth()->user()->email }}
                                    </span>
                                    <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">Company</span>
                                @elseif(auth()->user()->role == 'candidate')
                                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">
                                        {{ optional($user->candidateDetails)->name ? ucwords(optional($user->candidateDetails)->name) : auth()->user()->email }}
                                    </span>
                                    <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">Candidate</span>
                                @endif
                            </span>
                        </span>
                    </button>

                    @if (auth()->check())
                        <div class="dropdown-menu dropdown-menu-end">
                            {{-- User  --}}
                            @if (auth()->user()->role == 'owner')
                                <h6 class="dropdown-header">Welcome
                                    {{ $user->ownerDetails ? ucwords($user->ownerDetails->name) : '' }}!
                                </h6>
                            @elseif(auth()->user()->role == 'company')
                                <h6 class="dropdown-header">Welcome
                                    {{ $user->companyDetails ? ucwords($user->companyDetails->name) : '' }}!
                                </h6>
                            @elseif(auth()->user()->role == 'candidate')
                                <h6 class="dropdown-header">Welcome
                                    {{ $user->candidateDetails ? ucwords($user->candidateDetails->name) : '' }}!
                                </h6>
                            @endif
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle">Profile</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item">
                                    <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                    <span class="align-middle" data-key="t-logout">Logout</span>
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>
