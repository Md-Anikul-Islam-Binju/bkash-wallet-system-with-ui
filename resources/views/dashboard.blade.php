<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Click the button!") }} <br><br>

                    <!-- Wallet Button -->
                    <a href="{{ route('wallet.index') }}"
                       class="inline-block px-6 py-2 mt-4 bg-green-500 text-red-500 font-semibold rounded-lg shadow hover:bg-green-600 transition">
                        Wallet
                    </a>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
