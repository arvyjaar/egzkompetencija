<?php $__env->startSection('content'); ?>

    <div class="card">

        <div class="card-header alert alert-info">
            Nauja egzaminuotojo darbo stebėjimo ataskaita
        </div>

        <div class="card-body">

            <form action="<?php echo e(route("admin.monitoring-reports.store")); ?>" method="POST"
                  enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group <?php echo e($errors->has('branch_id') ? 'has-error' : ''); ?>">
                            <label for="branch_id">Filialas*</label>
                            <select name="branch_id" id="branch_id" class="form-control select2"
                                    required>
                                <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($id); ?>" <?php echo e((isset($monitoringReport) && $monitoringReport->branch ? $monitoringReport->branch->id : old('branch_id')) == $id ? 'selected' : ''); ?>><?php echo e($branch); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('branch_id')): ?>
                                <p class="help-block">
                                    <?php echo e($errors->first('branch_id')); ?>

                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group <?php echo e($errors->has('user_id') ? 'has-error' : ''); ?>">
                            <label for="examiner_id">Egzaminuotojas (-a)*</label>
                            <select name="examiner_id" id="examiner_id"
                                    class="form-control select2 "
                                    data-live-search="true"
                                    >
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($id); ?>" <?php echo e((isset($monitoringReport) && $monitoringReport->examiner ? $monitoringReport->examiner->id : old('examiner_id')) == $id ? 'selected' : ''); ?>><?php echo e($user); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('examiner_id')): ?>
                                <p class="help-block">
                                    <?php echo e($errors->first('examiner_id')); ?>

                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="observer_id">Stebėtojas (-a)*</label>
                        <input type="text" class="form-control" disabled="disabled"
                               placeholder="<?php echo e(auth()->user()->name); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group <?php echo e($errors->has('category') ? 'has-error' : ''); ?>">
                            <label for="drivecategory">Kategorija*</label>
                            <select type="text" id="drivecategory" name="drivecategory"
                                    class="form-control select2"
                                    required>
                                <?php $__currentLoopData = App\MonitoringReport::CATEGORIES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drivecategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($drivecategory); ?>" <?php echo e((isset($monitoringReport) && $monitoringReport->drivecategory ? $monitoringReport->drivecategory : old('drivecategory')) == $drivecategory ? 'selected' : ''); ?>><?php echo e($drivecategory); ?></option>
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
                        <div class="form-group <?php echo e($errors->has('exam_date') ? 'has-error' : ''); ?>">
                            <label for="exam_date">Egzamino data, laikas*</label>
                            <input type="text" id="exam_date" name="exam_date"
                                   class="form-control datetime"
                                   value="<?php echo e(old('exam_date', isset($monitoringReport) ? $monitoringReport->exam_date : '')); ?>"
                                   required>
                            <?php if($errors->has('exam_date')): ?>
                                <p class="help-block">
                                    <?php echo e($errors->first('exam_date')); ?>

                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group <?php echo e($errors->has('observing_date') ? 'has-error' : ''); ?>">
                            <label for="observing_date">Stebėjimo data*</label>
                            <input type="text" id="observing_date" name="observing_date"
                                   class="form-control date"
                                   value="<?php echo e(old('observing_date', isset($monitoringReport) ? $monitoringReport->observing_date : '')); ?>"
                                   required>
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
                        <div class="form-group <?php echo e($errors->has('observing_type') ? 'has-error' : ''); ?>">
                            <b>Stebėtas*: &nbsp;</b>
                            <?php $__currentLoopData = App\MonitoringReport::OBSERVING_TYPE_RADIO; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="custom-label" for="observing_type_<?php echo e($key); ?>"><?php echo e($label); ?>

                                <input type="radio" id="observing_type_<?php echo e($key); ?>"
                                       name="observing_type"
                                       value="<?php echo e($key); ?>"
                                       <?php echo e(old('observing_type', isset($monitoringReport) && ($monitoringReport->observing_type) === (string)$key) ? 'checked' : ''); ?>

                                       required>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if($errors->has('observing_type')): ?>
                                <p class="help-block">
                                    <?php echo e($errors->first('observing_type')); ?>

                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="">
                    <label>Vertinimas:</label>
                    <p>
                        <?php $__currentLoopData = $points; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($point->value == 0 ? 'N' : $point->value); ?> - <?php echo e($point->title); ?>,&nbsp;
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </p>
                    <hr>
                </div>

                <?php $__currentLoopData = $competencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <div class="row">
                        <div class="col-12">
                            <strong><?php echo e($competency->title); ?></strong>
                        </div>
                    </div>
                    <?php $__currentLoopData = $competency->criterion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $criterion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                        <div class="row">
                            <div class="col-7">
                                <p class="criterion"><?php echo e($criterion->title); ?></p>
                            </div>
                            <div class="col-5">

                                <?php $__currentLoopData = $points; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                    <label class="custom-label"
                                           for="point_cr<?php echo e($criterion->id); ?>_p<?php echo e($point->id); ?>"> <?php echo e($point->value == 0 ? 'N' : $point->value); ?>

                                    <input type="radio"
                                           id="point_cr<?php echo e($criterion->id); ?>_p<?php echo e($point->id); ?>"
                                           class="point"
                                           name="point[<?php echo e($criterion->id); ?>]"
                                           value="<?php echo e($point->id); ?>"
                                           <?php echo e($point->id == old('point.'.$criterion->id) ? ' checked' : ''); ?>

                                           required>
                                    </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="form-group <?php echo e($errors->has('competency_note') ? 'has-error' : ''); ?>">
                        <label for="competency_note">Pastabos</label>
                        <textarea id="competency_note"
                                  name="competency_note[<?php echo e($competency->id); ?>]"
                                  class="form-control"><?php echo e(old('competency_note.'.$competency->id)); ?>

                                    </textarea>
                        <?php if($errors->has('competency_note')): ?>
                            <p class="help-block">
                                <?php echo e($errors->first('competency_note.*')); ?>

                            </p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <div class="form-group <?php echo e($errors->has('technical_note') ? 'has-error' : ''); ?>">
                    <label for="technical_note">Papildomos/bendrosios pastabos</label>
                    <p class="helper-block">
                        Pastabos dėl techninių priemonių, trukdančių efektyviam darbui,
                        nesusijusios su šiuo
                        įvertinimu
                    </p>
                    <textarea id="technical_note" name="technical_note"
                              class="form-control"><?php echo e(old('technical_note', isset($monitoringReport) ? $monitoringReport->technical_note : '')); ?>

                    </textarea>
                    <?php if($errors->has('technical_note')): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('technical_note')); ?>

                        </p>
                    <?php endif; ?>
                </div>
                <div class="form-group <?php echo e($errors->has('observer_note') ? 'has-error' : ''); ?>">
                    <label for="observer_note">Stebėtojo išvados, pasiūlymai</label>
                    <textarea id="observer_note" name="observer_note"
                              class="form-control"><?php echo e(old('observer_note', isset($monitoringReport) ? $monitoringReport->observer_note : '')); ?></textarea>
                    <?php if($errors->has('observer_note')): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('observer_note')); ?>

                        </p>
                    <?php endif; ?>

                </div>

                <p id="count">Įvertinimų skaitliukas</p>

                <div>
                    <input class="btn btn-danger" type="submit" value="Išsaugoti">
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
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
            $("#count").html("<span style='color:" + color + " '> Įvertinote aspektų: " + n + " iš " + total + "</span>");
        };
        countChecked();
        $(".point").on("click", countChecked);
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/egzkomp.test/resources/views/admin/monitoringReports/create.blade.php ENDPATH**/ ?>