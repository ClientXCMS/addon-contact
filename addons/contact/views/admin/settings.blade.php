@extends('admin/layouts/admin')
@section('title', __('contact::lang.settings.title'))


@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto px-3">
        @include('admin/shared/alerts')

        <div class="mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ __('contact::lang.settings.title') }}</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ __('contact::lang.settings.description') }}</p>
            </div>

            @if ($errors->any())
    <div class="mb-4 bg-red-50 dark:bg-red-900/50 border border-red-200 dark:border-red-800 rounded-lg p-4">
        <div class="flex items-center">
            <svg class="flex-shrink-0 w-4 h-4 mr-2 text-red-600 dark:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div class="text-sm font-medium text-red-800 dark:text-red-200">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>
    </div>
@endif

@if (session('success'))
    <div class="mb-4 bg-green-50 dark:bg-green-900/50 border border-green-200 dark:border-green-800 rounded-lg p-4">
        <div class="flex items-center">
            <svg class="flex-shrink-0 w-4 h-4 mr-2 text-green-600 dark:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <div class="text-sm font-medium text-green-800 dark:text-green-200">
                {{ session('success') }}
            </div>
        </div>
    </div>
@endif

            <!-- Main Settings Card -->
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                    <nav class="px-6" aria-label="Tabs">
                        <div class="flex space-x-8">
                            <button class="relative border-b-2 border-blue-500 py-4 px-1 text-sm font-medium text-blue-600 dark:text-blue-400">
                                {{ __('contact::lang.settings.general_settings') }}
                                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-500"></span>
                            </button>
                        </div>
                    </nav>
                </div>

                <form action="{{ route($routePath . '.settings.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="p-6 space-y-6">
                        <!-- Security Settings Section -->
                        <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-6 backdrop-blur-sm border border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                {{ __('contact::lang.settings.security_settings') }}
                            </h3>
                            <div class="space-y-4">
                                <!-- Enable Captcha -->
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
                                        <select name="contact_enable_captcha" id="contact_enable_captcha"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="1" {{ $enable_captcha == '1' ? 'selected' : '' }}  >
                                                {{ __('contact::lang.settings.enabled') }}
                                            </option>
                                            <option value="0" {{ $enable_captcha == '0' ? 'selected' : '' }} >
                                                {{ __('contact::lang.settings.disabled') }}
                                            </option>
                                        </select>
                                    </div>

                                </div>

                                <!-- Require Login -->
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
                                        <select name="contact_require_login" id="contact_require_login"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="1" {{ $require_login == '1' ? 'selected' : '' }}>
                                                {{ __('contact::lang.settings.enabled') }}
                                            </option>
                                            <option value="0" {{ $require_login == '0' ? 'selected' : '' }}>
                                                {{ __('contact::lang.settings.disabled') }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Media Settings Section -->
                        <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-6 backdrop-blur-sm border border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ __('contact::lang.settings.media_settings') }}
                            </h3>
                            <div class="space-y-4">
                                <!-- Image Upload -->
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                                    <label class="block text-sm font-medium text-gray-900 dark:text-white mb-4">
                                        {{ __('contact::lang.settings.page_image') }}
                                    </label>
                                    <div id="hs-file-upload" class="group" data-hs-file-upload='{"url": "/upload", "maxFilesize": 2}'>
                                        <div class="cursor-pointer flex flex-col items-center p-6 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg group-hover:border-blue-500 dark:group-hover:border-blue-400 transition-colors">
                                            <div class="mb-3 text-gray-400 dark:text-gray-500 group-hover:text-blue-500 dark:group-hover:text-blue-400">
                                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                                </svg>
                                            </div>
                                            <div class="text-center space-y-2">
                                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                                    <span class="font-semibold text-blue-500 dark:text-blue-400">{{ __('contact::lang.settings.click_to_upload') }}</span>
                                                    {{ __('contact::lang.settings.or_drag_and_drop') }}
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    PNG, JPG, GIF {{ __('contact::lang.settings.up_to_2mb') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Actions -->
                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-50 dark:focus:ring-offset-gray-900 transition-all">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                {{ __('contact::lang.settings.save_settings') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
