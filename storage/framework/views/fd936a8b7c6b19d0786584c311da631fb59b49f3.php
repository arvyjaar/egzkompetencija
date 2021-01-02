 <?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header alert alert-info">
        Nauja darbuotojo (procedūros) stebėjimo ataskaita
    </div>

    <div class="card-body">
        <form action="<?php echo e(route('admin.reports.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-4">
                    <div class="form-group <?php echo e($errors->has('user_id') ? 'has-error' : ''); ?>">
                        <label for="employee_id">Darbuotojas (-a)*</label>
                        <select name="employee_id" id="employee_id" class="form-control select2"
                            data-live-search="true">
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($id); ?>"
                            <?php echo e(old('employee_id') == $id ? 'selected' : ''); ?>

                            >
                                <?php echo e($user); ?>

                            </option>
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
                    <label for="observer_id">Vertintojas (-a)*</label>
                    <input type="text" class="form-control" disabled="disabled"
                        placeholder="<?php echo e(auth()->user()->name); ?>" />
                </div>
                <div class="col-4">
                    <label for="form_id">Forma:*</label>
                    <select name="form_id" id="form_id" class="form-control"> 
                        <option value="<?php echo e($form->id); ?>" selected>
                            <?php echo e($form->title); ?>, v.<?php echo e($form->version); ?>

                        </option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group <?php echo e($errors->has('drivecategory_id') ? 'has-error' : ''); ?>">
                        <label for="drivecategory_id">TP kategorija*</label>
                        <select type="text" id="drivecategory_id" name="drivecategory_id" class="form-control">
                            <?php $__currentLoopData = $drivecategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drivecategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($drivecategory->id); ?>"
                                <?php echo e(old('drivecategory_id') == $drivecategory->id ? 'selected' : ''); ?>

                            >
                                <?php echo e($drivecategory->title); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('drivecategory_id')): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('drivecategory_id')); ?>

                        </p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group <?php echo e($errors->has('procedure_date') ? 'has-error' : ''); ?>">
                        <label for="procedure_date">
                            Procedūros data ir laikas*</label>
                        <input type="text" id="procedure_date" name="procedure_date" class="form-control datetime"
                            value="<?php echo e(old('procedure_date')); ?>"
                            required />
                        <?php if($errors->has('procedure_date')): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('procedure_date')); ?>

                        </p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group <?php echo e($errors->has('observing_date') ? 'has-error' : ''); ?>">
                        <label for="observing_date">Stebėjimo data*</label>
                        <input type="text" id="observing_date" name="observing_date" class="form-control date"
                            value="<?php echo e(old('observing_date')); ?>"
                            required />
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
                        <b>Buvo stebėta*: &nbsp;</b>
                        <?php $__currentLoopData = $observing_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="custom-label" for="observing_type_<?php echo e($type->id); ?>"><?php echo e($type->title); ?>

                        </label>
                        <input type="radio" id="observing_type_<?php echo e($type->id); ?>" name="observing_type_id"
                            value="<?php echo e($type->id); ?>"
                            <?php echo e((old('observing_type_id') == $type->id) ? 'checked' : ''); ?>

                            required />

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php if($errors->has('observing_type_id')): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('observing_type_id')); ?>

                        </p>
                        <?php endif; ?>
                    </div>
                </div>
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
                    
                    <?php $__currentLoopData = json_decode($criterion->assessment->assessment_values); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="custom-label" for="point_cr<?php echo e($criterion->id); ?>_p<?php echo e($point->value); ?>">
                        <?php echo e($point->title); ?>

                        <input type="radio" class="point" id="point_cr<?php echo e($criterion->id); ?>_p<?php echo e($point->value); ?>"
                            name="point[<?php echo e($criterion->id); ?>]" value="<?php echo e($point->value); ?>"
                            <?php echo e((null !== old('point.'.$criterion->id) && old('point.'.$criterion->id) == $point->value) ? 'checked' : ''); ?>

                            
                        />
                    </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="form-group <?php echo e($errors->has('competency_note') ? 'has-error' : ''); ?>">
                <label for="competency_note">Pastabos</label>
                <textarea 
                    id="competency_note_<?php echo e($competency->id); ?>" 
                    name="competency_note[<?php echo e($competency->id); ?>]" 
                    class="form-control"><?php echo e(old('competency_note.'.$competency->id)); ?></textarea>
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
                    Pastabos dėl techninių priemonių, trukdančių efektyviam
                    darbui, nesusijusios su šiuo įvertinimu
                </p>
                <textarea id="technical_note" name="technical_note" class="form-control"><?php echo e(old('technical_note')); ?></textarea>
                <?php if($errors->has('technical_note')): ?>
                <p class="help-block">
                    <?php echo e($errors->first('technical_note')); ?>

                </p>
                <?php endif; ?>
            </div>
            <div class="form-group <?php echo e($errors->has('observer_note') ? 'has-error' : ''); ?>">
                <label for="observer_note">Stebėtojo išvados, pasiūlymai</label>
                <textarea id="observer_note" name="observer_note"
                    class="form-control"><?php echo e(old('observer_note')); ?></textarea>
                <?php if($errors->has('observer_note')): ?>
                <p class="help-block">
                    <?php echo e($errors->first('observer_note')); ?>

                </p>
                <?php endif; ?>
            </div>

            <p id="count">Įvertinimų skaitliukas</p>

            <div>
                <input class="btn btn-danger" type="submit" value="Išsaugoti" />
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
            color = "red";
            $("input[type=submit]").attr("", true);
        } else {
            color = "green";
            $("input[type=submit]").attr("disabled", false);
        }
        $("#count").html(
            "<span style='color:" +
                color +
                " '> Įvertinote aspektų: " +
                n +
                " iš " +
                total +
                "</span>"
        );
    };
    countChecked();
    $(".point").on("click", countChecked);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/egzkomp.test/resources/views/admin/reports/create.blade.php ENDPATH**/ ?>