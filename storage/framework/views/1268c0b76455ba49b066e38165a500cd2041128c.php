<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <?php echo e(trans('cruds.statistics.title')); ?>

    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="date_from"><?php echo e(trans('cruds.statistics.date_from')); ?></label>
                    <input type="text" id="date_from" name="date_from" class="form-control date"
                        value="<?php echo e(old('date_from')); ?>" required>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="date_to"><?php echo e(trans('cruds.statistics.date_to')); ?></label>
                    <input type="text" id="date_to" name="date_to" class="form-control date"
                        value="<?php echo e(old('date_to')); ?>" required>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="worktype_id"><?php echo e(trans('cruds.worktype.title_singular')); ?></label>
                    <select name="worktype_id" id="worktype_id" class="form-control" required>
                        <?php $__currentLoopData = $worktypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>" <?php echo e(old('worktype_id') == $id ? 'selected' : ''); ?>>
                            <?php echo e($title); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="branch_id"><?php echo e(trans('cruds.branch.title_singular')); ?></label>
                    <select name="branch_id" id="worktype_id" class="form-control" required>
                        <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>" <?php echo e(old('branch_id') == $id ? 'selected' : ''); ?>>
                            <?php echo e($title); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div> <!-- /row -->
        <div class="row">
            <div class="col-12">
                <?php echo $html->table(['class' => 'table table-bordered table-stripped table-hover'], true); ?>

            </div>

        </div> <!-- / card body -->
    </div> <!-- / card -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
    <script>
        $('#dataTableBuilder').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 50,
            ajax: "<?php echo e(route('admin.stats.index')); ?>",
            columns: [               
                {data: 'name', name: 'name'},
                {data: 'branch.title', name: 'branch.title'},
            ],
            dom: 'lBfrtip',
            buttons: ['csv', 'print', 'colvis'],
            initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement('input');
                $(input).appendTo($(column.footer()).empty()).on('keyup', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                    column.search(val ? val : '', true, false).draw();
                });
            });
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/egzkomp.test/resources/views/admin/statistics/index.blade.php ENDPATH**/ ?>