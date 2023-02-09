<?php
require __DIR__ . '/../src/bootstrap.php';
require_login();
?>
<?php view('header-content', ['title' => 'Dashboard']) ?>
<span class="main-container"> 
    <div class="container">
        <div class="row">
            <div class="cols-xs-1">
                    </br>
                    <h1 class="form-htag">Welcome&nbsp;<?= current_user() ?>!!</h1> 
            </div>
       </div>
  </div>                                                                                                                              
</span>
<?php view('footer-log') ?>

