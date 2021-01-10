<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <?php echo e(trans('global.edit')); ?> <?php echo e(trans('cruds.competency.title_singular')); ?>

    </div>

    <div class="card-body">
        <form action="<?php echo e(route("admin.competencies.update", [$competency->id])); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
                <label for="title"><?php echo e(trans('cruds.competency.title')); ?>*</label>
                <input type="text" id="title" name="title" class="form-control" value="<?php echo e(old('title', isset($competency) ? $competency->title : '')); ?>" required> 
                <?php if($errors->has('title')): ?>
                    <p class="help-block">
                        <?php echo e($errors->first('title')); ?>

                    </p>
                <?php endif; ?>
            </div>
            <div class="form-group <?php echo e($errors->has('worktype_id') ? 'has-error' : ''); ?>">
                <label for="worktype_id"><?php echo e(trans('cruds.worktype.title')); ?>*</label>
                <select name="worktype_id" id="worktype_id" class="form-control select2" required>
                    <?php $__currentLoopData = $worktypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>" <?php echo e(old('worktype_id', $competency->worktype_id) == $id ? 'selected' : ''); ?> >
                        <?php echo e($title); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('worktype_id')): ?>
                    <p class="help-block">
                        <?php echo e($errors->first('worktype_id')); ?>

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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/egzkomp.test/resources/views/admin/competencies/edit.blade.php ENDPATH**/ ?>