<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())->with('wallet', 'category')->get();
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $wallets = Wallet::where('user_id', Auth::id())->get();
        $categories = Category::where('user_id', Auth::id())->get();
        return view('transactions.create', compact('wallets', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'wallet_id' => 'required|exists:wallets,id',
        'category_id' => 'required|exists:categories,id',
        'type' => 'required|in:income,expense',
        'amount' => 'required|numeric',
        'description' => 'nullable|string',
        'date' => 'required|date',
    ]);

    Transaction::create([
        'user_id' => Auth::id(),
        'name' => $request->name,
        'wallet_id' => $request->wallet_id,
        'category_id' => $request->category_id,
        'type' => $request->type,
        'amount' => $request->amount,
        'description' => $request->description,
        'date' => $request->date,
    ]);

    return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan.');
}


    /**
     * Display the specified resource.
     */
    
    public function show(Transaction $transaction)
    {
        $this->authorizeTransaction($transaction);
        return view('transactions.show', compact('transaction'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $this->authorizeTransaction($transaction);

        $wallets = Wallet::where('user_id', Auth::id())->get();
        $categories = Category::where('user_id', Auth::id())->get();
        return view('transactions.edit', compact('transaction', 'wallets', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
{
    $this->authorizeTransaction($transaction);

    $request->validate([
        'wallet_id' => 'required|exists:wallets,id',
        'category_id' => 'required|exists:categories,id',
        'type' => 'required|in:income,expense', // ✅ tambahkan validasi type
        'amount' => 'required|numeric',
        'description' => 'nullable|string',
        'date' => 'required|date',
    ]);

    $transaction->update($request->only(
    'name',
    'wallet_id',
    'category_id',
    'type',
    'amount',
    'description',
    'date'
));

    return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $this->authorizeTransaction($transaction);
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    private function authorizeTransaction(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
