<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('report_create')): ?>
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="<?php echo e(route("admin.reports.create")); ?>">
            <i class="far fa-plus-square">&nbsp;</i> <?php echo e(trans('cruds.report.title_singular')); ?>

        </a>
    </div>
</div>
<?php endif; ?>
<div class="card">
    <div class="card-header">
        Stebėjimo ataskaitos
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable">
            <thead>
                <tr>
                    <th>
                        Stebėtojas
                    </th>
                    <th>
                        Darbuotojas
                    </th>
                    <th>
                        Stebėjimo data
                    </th>
                    <th>
                        Darbuotojas susipažino
                    </th>
                    <th>
                        <?php echo e(trans('global.actions')); ?>

                    </th>
                </tr>
                <tr>
                    <th class="thead2 filterhead">
                        
                    </th>
                    <th class="thead2 filterhead">
                        
                    </th>
                    <th class="thead2 filterhead">
                        
                    </th>
                    <th class="thead2 filterhead">
                        
                    </th>
                    <th>
                        
                    </th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td>
                        1
                    </td>
                    <td>
                        2
                    </td>
                    <td>
                        3
                    </td>
                    <td>
                        4
                    </td>
                    <td>
                        5
                    </td>
                </tr>
            </tfoot>
        </table>
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
        ajax: "<?php echo e(route('admin.reports.index')); ?>",
        columns: [
            {data: 'observer.name', name: 'observer.name'},
            {data: 'employee.name', name: 'employee.name'},
            {data: 'observing_date', name: 'observing_date'},
            {data: 'employee_reviewed_at', name: 'employee_reviewed_at'},
            {data: 'actions', name: 'Veiksmai', orderable: false, searchable: false}
        ],
        dom: 'lBfrtip',
        buttons: ['csv', 'print', 'colvis'],
        initComplete: function () { 
            let col_count = this.api().columns(':visible').count(); // count visible columns
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
});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/egzkomp.test/resources/views/admin/reports/index.blade.php ENDPATH**/ ?>