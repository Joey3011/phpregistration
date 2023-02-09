<?php
require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/register.php';
if (is_user_logged_in()) {
    redirect_to('index');
  }
?>
<?php view('header', ['title' => 'Registration']) ?>

<div class="container-fluid">
            <div class="row justify-content-center mt-5 pt-5">
                <div class="col-sm-6">
                    <?php flash() ?> 
                    <form class="" action="register" method="post">
                        <h3 class="form-title">Create Account</h3>
                            <div class="input-group">
                                <label class="form-label" for="username">Username:</label>
                                <input class="form-control" type="text" name="username" id="username" placeholder="Username" value="<?= $inputs['username'] ?? '' ?>" class="<?= error_class($errors, 'username') ?>" > 
                            </div>
                            <small><?= $errors['username'] ?? '' ?></small>
                            <div class="input-group">
                                <label class="form-label" for="email">Email:</label>
                                <input class="form-control" type="email" name="email" id="email" placeholder="Email" value="<?= $inputs['email'] ?? '' ?>" class="<?= error_class($errors, 'email') ?>">
                            </div>
                            <small><?= $errors['email'] ?? '' ?></small>
                            <div class="input-group">
                                <label class="form-label" for="password">Password:</label>
                                <input class="form-control" type="password" name="password" id="password" placeholder="Password" value="<?= $inputs['password'] ?? '' ?>" class="<?= error_class($errors, 'password') ?>" >
                            </div>
                            <p><small><?= $errors['password'] ?? '' ?></small></p> 
                            <div class="input-group">
                                <label class="form-label" for="password2">Re-type Password:</label>
                                <input class="form-control" type="password" name="password2" id="password2" placeholder="Re-type Password" value="<?= $inputs['password2'] ?? '' ?>" class="<?= error_class($errors, 'password2') ?>">
                            </div>
                            <small><?= $errors['password2'] ?? '' ?></small>
                            <div class="input-group">
                                <label class="form-label"  for="agree">
                                    <input class="form-input_type" type="checkbox" name="agree" id="agree" value="checked" <?= $inputs['agree'] ?? '' ?> /> I agree with the 
                                    <a class="form-link" href="#" title="term of services">term of services</a>
                                </label>
                            </div>
                            <small><?= $errors['agree'] ?? '' ?></small>
                            <div class="d-grid gap-2">
                                <button class="btn btn-success" type="submit">Register</button>
                            </div>
                            <span class="form-footer">Already a member?&nbsp;<a class="form-link" href="sample_login">Login here</a></span>
                    </form>
                </div>
            </div>
        </div>
    <div class="bottom-area">
        <div class="containers">
            <button class="toggle-btn">
                <i class="fa fa-moon-o" aria-hidden="true"></i>
                <i class="fa fa-sun-o" aria-hidden="true"></i>
            </button>
        </div>
    </div>

<?php view('footer-home') ?>  





























