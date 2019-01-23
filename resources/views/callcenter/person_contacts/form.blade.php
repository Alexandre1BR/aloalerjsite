@extends('layouts.app')

@section('heading')
    @parent

    <div class="mt-4" id="vue-contact-outside-workflow">

        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <ul class="aloalerj-breadcrumbs">
                        <li>
                            <a href="{{ route('people.show', ['id' => $person->id]) }}">{{ $person->name }}</a>
                        </li>

                        <li>Contatos</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 offset-lg-2 form-bigger">
                <form method="POST" action="{{ route('people_contacts.update') }}" aria-label="Contatos"  class="form-with-labels">
                    @csrf

                    @if (isset($person))
                        <input name="person_id" type="hidden" value="{{ $person->id }}">
                    @endif

                    @if (isset($contact))
                        <input name="contact_id" type="hidden" value="{{ $contact->id }}">
                    @endif

                    <div class="form-group row">

                        <div class="col-md-6">
                            <label for="cpf_cnpj" class="col-form-label">CNPJ/CPF</label>
                            <input id="cpf_cnpj"
                                   class="form-control{{ $errors->has('cpf_cnpj') ? ' is-invalid' : '' }}" name="cpf_cnpj"
                                   value="{{is_null(old('cpf_cnpj')) ? $person->cpf_cnpj : old('cpf_cnpj')}}"
                                   readonly="readonly">

                            @if ($errors->has('cpf_cnpj'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('cpf_cnpj') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="col-form-label">Nome Completo</label>
                            <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   name="name" value="{{is_null(old('name')) ? $person->name : old('name')}}"
                                   readonly="readonly">

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>

                    </div>

                    {{--{{dd($contact->contact_type_id,$contact->contact)}}--}}

                    <div class="form-group row" >


                        <div class="col-md-4">
                            <label for="mobile" class="col-form-label">Tipo de Contato</label>
                            <input
                                    id="contact_type_id"
                                    name="contact_type_id"
                                    v-model="currentContactType"
                                    readonly="readonly"
                                    type="hidden"
                            />
                            <select
                                    id="contact_type_id_select"
                                    name="contact_type_id_select"
                                    v-model="currentContactType"
                                    {{--v-init:current-contact-type="'{{is_null(old('contact_type_id')) ? $contact->contact_type_id : old('contact_type_id')}}'"--}}
                                    class="select form-control{{ $errors->has('contact_type_id') ? ' is-invalid' : '' }} select2"
                                    autofocus
                                    required
                                    disabled="disabled"
                            >
                                <option value="">SELECIONE</option>
                                @foreach ($contactTypes as $key => $contactType)
                                    @if(((!is_null($contact->id)) && (!is_null($contact->contact_type_id) && $contact->contact_type_id == $contactType->id) || (!is_null(old('contact_type_id'))) && old('contact_type_id') == $contactType->id))
                                        <option value="{{ $contactType->id }}" selected="selected">{{ $contactType->name }}</option>
                                    @else
                                        <option value="{{ $contactType->id }}">{{ $contactType->name }}</option>
                                    @endif
                                @endforeach
                            </select>

                            @if ($errors->has('contact_type_id'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('contact_type_id') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="col-md-5">
                            <label for="mobile" class="col-form-label">Contato</label>
                            <the-mask
                                    v-if="this.currentContactType"
                                    v-model="currentContact"
                                    class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}"
                                    :mask="mask"
                                    id="contact"
                                    name="contact"
                                    value=""
                                    type="text"
                                    masked="masked"
                                    :tokens="tokens"
                                    required
                                    autofocus
                                    @include('partials.disabled',['model'=>$contact])
                            ></the-mask>
                        </div>

                        <div class="col-md-3">
                            <label for="active" class="col-form-label">Contato Ativo</label>

                            {{--<input type="hidden" name="active" value="0">--}}
                            {{--<p class="form-twolines">--}}
                                {{--<button type="button" class="btn btn-sm btn-toggle active" data-toggle="button" aria-pressed="true" autocomplete="não" @include('partials.disabled',['model'=>$contact])>--}}
                                    {{--<div class="handle"></div>--}}
                                {{--</button>--}}
                            {{--</p>--}}

                            <input type="hidden" name="active" value="0">
                            <input
                                type="checkbox"
                                name="active" {{old('active') || $contact->active ? 'checked="checked"' : ''}}
                                @include('partials.disabled',['model'=>$contact])
                            >

                        </div>

                    </div>


                    <div class="form-group row">


                    </div>

                    @if (!$workflow)
                        <div class="form-group row">

                            <div class="col-md-6">
                                <label for="identification" class="col-form-label">
                                    Criado em
                                </label>

                                <input id="identification"
                                       class="form-control"
                                       value="{{ $contact->created_at_formatted ?? '' }}"
                                       disabled
                                >
                            </div>
                            <div class="col-md-6">
                                <label for="identification" class="col-form-label">
                                    Alterado em
                                </label>
                                <input id="identification"
                                       class="form-control"
                                       value="{{ $contact->updated_at_formatted ?? '' }}"
                                       disabled
                                >
                            </div>
                        </div>

                    @endif


                    <div class="form-group row mb-0 mt-5">
                        <div class="col-md-8 offset-md-4">
                            @include('partials.edit-button',['model'=>$contact, 'form' =>'formRecords'])
                            <button type="submit" class="btn btn-danger" @include('partials.disabled',['model'=>$contact])>
                                <i class="far fa-save"></i> Gravar
                            </button>

                            <button id="cancelButton" class="btn btn-danger" v-on:click.prevent="cancel()"  :disabled="!(isEditing || isCreating)">
                                <i class="fas fa-ban"></i> Cancelar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('content')

@stop
