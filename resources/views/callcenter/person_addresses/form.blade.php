@extends('layouts.app')
@section('heading')

<div id="vue-addresses">
    @parent
    <div class="row mt-4">
        <div class="col-lg-8 offset-lg-2 text-center">
            <div class="section-title">
                <ul class="aloalerj-breadcrumbs">
                    <li>
                        <a href="{{ route('people.show', ['id' => $person->id]) }}">{{ $person->name }}</a>
                    </li>
                    <li>
                        Endereços
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2 form-bigger">
            <form method="POST" action="{{ route('people_addresses.store') }}" aria-label="Endereços"  class="form-with-labels">
                @csrf
                @if (isset($person))
                    <input name="person_id" type="hidden" value="{{ $person->id }}">
                @endif
                @if (isset($address))
                    <input name="address_id" type="hidden" value="{{ $address->id }}">
                @endif
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="cpf_cnpj" class="col-form-label">CNPJ/CPF</label>
                        <input id="cpf_cnpj"
                               class="form-control{{ $errors->getBag('validation')->has('cpf_cnpj') ? ' is-invalid' : '' }}" name="cpf_cnpj"
                               value="{{is_null(old('cpf_cnpj')) ? $person->cpf_cnpj : old('cpf_cnpj') }}"
                               readonly="readonly">
                        @if ($errors->getBag('validation')->has('cpf_cnpj'))
                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->getBag('validation')->first('cpf_cnpj') }}</strong></span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="name" class="col-form-label">Nome Completo</label>
                        <input id="name" class="form-control{{ $errors->getBag('validation')->has('name') ? ' is-invalid' : '' }}"
                               name="name" value="{{is_null(old('name')) ? $person->name : old('name') }}"
                               readonly="readonly">
                        @if ($errors->getBag('validation')->has('name'))
                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->getBag('validation')->first('name') }}</strong></span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="zipcode" class="col-form-label">CEP</label>
                        <input id="zipcode"
                               name="zipcode"
                               v-model="form.zipcode"
                               v-init:zipcode="'{{is_null(old('zipcode')) ? $address->zipcode : old('zipcode') }}'"
                               value="{{is_null(old('zipcode')) ? $address->zipcode : old('zipcode') }}"
                               class="form-control{{ $errors->getBag('validation')->has('zipcode') ? ' is-invalid' : '' }}"
                               @keyup="typeKeyUp"
                               v-mask='["##.###-###"]'
                               required
                                @include('partials.disabled',['model'=>$address])
                        >
                        @if ($errors->getBag('validation')->has('zipcode'))
                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->getBag('validation')->first('zipcode') }}</strong></span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="street" class="col-form-label">Endereço</label>
                        <input id="street"
                               name="street"
                               v-model="form.street"
                               v-init:street="'{{is_null(old('street')) ? $address->street : old('street') }}'"
                               value="{{is_null(old('street')) ? $address->street : old('street') }}"
                               class="form-control{{ $errors->getBag('validation')->has('street') ? ' is-invalid' : '' }}"
                               required
                               autofocus
                                @include('partials.disabled',['model'=>$address])
                        >
                        @if ($errors->getBag('validation')->has('street'))
                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->getBag('validation')->first('street') }}</strong></span>
                        @endif
                    </div>
                    <div class="col-md-2">
                        <label for="number" class="col-form-label">Número</label>
                        <input id="number"
                               name="number"
                               {{--v-on:keypress="isNumber(event)"--}}
                               value="{{is_null(old('number')) ? $address->number : old('number') }}"
                               class="form-control{{ $errors->getBag('validation')->has('state') ? ' is-invalid' : '' }}"
                               required
                               autofocus
                                @include('partials.disabled',['model'=>$address])
                        >
                        @if ($errors->getBag('validation')->has('number'))
                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->getBag('validation')->first('number') }}</strong></span>
                        @endif
                    </div>
                    <div class="col-md-2">
                        <label for="complement" class="col-form-label text-md-right">Complemento</label>
                        <input id="complement"
                               name="complement"
                               value="{{is_null(old('complement')) ? $address->complement : old('complement') }}"
                               class="form-control{{ $errors->getBag('validation')->has('complement') ? ' is-invalid' : '' }}"
                               autofocus
                                @include('partials.disabled',['model'=>$address])
                        >
                        @if ($errors->getBag('validation')->has('complement'))
                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->getBag('validation')->first('complement') }}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="neighbourhood" class="col-form-label">Bairro</label>
                        <input id="neighbourhood"
                               name="neighbourhood"
                               v-model="form.neighbourhood"
                               v-init:neighbourhood="'{{is_null(old('neighbourhood')) ? $address->neighbourhood : old('neighbourhood') }}'"
                               value="{{is_null(old('neighbourhood')) ? $address->neighbourhood : old('neighbourhood') }}"
                               class="form-control{{ $errors->getBag('validation')->has('neighbourhood') ? ' is-invalid' : '' }}"
                               required
                               autofocus
                                @include('partials.disabled',['model'=>$address])
                        >
                        @if ($errors->getBag('validation')->has('neighbourhood'))
                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->getBag('validation')->first('neighbourhood') }}</strong></span>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label for="city" class="col-form-label">Cidade</label>
                        <input id="city"
                               name="city"
                               v-model="form.city"
                               v-init:city="'{{is_null(old('city')) ? $address->city : old('city') }}'"
                               value="{{is_null(old('city')) ? $address->city : old('city') }}"
                               class="form-control{{ $errors->getBag('validation')->has('city') ? ' is-invalid' : '' }}"
                               required
                               autofocus
                                @include('partials.disabled',['model'=>$address])
                        >
                        @if ($errors->getBag('validation')->has('city'))
                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->getBag('validation')->first('city') }}</strong></span>
                        @endif
                    </div>
                    <div class="col-md-2">
                        <label for="state" class="col-form-label text-md-right">Estado</label>
                        <input id="state"
                               name="state"
                               v-model="form.state"
                               v-init:state="'{{is_null(old('state')) ? $address->state : old('state') }}'"
                               value="{{is_null(old('state')) ? $address->state : old('state') }}"
                               class="form-control{{ $errors->getBag('validation')->has('state') ? ' is-invalid' : '' }}"
                               required
                               autofocus
                                @include('partials.disabled',['model'=>$address])
                        >
                        @if ($errors->getBag('validation')->has('state'))
                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->getBag('validation')->first('state') }}</strong></span>
                        @endif
                    </div>

                    {{--DESLIGADO PARA REVERMOS A LÓGICA, PORQUE NÃO DÁ PRA FAZER ENDEREÇO VALIDADO COM CHECKBOX A MENOS QUE TENHA CÓDIGO PRA ISSO--}}
                    {{--<div class="col-md-2">--}}
                        {{--<label for="is_mailable" class="col-form-label">Endereço Validado</label>--}}

                        {{--<input type="hidden" name="is_mailable" value="0">--}}
                        {{--<p class="form-twolines">--}}
                            {{--<button type="button" class="btn btn-sm btn-toggle active" data-toggle="button" aria-pressed="true" autocomplete="não"{{old('is_mailable') || $address->is_mailable ? 'checked="checked"' : ''}}--}}
                                    {{--@include('partials.disabled',['model'=>$address])>--}}
                                {{--<div class="handle"></div>--}}
                            {{--</button>--}}
                        {{--</p>--}}

                        {{--<input type="hidden" name="is_mailable" value="0">--}}
                        {{--<input--}}
                            {{--type="checkbox"--}}
                            {{--name="is_mailable" {{old('send_answer_by_email') || $address->is_mailable ? 'checked="checked"' : ''}}--}}
                            {{--@include('partials.disabled',['model'=>$address])--}}
                        {{-->--}}
                    {{--</div>--}}
                </div>

                <div class="form-group row">
                    @if (!((isset($workflow) && $workflow) || old('workflow')) && isset($address->zipcode))
                        <div class="col-md-2">
                            <label for="active" class="col-form-label">Endereço Ativo</label>
                            {{--<p class="form-twolines">--}}
                                {{--<button type="button" class="btn btn-sm btn-toggle active" data-toggle="button" aria-pressed="true" autocomplete="não"  {{old('active') || $address->active ? 'checked="checked"' : ''}}--}}
                                        {{--@include('partials.disabled',['model'=>$address])>--}}
                                    {{--<div class="handle"></div>--}}
                                {{--</button>--}}
                            {{--</p>--}}

                            <p class="checkbox">
                                <input type="hidden" name="active" value="0">
                                <input
                                        type="checkbox"
                                        name="active" {{old('active') || $address->active ? 'checked="checked"' : ''}}
                                        @include('partials.disabled',['model'=>$address])
                                >
                            </p>
                        </div>
                    @else
                        <input type="hidden" name="active" value="1">
                    @endIf
                    @if (!$workflow)
                        <div class="col-md-4">
                            <label for="identification" class="col-form-label">Criado em </label>
                            <input id="identification"
                                   class="form-control"
                                   value="{{ $address->created_at_formatted ?? '' }}"
                                   disabled
                            >
                        </div>
                    <div class="col-md-4">
                        <label for="identification" class="col-form-label">Alterado em</label>
                        <input id="identification"
                               class="form-control"
                               value="{{ $address->updated_at_formatted ?? '' }}"
                               disabled
                        >
                    </div>
                    @endif
                </div>



                <div class="form-group row mb-0 mt-5 text-center">
                    <div class="col-md-12">
                        @if ((isset($workflow) && $workflow) || old('workflow'))
                            <button id="saveButton" type="submit" class="btn btn-danger" @include('partials.disabled',['model'=>$address])>
                                Próximo Passo  <i class="fas fa-forward"></i>
                            </button>
                        @else
                            @include('partials.edit-button',['model'=>$address, 'form' =>'formAddress'])
                            <button id="saveButton" type="submit" class="btn btn-danger" @include('partials.disabled',['model'=>$address])>
                                <i class="far fa-save"></i> Gravar
                            </button>
                            <button id="cancelButton" class="btn btn-danger" v-on:click.prevent="cancel()"  :disabled="!(isEditing || isCreating)">
                                <i class="fas fa-ban"></i> Cancelar
                            </button>
                        @endif
                    </div>
                </div>


            </form>
        </div>
    </div>
</div>
@endsection
@section('content')
@endsection
