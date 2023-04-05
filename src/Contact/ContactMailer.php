<?php
namespace App\Contact;

use ClientX\Entity\EmailMessage;
use App\Contact\Entity\Contact;
use ClientX\Database\EmailMessageTable;
use ClientX\Notifications\Mailer\MailMessage;
use ClientX\Notifications\Mailer\Support\SwiftMailer;
use ClientX\Router;
use ClientX\Services\LocaleService;

class ContactMailer
{

    private SwiftMailer $mailer;
    private Router $router;
    private EmailMessageTable $table;
    private LocaleService $localeService;
    private string $to;

    public function __construct(SwiftMailer $mailer, Router $router, string $to, EmailMessageTable $table, LocaleService $localeService)
    {
        $this->mailer = $mailer;
        $this->router = $router;
        $this->to = empty($to) ? 'contact@clientxcms.com' : $to;
        $this->table = $table;
        $this->localeService = $localeService;
    }

    public function sendTo(Contact $contact)
    {
        $template = $this->table->getConfiguredCustomTemplate('contact', $this->localeService->retrive());
        $link = $this->router->generateURIAbsolute('admin.contacts.edit', ['id' => $contact->getId()]);
        $message = new EmailMessage();
        $template->setContext([
            'contact' => $contact
        ]);
        $message->setUserId(0)
            ->setContext($template->getContext())
            ->setSubject($template->getSubject())
            ->setBoutonText($template->getBoutonText())
            ->setContent($this->mailer->renderCustomTemplate($template))
            ->setEmail($this->to)
            ->setBoutonUrl($link)
            ->setTemplateName('contact');
        return $this->mailer->send($message);
    }
}
