<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <a href="{{ route('produk.create') }}" class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-lg transition ease-in-out duration-150">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Produk Baru
                        </a>
                    </div>

                    @if ($products->count())
                    <div class="overflow-x-auto">
                        <table class="w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Produk</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Qty</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Harga</th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($products as $key => $product)
                                <tr class="hover:bg-gray-50 transition ease-in-out duration-150">
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $key + 1 }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $product->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $product->qty }}</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-sm text-center">
                                        <div class="flex items-center justify-center space-x-3">
                                            @can('update', $product)
                                                <x-edit-button :url="route('produk.edit', $product)" />
                                            @endcan
                                            
                                            @can('delete', $product)
                                                <x-delete-button :url="route('produk.destroy', $product)" />
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <p class="mt-4 text-gray-600 font-medium">Belum ada produk. Silakan tambahkan produk baru.</p>
                        <a href="{{ route('produk.create') }}" class="mt-4 inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-lg transition ease-in-out duration-150">
                            Tambah Produk Pertama
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>