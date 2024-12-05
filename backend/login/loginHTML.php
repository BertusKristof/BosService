<?php
require_once 'login.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belépés</title>
</head>
<body>
    <header>
        <h1>Belépés</h1>
    </header>
    <main>
        <form id="loginForm" method="POST">
            <input placeholder="Email-cím vagy Telefonszám" type="text" name="credential" value="<?php echo isset($credential) ? htmlspecialchars($credential): ''; ?>"><br><br>
            <?php if(!empty($credential_error)): ?>
            <span style="color:red"><?php echo $credential_error ?></span><br>
            <?php endif; ?>
            
            <input placeholder="Jelszó" type="password" name="password"><br><br>
            <?php if(!empty($password_error)): ?>
            <span style="color:red"><?php echo $password_error ?></span><br>
            <?php endif; ?>

            <a href="../register/registerHTML.php">Nincs fiókja? Regisztráljon</a><br>
            <button type="submit">Belépés</button>
            <span style="color:red"><?php echo $login_error ?></span>

        </form>
    </main>
</body>
</html>