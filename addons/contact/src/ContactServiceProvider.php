<?php

/*
 * This file is part of the CLIENTXCMS project.
 * This file is the property of the CLIENTXCMS association. Any unauthorized use, reproduction, or download is prohibited.
 * For more information, please consult our support: clientxcms.com/client/support.
 * Year: 2024
 */

namespace App\Addons\Contact;

use App\Addons\Contact\Controllers\Admin\ContactController;
use App\Addons\Contact\Models\Contact;
use App\Core\Admin\Dashboard\AdminCountWidget;
use App\Extensions\BaseAddonServiceProvider;
use App\Models\Admin\Permission;
use App\Services\SettingsService;
use Illuminate\Support\Facades\Storage;

class ContactServiceProvider extends BaseAddonServiceProvider
{
    protected string $uuid = 'contact';

    public function register()
    {
        //
    }

    public function boot()
    {
        $this->loadViews(); // Permet de charger les vues (views/admin et views/default)
        $this->loadTranslations(); // Permet de charger les traductions (lang/fr et lang/en)
        $this->loadMigrations(); // Permet de charger les migrations
        $service = $this->app->make('settings');
        $service->setDefaultValue('contact_require_login', false);
        $service->setDefaultValue('contact_allowed_extensions', 'jpg,jpeg,png,pdf,doc,docx,odt,txt');
        $service->setDefaultValue('contact_allowed_attachments', true);
        $service->setDefaultValue('contact_enable_captcha', false);
        $service->setDefaultValue('contact_max_file_size', 10);
        $service->setDefaultValue('contact_webhook', null);
        $service->setDefaultValue('contact_subscribers', '');
        $this->initImage($service, 'contact_page_image', 'contact_page_image', 'resources/global/authentification.jpg');
        // Routes d'administration
        \Route::middleware(['web', 'admin'])
            ->prefix(admin_prefix())
            ->name('admin.')
            ->group(function () {
                require addon_path($this->uuid, 'routes/admin.php');
            });

        // Routes publiques
        \Route::middleware(['web'])
            ->name($this->uuid)
            ->group(function () {
                require addon_path($this->uuid, 'routes/web.php');
            });
        $service->addCardItem('extensions', 'contacts_list', 'contact::lang.title', 'contact::lang.description', 'bi bi-envelope', action([ContactController::class, 'index']), Permission::MANAGE_EXTENSIONS);
        $service->addCardItem('personalization', 'contacts', 'contact::lang.settings.title', 'contact::lang.settings.description', 'bi bi-envelope-arrow-up', [ContactController::class, 'settings'], Permission::MANAGE_EXTENSIONS);
        $contactWidgets = new AdminCountWidget('contacts', 'bi bi-envelope', 'contact::lang.pending', function () {
            return Contact::where('read', false)->count();
        }, Permission::MANAGE_EXTENSIONS);
        $this->app['extension']->addAdminCountWidget($contactWidgets);
        if (setting('contact_enable_captcha')) {
            $this->app['extension']->addProtectedRoute('contact.index');
        }
    }

    protected function initImage(SettingsService $service, string $key, string $setting, string $default): void
    {
        $image = setting($setting);
        if ($image) {
            $service->set($key, Storage::url($image));
        } else {
            $service->set($key, \Vite::asset($default));
        }
    }
}
