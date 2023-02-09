<?php
$inputs = [];
$errors = [];

if (is_post_request()) {
    [$inputs, $errors] = filter($_POST, [
        'email' => 'email | required | email',
    ]);

$user = find_user_by_email($inputs['email']);
if(!$user){
    $errors['reset_password'] = 'Incorrect email address';
    redirect_with('reset_password', [
        'errors' => $errors,
        'inputs' => $inputs
    ]);
}
$token_code = generate_token_code();

if(request_password($inputs['email'], $token_code)){
    send_reset_password_email($inputs['email'], $token_code);
    redirect_with_message(
        'reset_password',
        'Reset password link was sent to your email.'
    );
}
}else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}