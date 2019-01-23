@extends('layouts.app')

@section('content')
    <div class="card mt-4" id="vue-committees-search">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-7 col-md-4">
                    <h3>
                        <i class="fas fa-layer-group"></i> Comissões
                    </h3>
                </div>

                <div class="col-12 col-md-8 text-right">
                    <input
                        type="text"
                        id="search"
                        placeholder="Comissões"
                        v-model="form.search"
                        @keyup="typeKeyUp"
                    >&nbsp;&nbsp;
                    <a id="buttonNovaComissao" href="{{ route('committees.create') }}"
                       class="btn btn-primary btn-sm pull-right">
                        <i class="fa fa-plus"></i>
                        Nova Commissão
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('callcenter.committees.partials.table')
        </div>
    </div>
@endsection
