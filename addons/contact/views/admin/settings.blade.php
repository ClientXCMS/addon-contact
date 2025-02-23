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
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                                    <label class="block text-sm font-medium text-gray-900 dark:text-white mb-4">
                                        {{ __('contact::lang.settings.page_image') }}
                                    </label>
                                    @if(!empty($page_image))
                                        <div class="relative mb-6">
                                            <div class="group relative rounded-xl overflow-hidden">
                                                <!-- Image principale -->
                                                <img src="{{ asset('storage/images/' . basename($page_image)) }}"
                                                    class="w-full max-w-md h-48 object-cover transition duration-200 group-hover:brightness-50"
                                                    alt="{{ __('contact::lang.settings.page_image') }}">

                                                <!-- Bouton de suppression (visible au hover) -->
                                                <form action="{{ route($routePath . '.settings.deleteImage') }}"
                                                    method="POST"
                                                    class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-200">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            onclick="return confirm('{{ __('Êtes-vous sûr de vouloir supprimer cette image ?') }}')"
                                                            class="transform scale-90 group-hover:scale-100 transition-all duration-200 inline-flex items-center gap-2 px-4 py-2 bg-red-500/90 hover:bg-red-600 text-white rounded-lg backdrop-blur-sm">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        <span class="font-medium">{{ __('Supprimer') }}</span>
                                                    </button>
                                                </form>

                                                <!-- Badge du nom de fichier -->
                                                <div class="absolute top-2 right-2 px-2 py-1 bg-black/50 backdrop-blur-sm rounded-lg">
                                                    <p class="text-xs font-medium text-white">
                                                        {{ basename($page_image) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="relative">
                                        <input type="file"
                                               name="page_image"
                                               id="page_image"
                                               accept="image/png,image/jpeg,image/gif"
                                               class="hidden"
                                               onchange="updatefilename(this)">

                                        <label for="page_image" class="cursor-pointer flex flex-col items-center p-6 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg hover:border-blue-500 dark:hover:border-blue-400 transition-colors">
                                            <div class="mb-3 text-gray-400 dark:text-gray-500">
                                                <svg class="w-12 h-12" fill="none" stroke="currentcolor" viewbox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 16a4 4 0 01-.88-7.903a5 5 0 1115.9 6l16 6a5 5 0 011 9.9m15 13l-3-3m0 0l-3 3m3-3v12"/>
                                                </svg>
                                            </div>
                                            <div class="text-center space-y-2">
                                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                                    <span class="font-semibold text-blue-500 dark:text-blue-400">{{ __('contact::lang.settings.click_to_upload') }}</span>
                                                    {{ __('contact::lang.settings.or_drag_and_drop') }}
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    png, jpg, gif {{ __('contact::lang.settings.up_to_2mb') }}
                                                </p>
                                                <p id="selectedfilename" class="text-sm text-gray-600 dark:text-gray-400"></p>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                        function updateFileName(input) {
                            const fileName = input.files[0]?.name;
                            if (fileName) {
                                document.getElementById('selectedFileName').textContent = fileName;
                            }
                        }
                        </script>
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
