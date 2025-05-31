<?php
/*
 * This file is part of the CLIENTXCMS project.
 * This file is the property of the CLIENTXCMS association. Any unauthorized use, reproduction, or download is prohibited.
 * For more information, please consult our support: clientxcms.com/client/support.
 * Year: 2024
 */
?>
@extends('admin/layouts/admin')
@section('title', __('contact::lang.title'))
@section('content')
    <div class="container mx-auto">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    @include('admin/shared/alerts')
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
                        </div>
                        <div class="border rounded-lg overflow-hidden dark:border-gray-700">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                                #
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                                {{ __('contact::lang.subject') }}
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                                {{ __('global.email') }}
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                                {{ __('global.status') }}
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                                {{ __('global.created') }}
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                            {{ __('global.actions') }}
                                        </span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @if (count($items) == 0)
                                    <tr class="bg-white hover:bg-gray-50 dark:bg-slate-900 dark:hover:bg-slate-800">
                                        <td colspan="8" class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="flex flex-auto flex-col justify-center items-center p-2 md:p-3">
                                                <p class="text-sm text-gray-800 dark:text-gray-400">
                                                    {{ __('global.no_results') }}
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                    @foreach($items as $item)
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
                                            @if ($item->customer)
                                                <a href="{{ route('admin.customers.show', [$item->customer]) }}">
                                                    <span class="block px-6 py-2">
                                                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ $item->customer->email }}</span>
                                                    </span>
                                                </a>
                                            @else
                                            <span class="block px-6 py-2">
                                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ $item->email }}</span>
                                            </span>
                                            @endif
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
                                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ $item->created_at ? $item->created_at->format('d/m/y H:i:s') : '-' }}</span>
                                            </span>
                                        </td>
                                        <td class="h-px w-px whitespace-nowrap">
                                            <a href="{{ route($routePath . '.show', $item->id) }}">
                                                <span class="px-1 py-1.5">
                                                    <span class="py-1 px-2 inline-flex justify-center items-center gap-2 rounded-lg border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800">
                                                        <i class="bi bi-eye-fill"></i>
                                                        {{ __('global.view') }}
                                                    </span>
                                                </span>
                                            </a>
                                            <form action="{{ route($routePath . '.destroy', $item->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirmation()">
                                                    <span class="py-1 px-2 inline-flex justify-center items-center gap-2 rounded-lg border font-medium bg-red text-red-700 shadow-sm align-middle hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-red-900 dark:hover:bg-red-800 dark:border-red-700 dark:text-white dark:hover:text-white dark:focus:ring-offset-gray-800">
                                                        <i class="bi bi-trash"></i>
                                                        {{ __('global.delete') }}
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
