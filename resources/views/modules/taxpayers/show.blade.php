@extends('layouts.template')

@push('js')
<script src="{{ asset('assets/js/profile.js') }}"></script>
@endpush

@section('title', 'Ficha del Contribuyente '.$row->name)

@section('content')

<div class="kt-portlet kt-portlet--height-fluid">
    <div class="kt-portlet__body">
        <div class="kt-widget kt-widget--user-profile-3">
            <div class="kt-widget__top">
                <div class="kt-widget__content">
                    <div class="kt-widget__head">
                        <a id="taxpayer" class="kt-widget__username" data_id="{{ $row->id }}" href="{{ Route('taxpayers.show', $row->id) }}">
                            {{ $row->name }}   
                            </br>
                            <small> {{ $row->rif }} </small>
                        </a>
                        @if(Auth::user()->can('edit.taxpayers'))
                        <div class="kt-widget__action">
                            <a href="{{ route('taxpayers.edit', $row) }}" class="btn btn-circle btn-icon">
                                <i class="flaticon2-edit kt-font-brand"></i>
                            </a>
                        </div>
                        @endif
                    </div>
                    <div class="kt-widget__subhead">
                        <a>
                            <i class="fas fa-tag"></i>
                            {{ $row->taxpayerClassification->name }}
                        </a>
                        <a>
                            <i class="flaticon2-maps"></i>
                             {{ $row->fiscal_address }}
                        </a>
                        <a>
                            <i class="flaticon2-new-email"></i>
                            {{ $row->email ?? 'NO REGISTRADO' }}
                        </a>
                        <a>
                            <i class="flaticon2-phone"></i>
                             {{ $row->phone ?? 'NO REGISTRADO' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">Pagos</h3>
            </div>
        </div>
        <div class="kt-portlet__body">
          <table id="tTaxpayerPayments" class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="15%">Nro.</th>
                <th width="15%">Estado</th>
                <th width="25%">Liquidador</th>
                <th width="15%">Creada</th>
                <th width="15%">Monto</th>
                <th width="15%">Acciones</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
</div>

@if(Auth::user()->can('process.settlements'))
<div class="row">
    @if (($row->taxpayerType->description == 'JURÍDICO') || ($row->companies()->first()))
    <div class="col-xl-6 col-sm-6">
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Actividades económicas</h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    @if(@Auth::user()->can('edit.taxpayers'))
                    <a href="{{ route('taxpayer.economic-activities', $row) }}" class="btn btn-circle btn-icon">
                        <i class="flaticon2-edit kt-font-brand"></i>
                    </a>
                    @endif
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kt-widget4">
                    @forelse($row->economicActivities as $activity) 
                        <div class="kt-widget4__item">
                            <div class="kt-widget4__icon">
                                 <i class="flaticon2-percentage"></i>
                            </div>
                            <div class="kt-widget4__info">
                                <a class="kt-widget4__username" href="{{ route('economic-activities.show', $activity->id) }}">
                                    {{ $activity->code }}
                                </a>
                                <p class="kt-widget4__text">
                                    {{ $activity->name  }}
                                </p>
                            </div>
                        </div>
                    @empty 
                        Este contribuyente no tiene actividades económicas asignadas
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="col-xl-6 col-sm-6">
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Representante(s)</h3>
                </div>
                @if(Auth()->user()->can('edit.taxpayers'))
                <div class="kt-portlet__head-toolbar">
                    <a href="{{ url("taxpayers/".$row->id."/representation/add") }}" class="btn btn-circle btn-icon">
                        <i class="flaticon2-plus kt-font-brand"></i>
                    </a>
                </div>
                @endif
            </div>
            <div class="kt-portlet__body">
                <div class="kt-widget4" id="representations">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-6 col-sm-6">
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__body">
                @if($row->economicActivities->count())
                <div class="kt-notification">
                    <a class="kt-notification__item" href="{{ url('taxpayers/'.$row->id.'/affidavits') }}">
                        <div class="kt-notification__item-icon">
                            <i class="fas fa-address-book"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Declaración jurada de ingresos    
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                <div class="kt-notification">
                    <a class="kt-notification__item" href="{{ route('fines.index', $row->id) }}">
                        <div class="kt-notification__item-icon">
                            <i class="fas fa-stop-circle"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Multas y sanciones
                            </div>
                        </div>
                    </a>
                </div>
                <div class="kt-notification">
                    <a class="kt-notification__item" href="{{ route('applications.index', $row->id) }}">
                        <div class="kt-notification__item-icon">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Solicitudes
                            </div>
                        </div>
                    </a>
                </div>
                {{--
                <div class="kt-notification">
                    <a class="kt-notification__item" href="{{ route('permits.index', $row) }}">
                        <div class="kt-notification__item-icon">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Permisos       
                            </div>
                        </div>
                    </a>
                </div>
                --}}
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-sm-6">
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Licencias 
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kt-notification">
                    <a class="kt-notification__item" href="{{ url('taxpayers/'.$row->id.'/economic-activity-licenses') }}">
                        <div class="kt-notification__item-icon">
                            <i class="fas fa-book-reader"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Licencias de actividad económica        
                            </div>
                            <div class="kt-notification__item-time">
                                Emitir nueva licencia y consultar histórico de renovaciones
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
