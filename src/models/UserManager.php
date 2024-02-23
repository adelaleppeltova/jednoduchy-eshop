<?php

class UserManager
{


    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }


    public function register(string $fname, string $lname, string $password, string $email, string $street, string $town, string $pcode): void
    {

        $user = array(
            'fname' => $fname,
            'lname' => $lname,
            'password' => $this->hashPassword($password),
            'email' => $email,
            'street' => $street,
            'town' => $town,
            'pcode' => $pcode,
            'admin' => false,

        );
        try {
            Db::insert('users', $user);
        } catch (PDOException $exeption) {
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

    public function getUserData()
    {
        $id = $this->getUser()["id"];

        if ($id) {
            return Db::requestSingle('
			SELECT `id`, `fname`, `lname`, `email`, `street`, `town`, `pcode`
			FROM `users` 
			WHERE `id` = ?
		', array($id));
        }

        return null;
    }


    public function editUser(string $fname, string $lname, string $email, string $street, string $town, string $pcode)
    {
        $id = $this->getUser()["id"];

        $user = array(
            'fname' => $fname,
            'lname' => $lname,
            'email' => $email,
            'street' => $street,
            'town' => $town,
            'pcode' => $pcode,
        );


        Db::update('users', $user, 'WHERE id = ?', array($id));
    }
}
