<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>I am a rodgers a page </title>
</head>
<body>
    <h1>Users</h1>
    <ul>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($task->title); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</body>
</html>