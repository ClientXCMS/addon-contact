<?php
/*
 * This file is part of the CLIENTXCMS project.
 * This file is the property of the CLIENTXCMS association. Any unauthorized use, reproduction, or download is prohibited.
 * For more information, please consult our support: clientxcms.com/client/support.
 * Year: 2024
 */
namespace App\Addons\Contact\Controllers\default;

use App\Addons\Contact\Models\Contact;
use App\Models\Account\Customer;
use App\Http\Controllers\Admin\AbstractCrudController;
use Illuminate\Http\Request;
use Illuminate\View\View;


class CustomerContactController extends AbstractCrudController
{
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
