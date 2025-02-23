@extends('layouts.front')
@section('title', "Contact")

@section('content')

<section class="bg-gray-100 dark:bg-gray-900 min-h-screen flex items-center">
    <div class="max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8 w-full">
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
            <div class="md:flex min-h-[600px]">
                <!-- Image Section -->
                <div class="md:w-1/2 relative bg-gradient-to-r from-blue-50 to-purple-50 dark:from-gray-700 dark:to-gray-600">
                    @if(!empty($page_image))
                        <div class="absolute inset-0 flex items-center justify-center p-8">
                            <img src="{{ asset('storage/images/' . basename($page_image)) }}"
                                 class="w-full h-full object-cover rounded-xl shadow-lg transform hover:scale-95 transition-transform duration-300"
                                 alt="{{ __('contact::lang.settings.page_image') }}">

                        </div>
                    @else
                        <div class="absolute inset-0 flex flex-col items-center justify-center p-8 text-center">
                            <div class="text-gray-400 dark:text-gray-500 mb-4">
                                <svg class="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400 font-medium mt-4">{{ __('contact::lang.settings.no_image_available') }}</p>
                        </div>
                    @endif
                </div>

                <!-- Form Section -->
                <div class="md:w-1/2 p-8 lg:p-12">
                    <div class="max-w-md mx-auto">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Contactez-nous</h2>
                        <p class="text-gray-600 dark:text-gray-300 mb-8">
                            Nous serions ravis de recevoir vos messages. Remplissez le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais.
                        </p>

                        @if(session('success'))
                            <div class="mb-6 p-4 text-sm text-green-800 bg-green-50 rounded-lg dark:bg-green-900 dark:text-green-200" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="mb-6 p-4 text-sm text-red-800 bg-red-50 rounded-lg dark:bg-red-900 dark:text-red-200" role="alert">
                                <ul class="list-disc pl-5">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route($routePath . ".customer.store") }}" method="POST" class="space-y-6">
                            @csrf

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nom</label>
                                <input type="text" id="name" name="name" placeholder="Votre nom complet"
                                       value="{{ isset($Customer->firstname) ? $Customer->firstname : '' }} {{ isset($Customer->lastname) ? $Customer->lastname : '' }}"
                                       class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                                <input type="email" id="email" name="email" placeholder="exemple@email.com"
                                       value="{{ isset($Customer->email) ? $Customer->email : '' }}"
                                       class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                            </div>

                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sujet</label>
                                <input type="text" id="subject" name="subject" placeholder="Objet de votre message"
                                       class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Message</label>
                                <textarea id="message" name="message" rows="5" placeholder="Décrivez votre demande en détails..."
                                          class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"></textarea>
                            </div>

                            @if($captcha)
                                <div class="pt-4">
                                    @include('shared/captcha')
                                </div>
                            @endif

                            <button type="submit"
                                    class="w-full py-3 px-6 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition-all transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                Envoyer le message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
