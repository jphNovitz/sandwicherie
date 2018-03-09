<?php
namespace App\Service;

class SendConfirmation
{
    protected $mailer;
    protected $template;
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $templating)
    {
        $this->mailer = $mailer;
        $this->template = $templating;
    }

    public function send(String $from,
                         String $to,
                         String $subject,
                         String $view,
                         String $contentType='text/html')
    {
            $message = (new \Swift_Message($subject))
                ->setFrom($from)
                ->setTo($to)
                ->setBody($this->template->render($view), $contentType);
            $this->mailer->send($message);
}

}