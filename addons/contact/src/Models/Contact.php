<?php
/*
 * This file is part of the CLIENTXCMS project.
 * This file is the property of the CLIENTXCMS association. Any unauthorized use, reproduction, or download is prohibited.
 * For more information, please consult our support: clientxcms.com/client/support.
 * Year: 2024
 */
namespace App\Addons\Contact\Models;

use App\Addons\Contact\Notifications\SubscriberNotification;
use App\DTO\Core\WebhookDTO;
use App\Models\Account\Customer;
use App\Models\Admin\Admin;
use App\Models\Traits\ModelStatutTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Contact extends Model
{
    protected $table = 'addon_contacts';

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'read',
        'ip_address',
        'customer_id'
    ];

    protected $casts = [
        'read' => 'boolean',
        'attachments' => 'array',
        'created_at' => 'datetime',
    ];

    protected $attributes = [
        'read' => false,
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function(Contact $contact) {
            $contact->ip_address = request()->ip();
            $contact->customer_id = auth('web')->check() ? auth('web')->id() : null;
        });

        static::created(function(Contact $contact) {
            $webhook = new WebhookDTO('', function() {
                return [
                    'content' => null,
                    'embeds' => [
                        [
                            'title' => __('contact::lang.webhook.title'),
                            'description' => __('contact::lang.webhook.description'),
                            'color' => 0x00ff00,
                            'fields' => [
                                [
                                    'name' => __('helpdesk.subject'),
                                    'value' => '[`📝`]  %subject%',
                                    'inline' => true
                                ],
                                [
                                    'name' => __('global.email'),
                                    'value' => '[`📙`]  [%customeremail%](%customer_url%)',
                                    'inline' => true
                                ],

                                [
                                    'name' => __('helpdesk.support.show.reply'),
                                    'value' => '[`🔗`]  %__url%',
                                    'inline' => true
                                ],
                            ],
                            'footer' => [
                                'text' => config('app.name'),
                                'icon_url' => 'https://clientxcms.com/Themes/CLIENTXCMS/images/CLIENTXCMS/LogoBlue.png',
                            ],
                            'timestamp' => now()->format('c')
                        ],
                    ],
                ];
            }, function(Contact $contact) {
                return [
                    '%subject%' => $contact->subject,
                    '%customeremail%' => $contact->email,
                    '%customer_url%' => $contact->customer_id ? route('admin.customers.show', $contact->customer_id) : null,
                    '%__url%' => route('admin.contacts.show', $contact->id),
                ];
            }, setting('contact_webhook'));
            if (!$webhook->isDisabled()) {
                $webhook->send([$contact]);
            }
        });

        static::created(function(Contact $contact) {
            if (setting('contact_subscribers')) {
                $subscribers = explode(',', setting('contact_subscribers'));
                foreach ($subscribers as $subscriber) {
                    $admin = Admin::find($subscriber);
                    if ($admin) {
                        $admin->notify(new SubscriberNotification($contact));
                    }
                }
            }
        });

    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
