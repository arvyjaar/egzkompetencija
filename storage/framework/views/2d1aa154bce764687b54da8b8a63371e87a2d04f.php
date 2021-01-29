<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <?php echo e(trans('cruds.report.title_singular')); ?> Nr. <?php echo e($report->id); ?>

    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-2">
                <p><b><?php echo e(trans('cruds.report.fields.observer')); ?></b> <?php echo e($report->observer->name ?? ''); ?></p>
                <p><b><?php echo e(trans('cruds.report.fields.observing_date')); ?></b> <?php echo e($report->observing_date); ?></p>
                <p><b><?php echo e(trans('cruds.report.fields.observing_type')); ?></b> <?php echo e($report->observingType->title); ?>

                </p>
            </div>
            <div class="col-3">
                <p><b><?php echo e(trans('cruds.report.fields.employee')); ?></b> <?php echo e($report->employee->name ?? ''); ?></p>
                <p><b><?php echo e(trans('cruds.report.fields.procedure_datetime')); ?></b> <?php echo e(substr($report->procedure_date, 0, 16)); ?></p>
                <?php if($report->drivecategory): ?>
                <p><b><?php echo e(trans('cruds.report.fields.category')); ?> </b><?php echo e($report->drivecategory->title ?? ''); ?></p>
                <?php endif; ?>
            </div>
            <div class="col-2">
                <p><b><?php echo e(trans('cruds.form.title_singular')); ?></b> <?php echo e($report->form->title ?? ''); ?>, v.<?php echo e($report->form->version); ?></p>
                <p><b><?php echo e(trans('cruds.worktype.title_singular')); ?></b> <?php echo e($report->form->worktype->title ?? ''); ?></p>
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
                <?php echo e($evaluation->criterionWithTrashed->title); ?>

            </div>
            <div class="col-2">
                <?php echo e($evaluation->assessment->title); ?>

            </div>
            <div class="col-1">
                <div <?php if(in_array($evaluation->assessment_value, $evaluation->criterionWithTrashed->assessment->bad_values)): ?>
                        class="text-center square text-danger"
                    <?php elseif(strtolower($evaluation->assessment_value) == 'n'): ?>
                        class="text-center square text-warning"
                    <?php else: ?>
                        class="text-center square"
                    <?php endif; ?>
                >
                    <b title="<?php echo e($evaluation->criterionWithTrashed->assessment->title); ?>"><?php echo e(strtoupper($evaluation->assessment_value)); ?></b>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="row">
            <div class="col-8">
                <br>
                <?php if(isset($evaluations->competency_note)): ?>
                <p><u><i><?php echo e(trans('cruds.report.fields.notes_singular')); ?>:</i></u> <span class="text-info"><?php echo e($evaluations->competency_note); ?></span></p>
                <?php endif; ?>
                <hr>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="row">
            <div class="col-8">
                <b><?php echo e(trans('cruds.report.fields.technical_notes')); ?></b>
                <p><span class="text-info"><?php echo e($report->technical_note ?? '-'); ?></span></p>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <b><?php echo e(trans('cruds.report.fields.observer_notes')); ?></b>
                <p><span class="text-info"><?php echo e($report->observer_note ?? '-'); ?></span></p>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <b><?php echo e(trans('cruds.report.fields.employee_notes')); ?></b>
                <p><span class="text-info"><?php echo e($report->employee_note ?? '-'); ?></span></p>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <b><?php echo e(trans('cruds.report.fields.employee_reviewed_at')); ?></b>
                <?php if(isset($report->employee_reviewed_at)): ?>
                <p><span class="text-info"><?php echo e($report->employee_reviewed_at); ?></span></p>
                <?php endif; ?>
                <?php if(empty($report->employee_reviewed_at)): ?>
                <p class="text-danger"><?php echo e(trans('cruds.report.not_reviewed')); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <b><?php echo e(trans('cruds.report.fields.manager_notes')); ?></b>
                <p><span class="text-info"><?php echo e($report->manager_note ?? '-'); ?></span></p>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <a class="btn btn-default" href="<?php echo e(route('admin.reports.index')); ?>">
                    <?php echo e(trans('global.back_to_list')); ?>

                </a>
            </div>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('report_comment', $report)): ?>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#commentModal">
                <?php echo e(trans('global.write_note')); ?>

            </button>

            <!-- Modal -->
            <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="commentModalLabel">
                                <?php if(auth()->user()->id === $report->employee_id): ?>
                                <?php echo e(trans('cruds.report.fields.employee_notes')); ?>

                                <?php else: ?>
                                <?php echo e(trans('cruds.report.fields.manager_notes')); ?>

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
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(trans('global.close')); ?>

                                </button>
                                <button type="submit" class="btn btn-danger"><?php echo e(trans('global.save')); ?></button>
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