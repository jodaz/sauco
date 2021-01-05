<?php

namespace App\Http\Controllers;

use App\Models\Taxpayer;
use App\Affidavit;
use App\Payment;
use App\License;

class DashboardController extends Controller
{
    public function index()
    {
        $taxpayerCount = Taxpayer::count();
        $licenseCount = License::count();
        $paymentCount = Payment::whereStatusId('2')
            ->count();
        $affidavitCount = Affidavit::count();

        return view('modules.dashboard.index')
            ->with('taxpayerCount', $taxpayerCount)
            ->with('paymentCount', $paymentCount)
            ->with('licenseCount', $licenseCount)
            ->with('affidavitCount', $affidavitCount);
    }
}
