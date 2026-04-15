<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('produk.update', $produk) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Nama Produk')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $produk->name }}" required autofocus />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="qty" :value="__('Kuantitas (Qty)')" />
                        <x-text-input id="qty" class="block mt-1 w-full" type="number" name="qty" value="{{ $produk->qty }}" required />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="price" :value="__('Harga')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" value="{{ $produk->price }}" required />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('produk.index') }}" class="px-4 py-2 text-gray-600 mr-2">
                            {{ __('Batal') }}
                        </a>
                        <x-primary-button>
                            {{ __('Simpan Perubahan') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
