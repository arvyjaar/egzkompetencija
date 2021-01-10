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
                    <a href="<?php echo e(route("admin.home")); ?>" class="nav-link">
                        <p>
                            <i class="fas fa-fw fa-tachometer-alt">

                            </i>
                            <span>Meniu</span>
                        </p>
                    </a>
                </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_edit')): ?>
                <li
                    class="nav-item has-treeview <?php echo e(request()->is('admin/permissions*') ? 'menu-open' : ''); ?> <?php echo e(request()->is('admin/roles*') ? 'menu-open' : ''); ?> <?php echo e(request()->is('admin/users*') ? 'menu-open' : ''); ?>">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users">

                        </i>
                        <p>
                            <span><?php echo e(trans('cruds.userManagement.title')); ?></span>
                            <i class="right fa fa-fw fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('is_admin')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route("admin.permissions.index")); ?>"
                                class="nav-link <?php echo e(request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : ''); ?>">
                                <i class="fa-fw fas fa-unlock-alt">

                                </i>
                                <p>
                                    <span><?php echo e(trans('cruds.permission.title')); ?></span>
                                </p>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('is_admin')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route("admin.roles.index")); ?>"
                                class="nav-link <?php echo e(request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : ''); ?>">
                                <i class="fa-fw fas fa-briefcase">

                                </i>
                                <p>
                                    <span><?php echo e(trans('cruds.role.title')); ?></span>
                                </p>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_edit')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route("admin.users.index")); ?>"
                                class="nav-link <?php echo e(request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : ''); ?>">
                                <i class="fa-fw fas fa-user">

                                </i>
                                <p>
                                    <span><?php echo e(trans('cruds.user.title')); ?></span>
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('report_access')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route("admin.reports.index")); ?>"
                        class="nav-link <?php echo e(request()->is('admin/reports') || request()->is('admin/reports/*') ? 'active' : ''); ?>">
                        <i class="fa-fw fas fa-star-half-alt"></i>
                        <p>
                            <span><?php echo e(trans('cruds.report.title')); ?></span>
                        </p>
                    </a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('criterion_access')): ?>
                <li class="nav-item has-treeview 
                        <?php echo e(request()->is('admin/criteria*') ? 'menu-open' : ''); ?> 
                        <?php echo e(request()->is('admin/forms*') ? 'menu-open' : ''); ?>

                        <?php echo e(request()->is('admin/competencies*') ? 'menu-open' : ''); ?>">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-toolbox"></i>
                        <p>
                            <span><?php echo e(trans('global.settings')); ?></span>
                            <i class="right fa fa-fw fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('criterion_access')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route("admin.competencies.index")); ?>"
                                class="nav-link <?php echo e(request()->is('admin/competencies') || request()->is('admin/competencies/*') ? 'active' : ''); ?>">
                                <i class="fa-fw fas fa-file-alt">

                                </i>
                                <p>
                                    <span><?php echo e(trans('cruds.competency.title')); ?></span>
                                </p>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('criterion_access')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route("admin.criteria.index")); ?>"
                                class="nav-link <?php echo e(request()->is('admin/criteria') || request()->is('admin/criteria/*') ? 'active' : ''); ?>">
                                <i class="fa-fw fas fa-file-alt">

                                </i>
                                <p>
                                    <span><?php echo e(trans('cruds.criterion.title')); ?></span>
                                </p>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('criterion_access')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route("admin.criteria.index")); ?>"
                                class="nav-link <?php echo e(request()->is('admin/forms') || request()->is('admin/forms/*') ? 'active' : ''); ?>">
                                <i class="fa-fw fas fa-file-alt">

                                </i>
                                <p>
                                    <span><?php echo e(trans('cruds.form.title')); ?></span>
                                </p>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>
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
</aside><?php /**PATH /home/vagrant/egzkomp.test/resources/views/partials/menu.blade.php ENDPATH**/ ?>