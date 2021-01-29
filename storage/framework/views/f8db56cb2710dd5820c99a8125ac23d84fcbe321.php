<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('criterion_edit')): ?>
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="<?php echo e(route("admin.forms.create")); ?>">
            <i class="far fa-plus-square">&nbsp;</i> <?php echo e(trans('cruds.form.title_singular')); ?>

        </a>
    </div>
</div>
<?php endif; ?>
<div class="card">
    <div class="card-header">
        <?php echo e(trans('cruds.form.title')); ?> <?php echo e(trans('global.list')); ?>

    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.form.title_singular')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.worktype.title_singular')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.form.fields.version')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.form.fields.active')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.form.fields.has_reports')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('global.actions')); ?>

                        </th>

                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr data-entry-id="<?php echo e($form->id); ?>">
                        <td>
                            <?php echo e($form->title ?? ''); ?>

                        </td>
                        <td>
                            <?php echo e($form->worktype->title ?? ''); ?>

                        </td>
                        <td>
                            <?php echo e($form->version); ?>

                        </td>
                        <td>
                            <?php echo e($form->active ? trans('global.yes') : ''); ?>

                        </td>
                        <td>
                            <?php echo e($form->hasReports ? trans('global.yes') : ''); ?>

                        </td>

                        <td>
                            <a class="btn btn-sm btn-primary" href="<?php echo e(route('admin.forms.show', $form->id)); ?>">
                                <i class="far fa-eye"></i>
                            </a>
                            <?php if(!$form->hasReports): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('criterion_edit')): ?>
                            <a class="btn btn-sm btn-info" href="<?php echo e(route('admin.forms.edit', $form->id)); ?>">
                                <i class="far fa-edit"></i>
                            </a>
                            <form action="<?php echo e(route('admin.forms.destroy', $form->id)); ?>" method="POST"
                                onsubmit="return confirm('Ar tikrai trinti?');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                            <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
<script>
$(function () {
    $('.datatable').DataTable({
        pageLength: 25,
    });
})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/egzkomp.test/resources/views/admin/forms/index.blade.php ENDPATH**/ ?>