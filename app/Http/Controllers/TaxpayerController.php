<?php

namespace App\Http\Controllers;

use App\EconomicActivity;
use App\EconomicSector;
use App\TaxpayerType;
use App\State;
use App\Taxpayer;
use Illuminate\Http\Request;
use App\Http\Requests\Taxpayers\TaxpayerActivitiesFormRequest;
use App\Http\Requests\Taxpayers\TaxpayersCreateFormRequest;
use Yajra\DataTables\Facades\DataTables;

class TaxpayerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.taxpayers.index');
    }

    public function list()
    {
        $query = Taxpayer::query()
            ->with('commercialRegister');

        return DataTables::eloquent($query)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.taxpayers.register')
            ->with('types', TaxpayerType::get())
            ->with('sectors', EconomicSector::get())
            ->with('states', State::pluck('name', 'id'))
            ->with('typeForm', 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaxpayersCreateFormRequest $request)
    {
        $rif = $request->input('rif');
        $correlative = TaxpayerType::find($request->input('taxpayer_type'))->correlative;

        $taxpayer = new Taxpayer([
            'rif' => $correlative.$rif,
            'name' => $request->input('name'),
            'denomination' => $request->input('denomination'),
            'address' => $request->input('address'),
            'permanent_status' => $request->input('permanent_status'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'compliance_use' => $request->input('compliance_use'),
            'capital' => $request->input('capital'),
            'taxpayer_type_id' => $request->input('taxpayer_type'),
            'economic_sector_id' => $request->input('economic_sector'),
            'municipality_id' => $request->input('municipality')
        ]);
        $taxpayer->save();

        return redirect("taxpayers/".$taxpayer->id)
            ->withSuccess('¡Contribuyente registrado!');
    }

    public function activitiesForm($id)
    {
        $taxpayer = Taxpayer::find($id);

        return view('modules.taxpayers.register-economic-activities')
            ->with('taxpayer', $taxpayer)
            ->with('economicActivities', EconomicActivity::get())
            ->with('typeForm', 'create');
    }

    public function addActivities($id, TaxpayerActivitiesFormRequest $request)
    {
        $taxpayer = Taxpayer::find($id);

        $taxpayer->economicActivities()->attach(
            $request->input('economic_activities')
        );

        return redirect('taxpayers/'.$id)
            ->withSuccess('¡Actividades económicas añadidas!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Taxpayer  $taxpayer
     * @return \Illuminate\Http\Response
     */
    public function show(Taxpayer $taxpayer)
    {
        return view('modules.taxpayers.show')
            ->with('row', $taxpayer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Taxpayer  $taxpayer
     * @return \Illuminate\Http\Response
     */
    public function edit(Taxpayer $taxpayer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Taxpayer  $taxpayer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Taxpayer $taxpayer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Taxpayer  $taxpayer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Taxpayer $taxpayer)
    {
        //
    }
}
