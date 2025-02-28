<?php
/*
 * This file is part of the CLIENTXCMS project.
 * This file is the property of the CLIENTXCMS association. Any unauthorized use, reproduction, or download is prohibited.
 * For more information, please consult our support: clientxcms.com/client/support.
 * Year: 2024
 */
namespace App\Addons\Contact\Controllers\Front;

use App\Addons\Contact\Models\Contact;
use App\Models\Account\Customer;
use Illuminate\Http\Request;

class CustomerContactController
{
    public function index()
    {
        $customer = auth('web')->check() ? auth('web')->user() : new Customer();
        if (setting('contact_require_login') && !auth('web')->check()) {
            return redirect()->route('login');
        }
        return view('contact::index', [
            'customer' => $customer,
        ]);
    }


    public function store(Request $request)
    {

        if (setting('contact_require_login') == 1) {
            if (!auth('web')->check()) {
                return redirect()->route('login');
            }
        }
        if (Contact::where('ip_address', $request->ip())->where('created_at', '>', now()->subMinutes(5))->count() != 0) {
            return redirect()->back()->with('error', __('contact::lang.actions.limit_error'));
        }
        $validated = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|max:255',
            'message' => 'required|max:5000',
            'subject' => 'required|max:255',
        ]);
        $contact = Contact::create($validated);
        return back()->with('success', __('contact::lang.actions.store_success'));
    }

}
