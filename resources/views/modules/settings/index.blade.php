@extends('layouts.template')

@section('title', 'Configuraciones')

@section('content')
	<div class="col-xl-12">
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon-settings-1"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Configuraciones
                    </h3>
                </div>
            </div>

            <div class="kt-portlet__body">
                <div class="kt-notification">
                    <a class="kt-notification__item" href="{{ url('settings/years') }}">
                        <div class="kt-notification__item-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Años fiscales
                            </div>
                        </div>
                    </a>
                    <a class="kt-notification__item" href="{{ route('categories.index') }}">
                        <div class="kt-notification__item-icon">
                            <i class="fas fa-tag"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Categorías
                            </div>
                        </div>
                    </a>
                    <a class="kt-notification__item" href="{{ url('settings/ordinances') }}">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-file-1"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Ordenanzas
                            </div>
                        </div>
                    </a>
                    <a class="kt-notification__item" href="{{ url('settings/payment-methods') }}">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon-coins"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Métodos de pago
                            </div>
                        </div>
                    </a>
                    <a class="kt-notification__item" href="{{ url('settings/tax-units') }}">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon-price-tag"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Unidades Tributarias
                            </div>
                        </div>
                    </a>
                    <a class="kt-notification__item" href="{{ url('settings/concepts') }}">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-shopping-cart-1"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Conceptos de recaudación
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
