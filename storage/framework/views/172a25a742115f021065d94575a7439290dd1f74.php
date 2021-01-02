<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($viewGate, $row)): ?>
    <a class="btn btn-sm btn-primary" href="<?php echo e(route('admin.' . $crudRoutePart . '.show', $row->id)); ?>" title="Žiūrėti">
        <i class="far fa-eye"></i>
    </a>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($editGate, $row)): ?>
    <a class="btn btn-sm btn-info" href="<?php echo e(route('admin.' . $crudRoutePart . '.edit', $row->id)); ?>" title="Taisyti">
        <i class="far fa-edit"></i>
    </a>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($deleteGate, $row)): ?>
    <form action="<?php echo e(route('admin.' . $crudRoutePart . '.destroy', $row->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(trans('global.areYouSure')); ?>');" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
        <button type="submit" class="btn btn-sm btn-danger" title="Trinti"><i class="far fa-trash-alt"></i></button>
    </form>
<?php endif; ?><?php /**PATH /home/vagrant/egzkomp.test/resources/views/partials/datatablesActions.blade.php ENDPATH**/ ?>