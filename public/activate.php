<?php

require __DIR__ . '/../src/bootstrap.php';

if (is_get_request()) {
    [$inputs, $errors] = filter($_GET, [
        'email' => 'string | required | email',
        'token_code' => 'string | required'
    ]);

    if (!$errors) {
        $user = find_unverified_user($inputs['token_code'], $inputs['email']);

        // if user exists and activate the user successfully
        if ($user && activate_user((int)$user['id'])) {
            redirect_with_message(
                'login',
                'You account has been activated successfully!'
            );
        }
    }
}

// redirect to the register page in other cases
redirect_with_message(
    'register',
    'The activation link is already expired.',
    FLASH_ERROR
);