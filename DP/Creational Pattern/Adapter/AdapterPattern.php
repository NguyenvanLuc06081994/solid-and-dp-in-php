<?php

interface EmailServiceInterface
{
    public function sendEmail(string $to, string $object, string $message): void;
}

class EmailService implements EmailServiceInterface
{
    public function sendEmail(string $to, string $object, string $message): void
    {
        echo "Sending email to $to with object $object and message $message";
    }
}

class SendEmailAWS
{
    public function send($email): void
    {
        echo "Sending email to $email";
    }
}

class AWSAdapter implements EmailServiceInterface
{
    private SendEmailAWS $awsService;

    public function __construct(SendEmailAWS $awsService)
    {
        $this->awsService = $awsService;
    }

    public function sendEmail(string $to, string $object, string $message): void
    {
        $email = [
            'to' => $to,
            'object' => $object,
            'message' => $message
        ];

        $this->awsService->send($email);
    }
}
