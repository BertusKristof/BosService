<?php
require_once 'register.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .error{
            color: red;
            font-size: 0.9em;
        }
    </style>
    <title>Regisztrálás</title>
</head>
<body>
    <h1>Regisztráció</h1>
    </header>
    <main>
        <form method="POST">
            
            <input placeholder="Vezetéknév" type="first_name" name="first_name" value="<?php echo isset($first_name) ? htmlspecialchars($first_name) : ''; ?>" ><br>
            <?php if (!empty($first_name_error)): ?>
                <p class="error"><?php echo $first_name_error; ?></p>
            <?php endif; ?>

            <input placeholder="Keresztnév" type="last_name" name="last_name" value="<?php echo isset($last_name) ? htmlspecialchars($last_name) : ''; ?>" ><br>
            <?php if (!empty($last_name_error)): ?>
                <p class="error"><?php echo $last_name_error; ?></p>
            <?php endif; ?>

            <input placeholder="Email cím" type="text" name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" ><br>
            <?php if (!empty($email_error)): ?>
                <p class="error"><?php echo $email_error; ?></p>
            <?php endif; ?>

            <input placeholder="Jelszó" type="password" name="password" value="<?php echo isset($password) ? htmlspecialchars($password) : ''; ?>" ><br>
            <?php if (!empty($password_error)): ?>
                <p class="error"><?php echo $password_error; ?></p>
            <?php endif; ?>

            <input placeholder="Telefonszám='123-456-7890'" type="tel" name="phone" value="<?php echo isset($phone) ? htmlspecialchars($phone) : ''; ?>"><br>
            <?php if (!empty($phone_error)): ?>
                <p class="error"><?php echo $phone_error; ?></p>
            <?php endif; ?>

            <button type="submit">Regisztrálás</button>
        </form>
    </main>
</body>
</html>