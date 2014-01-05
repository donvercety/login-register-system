<?php
require_once './core/init.php';

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array('required' => TRUE),
            'password' => array('required' => TRUE)
        ));

        if ($validation->passed()) {
            $user = new User;
            $remember = (Input::get('remember') === 'on') ? TRUE : FALSE;
            $login = $user->login(Input::get('username'), Input::get('password'), $remember);

            if ($login) {
                Redirect::to('index.php');
            }
            else {
                echo 'Sorry, logging in error';
            }
        }
        else {
            foreach ($validation->errors() as $error) {
                echo $error, '<br />';
            }
        }
    }
}
?>

<form action="" method="POST" >
    <div>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" autocomplete="off" >
    </div>

    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" autocomplete="off" >
    </div>

    <div>
        <label for="remember">
            <input type="checkbox" name="remember" id="remember"> Remember me
        </label>
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" >
    <input type="submit" value="Log In">
</form>