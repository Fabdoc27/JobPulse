{{-- left sidebar start --}}
<div class="app-menu navbar-menu">
    {{-- logo --}}
    <div class="navbar-brand-box">
        {{-- dark logo --}}
        <a href="{{ route('dashboard') }}" class="fs-3 fst-italic py-3  d-inline-block">
            <span class="fw-bold w-100 px-2"
                style=" background: linear-gradient(to right, #ff0057, #8a3ab9);
                -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            ">
                Job Pulse
            </span>
        </a>
        {{-- light logo --}}

        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            {{-- Menus --}}
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                {{-- Owner/Admin --}}
                @if (auth()->user()->role == 'owner')
                    {{-- dashboard --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('dashboard') }}">
                            <i data-feather="home" class="icon-dual"></i>
                            <span>Dashbord</span>
                        </a>
                    </li>

                    {{-- Companies --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('companies.index') }}">
                            <i class="bx bx-check-shield"></i>
                            <span data-key="t-widgets">Companies</span>
                        </a>
                    </li>

                    {{-- jobs --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('jobs.index') }}">
                            <i data-feather="briefcase" class="icon-dual"></i>
                            <span data-key="t-widgets">Jobs</span>
                        </a>
                    </li>

                    {{-- blogs --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('blogs.index') }}">
                            <i data-feather="edit-3" class="icon-dual"></i>
                            <span data-key="t-widgets">Blogs</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarPages" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarPages">
                            <i class="bx bx-book-content"></i>
                            <span>Pages</span>
                        </a>

                        {{-- pages --}}
                        <div class="collapse menu-dropdown" id="sidebarPages">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('page.create', ['page' => 'home']) }}" class="nav-link">
                                        Home
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('page.create', ['page' => 'about']) }}" class="nav-link">
                                        About
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('page.create', ['page' => 'jobs']) }}" class="nav-link">
                                        Jobs
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('page.create', ['page' => 'contact']) }}" class="nav-link">
                                        Contact
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarPlugins" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarPlugins">
                            <i class="bx bx-star"></i>
                            <span>Plugins</span>
                        </a>

                        {{-- plugins --}}
                        <div class="collapse menu-dropdown" id="sidebarPlugins">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('plugin.index') }}" class="nav-link">
                                        All Plugins
                                    </a>
                                </li>
                                @foreach ($plugins as $plugin)
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            {{ $plugin->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>

                    {{-- Company --}}
                @elseif(auth()->user()->role == 'company')
                    {{-- dashboard --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('dashboard') }}">
                            <i data-feather="home" class="icon-dual"></i>
                            <span>Dashbord</span>
                        </a>
                    </li>

                    {{-- jobs --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('jobs.index') }}">
                            <i data-feather="briefcase" class="icon-dual"></i>
                            <span data-key="t-widgets">Jobs</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarPlugins" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarPlugins">
                            <i class="bx bx-star"></i>
                            <span>Plugins</span>
                        </a>
                        {{-- plugins --}}
                        <div class="collapse menu-dropdown" id="sidebarPlugins">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('plugin.index') }}" class="nav-link">
                                        All Plugins
                                    </a>
                                </li>
                                @foreach ($plugins as $plugin)
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            {{ $plugin->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>

                    {{-- Candidate --}}
                @elseif(auth()->user()->role == 'candidate')
                    {{-- dashboard --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('dashboard') }}">
                            <i data-feather="home" class="icon-dual"></i>
                            <span>Dashbord</span>
                        </a>
                    </li>

                    {{-- jobs --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('jobs.index') }}">
                            <i data-feather="briefcase" class="icon-dual"></i>
                            <span data-key="t-widgets">Jobs</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    {{-- sidebar bg --}}
    <div class="sidebar-background"></div>
</div>
{{-- vertical overlay --}}
<div class="vertical-overlay"></div>
{{-- left sidebar end --}}
