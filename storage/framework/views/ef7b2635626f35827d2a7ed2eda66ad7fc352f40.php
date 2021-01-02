<?php $__env->startSection('content'); ?>
<div class="login-box">
    <div class="login-logo">
        <div class="login-logo">
            <a href="#">
                <?php echo e(trans('panel.site_title')); ?>

            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Prisijungti</p>
            <?php if(\Session::has('message')): ?>
                <p class="alert alert-info">
                    <?php echo e(\Session::get('message')); ?>

                </p>
            <?php endif; ?>
            <form action="<?php echo e(route('login')); ?>" method="POST">
                <?php echo e(csrf_field()); ?>

                <div class="form-group has-feedback">
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="el. paštas" name="email">
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="input-group">
                        <input type="password" class="form-control" placeholder="Slaptažodis" name="password">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-flat">Prisijungti</button>
                
            </form>


    
        </div>
        <!-- /.login-card-body -->
    </div>
    <!-- test accounts -->
    <div style="color: darkred">
        <u>Test accounts:</u> <br><br>
        admin@admin.com - Admin <br>
        examiner@exam.com - Examiner <br>
        observer@exam.com - Observer <br><br>
        <u>paswords:</u> "password" for all users

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/egzkomp.test/resources/views/auth/login.blade.php ENDPATH**/ ?>