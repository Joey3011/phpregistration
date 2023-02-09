<?php
$errors = [];
$inputs = [];

if (is_post_request()) {
    $fields = [
        'senderEmail' => 'email | required | email',
        'receiverEmail' => 'email | required | email',
        'emailSubject' => 'string | required',
        'senderMessage' => 'string | required'
    ];
    [$inputs, $errors] = filter($_POST, $fields);

    if ($errors) {
        redirect_with('contact', [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }
    if (!sendMail( $inputs['senderEmail'], $inputs['receiverEmail'], $inputs['emailSubject'], $inputs['senderMessage'])) {
        $errors['resume'] = 'Failed to connect to mail server';
        redirect_with('contact', [
            'errors' => $errors,
            'inputs' => $inputs
        ]);
    }
    redirect_with_message(
        'contact',
        'Email sent!!.'
    );
} else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}