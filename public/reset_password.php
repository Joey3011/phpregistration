<?php
require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/reset_password.php';
if (is_user_logged_in()) {
    redirect_to('index');
  }
?>
<?php view('header', ['title' => 'Reset Password']) ?>
        <div class="container-fluid">   
            <div class="row justify-content-center">
                <div class="col-sm-6">
                <?php flash() ?>
                        <?php if (isset($errors['reset_password'])) : ?>
                            <div class="error alert-error">
                                 <?= $errors['reset_password'] ?>
                            </div>
                        <?php endif  ?>
                    <form class="form" action="reset_password" method="post">
                        <h4 class="form-title">Request Password Link</h4>
                        <div class="input-group">
                        <label class="form-label" for="email">Email:</label>
                        <input class="form-control"  type="email" name="email" id="email" placeholder="Email" value="<?= $inputs['email'] ?? '' ?>"
                            class="<?= error_class($errors, 'email') ?>">
                        </div>
                        <small><?= $errors['email'] ?? '' ?></small>
                        <div class="d-grid gap-2 mt-3">
                            <button class="btn btn-success" type="submit">Login</button>
                        </div>
                        <span class="form-section">
                            <a class="form-link" href="register">Register</a>
                            <a class="form-link" href="sample_login">Login</a>
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




