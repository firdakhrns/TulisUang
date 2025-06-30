<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Daftar Kategori 📂</h2>
            <p class="text-slate-500 text-sm mt-1">Kelola kategori pemasukan dan pengeluaran kamu.</p>
        </div>
    </x-slot>

    {{-- Background --}}
    <div class="bg-gradient-to-br from-blue-100 via-sky-50 to-white min-h-screen py-10 px-6">
        <div class="max-w-7xl mx-auto space-y-6">
            
            {{-- Tombol Tambah Kategori --}}
            <div class="flex justify-end">
                <a href="{{ route('categories.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded-md shadow transition">
                    + Tambah Kategori
                </a>
            </div>

            {{-- Flash Message --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Tabel Kategori --}}
            @if ($categories->count())
                <div class="overflow-x-auto bg-white rounded-2xl shadow-xl border border-slate-100">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="bg-slate-100 text-slate-700 font-semibold uppercase text-xs tracking-wider">
                                <th class="py-3 px-4 text-left">#</th>
                                <th class="py-3 px-4 text-left">Nama Kategori</th>
                                <th class="py-3 px-4 text-left">Tipe</th>
                                <th class="py-3 px-4 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $index => $category)
                                <tr class="border-t hover:bg-slate-50">
                                    <td class="py-3 px-4">{{ $index + 1 }}</td>
                                    <td class="py-3 px-4">{{ $category->name }}</td>
                                    <td class="py-3 px-4">
                                        <span class="px-2 py-1 rounded-full text-xs font-medium
                                            {{ $category->type === 'income'
                                                ? 'bg-green-100 text-green-700'
                                                : 'bg-red-100 text-red-700' }}">
                                            {{ ucfirst($category->type) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 flex gap-2">
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                           class="bg-yellow-400 hover:bg-yellow-500 text-white text-sm px-3 py-1 rounded-md transition">
                                            Edit
                                        </a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin hapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-1 rounded-md transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="bg-white text-center text-slate-600 p-6 rounded-xl shadow">
                    <p>Belum ada kategori. Yuk buat kategori pertama kamu!</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
