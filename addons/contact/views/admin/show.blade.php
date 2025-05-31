<?php
/*
 * This file is part of the CLIENTXCMS project.
 * This file is the property of the CLIENTXCMS association. Any unauthorized use, reproduction, or download is prohibited.
 * For more information, please consult our support: clientxcms.com/client/support.
 * Year: 2024
 */
?>
@extends('admin.layouts.admin')

@section('title', __('contact::lang.show_title'))

@section('content')
    <div class="card p-6 relative">
        <div class="flex justify-between">
            <div>

                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                    {{ __('contact::lang.show_title') }}
                </h2>
                <p class="text-gray-600 dark:text-gray-400 my-2">
                    {{ __('contact::lang.show_description') }}
                </p>
            </div>
            <div>
                <a href="mailto:{{ $contact->email }}"
                   class="btn-primary btn">
                    <i class="bi bi-envelope"></i> {{ __('contact::lang.actions.reply_email') }}
                </a>
                @if ($contact->customer)
                    <a href="{{ route('admin.emails.create') }}?emails={{ $contact->customer->email }}"
                       class="btn-secondary btn">
                        <i class="bi bi-send"></i> {{ __('contact::lang.actions.send_mail') }}
                    </a>
                @endif
            </div>
        </div>
        <form method="POST" action="{{ route('admin.contacts.update', ['contact' => $contact]) }}">
            @csrf
            @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                @include('admin/shared/input', ['name' => 'subject', 'label' => __('contact::lang.subject'), 'value' => $contact->subject, 'readonly' => true])
            </div>
            <div>
                @include('admin/shared/input', ['name' => 'email', 'label' => __('global.email'), 'value' => $contact->email, 'readonly' => true, 'type' => 'email'])
            </div>
            <div>
                @include('admin/shared/input', ['name' => 'created_at', 'label' => __('global.created'), 'value' => $contact->created_at->format('d/m/y H:i'), 'readonly' => true])
            </div>
            <div>
                @include('admin/shared/select', [
                    'label' => __('global.status'),
                    'name' => 'status',
                    'value' => $contact->read ? 'read' : 'unread',
                    'options' => [
                        'read' => __('contact::lang.status.read'),
                        'unread' => __('contact::lang.status.unread')
                    ],
                    'disabled' => true,
                ])
            </div>
        </div>
        <div class="mt-6">
            @include('admin/shared/textarea', [
                'label' => __('global.content'),
                'name' => 'message',
                'value' => $contact->message,
                'rows' => 5,
            ])
        </div>


        <div>
            <button type="submit" class="btn-primary btn mt-4">
                {{ __('global.save') }}
            </button>
        </div>
        </form>

    </div>
@endsection
