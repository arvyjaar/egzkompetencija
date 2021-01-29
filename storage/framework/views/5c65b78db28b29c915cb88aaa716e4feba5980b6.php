<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <?php echo e(trans('global.add' )); ?> <?php echo e(trans('cruds.form.title_singular' )); ?>

    </div>

    <div class="card-body">
        <form action="<?php echo e(route("admin.forms.store")); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
                <label for="title"><?php echo e(trans('global.title')); ?>*</label>
                <input type="text" id="title" name="title" class="form-control"
                    value="<?php echo e(old('title', isset($form) ? $form->title : '')); ?>" required>
                <?php if($errors->has('title')): ?>
                <p class="help-block">
                    <?php echo e($errors->first('title')); ?>

                </p>
                <?php endif; ?>
            </div>
            <div class="form-group <?php echo e($errors->has('version') ? 'has-error' : ''); ?>">
                <label for="version"><?php echo e(trans('cruds.form.fields.version')); ?>*</label>
                <input type="text" id="version" name="version" class="form-control"
                    value="<?php echo e(old('version', isset($form) ? $form->version : '')); ?>" required>
                <?php if($errors->has('version')): ?>
                <p class="help-block">
                    <?php echo e($errors->first('version')); ?>

                </p>
                <?php endif; ?>
            </div>
            <div class="form-group <?php echo e($errors->has('worktype_id') ? 'has-error' : ''); ?>">
                <label for="worktype_id"><?php echo e(trans('cruds.worktype.title')); ?>*</label>

                <select name="worktype_id" id="worktype_id" class="form-control" required>

                    <?php $__currentLoopData = $worktypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($id); ?>" <?php echo e(old('worktype_id') == $id ? 'selected' : ''); ?>>
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
            <div class="form-group <?php echo e($errors->has('competencies') ? 'has-error' : ''); ?>">
                <label for="competencies"><?php echo e(trans('cruds.competency.title')); ?>*
                    <span class="btn btn-info btn-xs select-all"><?php echo e(trans('global.select_all')); ?></span>
                    <span class="btn btn-info btn-xs deselect-all"><?php echo e(trans('global.deselect_all')); ?></span></label>
                <select name="competencies[]" id="competencies" class="form-control select2" multiple="multiple"
                    required>
                    <?php $__currentLoopData = $competencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($competency->id); ?>"
                        <?php echo e((in_array($competency->id, old('competencies', [])) || isset($form) && $form->competency->contains($competency->id)) ? 'selected' : ''); ?>>
                        <?php echo e($competency->title.', '.$competency->worktype->title); ?> </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('competencies')): ?>
                <p class="help-block">
                    <?php echo e($errors->first('competencies')); ?>

                </p>
                <?php endif; ?>
            </div>
            <div class="form-group <?php echo e($errors->has('active') ? 'has-error' : ''); ?>">
                <div class="icheck-primary icheck-inline">
                    <input type="checkbox" name="active" id="active" value="1" <?php echo e(old('active') ? 'checked' : ''); ?>>
                    <label for="active"><?php echo e(trans('cruds.form.fields.active')); ?></label>
                </div>
                <p class="helper-block">
                    <?php echo e(trans('cruds.form.fields.active_helper')); ?>

                </p>
                <?php if($errors->has('active')): ?>
                <p class="help-block">
                    <?php echo e($errors->first('active')); ?>

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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/egzkomp.test/resources/views/admin/forms/create.blade.php ENDPATH**/ ?>