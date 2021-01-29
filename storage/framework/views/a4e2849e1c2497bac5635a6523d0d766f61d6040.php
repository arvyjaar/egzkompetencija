<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="row justify-content-md-center">
        <div class="col-md-4">
            <?php $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a class="btn btn-outline-dark form-type" href="<?php echo e(route('admin.reports.create-report', ['id' => $form->id])); ?>">
                <h4><?php echo e($form->title.', vers. '.$form->version.' - '.$form->worktype->title); ?></h4>
                <p><?php echo e(trans('cruds.report.title')); ?>: <?php echo e($form->report->count()); ?></p>
            </a>
            <p></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/egzkomp.test/resources/views/admin/reports/choose-form.blade.php ENDPATH**/ ?>