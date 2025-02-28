@extends('admin.settings.sidebar')
@section('title', __('contact::lang.settings.title'))


@section('setting')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto px-3">
        @include('admin/shared/alerts')
        <div class="mx-auto">
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">

                <form action="{{ route($routePath . '.settings.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="p-6 space-y-6">

                        <div class="mb-8">
                            <h1 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('contact::lang.settings.title') }}</h1>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ __('contact::lang.settings.description') }}</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-6 backdrop-blur-sm border border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                {{ __('contact::lang.settings.security_settings') }}
                            </h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                                    <div>
                                        <label for="contact_enable_captcha" class="font-medium text-gray-900 dark:text-white">
                                            {{ __('contact::lang.settings.enable_captcha') }}

                                        </label>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ __('contact::lang.settings.enable_captcha_description') }}
                                        </p>
                                    </div>
                                    <div class="flex items-center">
                                        @include('admin/shared/switch', ['name' => 'contact_enable_captcha', 'checked' => setting('contact_enable_captcha')])
                                    </div>

                                </div>

                                <div class="flex items-center justify-between p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                                    <div>
                                        <label for="contact_require_login" class="font-medium text-gray-900 dark:text-white">
                                            {{ __('contact::lang.settings.require_login') }}
                                        </label>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ __('contact::lang.settings.require_login_description') }}
                                        </p>
                                    </div>
                                    <div class="flex items-center">
                                        @include('admin/shared/switch', ['name' => 'contact_require_login', 'checked' => setting('contact_require_login')])
                                    </div>
                                </div>

                                <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                                    <div class="flex justify-between">
                                        <div>
                                        <label for="contact_webhook" class="font-medium text-gray-900 dark:text-white">
                                            {{ __('contact::lang.settings.webhook') }}
                                        </label>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ __('contact::lang.settings.webhook_description') }}
                                        </p>
                                        </div>

                                        <div class="hs-tooltip [--trigger:click]">
                                            <div class="hs-tooltip-toggle block text-center">
                                                <button type="button" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400">
                                                    {{ __('global.preview') }}
                                                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="m18 15-6-6-6 6"></path>
                                                    </svg>
                                                </button>

                                                <div class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible hidden opacity-0 transition-opacity absolute invisible z-10 max-w-xs w-full bg-white border border-gray-100 text-start rounded-xl shadow-md dark:bg-neutral-800 dark:border-neutral-700" role="tooltip">
                                                    <div class="p-4">
                                                        <div class="mb-3 flex justify-between items-center gap-x-3">
                                                            <img src="https://cdn.clientxcms.com/ressources/docs/contact.png">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                        @include('admin/shared/input', ['name' => 'contact_webhook', 'value' => setting('contact_webhook')])

                                </div>
                                <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                                    <div>
                                        <label for="contact_subscribers" class="font-medium text-gray-900 dark:text-white">
                                            {{ __('contact::lang.settings.subscribers') }}
                                        </label>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ __('contact::lang.settings.subscribers_description') }}
                                        </p>
                                        @include('admin/shared/search-select-multiple', ['name' => 'contact_subscribers[]', 'value' => explode(',', setting('contact_subscribers')), 'options' => $admins, 'label' => ''])

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-6 backdrop-blur-sm border border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ __('contact::lang.settings.media_settings') }}
                            </h3>
                            <div class="space-y-4">

                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">

                                    <div class="mt-2">

                                    @include('admin/shared/file', ['name' => 'contact_page_image', 'value' => setting('contact_page_image'), 'canRemove' => true, 'label' => __('contact::lang.settings.page_image')])
                                    </div>
                                </div>
                        </div>
                    </div>

                        <button type="submit" class="mt-3 btn-primary btn">

                            {{ __('global.save') }}
                        </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
