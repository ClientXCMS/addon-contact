@extends('admin.layouts.admin')

@section('title', __('contact::lang.show_title'))

@section('content')
    <div class="card p-6 relative">
        <!-- Barre d'actions -->
        <div class="flex justify-end items-center mb-6 gap-4">
            <a href="{{ url()->previous() }}" class="btn btn-secondary flex items-center">
            <i class="bi bi-arrow-left mr-2"></i> {{ __('contact::lang.actions.back') }}
            </a>

            <!-- Dropdown Menu -->
            <div class="relative">
            <button class="flex items-center gap-2 px-4 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-lg transition-colors duration-200 ease-in-out shadow-sm" id="dropdownButton">
                <i class="bi bi-gear"></i> {{ __('contact::lang.actions.options') }}
                <i class="bi bi-chevron-down transition-transform" id="dropdownArrow"></i>
            </button>
            <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700 transition-all transform scale-0 origin-top-right">
                <ul class="py-1 text-gray-700 dark:text-gray-300">
                <li>
                    <a href="mailto:{{ $contact->email }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center gap-2">
                    <i class="bi bi-envelope"></i> {{ __('contact::lang.actions.reply_email') }}
                    </a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center gap-2">
                    <i class="bi bi-send"></i> {{ __('contact::lang.actions.send_mail') }}
                    </a>
                </li>
                <li>
                    <form action="{{ route($routePath . '.update', $contact->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="w-full text-left block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center gap-2">
                        <i class="bi bi-check-lg"></i> {{ __('contact::lang.actions.save') }}
                    </button>
                    </form>
                </li>
                <li>
                    <form action="{{ route($routePath . '.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('{{ __('contact::lang.confirm_delete') }}')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full text-left block px-4 py-2 text-red-600 hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center gap-2">
                        <i class="bi bi-trash"></i> {{ __('contact::lang.actions.delete') }}
                    </button>
                    </form>
                </li>
                </ul>
            </div>
            </div>
        </div>

        <!-- Script pour gérer l'affichage du dropdown -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const dropdownButton = document.getElementById("dropdownButton");
                const dropdownMenu = document.getElementById("dropdownMenu");

                dropdownButton.addEventListener("click", function () {
                    dropdownMenu.classList.toggle("hidden");
                    dropdownMenu.classList.toggle("scale-100");
                });

                document.addEventListener("click", function (event) {
                    if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                        dropdownMenu.classList.add("hidden");
                        dropdownMenu.classList.remove("scale-100");
                    }
                });
            });
        </script>

        <!-- Titre et description -->
        <h4 class="font-semibold text-gray-700 dark:text-gray-300 uppercase mb-2">
            {{ __('contact::lang.show_title') }}
        </h4>
        <p class="text-gray-600 dark:text-gray-400 mb-4">
            {{ __('contact::lang.show_description') }}
        </p>

        <!-- Informations du contact -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach(['id', 'title' => 'subject', 'email', 'created_at'] as $key => $value)
                <div>
                    @php
                        $field = is_int($key) ? $value : $key;
                        $val = $contact->$value ?? '-';
                        if (in_array($value, ['created_at', 'updated_at']) && !empty($contact->$value)) {
                            $val = date('d/m/y H:i', strtotime($contact->$value));
                        }
                    @endphp
                    @include('shared/input', [
                        'label' => __('contact::lang.table.' . $field),
                        'name' => $value,
                        'value' => $val,
                        'read_only' => true,
                    ])
                </div>
            @endforeach

            <!-- Statut -->
            <div>
                @include('shared/select', [
                    'label' => __('contact::lang.table.status'),
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

        <!-- Message -->
        <div class="mt-6">
            @include('shared/textarea', [
                'label' => __('contact::lang.table.message'),
                'name' => 'message',
                'value' => $contact->message,
                'rows' => 5,
                'readonly' => true,
            ])
        </div>
    </div>
@endsection
