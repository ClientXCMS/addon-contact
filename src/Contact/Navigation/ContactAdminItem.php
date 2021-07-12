<?php
namespace App\Contact\Navigation;

use ClientX\Navigation\NavigationItemInterface;
use ClientX\Renderer\RendererInterface;

class ContactAdminItem implements NavigationItemInterface
{

    public function render(RendererInterface $renderer):string
    {
        return $renderer->render('@contact_admin/item');
    }

    public function getPosition(): int
    {
        return 40;
    }
}
