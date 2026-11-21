<div class="login-box">
    <h2>Admin Login</h2>

    <?php if ($error != "") { ?>
        <p class="error"><?php echo $error; ?></p>
    <?php } ?>

    <form method="post" action="index.php?action=login">
        <label>Username</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">

        <label>Password</label>
        <input type="password" name="password">

        <br>
        <input type="submit" value="Login" class="btn">
    </form>
</div>
