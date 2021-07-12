<?php
namespace App\Contact;

use App\Admin\Settings\SettingsInterface;
use ClientX\Renderer\RendererInterface;
use ClientX\Validator;

class ContactSettings implements SettingsInterface
{

    public function render(RendererInterface $renderer)
    {
        return $renderer->render('@contact_admin/setting');
    }

    public function validate(array $params): Validator
    {
        $validator =  new Validator($params);
        if (isset($params['contact_enabledwebhook'])) {
            $validator->notEmpty('contact_webhook');
        }
        return $validator;
    }

    public function icon(): string
    {
        return "fa fa-envelope";
    }

    public function name(): string
    {
        return "contact";
    }

    public function title(): string
    {
        return "Contact module";
    }
}
