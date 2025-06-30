<x-app-layout>
    <x-slot name="header">
        <div class="text-3xl font-bold text-slate-800">
            Dompetmu 💼
        </div>
        <p class="text-slate-500 text-sm mt-1">
            Kelola dan pantau saldo dompetmu dengan rapi.
        </p>
    </x-slot>

    <div class="bg-gradient-to-br from-blue-100 via-sky-50 to-white py-10 px-6 min-h-screen">
        {{-- Tombol Tambah Dompet --}}
        <div class="flex justify-end mb-6">
            <a href="{{ route('wallets.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded-lg shadow-md transition">
                + Tambah Dompet
            </a>
        </div>

        {{-- Notifikasi Berhasil --}}
        @if (session('success'))
            <div class="mb-6 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- List Dompet --}}
        @if ($wallets->count())
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($wallets as $wallet)
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-slate-100">
                        <h3 class="text-xl font-bold text-slate-800">{{ $wallet->name }}</h3>
                        <p class="text-slate-600 mt-2 text-sm">Saldo:</p>
                        <p class="text-lg font-semibold text-blue-700">Rp {{ number_format($wallet->balance, 0, ',', '.') }}</p>

                        <div class="mt-4 flex gap-2">
                            <a href="{{ route('wallets.edit', $wallet->id) }}"
                               class="bg-yellow-400 hover:bg-yellow-500 text-white font-medium py-1.5 px-4 rounded-md text-sm transition">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('wallets.destroy', $wallet->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin hapus dompet ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white font-medium py-1.5 px-4 rounded-md text-sm transition">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white text-center text-slate-600 p-6 rounded-xl shadow">
                <p>Kamu belum memiliki dompet. Yuk buat sekarang!</p>
            </div>
        @endif
    </div>
</x-app-layout>
