<?php
$errors = [];
$inputs = [];

if (is_post_request()) {
    $fields = [
        'username' => 'string | required | alphanumeric | between: 3, 25 | unique: users, username',
        'email' => 'email | required | email | unique: users, email',
        'password' => 'string | required | secure',
        'password2' => 'string | required | same: password',
        'agree' => 'string | required'
    ];

    // custom messages
    $messages = [
        'password2' => [
            'required' => 'Please enter the password again',
            'same' => 'The password does not match'
        ],
        'agree' => [
            'required' => 'You need to agree to the term of services to register'
        ]
    ];

    [$inputs, $errors] = filter($_POST, $fields, $messages);

    if ($errors) {
        redirect_with('register', [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }

    $token_code = generate_token_code();

    if (register_user($inputs['username'], $inputs['email'], $inputs['password'], $token_code)) {

        // send the activation email
        send_activation_email($inputs['email'], $token_code);
            redirect_with_message(
                'register',
                'Activation link was sent to your email.'
            );

    }

} else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}