<?php

class LoginValidation {

    private bool $passed;
    private string $emailErr;
    private string $passwordErr;

    private string $conceptEmail;
    private string $conceptPassword;


    function __construct()
    {
        $this->emailErr = '';
        $this->passwordErr = '';


        $this->conceptEmail = "";
        $this->conceptPassword = "";
    }

    public function getEmailErr() {
        return $this->emailErr;
    }

    public function getPasswordErr() {
        return $this->passwordErr;
    }

    public function getConceptEmail() {
        return $this->conceptEmail;
    }

    public function getConceptPassword() {
        return $this->conceptPassword;
    }

    public function getPassed() {
        return $this->passed;
    }

    public function processValidation($email, $password) {
        $this->passed = false;

        $this->emailErr = '';
        $this->passwordErr = '';

        $this->conceptEmail = $email;
        $this->conceptPassword = $password;
        
        if (empty($email)) {
            $this->emailErr = "Vul uw email in";
          } else {
            $email = $this->test_input($email);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $this->emailErr = "Niet geldige e-mail ingevoerd";
            }
        }

        if(!empty($password)) {
            $password = $this->test_input($password);
        } else {
             $this->passwordErr = "Vul uw wachtwoord in";
        }
        
        if($this->determinePass()) {
            $user = new User();
            $user->setEmail($email);
            $user->setPassword($password);

            $userController = new UserController();
            if($userController->loginUser($user)) {
                $this->passed = true;
            } else {
                $this->emailErr = "Het e-mail of wachtwoord is onjuist.";
            }
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
    return $data;
    }

    function determinePass() {
        if(empty($this->emailErr) && empty($this->passwordErr)) {
            return true;
        }
    }
}