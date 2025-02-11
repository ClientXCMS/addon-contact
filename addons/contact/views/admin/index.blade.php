@extends('admin/layouts/admin')
@section('title', __('contact::lang.title'))
@section('content')
    <div class="container mx-auto">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="card">
                        <div class="card-heading">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                                    {{ __('contact::lang.management_title') }}
                                </h2>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('contact::lang.management_description') }}
                                </p>
                            </div>
                            <div class="">
                                <a href="{{ route($routePath . '.settings') }}" class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-lg border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800">
                                    <i class="bi bi-gear-fill"></i>
                                    {{ __('contact::lang.actions.settings') }}
                                </a>
                            </div>
                        </div>
                        <div class="border rounded-lg overflow-hidden dark:border-gray-700">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                                {{ __('contact::lang.table.id') }}
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                                {{ __('contact::lang.table.title') }}
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                                {{ __('contact::lang.table.email') }}
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                                {{ __('contact::lang.table.status') }}
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                                {{ __('contact::lang.table.created_at') }}
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                            {{ __('contact::lang.table.actions') }}
                                        </span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($contacts as $item)
                                    <tr class="bg-white hover:bg-gray-50 dark:bg-slate-900 dark:hover:bg-slate-800">
                                        <td class="h-px w-px whitespace-nowrap">
                                            <span class="block px-6 py-2">
                                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ $item->id }}</span>
                                            </span>
                                        </td>
                                        <td class="h-px w-px whitespace-nowrap">
                                            <span class="block px-6 py-2">
                                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ $item->subject }}</span>
                                            </span>
                                        </td>
                                        <td class="h-px w-px whitespace-nowrap">
                                            <span class="block px-6 py-2">
                                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ $item->email }}</span>
                                            </span>
                                        </td>
                                        <td class="h-px w-px whitespace-nowrap">
                                            <span class="block px-6 py-2">
                                                @if($item->read)
                                                    <span class="inline-flex items-center gap-1.5 py-0.5 px-2 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                        <i class="bi bi-check"></i>
                                                        {{ __('contact::lang.status.read') }}
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center gap-1.5 py-0.5 px-2 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                        <i class="bi bi-x-lg"></i>
                                                        {{ __('contact::lang.status.unread') }}
                                                    </span>
                                                @endif
                                            </span>
                                        </td>
                                        <td class="h-px w-px whitespace-nowrap">
                                            <span class="block px-6 py-2">
                                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ $item->created_at ? $item->created_at->format('d/m/y') : '-' }}</span>
                                            </span>
                                        </td>
                                        <td class="h-px w-px whitespace-nowrap">
                                            <a href="{{ route($routePath . '.show', $item->id) }}">
                                                <span class="px-1 py-1.5">
                                                    <span class="py-1 px-2 inline-flex justify-center items-center gap-2 rounded-lg border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800">
                                                        <i class="bi bi-eye-fill"></i>
                                                        {{ __('contact::lang.actions.view') }}
                                                    </span>
                                                </span>
                                            </a>
                                            <form action="{{ route($routePath . '.destroy', $item->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('{{ __('contact::lang.confirm_delete') }}')">
                                                    <span class="py-1 px-2 inline-flex justify-center items-center gap-2 rounded-lg border font-medium bg-red text-red-700 shadow-sm align-middle hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-red-900 dark:hover:bg-red-800 dark:border-red-700 dark:text-white dark:hover:text-white dark:focus:ring-offset-gray-800">
                                                        <i class="bi bi-trash"></i>
                                                        {{ __('contact::lang.actions.delete') }}
                                                    </span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
