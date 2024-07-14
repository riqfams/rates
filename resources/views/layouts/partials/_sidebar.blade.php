<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div id="kt_app_sidebar_wrapper" class="app-sidebar-wrapper hover-scroll-y my-5 my-lg-2" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_header" data-kt-scroll-wrappers="#kt_app_sidebar_wrapper" data-kt-scroll-offset="5px">
        <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false" class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary px-6 mb-5">
            <div class="menu-item">
                <a class="menu-link {{ request()->is(['dashboard', 'dashboard/*']) ? 'active ' : '' }}" href="{{ route('dashboard') }}">
                    <span class="menu-icon">
                        <i class="fas fa-th fs-2"></i>
                    </span>
                    <span class="menu-title">{{ __('sidebar.dashboard') }}</span>
                </a>
            </div>

            {{-- @canany(['roles-view', 'permission-view'])
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->is(['master', 'master/*']) ? 'here show' : '' }}">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fas fa-database fs-2"></i>
                        </span>
                        <span class="menu-title">Master Data</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ request()->is(['master/mutasis', 'master/mutasis/*']) ? 'active ' : '' }}" href="{{ route('master.mutasis.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Mutasi</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ request()->is(['master/category-coas', 'master/category-coas/*']) ? 'active ' : '' }}" href="{{ route('master.category-coas.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Category CoA</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ request()->is(['master/detail-coas', 'master/detail-coas/*']) ? 'active ' : '' }}" href="{{ route('master.detail-coas.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Detail CoA</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endcanany --}}

            @canany(['users-view', 'roles-view', 'permission-view'])
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->is(['resources', 'resources/*']) ? 'here show' : '' }}">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="bi bi-shield-fill-check fs-2"></i>
                    </span>
                    <span class="menu-title">Super Admin Control</span>
                    <span class="menu-arrow"></span>
                </span>

                <div class="menu-sub menu-sub-accordion">
                    @can ('users-view')
                    <div class="menu-item">
                        <a class="menu-link {{ request()->is(['resources/users', 'resources/users/*']) ? 'active ' : '' }}" href="{{ route('resources.users.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Users</span>
                        </a>
                    </div>
                    @endcan
                    @can ('roles-list')
                    <div class="menu-item">
                        <a class="menu-link {{ request()->is(['resources/roles', 'resources/roles/*']) ? 'active ' : '' }}" href="{{ route('resources.roles.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Roles</span>
                        </a>
                    </div>
                    @endcan
                    @can ('permission-view')
                    <div class="menu-item">
                        <a class="menu-link {{ request()->is(['resources/permissions', 'resources/permissions/*']) ? 'active ' : '' }}" href="{{ route('resources.permissions.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Permission</span>
                        </a>
                    </div>
                    @endcan
                    @canany(['setting-general', 'setting-smtp', 'config-view'])
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->is(['resources/setting', 'resources/setting/*']) ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Settings</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            @can ('setting-general')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is(['resources/setting/general',]) ? 'active ' : '' }}" href="{{ route('resources.setting.general.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">General Settings</span>
                                </a>
                            </div>
                            @endcan
                            @can ('setting-smtp')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is(['resources/setting/smtp',]) ? 'active ' : '' }}" href="{{ route('resources.setting.smtp.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">SMTP Settings</span>
                                </a>
                            </div>
                            @endcan
                            @can ('config-view')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is(['resources/setting/config', 'resources/setting/config/*']) ? 'active ' : '' }}" href="{{ route('resources.setting.config.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Config Settings</span>
                                </a>
                            </div>
                            @endcan
                        </div>
                    </div>
                    @endcanany
                </div>
            </div>
            @endcanany
        </div>
    </div>
</div>
