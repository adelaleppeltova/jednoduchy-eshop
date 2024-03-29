<?php

class LoginController extends Controller
{
    public function process(array $parameters): void
    {
        $userManager = new UserManager();
        if ($parameters[0] = "odhlasit") {
            $userManager->logout();
        }
        if ($userManager->getUser())
            $this->redirect('ucet');


        $this->header['title'] = 'Přihlášení';
        $this->header['key_words'] = 'Přihlášení';
        $this->header['desc'] = 'Přihlášení';

        if ($_POST) {
            try {
                $userManager->login($_POST['email'], $_POST['password']);
                $this->addMessage('Byl jste úspěšně přihlášen.');
                $this->redirect('klient');
            } catch (UserExeption $exeption) {
                $this->addMessage($exeption->getMessage());
            }
        }


        $this->view = 'signin';
    }
}
