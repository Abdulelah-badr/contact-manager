<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contact Manager</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="nav">
    <a href="index.php" class="logo">Contact Manager</a>
    <div class="right">
        <?php if (isset($_SESSION['admin_id'])) { ?>
            Hi, <?php echo htmlspecialchars($_SESSION['username']); ?> | <a href="index.php?action=logout">Logout</a>
        <?php } else { ?>
            <a href="index.php?action=login">Admin Login</a>
        <?php } ?>
    </div>
</div>

<div class="container">
<?php
if (isset($_SESSION['msg'])) {
    echo '<div class="msg">' . $_SESSION['msg'] . '</div>';
    unset($_SESSION['msg']);
}
?>
