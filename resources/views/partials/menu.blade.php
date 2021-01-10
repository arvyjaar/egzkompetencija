<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">Kompetencijos vertinimas</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route("admin.home") }}" class="nav-link">
                        <p>
                            <i class="fas fa-fw fa-tachometer-alt">

                            </i>
                            <span>Meniu</span>
                        </p>
                    </a>
                </li>
                @can('user_edit')
                <li
                    class="nav-item has-treeview {{ request()->is('admin/permissions*') ? 'menu-open' : '' }} {{ request()->is('admin/roles*') ? 'menu-open' : '' }} {{ request()->is('admin/users*') ? 'menu-open' : '' }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users">

                        </i>
                        <p>
                            <span>{{ trans('cruds.userManagement.title') }}</span>
                            <i class="right fa fa-fw fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('is_admin')
                        <li class="nav-item">
                            <a href="{{ route("admin.permissions.index") }}"
                                class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt">

                                </i>
                                <p>
                                    <span>{{ trans('cruds.permission.title') }}</span>
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('is_admin')
                        <li class="nav-item">
                            <a href="{{ route("admin.roles.index") }}"
                                class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-briefcase">

                                </i>
                                <p>
                                    <span>{{ trans('cruds.role.title') }}</span>
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('user_edit')
                        <li class="nav-item">
                            <a href="{{ route("admin.users.index") }}"
                                class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user">

                                </i>
                                <p>
                                    <span>{{ trans('cruds.user.title') }}</span>
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @endcan
                @can('report_access')
                <li class="nav-item">
                    <a href="{{ route("admin.reports.index") }}"
                        class="nav-link {{ request()->is('admin/reports') || request()->is('admin/reports/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-star-half-alt"></i>
                        <p>
                            <span>{{ trans('cruds.report.title') }}</span>
                        </p>
                    </a>
                </li>
                @endcan
                @can('criterion_access')
                <li class="nav-item has-treeview 
                        {{ request()->is('admin/criteria*') ? 'menu-open' : '' }} 
                        {{ request()->is('admin/forms*') ? 'menu-open' : '' }}
                        {{ request()->is('admin/competencies*') ? 'menu-open' : '' }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-toolbox"></i>
                        <p>
                            <span>{{ trans('global.settings') }}</span>
                            <i class="right fa fa-fw fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('criterion_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.competencies.index") }}"
                                class="nav-link {{ request()->is('admin/competencies') || request()->is('admin/competencies/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-file-alt">

                                </i>
                                <p>
                                    <span>{{ trans('cruds.competency.title') }}</span>
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('criterion_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.criteria.index") }}"
                                class="nav-link {{ request()->is('admin/criteria') || request()->is('admin/criteria/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-file-alt">

                                </i>
                                <p>
                                    <span>{{ trans('cruds.criterion.title') }}</span>
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('criterion_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.criteria.index") }}"
                                class="nav-link {{ request()->is('admin/forms') || request()->is('admin/forms/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-file-alt">

                                </i>
                                <p>
                                    <span>{{ trans('cruds.form.title') }}</span>
                                </p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                <li class="nav-item">
                    <a href="#" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p class="text-info">
                            <i class="fas fa-fw fa-sign-out-alt">

                            </i>
                            <span>Atsijungti</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>