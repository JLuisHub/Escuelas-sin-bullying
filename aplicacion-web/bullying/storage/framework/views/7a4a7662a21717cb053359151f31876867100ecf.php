

<?php $__env->startSection('title'); ?> Estudiantes <?php $__env->stopSection(); ?>

<?php $__env->startSection('Head'); ?>
<?php echo e(__('Estudiantes')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('enlaces'); ?>
<a href="<?php echo e(url('estudiantes')); ?>" class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout-dashboard" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
        <path d="M4 4h6v8h-6z"></path>
        <path d="M4 16h6v4h-6z"></path>
        <path d="M14 12h6v8h-6z"></path>
        <path d="M14 4h6v4h-6z"></path>
    </svg>Volver al tablero          
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div >

            <?php if( session('errors') ): ?>
                <div class="alert alert-warning " role="alert">
                    <strong>  <?php echo e(session('errors')->first('error')); ?> 
                    </strong>
                </div>
            <?php endif; ?>

            <div class="card" style="min-width: 280px ">
                <div class="card-header">
                    <?php echo e(__('Cargar base de datos por archivo CSV')); ?>

                </div>
                <div class="card-body card-header">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    <form  action="<?php echo e(url('/estudiantes' )); ?>" method="POST" enctype="multipart/form-data" >
                        <?php echo e(csrf_field()); ?>          
                        <div class="card-body">
                            <center>
                                <div class="col" >
                                    <label class="form-label" style="color:#001640; font-size:25px">Seleccione el archivo</label>
                                    <input class="form-control form-control-rounded mb-2" type="file" name="file" style="width: 280px">
                                </div>
                                <div class="form-footer">
                                    <hr>
                                    <button type="submit" class="btn btn-primary" style="background-color:#001640; border-radius: 30px; font-size:20px; width: 180px">
                                        Guardar cambios
                                    </button>
                                </div>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\juann\Downloads\TSP-Escuelas-sin-bullying\aplicacion-web\bullying\resources\views/estudiantes/reg_estudiantes.blade.php ENDPATH**/ ?>