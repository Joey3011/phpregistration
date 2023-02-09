<?php
require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/update_password.php';
?>
<?php
$user = verify_pwd_link($_GET['email'],  $_GET['token_code']);
if(!$user){
        redirect_with_message(
            'login',
            'The reset password link is already expired.',
            FLASH_ERROR
        );
}
?>
<?php view('header-login', ['title' => 'Update Password']) ?>

<div class="form-menu">
 <form class="form-elements" action="update_password" method="post">
 <h4 class="form-htag">Update Password</h4>
    <div>
        <input type="hidden" name="email" id="email" value="<?= $_GET['email'] ?? '' ?>"> 
        <input type="hidden" name="token_code" id="token_code" value="<?= $_GET['token_code'] ?? '' ?>">  
        <label class="form-label" for="password">Password:</label>
        <input class="form-input" type="password" name="password" id="password" placeholder="Password" value="<?= $inputs['password'] ?? '' ?>"class="<?= error_class($errors, 'password') ?>">
                <small><?= $errors['password'] ?? '' ?></small>
    </div>
    <div>
        <label class="form-label" for="password2">Re-type Password:</label>
        <input class="form-input" type="password" name="password2" id="password2" placeholder="Re-type Password" value="<?= $inputs['password2'] ?? '' ?>" class="<?= error_class($errors, 'password2') ?>">
        <small><?= $errors['password2'] ?? '' ?></small>
    </div>
    <section class="form-section">
            <button class="form-button" type="submit">Update</button>
    </section>
</form>
</div>
<?php view('footer-log') ?>
