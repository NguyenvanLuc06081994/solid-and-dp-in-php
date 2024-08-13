<?php

interface MessageService
{
    public function sendMessage(string $message): string;
}

class EmailService implements MessageService
{
    public function sendMessage(string $message): string
    {
        return "Sending email with message: $message";
    }
}

class SmsService implements MessageService
{
    public function sendMessage(string $message): string
    {
        return "Sending SMS with message: $message";
    }
}

class Notification
{
    private MessageService $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function send(string $message): string
    {
        return $this->messageService->sendMessage($message);
    }
}

// Sử dụng lớp Notification với EmailService
$emailService = new EmailService();
$notification = new Notification($emailService);
echo $notification->send("Hello via Email!");
echo "<br/>";
// Sử dụng lớp Notification với SmsService
$smsService = new SmsService();
$notification = new Notification($smsService);
echo $notification->send("Hello via SMS!");
echo "<br/>";