<div class="section promo-part">
    <div class="container">
        <div class="row">
            <?php $__currentLoopData = Cache::get('r_campaigns'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="promo-img">
                    <a href="<?php echo e(route('web.campaign.products.show', $c->slug)); ?>">
                        <img src="<?php echo e(asset($c->image)); ?>" alt="<?php echo e($c->title); ?>">
                    </a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div><?php /**PATH C:\laragon\www\eticaretim\resources\views/web/homepage/layouts/campaign.blade.php ENDPATH**/ ?>