<?php


namespace App\Service;


use Swift_Mailer;
use Swift_Message;

class Mailer
{
    /**
     * @var Swift_Mailer
     */
    private $mailer;

    public function __construct(Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send(string $to, string $subject, string $body): bool
    {
        $message = (new Swift_Message('Hello Email'))
            ->setFrom('send@example.com')
            ->setTo($to)
            ->setSubject($subject)
            ->setBody($body, 'text/html');

        return (boolean) $this->mailer->send($message);
    }
}