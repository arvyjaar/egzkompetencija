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
        <?php echo e(trans('cruds.user.title_singular')); ?> <?php echo e(trans('global.list')); ?>

    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable">
            <thead>
                <tr>
                    <th width="10">
                        &#10043;
                    </th>
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
        let deleteButtonTrans = '<?php echo e(trans('global.datatables.delete')); ?>';
        let deleteButton = {
            text: deleteButtonTrans,
            url: "<?php echo e(route('admin.users.massDestroy')); ?>",
            className: 'btn-danger',
            action: function (e, dt, node, config) {
                let ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                return $(entry).data('entry-id')
            });

            if (ids.length === 0) {
                alert('<?php echo e(trans('global.datatables.zero_selected')); ?>')
                return
            }

            if (confirm('<?php echo e(trans('global.areYouSure')); ?>')) {
                $.ajax({
                    headers: {'x-csrf-token': _token},
                    method: 'POST',
                    url: config.url,
                    data: { ids: ids, _method: 'DELETE' }
                }).done(function () { location.reload() })
            }
            }
        };
  
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('is_admin')): ?>
            dtButtons.push(deleteButton)
        <?php endif; ?>

        let dtOverrideGlobals = {
            buttons: dtButtons,
            processing: true,
            serverSide: true,
            retrieve: true,
            aaSorting: [],
            ajax: "<?php echo e(route('admin.users.index')); ?>",
            columns: [
                {data: 'placeholder', name: 'placeholder'},
                {data: 'name', name: 'name'},
                {data: 'branch_id', name: 'branch_id'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false}
            ],
        };

    $('.datatable').DataTable(dtOverrideGlobals);

});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/egzkomp.test/resources/views/admin/users/index.blade.php ENDPATH**/ ?>