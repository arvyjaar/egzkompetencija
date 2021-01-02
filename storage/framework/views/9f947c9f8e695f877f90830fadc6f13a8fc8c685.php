<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            Stebėjimo ataskaita Nr. <?php echo e($monitoringReport->id); ?>

        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-2">
                    <p><b>Stebėtojas: </b> <?php echo e($monitoringReport->observer->name ?? ''); ?></p>
                    <p><b>Stebėjo: </b> <?php echo e($monitoringReport->observing_date); ?></p>
                    <p><b>Tipas: </b><?php echo e(App\MonitoringReport::OBSERVING_TYPE_RADIO[$monitoringReport->observing_type]); ?>

                    </p>
                </div>
                <div class="col-3">
                    <p><b>Egzaminuotojas: </b> <?php echo e($monitoringReport->examiner->name ?? ''); ?></p>
                    <p><b>Egzaminavo: </b> <?php echo e(substr($monitoringReport->exam_date, 0, 16)); ?></p>
                    <p><b>Kategorija: </b><?php echo e($monitoringReport->drivecategory); ?></p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <label>Vertinimas:</label>
                    <p>
                        <?php $__currentLoopData = $points; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($point->value == 0 ? 'N' : $point->value); ?> - <?php echo e($point->title); ?>;
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </p>
                    <hr>
                </div>
            </div>
            <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="row">
                    <div class="col-12">
                        <b><?php echo e($result->competency->title); ?></b>
                    </div>
                </div>
                <?php $__currentLoopData = $result->evaluations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evaluation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row">
                        <div class="col-8">
                            <?php echo e($evaluation->criterion->title); ?></div>
                        <div class="col-4">
                            <span
                                    <?php if(in_array($evaluation->point->value, [1, 2])): ?>
                                        class="text-center square text-danger"
                                    <?php else: ?>
                                        class="text-center square"
                                    <?php endif; ?>
                            >
                                <b><?php echo e($evaluation->point->value == 0 ? 'N' : $evaluation->point->value); ?></b>
                            </span>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="row">
                    <div class="col-8">
                        <br>
                        <?php if(isset($result->competency_note)): ?>
                            <p><u><i>Pastaba:</i></u> <span
                                        class="text-info"><?php echo e($result->competency_note->text); ?></span></p>
                        <?php endif; ?>
                        <hr>
                    </div>
                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="row">
                <div class="col-8">
                    <b>Papildomos/bendrosios pastabos (pastabos dėl techninių priemonių, trukdančių efektyviam
                        darbui, nesusijusios su šiuo įvertinimu)</b>
                    <p><span class="text-info"><?php echo e($monitoringReport->technical_note ?? 'nėra'); ?></span></p>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <b>Stebėtojo išvados, pasiūlymai</b>
                    <p><span class="text-info"><?php echo e($monitoringReport->observer_note ?? 'nėra'); ?></span></p>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <b>Egzaminuotojo atsiliepimas</b>
                    <p><span class="text-info"><?php echo e($monitoringReport->examiner_note ?? 'nėra'); ?></span></p>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <b>Egzaminuotojas susipažino</b>
                    <?php if(isset($monitoringReport->examiner_reviewed)): ?>
                        <p><span class="text-info"><?php echo e($monitoringReport->examiner_reviewed); ?></span></p>
                    <?php else: ?>
                        <p class="text-danger">nesusipažino</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <b>Egzaminavimo ir vairuotojo pažymėjimų išdavimo skyriaus pastabos</b>
                    <p><span class="text-info"><?php echo e($monitoringReport->evpis_note ?? 'nėra'); ?></span></p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <a style="" class="btn btn-default" href="<?php echo e(url()->previous()); ?>">
                        Atgal į sąrašą
                    </a>
                </div>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('report_comment', $monitoringReport)): ?>
                <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                            data-target="#commentModal">
                        Rašyti pastabą
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="commentModal" tabindex="-1" role="dialog"
                         aria-labelledby="commentModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="commentModalLabel">
                                        <?php if(auth()->user()->id === $monitoringReport->examiner_id): ?>
                                            Egzaminuotojo pastaba
                                        <?php else: ?>
                                            EVPIS pastaba
                                        <?php endif; ?>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?php echo e(route("admin.monitoring-reports.comment", [$monitoringReport->id])); ?>"
                                      method="POST"
                                      enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <div class="modal-body">
                                        <textarea name="comment" class="form-control"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Uždaryti
                                        </button>
                                        <button type="submit" class="btn btn-danger">Išsaugoti</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/egzkomp.test/resources/views/admin/monitoringReports/show.blade.php ENDPATH**/ ?>