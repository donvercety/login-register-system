<?php
require_once 'core/init.php';

if (Session::exists('home')) {
    echo Session::flash('home');
}

$user = new User();

if ($user->isLoggedIn()) {
    ?>
    <p>Hello <a href="profile.php?user=<?php echo escape($user->data()->username); ?>" ><?php echo escape($user->data()->username); ?></a>!</p>
    <ul>
        <li><a href="logout.php">Log out</a></li>
        <li><a href="update.php">Update details</a></li>
        <li><a href="changepassword.php">Change Password</a></li>
    </ul>
    <?php
    /* CHECKING PERMISSION TYPE,
     * SIMPLE BUT YET VERY POWERFUL
     */
    if ($user->hasPermission('admin')) {
        echo '<p>You are an <b>administrator</b>!</p>';
    }
}
else {
    echo 'You need to <a href="login.php">log in</a> or <a href="register.php" >register</a>!';
}