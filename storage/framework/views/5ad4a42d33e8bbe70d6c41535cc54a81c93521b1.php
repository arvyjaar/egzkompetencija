<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <?php echo e(trans('global.edit')); ?> <?php echo e(trans('cruds.criterion.title_singular')); ?>

    </div>

    <div class="card-body">
        <form action="<?php echo e(route("admin.criteria.update", [$criterion->id])); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
                <label for="title"><?php echo e(trans('cruds.criterion.fields.title')); ?>*</label>
                <input type="text" id="title" name="title" class="form-control" value="<?php echo e(old('title', isset($criterion) ? $criterion->title : '')); ?>" required>
                <?php if($errors->has('title')): ?>
                    <p class="help-block">
                        <?php echo e($errors->first('title')); ?>

                    </p>
                <?php endif; ?>
                <p class="helper-block">
                    <?php echo e(trans('cruds.criterion.fields.title_helper')); ?>

                </p>
            </div>
            <div class="form-group <?php echo e($errors->has('competency_id') ? 'has-error' : ''); ?>">
                <label for="competency_id"><?php echo e(trans('cruds.criterion.fields.category')); ?>*</label>
                <select name="competency_id" id="competency_id" class="form-control select2" required>
                    <?php $__currentLoopData = $competencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($competency->id); ?>" 
                            <?php echo e(old('competency_id', $criterion->competency_id) == $competency->id ? 'selected' : ''); ?> 
                            > 
                            <?php echo e($competency->title); ?> (<?php echo e($competency->worktype->title); ?>)</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('competency_id')): ?>
                    <p class="help-block">
                        <?php echo e($errors->first('competency_id')); ?>

                    </p>
                <?php endif; ?>
            </div>
            <div class="form-group <?php echo e($errors->has('assessment_type_id') ? 'has-error' : ''); ?>">
                <label for="assessment_type"><?php echo e(trans('cruds.assessment_type.title')); ?>*</label>
                <select name="assessment_type_id" id="assessment_type_id" class="form-control" >
                    <?php $__currentLoopData = $assessment_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assessment_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($assessment_type->id); ?>" 
                        <?php echo e(old('assessment_type_id', $criterion->assessment_type_id) == $criterion->assessment_type_id ? 'selected' : ''); ?> > 
                        <?php echo e($assessment_type->title); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('assessment_type_id')): ?>
                    <p class="help-block">
                        <?php echo e($errors->first('assessment_type_id')); ?>

                    </p>
                <?php endif; ?>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="Išsaugoti">
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/egzkomp.test/resources/views/admin/criteria/edit.blade.php ENDPATH**/ ?>