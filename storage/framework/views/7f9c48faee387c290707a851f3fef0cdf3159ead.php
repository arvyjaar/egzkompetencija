<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <?php echo e(trans('cruds.form.title_singular')); ?>

    </div>

    <div class="card-body">
        <div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            <?php echo e(trans('global.title')); ?>

                        </th>
                        <td>
                            <?php echo e($form->title); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.form.fields.version')); ?>

                        </th>
                        <td>
                            <?php echo e($form->version); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.worktype.title_singular')); ?>

                        </th>
                        <td>
                            <?php echo e($form->worktype->title); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.competency.title')); ?>

                        </th>
                        <td>                           
                            <?php $__currentLoopData = $form->competency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p><?php echo e($competency->title); ?>, <?php echo e($competency->worktype->title); ?></p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                          
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.form.fields.active')); ?>

                        </th>
                        <td>
                            <?php echo e($form->active ? trans('global.yes') : trans('global.no')); ?>

                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="<?php echo e(url()->previous()); ?>">
                <?php echo e(trans('global.back_to_list')); ?>

            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/egzkomp.test/resources/views/admin/forms/show.blade.php ENDPATH**/ ?>