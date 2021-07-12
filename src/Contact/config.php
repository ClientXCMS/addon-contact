<?php

use App\Contact\ContactMailer;
use App\Contact\ContactMainItem;
use App\Contact\ContactService;
use App\Contact\ContactSettings;
use App\Contact\ContactWebhook;
use App\Contact\Navigation\ContactAdminItem;
use ClientX\Navigation\DefaultMainItem;

use function ClientX\setting;
use function DI\add;
use function DI\autowire;
use function DI\get;

return [
    ContactMailer::class => autowire()->constructorParameter('from', 'contact@clientx.fr')->constructorParameter('to', setting('contact_to', 'contact@clientx.fr')),
    ContactService::class => autowire()->constructorParameter('hours', setting('contact_hours', 1)),
    'admin.menu.items' => add([get(ContactAdminItem::class)]),
    'navigation.main.items' => add([new DefaultMainItem([DefaultMainItem::makeItem('contact.show', 'contact', 'fa fa-envelope')], 30)]),
    'admin.settings' => add([get(ContactSettings::class)]),
    ContactWebhook::class => autowire()->constructorParameter('enable', setting('contact.enabledwebhook', false))->constructorParameter('link', setting('contact.webhook', ''))
];
