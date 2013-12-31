<?php
require_once 'core/init.php';

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array(
                'required' => TRUE,
                'min' => 2,
                'max' => 20,
                'unique' => 'users'
            ),
            'password' => array(
                'required' => TRUE,
                'min' => 6
            ),
            'password_again' => array(
                'required' => TRUE,
                'matches' => 'password'
            ),
            'name' => array(
                'required' => TRUE,
                'min' => 2,
                'max' => 50
            )
        ));
        if ($validate->passed()) {
            Session::flash('success', 'You registrated successfully!');
            header('Location: index.php');
        }
        else {
            foreach ($validation->errors() as $error) {
                echo $error, '<br>';
            }
        }
    }
}
?>

<form action="" method="post">
    <div class="field">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off" />
    </div>

    <div class="field">
        <label for="password">Choose password:</label>
        <input type="password" name="password" id="password" value="" />
    </div>

    <div class="field">
        <label for="password_again">Repeat password:</label>
        <input type="password" name="password_again" id="password_again" value="" />
    </div>

    <div class="field">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo escape(Input::get('name')); ?>" autocomplete="off" />
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
    <input type="submit" value="Register" />
</form>