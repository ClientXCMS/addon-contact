<?php
namespace App\Addons\Contact\Controllers\Admin;

use App\Addons\Contact\Models\Contact;
use App\Services\SettingsService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Account\Customer;
use App\Models\Admin\Setting as Setting;
use App\Http\Controllers\Admin\AbstractCrudController;
use Illuminate\Support\Facades\Storage;





class ContactController extends AbstractCrudController
{
    protected string $model = Contact::class;
    protected string $viewPath = 'contact_admin::';
    protected string $routePath = 'contact.contacts';




    public function index(Request $request): View
    {
        $contacts = Contact::all();
        return view('contact_admin::index', compact('contacts'))->with('routePath', $this->routePath);
    }

    public function show($id): View
    {
        $contact = Contact::findOrFail((int) $id);
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
            'enable_captcha' => setting('contact_enable_captcha', '0'),
            'require_login' => setting('contact_require_login', '0'),
            'page_image' => setting('contact_page_image', null)
        ])->with('routePath', $this->routePath);
    }



    public function storeSettings(Request $request)
    {

        try {
            $validated = $request->validate([
                'contact_enable_captcha' => 'required',
                'contact_require_login' => 'required',
                'page_image' => 'nullable|image|mimes:jpeg,png,gif|max:2048'
            ]);

            Setting::updateSettings('contact_enable_captcha', $validated['contact_enable_captcha']);
            Setting::updateSettings('contact_require_login', $validated['contact_require_login']);

            if ($request->hasFile('page_image')) {
                if (setting('contact_page_image')) {
                    Storage::delete('public/' . setting('contact_page_image'));
                }
                $image = $request->file('page_image');
                $filename = 'contact_image_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/images', $filename);
                Setting::updateSettings('contact_page_image', 'images/' . $filename);
            }

            return redirect()->route($this->routePath . '.settings')
                ->with('success', __('contact::lang.settings.saved_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => __('contact::lang.settings.save_failed') . ': ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function deleteIMGSettings()
    {
        if (setting('contact_page_image')) {
            Storage::delete('public/' . setting('contact_page_image'));
            Setting::updateSettings('contact_page_image', null);
        }
        return redirect()->route($this->routePath . '.settings')
            ->with('success', __('contact::lang.settings.image_deleted'));
    }



}
