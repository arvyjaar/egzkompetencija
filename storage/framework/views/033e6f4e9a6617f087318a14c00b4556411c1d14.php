<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_create')): ?>
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="<?php echo e(route("admin.users.create")); ?>">
            <i class="far fa-plus-square">&nbsp;</i> <?php echo e(trans('cruds.user.title_singular')); ?>

        </a>
    </div>
</div>
<?php endif; ?>
<div class="card">
    <div class="card-header">
        <?php echo e(trans('cruds.user.title')); ?> - <?php echo e(trans('global.list')); ?>

    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable">
            <thead>
                <tr>
                    <th>
                        <?php echo e(trans('cruds.user.fields.name')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.user.fields.branch')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('global.actions')); ?>

                    </th>
                </tr>
            </thead>
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
            processing: true,
            serverSide: true,
            pageLength: 25,
            orderCellsTop: true,
            fixedHeader: true,
            ajax: "<?php echo e(route('admin.users.index')); ?>",
            dom: 'lBfrtip',
            buttons: ['csv', 'print', 'colvis'],
            columns: [
                {data: 'name', name: 'name'},
                {data: 'branch.title', name: 'branch.title'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false}
            ],
        });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/egzkomp.test/resources/views/admin/users/index.blade.php ENDPATH**/ ?>