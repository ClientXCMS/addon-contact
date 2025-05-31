<?php

/*
 * This file is part of the CLIENTXCMS project.
 * This file is the property of the CLIENTXCMS association. Any unauthorized use, reproduction, or download is prohibited.
 * For more information, please consult our support: clientxcms.com/client/support.
 * Year: 2024
 */

namespace App\Addons\Contact\Notifications;

use App\Addons\Contact\Models\Contact;
use App\Models\Admin\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class SubscriberNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private Contact $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $context = [
            'name' => $this->contact->name,
            'email' => $this->contact->email,
            'subject' => $this->contact->subject,
            'message' => $this->contact->message,
        ];
        $url = route('admin.contacts.show', ['contact' => $this->contact->id]);
        $mail = EmailTemplate::getMailMessage('contact_subscriber', $url, $context, $notifiable);
        $mail->metadata('disable_save', true);

        return $mail;
    }
}
