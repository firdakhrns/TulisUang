<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Edit Kategori 🛠️</h2>
            <p class="text-slate-500 text-sm mt-1">Perbarui informasi kategori sesuai kebutuhanmu.</p>
        </div>
    </x-slot>

    {{-- Background --}}
    <div class="bg-gradient-to-br from-blue-100 via-sky-50 to-white min-h-screen py-10 px-6">
        <div class="max-w-xl mx-auto">
            <div class="bg-white shadow-xl rounded-2xl p-8 border border-slate-100">
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Validasi Error --}}
                    @if ($errors->any())
                        <div class="mb-6 bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg">
                            <strong class="block font-medium">Ups! Ada kesalahan input:</strong>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Nama Kategori --}}
                    <div class="mb-6">
                        <label for="name" class="block text-slate-700 font-medium mb-2">Nama Kategori</label>
                        <input type="text" id="name" name="name" required
                            class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400"
                            value="{{ old('name', $category->name) }}">
                    </div>

                    {{-- Tipe Kategori --}}
                    <div class="mb-6">
                        <label for="type" class="block text-slate-700 font-medium mb-2">Tipe</label>
                        <select id="type" name="type" required
                            class="w-full border border-slate-300 rounded-lg px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400">
                            <option value="income" {{ $category->type == 'income' ? 'selected' : '' }}>Pemasukan</option>
                            <option value="expense" {{ $category->type == 'expense' ? 'selected' : '' }}>Pengeluaran</option>
                        </select>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-between items-center">
                        <a href="{{ route('categories.index') }}"
                           class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-5 rounded-md transition">
                            Batal
                        </a>
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md shadow transition">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
