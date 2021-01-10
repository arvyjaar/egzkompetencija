<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('criterion_create')): ?>
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="<?php echo e(route("admin.criteria.create")); ?>">
                <i class="far fa-plus-square">&nbsp;</i> <?php echo e(trans('cruds.criterion.title_singular')); ?>

            </a>
        </div>
    </div>
<?php endif; ?>
<div class="card">
    <div class="card-header">
        <?php echo e(trans('cruds.criterion.title')); ?> <?php echo e(trans('global.list')); ?>

    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">
                            &#10043;
                        </th>
                        <th>
                            <?php echo e(trans('cruds.criterion.title_singular')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.competency.title_singular')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.criterion.fields.rating_type')); ?>

                        </th>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('is_admin')): ?>
                        <th>
                            <?php echo e(trans('global.actions')); ?>

                        </th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $criteria; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $criterion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr data-entry-id="<?php echo e($criterion->id); ?>">
                            <td>

                            </td>
                            
                            <td>
                                <?php echo e($criterion->title ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($criterion->competency->title ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($criterion->assessment->title ?? ''); ?>

                            </td>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('is_admin')): ?>
                            <td>
                                    <a class="btn btn-sm btn-primary" href="<?php echo e(route('admin.criteria.show', $criterion->id)); ?>">
                                        <i class="far fa-eye"></i>
                                    </a>
                                    <a class="btn btn-sm btn-info" href="<?php echo e(route('admin.criteria.edit', $criterion->id)); ?>">
                                        <i class="far fa-edit"></i>
                                    </a>

                                    <form action="<?php echo e(route('admin.criteria.destroy', $criterion->id)); ?>" method="POST" onsubmit="return confirm('Ar tikrai trinti?');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                            </td>
                            <?php endif; ?>
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
  let deleteButtonTrans = '<?php echo e(trans('global.datatables.delete')); ?>'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "<?php echo e(route('admin.criteria.massDestroy')); ?>",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
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
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('criterion_delete')): ?>
  dtButtons.push(deleteButton)
<?php endif; ?>

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/egzkomp.test/resources/views/admin/criteria/index.blade.php ENDPATH**/ ?>