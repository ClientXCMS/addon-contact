<?php
namespace App\Contact;

use ClientX\Navigation\NavigationItemInterface;
use ClientX\Renderer\RendererInterface;

class ContactMainItem implements NavigationItemInterface
{
    public function render(RendererInterface $renderer):string
    {
        return $renderer->render("@contact/menu");
    }

    public function getPosition():int
    {
        return 10;
    }
}
