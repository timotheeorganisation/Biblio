<?php
namespace App\Security;



use Swift_Mailer;
use Swift_Message;
use Twig\Environment;

class SendMail
{
    private $mailer;
    private $renderer;
    public function __construct(Swift_Mailer $swift_Mailer, Environment $renderer )
    {
        $this->mailer = $swift_Mailer;
        $this->renderer = $renderer;
    }
    public function sendMail()
    {
          $message = (new Swift_Message('Test'))
            ->setFrom('acsid.certain@gmail.com')
            ->setFrom('acsid.certain@gmail.com')
            ->setReplyTo('acsid.certain@gmail.com')
            ->setBody("à tester en  heberge");

        $this->mailer->send($message);
    }
}