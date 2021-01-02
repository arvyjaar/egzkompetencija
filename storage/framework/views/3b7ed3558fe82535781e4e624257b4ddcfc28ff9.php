<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <?php echo e(trans('global.create')); ?> <?php echo e(trans('cruds.role.title_singular')); ?>

    </div>

    <div class="card-body">
        <form action="<?php echo e(route("admin.roles.store")); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
                <label for="title"><?php echo e(trans('cruds.role.fields.title')); ?>*</label>
                <input type="text" id="title" name="title" class="form-control" value="<?php echo e(old('title', isset($role) ? $role->title : '')); ?>" required>
                <?php if($errors->has('title')): ?>
                    <p class="help-block">
                        <?php echo e($errors->first('title')); ?>

                    </p>
                <?php endif; ?>
                <p class="helper-block">
                    <?php echo e(trans('cruds.role.fields.title_helper')); ?>

                </p>
            </div>
            <div class="form-group <?php echo e($errors->has('permissions') ? 'has-error' : ''); ?>">
                <label for="permissions"><?php echo e(trans('cruds.role.fields.permissions')); ?>*
                    <span class="btn btn-info btn-xs select-all"><?php echo e(trans('global.select_all')); ?></span>
                    <span class="btn btn-info btn-xs deselect-all"><?php echo e(trans('global.deselect_all')); ?></span></label>
                <select name="permissions[]" id="permissions" class="form-control select2" multiple="multiple" required>
                    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $permissions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>" <?php echo e((in_array($id, old('permissions', [])) || isset($role) && $role->permissions->contains($id)) ? 'selected' : ''); ?>><?php echo e($permissions); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('permissions')): ?>
                    <p class="help-block">
                        <?php echo e($errors->first('permissions')); ?>

                    </p>
                <?php endif; ?>
                <p class="helper-block">
                    <?php echo e(trans('cruds.role.fields.permissions_helper')); ?>

                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="<?php echo e(trans('global.save')); ?>">
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/egzkomp.test/resources/views/admin/roles/create.blade.php ENDPATH**/ ?>