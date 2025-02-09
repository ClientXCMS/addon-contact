<?php
/*
 * This file is part of the CLIENTXCMS project.
 * This file is the property of the CLIENTXCMS association. Any unauthorized use, reproduction, or download is prohibited.
 * For more information, please consult our support: clientxcms.com/client/support.
 * Year: 2024
 */
namespace App\Addons\Contact\Models;

use App\Models\Traits\ModelStatutTrait;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'addon_contact';

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'read'
    ];

    protected $casts = [
        'read' => 'boolean'
    ];
}
