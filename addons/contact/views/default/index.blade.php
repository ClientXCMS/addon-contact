@extends('layouts.front')
@section('title', "Contact")

@section('content')

<section class="bg-gray-100 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8">

      <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
        <div class="md:flex">
          <!-- Colonne image (visible sur md et plus) -->
          <div class="hidden md:block md:w-1/2">
            <img src="https://www.krea.ai/api/img?f=webp&i=https%3A%2F%2Ftest1-emgndhaqd0c9h2db.a01.azurefd.net%2Fimages%2Fa37972f4-533f-4525-b207-85d49c507194.png" alt="Image de contact" class="h-full w-full object-cover">
          </div>
          <!-- Colonne formulaire -->
          <div class="w-full md:w-1/2 p-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Contactez-nous</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-300">
              Nous serions ravis de recevoir vos messages. Remplissez le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais.
            </p>
            @if(session('success'))
            <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
              {{ session('success') }}
            </div>
          @endif

          @if($errors->any())
            <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
              <ul>
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
            <form class="mt-6" action="{{ route($routePath . ".customer.store") }}" method="POST">
                @csrf
              <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom</label>
                <input type="text" id="name" name="name" placeholder="Votre nom" value="{{ isset($Customer->firstname) ? $Customer->firstname : '' }} {{ isset($Customer->lastname) ? $Customer->lastname : '' }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
              </div>
              <div class="mt-4">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input type="email" id="email" name="email" placeholder="Votre email" value="{{ auth('web')->user()->email }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
              </div>
              <div class="mt-4">
                <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sujet</label>
                <input type="subject" id="subject" name="subject" placeholder="Votre subject" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
              </div>
              <div class="mt-4">
                <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message</label>
                <textarea id="message" name="message" rows="4" placeholder="Votre message" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
              </div>
              <div class="mt-6">
                <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  Envoyer
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>



@endsection
