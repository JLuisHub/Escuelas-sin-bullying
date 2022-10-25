

<?php $__env->startSection('title'); ?> Estudiantes <?php $__env->stopSection(); ?>

<?php $__env->startSection('Head'); ?>
<?php echo e(__('Estudiantes')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('enlaces'); ?>
<a href="<?php echo e(route('home')); ?>" class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
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
            <div class="card" style="min-width: 280px ">
                <div class="card-header">
                    <?php echo e(__('Listado de estudiantes')); ?>

                </div>
                <div class="card-body card-header">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                            <th>Matrícula</th>
                            <th>Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $estudiantes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estudiante): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td >
                                    <button type="submit" class="btn btn-primary w-100" style="background-color:#001640; border-radius: 5px; font-size:12px">
                                        <?php echo e($estudiante -> Matricula); ?>

                                    </button>
                                </td >
                                <td ><?php echo e($estudiante -> Nombre); ?> <?php echo e($estudiante -> Apaterno); ?> <?php echo e($estudiante -> Amaterno); ?></td >
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <hr>
                    <center>
                        <a href="<?php echo e(url('estudiantes/create')); ?>" class="btn btn-primary d-none d-sm-inline-block" style="background-color:#001640; border-radius: 15px; font-size:20px; width: 180px ">
                             + CSV
                        </a>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\juann\Downloads\TSP-Escuelas-sin-bullying\aplicacion-web\bullying\resources\views/estudiantes/lista.blade.php ENDPATH**/ ?>