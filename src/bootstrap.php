<?php

session_start();
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/libs/helpers.php';
require_once __DIR__ . '/libs/flash.php';
require_once __DIR__ . '/libs/sanitization.php';
require_once __DIR__ . '/libs/validation.php';
require_once __DIR__ . '/libs/filter.php';
require_once __DIR__ . '/libs/connection.php';
require_once __DIR__ . '/reauth.php';

function generate_token_code(): string
{
    return bin2hex(random_bytes(16));
}

function send_activation_email(string $email, string $token_code): void
{
    // create the activation link
    $activation_link = APP_URL . "/activate?email=$email&token_code=$token_code";
    // set email subject & body
    $subject = 'Signup | Verification';
    $from = 'no-reply@email.com';
 
        // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
    // Create email headers
    $headers .= 'From: '.$from."\r\n".
        'Reply-To: '.$from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
 
    // Compose a simple HTML email message
    $message = '<html><body>';
    $message .= '<p style="color:#000;" font-size:12px;>Thank you for signing up</p>';
    $message .= '<p style="color:#000;font-size:12px;">Your account has been created, you can login using the username and password you have registered after you activated your account.</p>';
        $message .= '<p style="color:#000;font-size:12px;">If you did not initiate this action please disregard it.</p>';
    $message .= '<p style="color:#000;font-size:12px;">Please click the link below to activate your account:</p>';
    $message .= '<a href="' .$activation_link. '" style="color: royalblue;font-size:12px;;">Your Account Activation Link</a>';
    $message .= '</body></html>';  
    // send the email
    mail($email, $subject, $message, $headers);
}

function send_reset_password_email(string $email, string $token_code): void
{
    // create the activation link
    $password_link = APP_URL . "/update_password?email=$email&token_code=$token_code";
    // set email subject & body
    $subject = 'Reset Password Request';
    $from = 'no-reply@email.com';
 
        // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
    // Create email headers
    $headers .= 'From: '.$from."\r\n".
        'Reply-To: '.$from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
 
    // Compose a simple HTML email message
    $message = '<html><body>';
    $message .= '<p style="color:#000;" font-size:12px;>Hi!</p>';
    $message .= '<p style="color:#000;font-size:12px;">You have requested a reset password to your account.</p>';
    $message .= '<p style="color:#000;font-size:12px;">Please login to your account and reset your password.</p>';
    $message .= '<p style="color:#000;font-size:12px;">Kindly disregard this email if you did not request for this action.</p><br />';
    $message .= '<p style="color:#000;font-size:12px;">Please click the link below to reset your password:</p>';
    $message .= '<a href="' .$password_link. '" style="color: royalblue;font-size:12px;;">Your Reset Password Link</a>';
    $message .= '</body></html>';  
    // send the email
    mail($email, $subject, $message, $headers);
}

function delete_user_by_id(string $id, int $active = 0){
    $sql = 'DELETE FROM users
            WHERE id =:id and active=:active';
    $statement = db()->prepare($sql);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->bindValue(':active', $active, PDO::PARAM_INT);
    return $statement->execute();
}  
function sendMail(string $senderEmail, string $receiverEmail, string $emailSubject, string $senderMessage):bool{  
        // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
    // Create email headers
    $headers .= 'From: '.$senderEmail."\r\n".
        'Reply-To: '.$senderEmail."\r\n" .
        'X-Mailer: PHP/' . phpversion();
 
    // Compose a simple HTML email message
    $message = '<html><body>';
    $message .= '<p style="color:#000;font-size:12px;">'. $senderMessage.'</p><br />';
    $message .= '</body></html>';  
    // send the email
    $mail = mail($receiverEmail, $emailSubject, $message, $headers);
    if($mail){
        return true;
    }else{
        return false;
    }
}
function find_unverified_user(string $token_code, string $email)
{
    $sql = 'SELECT *
            FROM users
            WHERE email=:email'; 
    $statement = db()->prepare($sql);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
   if($user && $user['token_code_expiry'] < date('Y-m-d H:i:s', time())){ 
        delete_user_by_id($user['id']);
        return null;
    }else if($user && password_verify($token_code, $user['token_code'])){
        return $user;
  }else{
      return null;
  }
}

function activate_user(int $user_id)
{
    $sql = 'UPDATE users
            SET active = 1,
                token_code = "",
                updated_on = CURRENT_TIMESTAMP,
                reason = "account activation"
            WHERE id=:id';
    $statement = db()->prepare($sql);
    $statement->bindValue(':id', $user_id, PDO::PARAM_INT);
    return $statement->execute();
}

function verify_pwd_link(string $email, string $token_code)
{
    $sql = 'SELECT *
            FROM users
            WHERE email=:email';           
    $statement = db()->prepare($sql);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if($user && $user['token_code_expiry'] < date('Y-m-d H:i:s', time())){ 
        return null;
    }else if($user && password_verify($token_code, $user['token_code'])){
        return $user;
  }else{
      return null;
  }
}

function update_pwd(string $email, string $password){
    $sql = 'UPDATE users
        SET pasword = :password,
        token_code = "",
        updated_on = CURRENT_TIMESTAMP,
        reason = "password updated"
        WHERE email=:email';

        $statement = db()->prepare($sql);

        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT));
        return $statement->execute();
}



