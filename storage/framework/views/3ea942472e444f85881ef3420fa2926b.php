<?php $__env->startSection('tilte', 'Trang chủ'); ?>

<?php $__env->startSection('content'); ?>
<!-- customer login start -->
<div class="customer_login">
    <div class="row">
        <!--login area start-->
        <div class="col-lg-6 col-md-6">
            <div class="account_form">
                <h2>Đăng nhập</h2>
                <form action="<?php echo e(route('login')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <p>
                        <label>Tên đăng nhập <span>*</span></label>
                        <input type="text" name="username">
                    </p>
                    <p>
                        <label>Mật khẩu <span>*</span></label>
                        <input type="password" name="password">
                    </p>
                    <div class="login_submit">
                        <button type="submit">Đăng nhập</button>
                        <label for="remember">
                            <input id="remember" type="checkbox">Nhớ mật khẩu
                        </label>
                        <a href="#">Bạn quên mật khẩu?</a>
                    </div>
                </form>
            </div>
        </div>
        <!--login area start-->

        <!--register area start-->
        <div class="col-lg-6 col-md-6">
            <div class="account_form register">
                <h2>Đăng ký</h2>
                <form action="<?php echo e(route('register')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <p>
                        <label>Username <span>*</span></label>
                        <input type="text" name="username" >
                    </p>
                    <p>
                        <label>Địa chỉ email <span>*</span></label>
                        <input type="text" name="email">
                    </p>
                    <p>
                        <label>Mật khẩu <span>*</span></label>
                        <input type="password" name="password">
                    </p>
                    <div class="login_submit">
                        <button type="submit">Đăng ký</button>
                    </div>
                </form>
            </div>
        </div>
        <!--register area end-->
    </div>
</div>

<!-- customer login end -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if(session('success')): ?>
            alert("<?php echo e(session('success')); ?>");
            <?php echo e(session()->forget('success')); ?> // Xóa thông báo khỏi session
        <?php endif; ?>

        <?php if($errors->any()): ?>
            var errors = "";
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                errors += "<?php echo e($error); ?>\n";
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            alert(errors);
        <?php endif; ?>
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\asm-laravel\resources\views/login.blade.php ENDPATH**/ ?>