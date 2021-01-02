<?php $__env->startSection('content'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('monitoring_report_create')): ?>
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="<?php echo e(route("admin.monitoring-reports.create")); ?>">
                    Sukurti stebėjimo ataskaitą
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
                    <th width="10">

                    </th>
                    <th>
                        Stebėtojas
                    </th>
                    <th>
                        Egzaminuotojas
                    </th>

                    <th>
                        Filialas
                    </th>
                    <th>
                        Egzaminas
                    </th>
                    <th>
                        Kategorija
                    </th>
                    <th>
                        Stebėta
                    </th>
                    <th>
                        Tipas
                    </th>
                    <th>
                        Egzaminuotojas susipažino
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
    <script>

        $(function () {

            let deleteButtonTrans = 'Ištrinti pažymėtus';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "<?php echo e(route('admin.monitoring-reports.massDestroy')); ?>",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({selected: true}).data(), function (entry) {
                        return entry.id
                    });

                    if (ids.length === 0) {
                        alert('Nieko nepažymėjote')

                        return
                    }

                    if (confirm('Ar tikrai ištrinti?')) {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: {ids: ids, _method: 'DELETE'}
                        })
                                .done(function () {
                                    location.reload()
                                })
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
                        ajax: "<?php echo e(route('admin.monitoring-reports.index')); ?>",
                        columns: [
                            {data: 'placeholder', name: 'placeholder'},
                            {data: 'observer', name: 'observer.name'},
                            {data: 'examiner', name: 'examiner.name'},
                            //{ data: 'user.email', name: 'user.email' },
                            {data: 'branch', name: 'branch.title'},
                            {data: 'exam_date', name: 'exam_date'},
                            {data: 'drivecategory', name: 'drivecategory'},
                            {data: 'observing_date', name: 'observing_date'},
                            {data: 'observing_type', name: 'observing_type'},
                            {data: 'examiner_reviewed', name: 'examiner_reviewed'},
                            {data: 'actions', name: 'Veiksmai'}
                        ],
                    };

            $('.datatable').DataTable(dtOverrideGlobals);

        });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/egzkomp.test/resources/views/admin/monitoringReports/index.blade.php ENDPATH**/ ?>