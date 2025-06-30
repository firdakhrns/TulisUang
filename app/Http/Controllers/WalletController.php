<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    /**
     * Menampilkan semua dompet.
     */
    public function index()
    {
        $wallets = Wallet::where('user_id', Auth::id())->get();

        // Hitung saldo akhir dari: saldo_awal + pemasukan - pengeluaran
        foreach ($wallets as $wallet) {
            $income = $wallet->transactions()->where('type', 'income')->sum('amount');
            $expense = $wallet->transactions()->where('type', 'expense')->sum('amount');
            $wallet->final_balance = $wallet->balance + $income - $expense;
        }

        return view('wallets.index', compact('wallets'));
    }

    /**
     * Form tambah dompet.
     */
    public function create()
    {
        return view('wallets.create');
    }

    /**
     * Simpan dompet baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'balance' => 'required|numeric|min:0',
        ]);

        Wallet::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'balance' => $request->balance,
        ]);

        return redirect()->route('wallets.index')->with('success', 'Wallet berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail dompet.
     */
    public function show(Wallet $wallet)
    {
        $this->authorizeWallet($wallet);

        $income = $wallet->transactions()->where('type', 'income')->sum('amount');
        $expense = $wallet->transactions()->where('type', 'expense')->sum('amount');
        $wallet->final_balance = $wallet->balance + $income - $expense;

        return view('wallets.show', compact('wallet'));
    }

    /**
     * Form edit dompet.
     */
    public function edit(Wallet $wallet)
    {
        $this->authorizeWallet($wallet);
        return view('wallets.edit', compact('wallet'));
    }

    /**
     * Update dompet.
     */
    public function update(Request $request, Wallet $wallet)
    {
        $this->authorizeWallet($wallet);

        $request->validate([
            'name' => 'required|string|max:100',
            'balance' => 'required|numeric|min:0',
        ]);

        $wallet->update([
            'name' => $request->name,
            'balance' => $request->balance,
        ]);

        return redirect()->route('wallets.index')->with('success', 'Wallet berhasil diperbarui.');
    }

    /**
     * Hapus dompet.
     */
    public function destroy(Wallet $wallet)
    {
        $this->authorizeWallet($wallet);
        $wallet->delete();

        return redirect()->route('wallets.index')->with('success', 'Wallet berhasil dihapus.');
    }

    /**
     * Pastikan dompet milik user yang login.
     */
    private function authorizeWallet(Wallet $wallet)
    {
        if ($wallet->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
