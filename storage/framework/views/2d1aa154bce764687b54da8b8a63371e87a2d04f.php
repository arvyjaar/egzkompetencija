<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        Stebėjimo ataskaita Nr. <?php echo e($report->id); ?>

    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-2">
                <p><b>Stebėtojas: </b> <?php echo e($report->observer->name ?? ''); ?></p>
                <p><b>Stebėjo: </b> <?php echo e($report->observing_date); ?></p>
                <p><b>Tipas: </b><?php echo e($report->observingType->title); ?>

                </p>
            </div>
            <div class="col-3">
                <p><b>Darbuotojas: </b> <?php echo e($report->employee->name ?? ''); ?></p>
                <p><b>Procedūros data: </b> <?php echo e(substr($report->procedure_date, 0, 16)); ?></p>
                <p><b>Kategorija: </b><?php echo e($report->drivecategory->title ?? ''); ?></p>
            </div>
            <div class="col-2">
                <p><b>Forma: </b> <?php echo e($report->form->title ?? ''); ?>, v.<?php echo e($report->form->version); ?></p>
                <p><b>Veikla: </b> <?php echo e($report->form->worktype->title ?? ''); ?></p>
            </div>
        </div>
        <hr>

        <?php $__currentLoopData = $evaluation_set; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competency_title => $evaluations): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <div class="row">
            <div class="col-12">
                <b><?php echo e($competency_title); ?></b>
            </div>
        </div>
        <?php $__currentLoopData = $evaluations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evaluation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row">
            <div class="col-9">
                <?php echo e($evaluation->criterion->title); ?>

            </div>
            <div class="col-2">
                <?php echo e($evaluation->assessment->title); ?>

            </div>
            <div class="col-1">
                <span <?php if(in_array($evaluation->assessment_value, $evaluation->criterion->assessment->bad_values)): ?>
                        class="text-center square text-danger"
                    <?php elseif($evaluation->assessment_value == 'n'): ?>
                        class="text-center square text-warning"
                    <?php else: ?>
                        class="text-center square"
                    <?php endif; ?>
                >
                    <b title="<?php echo e($evaluation->criterion->assessment->title); ?>"><?php echo e(strtoupper($evaluation->assessment_value)); ?></b>
                </span>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="row">
            <div class="col-8">
                <br>
                <?php if(isset($evaluations->competency_note)): ?>
                <p><u><i>Pastaba:</i></u> <span class="text-info"><?php echo e($evaluations->competency_note); ?></span></p>
                <?php endif; ?>
                <hr>
            </div>
        </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="row">
            <div class="col-8">
                <b>Papildomos/bendrosios pastabos (pastabos dėl techninių priemonių, trukdančių efektyviam
                    darbui, nesusijusios su šiuo įvertinimu)</b>
                <p><span class="text-info"><?php echo e($report->technical_note ?? 'nėra'); ?></span></p>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <b>Stebėtojo išvados, pasiūlymai</b>
                <p><span class="text-info"><?php echo e($report->observer_note ?? 'nėra'); ?></span></p>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <b>Darbuotojo atsiliepimas</b>
                <p><span class="text-info"><?php echo e($report->employee_note ?? 'nėra'); ?></span></p>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <b>Darbuotojas susipažino</b>
                <?php if(isset($report->employee_reviewed_at)): ?>
                <p><span class="text-info"><?php echo e($report->employee_reviewed_at); ?></span></p>
                <?php else: ?>
                <p class="text-danger">nesusipažino</p>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <b>Administracijos pastabos</b>
                <p><span class="text-info"><?php echo e($report->manager_note ?? 'nėra'); ?></span></p>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <a class="btn btn-default" href="<?php echo e(url()->previous()); ?>">
                    Atgal į sąrašą
                </a>
            </div>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('report_comment', $report)): ?>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#commentModal">
                Rašyti pastabą
            </button>

            <!-- Modal -->
            <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="commentModalLabel">
                                <?php if(auth()->user()->id === $report->employee_id): ?>
                                Darbuotojo pastaba
                                <?php else: ?>
                                Administracijos pastaba
                                <?php endif; ?>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?php echo e(route("admin.reports.comment", [$report->id])); ?>" method="POST"
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/egzkomp.test/resources/views/admin/reports/show.blade.php ENDPATH**/ ?>