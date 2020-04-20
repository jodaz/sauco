<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Taxpayer;
use App\EconomicActivity;
use App\License;
use Carbon\Carbon;
use PDF;
use Session;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display reports dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.reports.index');
    }

    /**
     * Display a listing of processed payments.
     *
     * @return \Illuminate\Http\Response
     */
    public function payments()
    {
        return view('modules.reports.payments');
    }

    /**
     * Display a listing of null payments.
     *
     * @return \Illuminate\Http\Response
     */
    public function showNullPayments()
    {
        return view('modules.reports.list-null-payments');
    }

    public function printPaymentReport(Request $request)
    {
        $date = Carbon::parse($request->input('date'));
        $payments = Payment::processedByDate($date);
        $dateFormat = date('d-m-Y', strtotime($date)); 
        $total = $payments->map(function ($row) {
            return $row->getOriginal('amount');
        })->sum();

        $total = number_format($total, 2, ',', '.')." Bs";

        $pdf = PDF::LoadView('modules.reports.pdf.payments', compact(['dateFormat', 'payments', 'total']));
        return $pdf->download('reporte-de-pagos.pdf');
    }

    public function printTaxpayersReport()
    {
        $taxpayers = Taxpayer::get();
        $emissionDate = date('d-m-Y', strtotime(Carbon::now()));

        $pdf = PDF::loadView('modules.reports.pdf.taxpayers', compact(['taxpayers', 'emissionDate']));
        return $pdf->download('contribuyentes-registrados-'.$emissionDate.'.pdf');
    }

    public function printActivityReport(EconomicActivity $activity)
    {
        $taxpayers = $activity->taxpayers;
        $emissionDate = date('d-m-Y', strtotime(Carbon::now()));

        if (!$taxpayers->count()) {
            return redirect()->back()
                ->withError('¡La actividad no tiene contribuyentes!');
        }

        $data = compact(['activity', 'emissionDate', 'taxpayers']);

        return PDF::setOptions(['isRemoteEnabled' => true])
            ->loadView('modules.reports.pdf.activity', $data)
            ->download('reporte-actividad-'.$activity->code.'.pdf');
    }

    public function printLicensesList()
    {
        $licenses = License::with(['taxpayer'])->get();
        $emissionDate = date('d-m-Y', strtotime(Carbon::now()));

        $data = compact(['licenses', 'emissionDate']);
        $pdf = PDF::loadView('modules.reports.pdf.licenses', $data);

        return $pdf->download('licencias-emitidas-'.$emissionDate.'.pdf');
    }
}
