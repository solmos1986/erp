<div class="app-menu">
    <div class="logo-box">
        <a href="index.html" class="logo-light">
            <img src="{{ asset('/images/logo-light.png') }}" alt="logo" class="logo-lg">
            <img src="{{ asset('/images/logo-sm.png') }}" alt="small logo" class="logo-sm">
        </a>
        <a href="index.html" class="logo-dark">
            <img src="{{ asset('/images/logo-dark.png') }}" alt="dark logo" class="logo-lg">
            <img src="{{ asset('/images/logo-sm.png') }}" alt="small logo" class="logo-sm">
        </a>
    </div>
    <div class="scrollbar">
        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{ asset('/images/users/user-1.jpg') }}" alt="user-img" title="Mat Helme"
                class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="dropdown-toggle h5 mb-1 d-block" data-bs-toggle="dropdown">Geneva
                    Kennedy</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings me-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock me-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a href="{{ route('auth.logout') }}" class="dropdown-item notify-item">
                        <i class="fe-log-out me-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-muted mb-0">Admin Head</p>
        </div>
        <!--- Menu -->
        <ul class="menu">
            @foreach (auth()->user()->obtener_menu() as $i => $supermodulo)
                <li class="menu-title">{{ $supermodulo->nombre_super_modulo }}</li>
                @foreach ($supermodulo->modulos as $key => $modulos)
                    <li class="menu-item">
                        <a href="#modulo{{ $key }}{{ $i }}" data-bs-toggle="collapse"
                            class="menu-link">
                            <span class="menu-icon">
                                <i data-feather="{{ $modulos->class_icon }}" class="icon-dual"></i>
                            </span>
                            <span class="menu-text">{{ $modulos->nombre_modulo }}</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="modulo{{ $key }}{{ $i }}">
                            <ul class="sub-menu">
                                @foreach ($modulos->sub_modulos as $sub_modulo)
                                    <li class="menu-item">
                                        <a href="{{ url('/') . $sub_modulo->url }}" class="menu-link">
                                            <span class="menu-text">{{ $sub_modulo->nombre_sub_modulo }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @endforeach
            @endforeach
        </ul>
        <!--- End Menu -->
        <div class="clearfix"></div>
    </div>
</div>
