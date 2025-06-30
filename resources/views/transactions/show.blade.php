<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Detail Transaksi 💳</h2>
            <p class="text-slate-500 text-sm mt-1">Lihat informasi lengkap transaksi keuanganmu.</p>
        </div>
    </x-slot>

    <div class="bg-gradient-to-br from-blue-100 via-sky-50 to-white min-h-screen py-10 px-6">
        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-xl p-8 space-y-6">

            {{-- Informasi Utama --}}
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-1">{{ $transaction->name }}</h3>
                <p class="text-sm text-gray-500">Dibuat pada {{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</p>
            </div>

            {{-- Tipe Transaksi --}}
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Jenis Transaksi</label>
                <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold text-white
                    {{ $transaction->type == 'income' ? 'bg-green-600' : 'bg-red-600' }}">
                    {{ ucfirst($transaction->type) }}
                </span>
            </div>

            {{-- Detail Lainnya --}}
            <div class="space-y-3 text-gray-700">
                <div>
                    <span class="font-medium">Dompet:</span>
                    <span class="ml-1">{{ $transaction->wallet->name }}</span>
                </div>

                <div>
                    <span class="font-medium">Kategori:</span>
                    <span class="ml-1">{{ $transaction->category->name }}</span>
                </div>

                <div>
                    <span class="font-medium">Jumlah:</span>
                    <span class="ml-1 text-gray-900 font-bold">Rp{{ number_format($transaction->amount, 2, ',', '.') }}</span>
                </div>

                <div>
                    <span class="font-medium">Catatan:</span>
                    <span class="ml-1">{{ $transaction->note ?? '-' }}</span>
                </div>
            </div>

            {{-- Tombol Navigasi --}}
            <div class="flex justify-between pt-4">
                <a href="{{ route('transactions.index') }}"
                    class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
                    ← Kembali
                </a>

                <a href="{{ route('transactions.edit', $transaction->id) }}"
                    class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 transition">
                     Edit
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
