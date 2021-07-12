<?php
namespace App\Contact\Actions;

use App\Contact\ContactService;
use App\Contact\Entity\Contact;
use App\Contact\TooManyContactException;
use ClientX\Actions\Action;
use ClientX\Database\Hydrator;
use ClientX\Renderer\RendererInterface;
use ClientX\Validator;
use Psr\Http\Message\ServerRequestInterface;

class ContactAction extends Action
{

    /**
     * @var ContactService
     */
    private $service;

    public function __construct(ContactService $service, RendererInterface $renderer)
    {
        $this->service = $service;
        $this->renderer = $renderer;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        if ($request->getMethod() === 'GET') {
            return $this->render('@contact/contact');
        }
        try {
            $data = $request->getParsedBody();
            $validator = $this->validate($data);
            if ($validator->isValid()) {
                $contact = Hydrator::hydrate($data, Contact::class);
                $success = $this->service->send($contact);
                return $this->render('@contact/contact', ['success' => true]);
            }
            return $this->render('@contact/contact', ['errors' => $validator->getErrors()]);
        } catch (TooManyContactException $e) {
            return $this->render('@contact/contact', ['too_many' => true]);
        }
    }

    private function validate(array $params)
    {
        return (new Validator($params))
            ->notEmpty('name', 'email', 'subject', 'content')
            ->email('email')
            ->length('content', 3, 1000);
    }
}
