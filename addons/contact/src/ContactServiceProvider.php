<?php

namespace App\Addons\Contact;

use \App\Extensions\BaseAddonServiceProvider;

class ContactServiceProvider extends BaseAddonServiceProvider
{
  protected string $uuid = "contact";

  public function register()
    {
        //
    }

    public function boot()
    {
        $this->loadViews(); // Permet de charger les vues (views/admin et views/default)
        $this->loadTranslations(); // Permet de charger les traductions (lang/fr et lang/en)
        $this->loadMigrations(); // Permet de charger les migrations

        // Routes d'administration
        \Route::middleware(['web', 'admin'])
            ->prefix(admin_prefix())
            ->name($this->uuid . '.')
            ->group(function () {
                require addon_path($this->uuid, 'routes/admin.php');
            });

        // Routes publiques
        \Route::middleware(['web'])
            ->name($this->uuid . '.admin.')
            ->group(function () {
                require addon_path($this->uuid, 'routes/web.php');
            });
    }
}
