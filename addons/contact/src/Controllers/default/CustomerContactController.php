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
use App\Models\Admin\Setting as Setting;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CustomerContactController extends AbstractCrudController
{
    public function customerindex(): View|RedirectResponse
    {
        $customer = null;
        if (setting('contact_require_login', '0') == 1 && !auth('web')->check()) {
            return redirect()->route('login');
        }

        if (setting('contact_require_login', '0') == 1) {
            $customer = Customer::where('email', auth('web')->user()->email)->first();
        }

        $captcha = setting('contact_enable_captcha', '0') == 1;

        return view('contact_default::index', [
            'Customer' => $customer,
            'captcha' => $captcha,
            'page_image' => setting('contact_page_image', null),
            'routePath' => 'contact.admin'
        ]);
    }


    public function customerstore(Request $request) {

        if (setting('captcha_require_login', '0') == 1) {
            if (!auth('web')->check()) {
                return redirect()->route('login');
            }
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
