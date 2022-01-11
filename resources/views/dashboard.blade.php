<x-app-layout>
    <x-slot name="header">
        <h1 style="display: none"> {{ $role1=Auth::user()->roles->pluck('name') }}</h1>
        <h1 style="display: none"> {{ $role = trim($role1,'"[]')}}</h1>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
            @can('view_user')
            <button class="ml-5"><a href="users">Users</a></button>
            @endcan
            <button class="ml-5"><a href="products">Products</a></button>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
