<?php
namespace App\Contact;

use App\Contact\Actions\AdminContactCrudAction;
use App\Contact\Actions\ContactAction;
use ClientX\Module;
use ClientX\Router;
use ClientX\Renderer\RendererInterface as Renderer;
use ClientX\Theme\ThemeInterface as Theme;
use Psr\Container\ContainerInterface as Container;

class ContactModule extends Module
{

    const DEFINITIONS = __DIR__ . '/config.php';
    const MIGRATIONS = __DIR__ . '/db/migrations';
    
    const TRANSLATIONS = [
        "fr_FR" => __DIR__ ."/trans/fr.php",
        "en_GB" => __DIR__ ."/trans/en.php",
        "uk_UA" => __DIR__ . "/trans/ua.php",
        "es_ES" => __DIR__ . "/trans/es.php"
    ];

    public function __construct(Router $router, Renderer $renderer, Theme $theme, Container $container)
    {
        if ($container->has('admin.prefix')) {
            $prefix = $container->get('admin.prefix');
            $router->crud($prefix . '/contacts', AdminContactCrudAction::class, 'admin.contacts');
        }
        $router->any('/contact', ContactAction::class, 'contact');
        $renderer->addPath("contact", $theme->getViewsPath() . '/Contact');
        $renderer->addPath("contact_admin", __DIR__ . '/views');
    }
}
