<?php
namespace App\Addons\Contact\Controllers\Admin;

use App\Addons\Contact\Models\Contact;
use App\Services\SettingsService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Account\Customer;
use App\Models\Admin\Setting as Setting;
use App\Http\Controllers\Admin\AbstractCrudController;





class ContactController extends AbstractCrudController
{
    protected string $model = Contact::class;
    protected string $viewPath = 'contact_admin::';
    protected string $routePath = 'contact.contact';



    public function index(Request $request): View
    {
        $contacts = Contact::all();
        return view('contact_admin::index', compact('contacts'))->with('routePath', $this->routePath);
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
    public function settings(): View
    {
        return view('contact_admin::settings', [
            'enable_captcha' => setting('enable_captcha', '0'),
            'require_login' => setting('require_login', '0')
        ])->with('routePath', $this->routePath);
    }



    public function storeSettings(Request $request)
    {
        $validated = $request->validate([
            'enable_captcha' => ['required', 'in:0,1'],
            'require_login' => ['required', 'in:0,1'],
        ]);

        Setting::updateSettings($validated);

        return redirect()->route('admin.settings.index')->with('success', __('contact::lang.settings.saved_successfully'));
    }



}
