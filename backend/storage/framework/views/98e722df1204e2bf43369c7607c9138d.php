<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció - BosService</title>
    <link rel="stylesheet" href="<?php echo e(asset('styles.css')); ?>">
    <script src="<?php echo e(asset('js/scripts.js')); ?>" defer></script>
</head>
<body>
    <header>
        <div class="container2">
            <h1>BosService Regisztráció</h1>
            <nav class="nav2">
                <a href="<?php echo e(url('/')); ?>">Vissza a főoldalra</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="register2">
            <h2>Regisztráció</h2>
            <form action="<?php echo e(route('register')); ?>" method="POST" >
                <?php echo csrf_field(); ?>
                <label for="last_name">Vezetéknév</label>
                <input type="text" id="last_name" name="last_name" required> 
                
                <label for="first_name">Keresztnév</label>
                <input type="text" id="first_name" name="first_name" required>

                <label for="register_email">Email-cím</label>
                <input type="email" id="register_email" name="register_email" required>

                <label for="register_phone">Telefonszám</label>
                <input type="text" id="phone" name="register_phone" required>

                <label for="register_password">Jelszó</label>
                <input type="password" id="register_password" name="register_password" required><br>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <button type="submit">Regisztráció</button>
            </form>
        </section>
    </main>

    <footer>
        <div class="container2">
            <p>&copy; 2024 Autószerviz. Minden jog fenntartva.</p>
        </div>
    </footer>
</body>
</html>
<?php /**PATH C:\Users\krist\Documents\PHP\BOSSERIVCE\resources\views/register.blade.php ENDPATH**/ ?>