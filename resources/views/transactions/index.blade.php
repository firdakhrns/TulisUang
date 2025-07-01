<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Daftar Transaksi 💳</h2>
            <p class="text-slate-500 text-sm mt-1">Lihat dan kelola semua catatan transaksi keuanganmu di sini.</p>
        </div>
    </x-slot>

    <div class="bg-gradient-to-br from-blue-100 via-sky-50 to-white min-h-screen py-10 px-6">
        <div class="max-w-7xl mx-auto space-y-6">

            {{-- Tombol Tambah --}}
            <div class="flex justify-end">
                <a href="{{ route('transactions.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded-md shadow transition">
                    + Tambah Transaksi
                </a>
            </div>

            {{-- Notifikasi berhasil--}}
            @if (session('success'))
                <div class="p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Tabel Transaksi --}}
            <div class="bg-white shadow-xl rounded-xl overflow-x-auto border border-slate-100">
                <table class="min-w-full table-auto text-sm">
                    <thead class="bg-gray-100 text-slate-700 text-left">
                        <tr>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Kategori</th>
                            <th class="px-4 py-3">Jumlah</th>
                            <th class="px-4 py-3">Tipe</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                            <tr class="border-t hover:bg-sky-50/40">
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</td>
                                <td class="px-4 py-3">{{ $transaction->name }}</td>
                                <td class="px-4 py-3">{{ $transaction->category->name ?? '-' }}</td>
                                <td class="px-4 py-3 font-medium text-slate-800">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded 
                                        {{ $transaction->type === 'income' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ ucfirst($transaction->type) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 space-x-2">
                                    <a href="{{ route('transactions.show', $transaction->id) }}"
                                       class="text-indigo-600 hover:underline">Lihat</a>
                                    <a href="{{ route('transactions.edit', $transaction->id) }}"
                                       class="text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                    Belum ada transaksi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
