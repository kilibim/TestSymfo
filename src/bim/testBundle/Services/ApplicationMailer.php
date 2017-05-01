<?php
namespace bim\testBundle\Services;

use bim\testBundle\Entity\Application;

class ApplicationMailer
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendNewNotification(Application $application)
    {
        $message = new \Swift_Message(
            'Nouvelle candidature',
            'Vous avez reçu une nouvelle candidature.'
        );

        $message
            ->addTo('brahiim') // Ici bien sûr il faudrait un attribut "email", j'utilise "author" à la place
            ->addFrom('brahimbimziani@gmail.com')
        ;

        $this->mailer->send($message);
    }
}