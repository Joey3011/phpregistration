<?php

function register_user(string $username, string $email, string $password, string $token_code, int $expiry = 1 * 1  * 60 * 60): bool
{
    $sql = 'INSERT INTO users(username, email, pasword, token_code, token_code_expiry)
            VALUES(:username, :email, :pasword, :token_code, :token_code_expiry)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':username', $username);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':pasword', password_hash($password, PASSWORD_BCRYPT));
    $statement->bindValue(':token_code', password_hash($token_code, PASSWORD_DEFAULT));
    $statement->bindValue(':token_code_expiry', date('Y-m-d H:i:s',  time() + $expiry));

    return $statement->execute();
}
function request_password(string $email, string $token_code):bool
{
    $date_expire = date('Y-m-d H:i:s',  time() + 1 * 1  * 60 * 60);
    $sql = 'UPDATE users
        SET token_code = :token_code,
        token_code_expiry = :date_expire,
        reason = "password request"
        WHERE email=:email';

        $statement = db()->prepare($sql);

        $statement->bindValue(':email', $email);
        $statement->bindValue(':token_code', password_hash($token_code, PASSWORD_DEFAULT));
        $statement->bindValue(':date_expire', $date_expire);
        return $statement->execute();
}

function find_user_by_email(string $email)
{
    $sql = 'SELECT *
            FROM users
            WHERE email = :email AND active=1';

    $statement = db()->prepare($sql);
    $statement->bindValue(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}

function find_user_by_username(string $username)
{
    $sql = 'SELECT id, username, pasword, active
            FROM users
            WHERE email = :username OR username=:username';

    $statement = db()->prepare($sql);
    $statement->bindValue(':username', $username, PDO::PARAM_STR);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}
 // login using username
function login(string $username, string $password): bool
{
    $user = find_user_by_username($username);
    // if user found, check the password and if user is already active
         if ($user && password_verify($password, $user['pasword']) && intval($user['active'])===1) {

             // prevent session fixation attack
             session_regenerate_id();

             // set username in the session
             $_SESSION['username'] = $user['username'];
                $_SESSION['user_id']  = $user['id'];
            return true;
      }
    return false;
}

function is_user_logged_in(): bool
{
    return isset($_SESSION['username']);
}

function require_login(): void
{
    if (!is_user_logged_in()) {
        redirect_to('login');
    }
}

function logout(): void
{
    if (is_user_logged_in()) {
        unset($_SESSION['username'], $_SESSION['user_id']);
        session_destroy();
        redirect_to('login');
    }
} 

function current_user()
{
    if (is_user_logged_in()) {
        return $_SESSION['username'];
    }
    return null;
}