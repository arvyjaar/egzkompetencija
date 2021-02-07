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
                    <input type="text" id="date_from" name="date_from" class="form-control date" value="">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="date_to"><?php echo e(trans('cruds.statistics.date_to')); ?></label>
                    <input type="text" id="date_to" name="date_to" class="form-control date" value="">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="branch_id"><?php echo e(trans('cruds.branch.title_singular')); ?></label>
                    <select name="branch_id" id="branch_id" class="form-control" required>
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
            <div class="col-1">
                <button class="btn btn-outline-primary" id="go">
                    <?php echo e(trans('global.search')); ?>

                </button>
            </div>
            <div class="col-3 col-offset-2">
                <b><span class="search_params">....</span></b>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p></p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <?php echo $html->table(['class' => 'table table-bordered table-stripped table-hover'], true); ?>

            </div>
        </div>

    </div> <!-- / card body -->
</div> <!-- / card -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
<script>
    $(function () {
    var table = $('#dataTableBuilder').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 25,
        ajax: {
            url: "<?php echo e(route('admin.stats.index')); ?>",
            data: function (d) {
                d.branch_id = $('#branch_id').val();
                d.date_from = $('#date_from').val();
                d.date_to = $('#date_to').val();
            }
        },
        columns: [               
            {data: 'name', name: 'name'},
            {data: 'branch.title', name: 'branch.title'},
            {data: 'report_as_employee_count', name: 'report_as_employee_count',  searchable: false, orderable: true}
        ],
        dom: 'lBfrtip',
        buttons: ['csv', 'print', 'colvis'],
        initComplete: function () {
            $("#go").click(function(){
                table.draw();
                table.one('xhr', function(e, settings, json){
                    console.log(json.params);
                    $('.search_params').text("<?php echo e(trans('global.timeFrom')); ?>: "
                    + (json.params.from ?? " - - - ")
                    + " <?php echo e(trans('global.timeTo')); ?>: "
                    + (json.params.to ?? " - - - ")
                    + " <?php echo e(trans('cruds.branch.title_singular')); ?>: "
                    + (json.params.branch ?? " - - - ")
                    )               
                })
            })
        }
    });
});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/egzkomp.test/resources/views/admin/statistics/index.blade.php ENDPATH**/ ?>