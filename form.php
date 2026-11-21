<h2><?php echo $title; ?></h2>

<form method="post" action="index.php?action=<?php echo $action; ?>">
    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">

    <label>Name</label>
    <input type="text" name="name" maxlength="100" value="<?php echo htmlspecialchars($name); ?>">
    <?php if (isset($errors['name'])) { ?>
        <span class="error"><?php echo $errors['name']; ?></span>
    <?php } ?>

    <label>Email</label>
    <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
    <?php if (isset($errors['email'])) { ?>
        <span class="error"><?php echo $errors['email']; ?></span>
    <?php } ?>

    <label>Phone</label>
    <input type="text" name="phone" placeholder="05xxxxxxxx" value="<?php echo htmlspecialchars($phone); ?>">
    <?php if (isset($errors['phone'])) { ?>
        <span class="error"><?php echo $errors['phone']; ?></span>
    <?php } ?>

    <br>
    <input type="submit" value="Save" class="btn">
    <a href="index.php">Cancel</a>
</form>
