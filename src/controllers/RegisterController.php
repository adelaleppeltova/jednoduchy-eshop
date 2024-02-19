<?php

class RegisterController extends Controller
{
	public function process(array $parametry): void
	{
		$this->header['title'] = 'Registrace';
		$this->header['key_words'] = 'Registrace';
		$this->header['desc'] = 'Registrace';
		if ($_POST) {
			try {
				$userManager = new UserManager();
				$userManager->register($_POST['fname'], $_POST['lname'], $_POST['password'], $_POST['email'], $_POST['street'], $_POST['town'], $_POST['pcode']);
				$userManager->login($_POST['email'], $_POST['password']);
				$this->addMessage('Byl jste úspěšně zaregistrován.');
				$this->redirect('klient');
			} catch (UserExeption $exeption) {
				$this->addMessage($exeption->getMessage());
			}
		}
		// Nastavení šablony
		$this->view = 'signup';
	}
}
