<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header alert alert-warning">
        <i class="far fa-edit"></i> <?php echo e(trans('cruds.report.title_singular')); ?> Nr. <b><?php echo e($report->id); ?></b>
    </div>

    <div class="card-body">
        <form action="<?php echo e(route("admin.reports.update", [$report->id])); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="row">
                <div class="col-4">
                    <div class="form-group <?php echo e($errors->has('user_id') ? 'has-error' : ''); ?>">
                        <label for="employee_id"><?php echo e(trans('cruds.report.fields.employee')); ?>*</label>
                        <select name="employee_id" id="employee_id" class="form-control select2">
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($id); ?>"
                                <?php echo e(($report->employee ? $report->employee->id : old('employee_id')) == $id ? 'selected' : ''); ?>>
                                <?php echo e($user); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('employee_id')): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('employee_id')); ?>

                        </p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-4">
                    <label for="observer_id"><?php echo e(trans('cruds.report.fields.observer')); ?>*</label>
                    <input type="text" class="form-control" disabled="disabled"
                        placeholder="<?php echo e($report->observer->name ?? ''); ?>">
                </div>
                <div class="col-4">
                    <label for="form_id"><?php echo e(trans('cruds.form.title_singular')); ?>*</label>
                    <input type="text" name="form_id" id="form_id" class="form-control"
                        placeholder="<?php echo e($report->form->title); ?>, v.<?php echo e($report->form->version); ?>" disabled />
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group <?php echo e($errors->has('drivecategory_id') ? 'has-error' : ''); ?>">
                        <label for="drivecategory_id"><?php echo e(trans('cruds.report.fields.category')); ?>*</label>
                        <select type="text" id="drivecategory_id" name="drivecategory_id" class="form-control select2"
                            required>
                            <?php $__currentLoopData = $drivecategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($id); ?>"
                                <?php echo e((old('drivecategory_id') == $id || $report->drivecategory_id == $id) ? 'selected' : ''); ?>>
                                <?php echo e($title); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('category')): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('category')); ?>

                        </p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group <?php echo e($errors->has('procedure_date') ? 'has-error' : ''); ?>">
                        <label for="procedure_date"><?php echo e(trans('cruds.report.fields.procedure_datetime')); ?>*</label>
                        <input type="text" id="procedure_date" name="procedure_date" class="form-control datetime"
                            value="<?php echo e(old('procedure_date', $report->procedure_date ?? '')); ?>" required>
                        <?php if($errors->has('procedure_date')): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('procedure_date')); ?>

                        </p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group <?php echo e($errors->has('observing_date') ? 'has-error' : ''); ?>">
                        <label for="observing_date"><?php echo e(trans('cruds.report.fields.observing_date')); ?>*</label>
                        <input type="text" id="observing_date" name="observing_date" class="form-control date"
                            value="<?php echo e(old('observing_date', $report->observing_date ?? '')); ?>" required>
                        <?php if($errors->has('observing_date')): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('observing_date')); ?>

                        </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group <?php echo e($errors->has('observing_type_id') ? 'has-error' : ''); ?>">
                        <b><?php echo e(trans('cruds.report.fields.observing_type')); ?>*: &nbsp;</b>
                        <?php $__currentLoopData = $observing_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="icheck-primary icheck-inline">
                            <input type="radio" id="observing_type_<?php echo e($type->id); ?>" name="observing_type_id"
                            value="<?php echo e($type->id); ?>"
                            <?php echo e((old('observing_type_id') == $type->id || $report->observing_type_id == $type->id) ? 'checked' : ''); ?>

                            required />
                            <label for="observing_type_<?php echo e($type->id); ?>"><?php echo e($type->title); ?></label>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php if($errors->has('observing_type_id')): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('observing_type_id')); ?>

                        </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            
            <?php $__currentLoopData = $evaluation_set; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competency_title => $evaluations): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
                <div class="col-12">
                    <strong><?php echo e($competency_title); ?></strong>
                </div>
            </div>

            <?php $__currentLoopData = $evaluations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evaluation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
                <div class="col-6">
                    <p class="criterion"> <?php echo e($evaluation->criterionWithTrashed->title); ?></p>
                </div>
                <div class="col-6">
                    <?php $__currentLoopData = json_decode($evaluation->criterionWithTrashed->assessment->assessment_values); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="icheck-primary icheck-inline">
                        <input type="radio"
                            id="point_cr<?php echo e($evaluation->criterionWithTrashed->id); ?>_p<?php echo e($point->value); ?>" class="point"
                            name="point[<?php echo e($evaluation->criterionWithTrashed->id); ?>]" value="<?php echo e($point->value); ?>"
                            data-evaluation_id="<?php echo e($evaluation->id); ?>" data-assessment_value="<?php echo e($point->value); ?>"
                            onclick="updateSingleEvaluation(this)"
                            <?php echo e((old("point.".$evaluation->criterionWithTrashed->id) == $point->value || $evaluation->assessment_value == $point->value) ? 'checked' : ''); ?>

                            required />
                        <label class="custom-label"
                            for="point_cr<?php echo e($evaluation->criterionWithTrashed->id); ?>_p<?php echo e($point->value); ?>">
                            <?php echo e($point->title); ?>

                        </label>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

            <div class="row">
                <div class="col-12">
                    <div class="form-group <?php echo e($errors->has('competency_note') ? 'has-error' : ''); ?>">
                        <label for="competency_note"><?php echo e(trans('cruds.report.fields.notes')); ?></label>
                        <textarea id="competency_note" name="competency_note[<?php echo e($evaluations->competency_id); ?>]"
                            class="form-control"><?php echo e(old('competency_note.'.$evaluations->competency_id, $evaluations->competency_note ?? '')); ?></textarea>

                        <?php if($errors->has('competency_note')): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('competency_note.*')); ?>

                        </p>
                        <?php endif; ?>
                    </div>
                    <hr>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

            <div class="form-group <?php echo e($errors->has('technical_note') ? 'has-error' : ''); ?>">
                <label for="technical_note"><?php echo e(trans('cruds.report.fields.technical_notes')); ?></label>
                <p class="helper-block">
                    <?php echo e(trans('cruds.report.fields.technical_notes_helper')); ?>

                </p>
                <textarea id="technical_note" name="technical_note"
                    class="form-control"><?php echo e(old('technical_note', isset($report) ? $report->technical_note : '')); ?>

                </textarea>
                <?php if($errors->has('technical_note')): ?>
                <p class="help-block">
                    <?php echo e($errors->first('technical_note')); ?>

                </p>
                <?php endif; ?>
            </div>
            <div class="form-group <?php echo e($errors->has('observer_note') ? 'has-error' : ''); ?>">
                <label for="observer_note"><?php echo e(trans('cruds.report.fields.observer_notes')); ?></label>
                <textarea id="observer_note" name="observer_note"
                    class="form-control"><?php echo e(old('observer_note', isset($report) ? $report->observer_note : '')); ?></textarea>

                <?php if($errors->has('observer_note')): ?>
                <p class="help-block">
                    <?php echo e($errors->first('observer_note')); ?>

                </p>
                <?php endif; ?>
            </div>

            <p id="count">Counter</p>

            <div>
                <input class="btn btn-danger" type="submit" value="Išsaugoti">
            </div>
        </form>
    </div> <!-- / card-body -->
