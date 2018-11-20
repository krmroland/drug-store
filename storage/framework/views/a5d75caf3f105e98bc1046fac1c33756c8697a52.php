<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Drug Store</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo e(mix('css/app.css')); ?>" rel="stylesheet">
</head>
<body id="welcome">
    <div class="col-md-4 mx-auto mt-2">
        <div class="card">
            <h3 class="card-title text-center"><?php echo e(config('app.name')); ?></h3>
            <hr>
            <h4 class="text-center">Login Form</h4>
            <div class="card-body">
                <form method="POST" action="/login">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input  type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
                        
                        <?php if($errors->has('email')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>Password</label>

                        <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required>
                        
                        <?php if($errors->has('password')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">
                            Login
                        </button>
                        <div class="form-group mt-2">
                            <a href="<?php echo e(route('register')); ?>">Register instead</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
