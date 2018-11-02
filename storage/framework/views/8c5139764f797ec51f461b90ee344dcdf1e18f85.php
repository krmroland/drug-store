<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo e(mix('css/app.css')); ?>" rel="stylesheet">
</head>
<body>
  <div id="app">
    <header class="header"></header>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2">
          <?php echo $__env->make('partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <div class="col-md-10">
          <main>
            <router-view></router-view>
          </main>
        </div>
      </div>
   
    </div>

  </div>
  <script src="<?php echo e(mix('js/app.js')); ?>"></script>
</body>
</html>