</div> <!-- / card -->

<div class="modal fade" id="value-confirmation" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-info"><?php echo e(trans('cruds.report.new_value')); ?>: <span id=json-value></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    // count checked (evaluated) criteria
        var countChecked = function () {
            n = $(".point:checked").length;
            total = $(".criterion").length;
            if (n < total) {
                color = 'red';
                $('input[type=submit]').attr('disabled', true);
            } else {
                color = 'green';
                $('input[type=submit]').attr('disabled', false);
            }
            $("#count").html("<span style='color:" + color + " '> <?php echo e(trans('cruds.report.counter.assessed')); ?> " + n + " / " + total + "</span>");
        };
        countChecked();
        $(".point").on("click", countChecked);

        // confirm evaluation update wit BS modal
        function updateSingleEvaluation(eval) {
            $.ajax({
                headers: {'x-csrf-token': _token},
                method: 'POST',
                url: '<?php echo e(route("admin.reports.updateSingleEvaluation", [$report->id])); ?>',
                data: {evaluation_id: eval.dataset.evaluation_id, assessment_value: eval.dataset.assessment_value, _method: 'PUT'},
                success: function (data) {
                    $('#json-value').html(data.result);
                    $("#value-confirmation").modal('show');
                    setTimeout(function () {
                        $('#json-value').html(''); // unset result
                        $("#value-confirmation").modal('hide');
                    }, 2000);
                }
            });
        }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/egzkomp.test/resources/views/admin/reports/edit.blade.php ENDPATH**/ ?>