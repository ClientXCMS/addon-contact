<?php
namespace App\Contact;

use App\Contact\Entity\Contact;
use ClientX\Notifications\Mailer\MailMessage;
use ClientX\Notifications\Mailer\Support\DatabaseMailer;
use ClientX\Router;

class ContactMailer
{

    /**
     * @var string
     */
    private string $from;
    private DatabaseMailer $mailer;
    private Router $router;

    public function __construct(DatabaseMailer $mailer, Router $router, string $from, string $to)
    {
        $this->mailer = $mailer;
        $this->router = $router;
        $this->from = $from;
        $this->to   = $to;
    }
    public function sendTo(Contact $contact)
    {
        $link = $this->router->generateURI('admin.contacts.edit', ['id' => $contact->getId()]);
        $title = "ClientXCMS :: Contact";
        $message = MailMessage::initTranslated($this->mailer->getTranslator(), $this->from);
        $message->bcc($this->to);
        $message->action($this->mailer->trans("contact.email.button"), $link);
        $message->subject($title);
        $message->line($this->mailer->trans("contact.email.button"));
        $message->line($contact->getSubject() . "(" . $contact->getEmail() .  ")");
        return $this->mailer->send($message);
    }
}
