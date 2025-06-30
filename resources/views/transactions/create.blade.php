<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Tambah Transaksi 💳</h2>
            <p class="text-slate-500 text-sm mt-1">Catat pemasukan atau pengeluaran baru keuanganmu di sini.</p>
        </div>
    </x-slot>

    <div class="bg-gradient-to-br from-blue-100 via-sky-50 to-white min-h-screen py-10 px-6">
        <div class="max-w-2xl mx-auto bg-white shadow-xl rounded-xl p-8">

            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf

                {{-- Nama Transaksi --}}
                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-1">Nama Transaksi</label>
                    <input type="text" name="name" required
                        class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:border-blue-400"
                        placeholder="Contoh: Gaji Bulanan">
                </div>

                {{-- Dompet --}}
                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-1">Dompet</label>
                    <select name="wallet_id" required
                        class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:border-blue-400">
                        @foreach ($wallets as $wallet)
                            <option value="{{ $wallet->id }}">{{ $wallet->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Kategori --}}
                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-1">Kategori</label>
                    <select name="category_id" required
                        class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:border-blue-400">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Tipe --}}
                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-1">Jenis Transaksi</label>
                    <select name="type" required
                        class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:border-blue-400">
                        <option value="income">Pemasukan</option>
                        <option value="expense">Pengeluaran</option>
                    </select>
                </div>

                {{-- Jumlah --}}
                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-1">Jumlah</label>
                    <input type="number" name="amount" step="0.01" required
                        class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:border-blue-400"
                        placeholder="Contoh: 1500000">
                </div>

                {{-- Tanggal --}}
                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-1">Tanggal</label>
                    <input type="date" name="date" required
                        class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:border-blue-400">
                </div>

                {{-- Catatan --}}
                <div class="mb-6">
                    <label class="block font-medium text-gray-700 mb-1">Catatan (Opsional)</label>
                    <textarea name="note" rows="3"
                        class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:border-blue-400"
                        placeholder="Contoh: Bonus proyek, cashback, dll."></textarea>
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex justify-between">
                    <a href="{{ route('transactions.index') }}"
                       class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-md transition">
                        Batal
                    </a>
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md shadow transition">
                        Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
