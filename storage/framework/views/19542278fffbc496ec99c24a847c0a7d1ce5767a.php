<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <?php echo e(trans('cruds.criterion.title_singular')); ?>

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
                            <?php echo e($criterion->title); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.competency.title')); ?>

                        </th>
                        <td>
                            <?php echo e($criterion->competency->title); ?> (<?php echo e($criterion->competency->worktype->title); ?>)
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.assessment_type.title_singular')); ?>

                        </th>
                        <td>
                            <?php echo e($criterion->assessment->title); ?>

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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/egzkomp.test/resources/views/admin/criteria/show.blade.php ENDPATH**/ ?>