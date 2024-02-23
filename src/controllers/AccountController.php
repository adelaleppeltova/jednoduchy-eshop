<?php

class AccountController extends Controller
{
    function process(array $parameters): void
    {
        $this->header = array(
            'title' => 'Můj účet',
            'key_words' => 'account',
            'desc' => 'Vaše osobní údaje'
        );
        $userManager = new UserManager();
        $this->data['user'] = $userManager->getUserData();

        $this->view = 'client';

        if ($_POST) {
            try {
                $userManager = new UserManager();
                $userManager->editUser($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['street'], $_POST['town'], $_POST['pcode']);
                $this->addMessage('Údaje byly změněny.');
            } catch (UserExeption $exeption) {
                $this->addMessage($exeption->getMessage());
            }

            $this->redirect('ucet');
        }
    }
}
