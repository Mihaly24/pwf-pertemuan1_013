<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Produk Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <div class="flex items-start">
                                <svg class="h-5 w-5 text-red-400 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                <div>
                                    <h3 class="text-sm font-semibold text-red-800">Terjadi kesalahan validasi:</h3>
                                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('produk.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-6">
                            <x-input-label for="name" :value="__('Nama Produk')" />
                            <x-text-input 
                                id="name" 
                                class="block mt-2 w-full @error('name') border-red-500 @enderror" 
                                type="text" 
                                name="name" 
                                value="{{ old('name') }}"
                                placeholder="Masukkan nama produk (minimal 3 karakter)"
                                required 
                                autofocus 
                            />
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-input-label for="qty" :value="__('Kuantitas (Qty)')" />
                            <x-text-input 
                                id="qty" 
                                class="block mt-2 w-full @error('qty') border-red-500 @enderror" 
                                type="number" 
                                name="qty" 
                                value="{{ old('qty') }}"
                                placeholder="Masukkan jumlah produk (minimal 1)"
                                min="1"
                                required 
                            />
                            @error('qty')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-input-label for="price" :value="__('Harga')" />
                            <x-text-input 
                                id="price" 
                                class="block mt-2 w-full @error('price') border-red-500 @enderror" 
                                type="number" 
                                name="price" 
                                value="{{ old('price') }}"
                                placeholder="Masukkan harga produk"
                                step="0.01"
                                min="0"
                                required 
                            />
                            @error('price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-4 mt-6">
                            <a href="{{ route('produk.index') }}" class="px-4 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 font-semibold rounded-lg transition ease-in-out duration-150">
                                Batal
                            </a>
                            <x-primary-button>
                                {{ __('Simpan Produk') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>