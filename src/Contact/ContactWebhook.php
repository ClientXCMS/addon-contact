<?php
namespace App\Contact;

use App\Contact\Entity\Contact;
use Carbon\Carbon;
use ClientX\Discord\DiscordMessage;
use ClientX\Helpers\RequestHelper;
use ClientX\Router;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class ContactWebhook
{

    private bool $enable;
    private string $link;
    private Router $router;

    public function __construct($enable, $link, Router $router)
    {
        $this->enable = $enable === 'yes';
        $this->link   = (string)$link;
        $this->router = $router;
    }

    public function send(Contact $contact)
    {
        if ($this->enable === false) {
            return;
        }
        $link = $this->router->generateURI('admin.contacts.edit', ['id' => $contact->getId()]);
        $message = new DiscordMessage();
        $message->timestamp(Carbon::now());
        $message->title($contact->getSubject());
        $message->description([
            $contact->getName(), $contact->getEmail()
        ]);
        $message->url(RequestHelper::fromGlobal() . $link);
        (new Client())->post($this->link, [
            RequestOptions::JSON =>  $message->toArray(),
        ]);
    }
}
