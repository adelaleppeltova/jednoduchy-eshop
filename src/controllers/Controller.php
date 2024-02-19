<?php

abstract class Controller
{

    protected array $data = array();
    protected string $view = "";
    protected array $header = array('title' => '', 'key_word' => '', 'desc' => '');


    private function escape(mixed $x = null): mixed
    {
        if (!isset($x))
            return null;
        elseif (is_string($x))
            return htmlspecialchars($x, ENT_QUOTES);
        elseif (is_array($x)) {
            foreach ($x as $k => $v) {
                $x[$k] = $this->escape($v);
            }
            return $x;
        } else
            return $x;
    }

    public function printView(): void
    {
        if ($this->view) {
            extract($this->escape($this->data));
            extract($this->data, EXTR_PREFIX_ALL, "");
            require("views/" . $this->view . ".phtml");
        }
    }

    public function addMessage(string $message): void
    {
        if (isset($_SESSION['messages']))
            $_SESSION['messages'][] = $message;
        else
            $_SESSION['messages'] = array($message);
    }

    public function getMessages(): array
    {
        if (isset($_SESSION['messages'])) {
            $messages = $_SESSION['messages'];
            unset($_SESSION['messages']);
            return $messages;
        } else
            return array();
    }


    public function redirect(string $url): never
    {
        header("Location: /$url");
        header("Connection: close");
        exit;
    }

    public function verifyUser(bool $admin = false): void
    {
        $userManager = new UserManager();
        $user = $userManager->getUser();
        if (!$user || ($admin && !$user['admin'])) {
            $this->addMessage('Nedostatečná oprávnění.');
            $this->redirect('login');
        }
    }

    abstract function process(array $parameters): void;
}
