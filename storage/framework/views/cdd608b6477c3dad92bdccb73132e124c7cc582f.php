<?php $__env->startSection('content'); ?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><?php echo e(__('Dashboard')); ?></div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                <div class='row justify-content-between'><div id="cercle_temp">
                    <div id="temperature">
                         <?php echo "17º";?>
                    </div>
                </div>
                <div id="cercle_humi">
                    <div id="humiditer">
                        <?php 
                        echo "43%";
                        ?>
                    </div>
                </div>
                </div>
                <text class='graphique_jour'>Température et Humidité de la journer</text>
                <canvas id="myChart" style='width:50%;height:50%'></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('JS'); ?>
<script src="<?php echo e(asset('js/test.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\meteo\resources\views/home.blade.php ENDPATH**/ ?>