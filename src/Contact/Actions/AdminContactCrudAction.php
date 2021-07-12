<?php
namespace App\Contact\Actions;

use App\Contact\Table\ContactTable;
use ClientX\Actions\CrudAction;
use ClientX\Renderer\RendererInterface;
use ClientX\Response\RedirectBackResponse;
use ClientX\Router;
use ClientX\Session\FlashService;
use Psr\Http\Message\ServerRequestInterface;

class AdminContactCrudAction extends CrudAction
{

    protected $routePrefix = 'admin.contacts';
    protected $viewPath = "@contact_admin/";
    protected $moduleName = "Contact";
    
    public function __construct(RendererInterface $renderer, ContactTable $table, Router $router, FlashService $flash)
    {
        parent::__construct($renderer, $table, $router, $flash);
    }

    protected function create(ServerRequestInterface $request)
    {
        $this->flash->error('Access denied');
        return new RedirectBackResponse($request);
    }
}
