<?php

interface Handler
{
    public function setNext(Handler $handler): Handler;

    public function handle(array $request): ?string;
}

abstract class AbstractHandler implements Handler
{
    private ?Handler $nextHandler = null;

    public function setNext(Handler $handler): Handler
    {
        $this->nextHandler = $handler;

        return $handler;
    }

    public function handle(array $request): ?string
    {
        return $this->nextHandler?->handle($request);
    }
}

class UserExistsHandler extends AbstractHandler
{
    private array $users = ['john@example.com' => 'password1', 'jane@example.com' => 'password2', 'doe@example.com' => 'password3'];

    public function handle(array $request): ?string
    {
        if (!isset($this->users[$request['email']])) {
            return 'User not found';
        }

        return parent::handle($request);
    }
}

class PasswordValidationHandler extends AbstractHandler
{
    private array $users = ['john@example.com' => 'password1', 'jane@example.com' => 'password2', 'doe@example.com' => 'password3'];

    public function handle(array $request): ?string
    {
        if ($this->users[$request['email']] !== $request['password']) {
            return 'Invalid password';
        }

        return parent::handle($request);
    }
}

class RoleCheckHandler extends AbstractHandler
{
    private array $roles = ['john@example.com' => 'super_admin', 'jane@example.com' => 'admin', 'doe@example.com' => 'user'];

    public function handle(array $request): ?string
    {
        if ($this->roles[$request['email']] !== 'super_admin') {
            return 'You do not have permission to access this page';
        }

        return parent::handle($request);
    }
}

$userExistsHandler = new UserExistsHandler();
$passwordValidationHandler = new PasswordValidationHandler();
$roleCheckHandler = new RoleCheckHandler();

$userExistsHandler->setNext($passwordValidationHandler)
    ->setNext($roleCheckHandler);

$request = ['email' => 'jane@example.com', 'password' => 'password2'];


echo $userExistsHandler->handle($request) . "\n";
