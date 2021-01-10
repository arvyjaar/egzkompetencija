<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <?php echo e(trans('cruds.competency.title_singular')); ?>

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
                            <?php echo e($competency->title); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.worktype.title_singular')); ?>

                        </th>
                        <td>
                            <?php echo e($competency->worktype->title); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.criterion.title')); ?>

                        </th>    
                        <td>
                            <?php if($competency->criterion->count() > 0): ?>
                                <?php $__currentLoopData = $competency->criterion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $criterion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <p><?php echo e($criterion->title); ?>, <?php echo e($criterion->assessment->title); ?></p>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>                 
                                <p class="text-danger"><?php echo e(trans('global.no')); ?></p>
                            <?php endif; ?>    
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="<?php echo e(url()->previous()); ?>">
                Atgal į sąrašą
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/egzkomp.test/resources/views/admin/competencies/show.blade.php ENDPATH**/ ?>