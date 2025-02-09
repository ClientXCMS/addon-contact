<?php
/*
 * This file is part of the CLIENTXCMS project.
 * This file is the property of the CLIENTXCMS association. Any unauthorized use, reproduction, or download is prohibited.
 * For more information, please consult our support: clientxcms.com/client/support.
 * Year: 2024
 */
namespace App\Addons\Contact\Controllers\Admin;

use App\Addons\Contact\Models\Contact;
use App\Models\Account\Customer;
use App\Http\Controllers\Admin\AbstractCrudController;
use Illuminate\Http\Request;
use Illuminate\View\View;


class ContactController extends AbstractCrudController
{
    protected string $model = Contact::class;
    protected string $viewPath = 'contact_admin::';
    protected string $translatePrefix = 'contact::messages.admin';
    protected string $routePath = 'contact.contact';

    public function index(Request $request): View
    {
        $contacts = Contact::all();
        return view('contact_admin::index', compact('contacts'))->with('routePath', $this->routePath);;
    }

    public function show(int $id): View
    {
        $contact = Contact::findOrFail($id);
        return view('contact_admin::show', compact('contact'))->with('routePath', $this->routePath);
    }

    public function destroy(int $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route($this->routePath . '.index')->with('success', __('contact::lang.actions.delete_success'));
    }

    public function update(Request $request, int $id)
    {
        try {
            $contact = Contact::findOrFail($id);
            $contact->update([
                'read' => !$contact->read
            ]);

            return redirect()->route($this->routePath . '.index')
                ->with('success', __('contact::lang.actions.update_success'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route($this->routePath . '.index')
                ->with('error', __('contact::lang.errors.not_found'));
        } catch (\Exception $e) {
            return redirect()->route($this->routePath . '.index')
                ->with('error', __('contact::lang.errors.update_failed'));
        }
    }

    public function customerindex() {
        if (!auth('web')->check()) {
            return redirect()->route('login');
        }
        $Customer = Customer::where('email', auth('web')->user()->email)->first();
        return view('contact_default::index', compact('Customer'))->with('routePath', "contact.admin");
    }

    public function customerstore(Request $request) {
        if (!auth('web')->check()) {
            return redirect()->route('login');
        }


        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'subject' => 'required'
        ]);

        $customer = Customer::where('email', auth('web')->user()->email)->first();
        $name = $customer ? trim($customer->firstname . ' ' . $customer->lastname) : $request->name;


        Contact::create([
            'name' => $name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'read' => false
        ]);

        return redirect()->route('contact.admin.customer.index')->with('success', __('contact::lang.actions.store_success'));
    }

}
