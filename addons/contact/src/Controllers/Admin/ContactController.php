<?php

/*
 * This file is part of the CLIENTXCMS project.
 * This file is the property of the CLIENTXCMS association. Any unauthorized use, reproduction, or download is prohibited.
 * For more information, please consult our support: clientxcms.com/client/support.
 * Year: 2024
 */

namespace App\Addons\Contact\Controllers\Admin;

use App\Addons\Contact\Models\Contact;
use App\Http\Controllers\Admin\AbstractCrudController;
use App\Models\Admin\Admin;
use App\Models\Admin\Setting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends AbstractCrudController
{
    protected string $model = Contact::class;

    protected string $viewPath = 'contact_admin::';

    protected string $routePath = 'admin.contacts';

    public function show(Contact $contact)
    {
        return $this->showView([
            'contact' => $contact,
        ]);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return $this->deleteRedirect($contact);
    }

    public function update(Request $request, Contact $contact)
    {
        $contact->update([
            'read' => ! $contact->read,
        ]);

        return redirect()->route($this->routePath.'.index')
            ->with('success', __('contact::lang.actions.update_success'));
    }

    public function settings(): View
    {
        return view('contact_admin::settings', [
            'routePath' => $this->routePath,
            'admins' => Admin::all()->pluck('username', 'id'),
        ]);
    }

    public function storeSettings(Request $request)
    {
        $validated = $request->validate([
            'contact_enable_captcha' => 'nullable',
            'contact_require_login' => 'nullable',
            'contact_page_image' => 'nullable|image|mimes:jpeg,png,gif',
            'contact_webhook' => 'nullable|url',
            'contact_subscribers' => 'nullable|array',
        ]);
        Setting::updateSettings([
            'contact_enable_captcha' => array_key_exists('contact_enable_captcha', $validated) ? 'true' : 'false',
            'contact_require_login' => array_key_exists('contact_require_login', $validated) ? 'true' : 'false',
            'contact_webhook' => $validated['contact_webhook'] ?? '',
            'contact_subscribers' => join(',', $validated['contact_subscribers'] ?? ''),
        ]);
        if ($request->hasFile('contact_page_image')) {
            if (\setting('contact_page_image') && \Storage::exists(\setting('contact_page_image'))) {
                \Storage::delete(\setting('contact_page_image'));
            }
            $file = $request->file('contact_page_image')->storeAs('public', 'contact_page_image'.rand(1000, 9999).'.png');
            Setting::updateSettings([
                'contact_page_image' => $file,
            ]);
        }
        if ($request->remove_contact_page_image == 'true') {
            if (\setting('contact_page_image') && \Storage::exists(\setting('contact_page_image'))) {
                \Storage::delete(\setting('contact_page_image'));
            }
            Setting::updateSettings([
                'contact_page_image' => null,
            ]);
            unset($validated['remove_contact_page_image']);
        }

        return back();
    }
}
