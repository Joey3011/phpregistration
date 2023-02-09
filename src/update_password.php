<?php
$inputs = [];
$errors = [];

if(isset($_POST['password']) && $_POST['email']){
    $fields = [
        'email' => 'email | required',
         'token_code' => 'string | required',
        'password' => 'string | required | secure',
        'password2' => 'string | required | same: password'
    ];

    // custom messages
    $messages = [
        'password2' => [
            'required' => 'Please enter the password again',
            'same' => 'The password does not match'
        ]
    ];

    [$inputs, $errors] = filter($_POST, $fields, $messages);
    
    $email = $_POST['email'];
    $token = $_POST['token_code'];
    
 
    $user = verify_pwd_link($email, $token);
    
    $reset_link = APP_URL . "/update_password?email=$email&token_code=$token";
    
    
        if ($errors) {
               redirect_with($reset_link, ['errors' => $errors, 'inputs' => $inputs]); 

         }
       
        if($user && update_pwd($user['email'], $inputs['password'])){
           redirect_with_message('login', 'Password was successfuly updated!');
        }
}
 else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}