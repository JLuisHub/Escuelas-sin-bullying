


<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <?php echo e(__('Area administrativa de directivos')); ?>

                </div>
                <div class="card-body card-header">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    <br>
                    <div class="form-group mb-3 row">
                        <a href="<?php echo e(url('docentes')); ?>" class="btn btn-outline-primary w-100" style="background-color:#001640; border-radius: 15px; font-size:20px; width: 180px; color:white ">Docentes</a>
                    </div>
                    <div class="form-group mb-3 row">   
                        <a href="<?php echo e(url('estudiantes')); ?>" class="btn btn-outline-primary w-100" style="background-color:#001640; border-radius: 15px; font-size:20px; width: 180px; color:white ">Estudiantes</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\juann\Downloads\TSP-Escuelas-sin-bullying\aplicacion-web\bullying\resources\views/home.blade.php ENDPATH**/ ?>