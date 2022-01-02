<?php

namespace App\Contact;

use App\Contact\Entity\Contact;
use App\Contact\Table\ContactTable;
use ClientX\App;
use ClientX\Helpers\IP;

class ContactService
{

    private ContactTable  $table;
    private ContactMailer $mailer;
    private ContactWebhook $webhook;
    private int $hours;
    public function __construct(ContactTable $table, ContactMailer $mailer, ContactWebhook $webhook, $hours)
    {
        $this->table = $table;
        $this->mailer = $mailer;
        $this->webhook = $webhook;
        $this->hours = (int)$hours;
    }

    public function send(Contact $contact)
    {
        $contact->setRawIp(IP::get());
        $lastRequest = $this->table->findLastRequestForIp($contact->getIP());
        if ($lastRequest && $lastRequest->getCreatedAt() > new \DateTime(sprintf('-%d hour', $this->hours)) && App::inProduction()) {
            throw new \App\Contact\TooManyContactException();
        }

        $id = $this->table->insertContact($contact);
        $contact->setId($id);
        $this->mailer->sendTo($contact);
        $this->webhook->send($contact);
        return true;
    }
}
