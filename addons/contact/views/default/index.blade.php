<?php
/*
 * This file is part of the CLIENTXCMS project.
 * This file is the property of the CLIENTXCMS association. Any unauthorized use, reproduction, or download is prohibited.
 * For more information, please consult our support: clientxcms.com/client/support.
 * Year: 2024
 */
?>
@extends('layouts.front')
@section('title', "Contact")

@section('content')
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
                    <div class="grid sm:grid-cols-2 grid-cols-1 gap-6">
                                <img src="{{ setting('contact_page_image') }}"
                                     class="w-full h-full object-cover rounded-xl shadow-lg transform hover:scale-95 transition-transform duration-300"
                                     alt="{{ __('contact::lang.settings.page_image') }}">
                    <div class="card">
                        <div class="card-body">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ __('contact::lang.title_page') }}</h2>
                        <p class="text-gray-600 dark:text-gray-300 mb-8">
                            {{ __('contact::lang.subtitle_page') }}
                        </p>

                            @include('shared/alerts')

                        <form action="{{ route("contact.store") }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                            @csrf

                            <div>
                                @include('shared/input', ['name' => 'name', 'label' => __('global.name'), 'value' => old('name', $customer->FullName), 'help' => __('contact::lang.max_characters', ['max' => 100]), ['attributes' => [ 'placeholder' => __('contact::lang.name_placeholder')]]])
                            </div>

                            <div>
                                @include('shared/input', ['name' => 'email', 'label' => __('global.email'), 'value' => old('email', $customer->email), 'help' => __('contact::lang.max_characters', ['max' => 255]), ['attributes' => [ 'placeholder' => 'example@example.com']], 'type' => 'email'])
                            </div>

                            <div>
                                @include('shared/input', ['name' => 'subject', 'value' => old('subject'), 'label' => __('contact::lang.subject'), 'help' => __('contact::lang.max_characters', ['max' => 255]), ['attributes' => [ 'placeholder' => __('contact::lang.object_label')]]])
                            </div>

                            <div>
                                @include('shared/textarea', ['name' => 'message', 'value' => old('message'), 'label' => __('global.content'), 'help' => __('contact::lang.max_characters', ['max' => 5000]), ['attributes' => [ 'placeholder' => __('contact::lang.content_label')]]])
                            </div>
                            @if(setting('contact_enable_captcha'))
                                <div class="pt-4">
                                    @include('shared/captcha')
                                </div>
                            @endif

                            <button type="submit"
                                    class="w-full py-1 px-6 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition-all transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                {{ __('contact::lang.send') }}
                            </button>
                        </form>
                        </div>
                    </div>
                    </div>
@endsection
