<?php

namespace App\Http\Controllers\Referrals;

use Illuminate\Http\Request;
use App\Rules\NotReferringSelf;
use App\Rules\NotReferringExisting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Referrals\ReferralReceived;
use App\Http\Requests\Referrals\ReferralStoreRequest;

class ReferralController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        $referrals = $request->user()->referrals()->orderBy('completed', 'asc')->get();

        return view('referrals.index', compact('referrals'));
    }

    public function store(ReferralStoreRequest $request)
    {
        $referral = $request->user()->referrals()->create($request->only('email'));

        Mail::to($referral->email)->send(
            new ReferralReceived($request->user(), $referral)
        );

        return back();
    }
}
