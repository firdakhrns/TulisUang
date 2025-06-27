<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wallets = Wallet::where('user_id', Auth::id())->get();
        return view('wallets.index', compact('wallets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('wallets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'balance' => $request->balance,
        ]);

        return redirect()->route('wallets.index')->with('success', 'Wallet berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wallet $wallet)
    {
        $this->authorizeWallet($wallet);
        return view('wallets.edit', compact('wallet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wallet $wallet)
    {
        $this->AuthorizeWallet($wallet);

        $request->validate([
            'name' =>'required|string|max:100',
            'balance' =>'required|numeric',
        ]);

        $wallet->update($request->only('name', 'balance'));

        return redirect()->route('wallets.index')->with('success', 'Wallet berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wallet $wallet)
    {
        $this->authorizeWallet($wallet);
        $wallet->delete();

        return redirect()->route('wallets.index')->with('success', 'Wallet berhasil dihapus.');
    }

    private function authorizeWallet(Wallet $wallet)
    {
        if ($wallet->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
