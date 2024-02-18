<?php

class UserManager
{


    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }


    public function register(string $name, string $password, string $passwordRepeat, string $email, string $street, string $town, string $pcode): void
    {
        if ($password != $passwordRepeat)
            throw new Exception('Hesla nesouhlasí.');
        $user = array(
            'name' => $name,
            'password' => $this->hashPassword($password),
            'email' => $email,
            'street' => $street,
            'town' => $town,
            'pcode' => $pcode,
        );
        try {
            Db::insert('users', $user);
        } catch (PDOException $error) {
            throw new Exception('Uživatel s tímto jménem je již zaregistrovaný.');
        }
    }


    public function login(string $email, string $password): void
    {
        $user = Db::requestSingle('
			SELECT id, email, admin, password
			FROM users
			WHERE email = ?
		', array($email));
        if (!$user || !password_verify($password, $user['password']))
            throw new Exception('Neplatné jméno nebo heslo.');
        $_SESSION['user'] = $user;
    }


    public function logout(): void
    {
        unset($_SESSION['user']);
    }


    public function getUser(): array|null
    {
        if (isset($_SESSION['user']))
            return $_SESSION['user'];
        return null;
    }
}
