<?php
require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/login.php';
if (is_user_logged_in()) {
    redirect_to('index');
  }
?>
<?php view('header', ['title' => 'Login']) ?>
        <div class="container-fluid">   
            <div class="row justify-content-center">
                <div class="col-sm-6">
                    <?php flash() ?>
                        <?php if (isset($errors['login'])) : ?>
                            <div class="error alert-error">
                                <small><?= $errors['login'] ?></small>
                            </div>  
                        <?php endif  ?>
                    <form class="form" action="login" method="post">
                        <h1 class="form-title">Login</h1>
                        <div class="input-group">
                            <label class="form-label" for="username">Username:</label>
                            <input class="form-control" type="text" name="username" id="username" value="<?= $inputs['username'] ?? '' ?>" placeholder="Username or Email" autocomplete="on">
                        </div>
                        <small><?= $errors['username'] ?? '' ?></small>
                        <div class="input-group">
                            <label class="form-label" for="password">Password:</label>
                            <input class="form-control" type="password" name="password" id="password" placeholder="Password" >
                        </div>
                        <small><?= $errors['password'] ?? '' ?></small>
                        <div class="d-grid gap-2 mt-3">
                            <button class="btn btn-success" type="submit">Login</button>
                        </div>
                        <span class="form-section">
                            <a class="form-link" href="register">Create Account</a>
                            <a class="form-link" href="reset_password">Forgot Password</a>
                        </span>
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