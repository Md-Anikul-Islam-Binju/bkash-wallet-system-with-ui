<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BkashService;
use App\Services\WalletService;
use App\Models\Wallet;

class WalletController extends Controller
{
    public function index()
    {
        $wallet = auth()->user()->wallet;
        $transactions = $wallet?->transactions()->latest()->get();

        return view('wallet.index',compact('wallet','transactions'));
    }

    public function connect(BkashService $bkash)
    {
        $res = $bkash->createAgreement(auth()->user());

        Wallet::updateOrCreate(
            ['user_id'=>auth()->id()],
            [
                'agreement_id'=>$res['agreementId'],
                'masked'=>$res['masked'],
                'balance'=>0
            ]
        );

        return back()->with('success','bKash connected');
    }

    public function pay(Request $r, WalletService $wallet)
    {
        $r->validate(['amount'=>'required|numeric|min:1']);
        $wallet->pay(auth()->user(),$r->amount);
        return back()->with('success','Payment successful');
    }
}
