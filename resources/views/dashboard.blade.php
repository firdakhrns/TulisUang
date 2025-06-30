<x-app-layout>
    <div class="bg-gradient-to-br from-blue-100 via-sky-50 to-white min-h-screen py-10 px-6">
        <div class="max-w-7xl mx-auto space-y-10">

            {{-- Header dengan Gambar --}}
<div class="rounded-xl shadow-lg overflow-hidden"
     style="width: 100%; max-width: 1280px; height: 220px; background-image: url('/images/Banner.png'); background-size: cover; background-position: center;">
    <div class="h-full w-full bg-blue-800/60 flex items-center px-8">
        <div>
            <h2 class="text-white text-2xl md:text-3xl font-bold mb-1">
                Selamat datang, {{ Auth::user()->name }} 👋
            </h2>
            <p class="text-white text-sm md:text-base">
                Jangan biarkan uang mengatur hidupmu. Biarkan kamu yang mengatur uangmu
            </p>
        </div>
    </div>
</div>


            {{-- Ringkasan Statistik --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-green-100 text-green-800 p-6 rounded-xl shadow text-center">
                    <p class="text-sm uppercase font-semibold">Total Pemasukan</p>
                    <p class="text-2xl font-bold">Rp {{ number_format($totalIncome ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="bg-red-100 text-red-800 p-6 rounded-xl shadow text-center">
                    <p class="text-sm uppercase font-semibold">Total Pengeluaran</p>
                    <p class="text-2xl font-bold">Rp {{ number_format($totalExpense ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="bg-blue-100 text-blue-800 p-6 rounded-xl shadow text-center">
                    <p class="text-sm uppercase font-semibold">Jumlah Transaksi</p>
                    <p class="text-2xl font-bold">{{ $totalTransactions ?? 0 }}</p>
                </div>
            </div>

            {{-- Grafik dan Navigasi --}}
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                {{-- Grafik --}}
                <div class="lg:col-span-3 bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Grafik Pemasukan vs Pengeluaran</h3>
                    <canvas id="financeChart" height="100"></canvas>
                    @if (($totalIncome ?? 0) == 0 && ($totalExpense ?? 0) == 0)
                        <p class="text-center text-gray-500 mt-4">Belum ada data transaksi untuk ditampilkan.</p>
                    @endif
                </div>

                {{-- Navigasi --}}
                <div class="flex flex-col space-y-4">
                    <a href="{{ route('wallets.index') }}" class="bg-white border p-4 rounded-xl shadow hover:bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-700">💰 Kelola Dompet</h3>
                        <p class="text-sm text-gray-500 mt-1">Tambah, edit, atau hapus dompet.</p>
                    </a>
                    <a href="{{ route('categories.index') }}" class="bg-white border p-4 rounded-xl shadow hover:bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-700">📂 Kelola Kategori</h3>
                        <p class="text-sm text-gray-500 mt-1">Atur kategori pemasukan dan pengeluaran.</p>
                    </a>
                    <a href="{{ route('transactions.index') }}" class="bg-white border p-4 rounded-xl shadow hover:bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-700">📋 Kelola Transaksi</h3>
                        <p class="text-sm text-gray-500 mt-1">Lihat dan catat transaksi keuanganmu.</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const totalIncome = Number(@json($totalIncome ?? 0));
        const totalExpense = Number(@json($totalExpense ?? 0));

        const ctx = document.getElementById('financeChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Pemasukan', 'Pengeluaran'],
                datasets: [{
                    label: 'Jumlah (Rp)',
                    data: [totalIncome, totalExpense],
                    backgroundColor: ['#34d399', '#f87171'],
                    borderColor: ['#059669', '#dc2626'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>
