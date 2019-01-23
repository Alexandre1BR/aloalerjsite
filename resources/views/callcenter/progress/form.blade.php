@extends('layouts.app')

@section('vue-app-name', 'vue-progress')

@section('heading')
    @parent

    <div class="mt-4">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <ul class="aloalerj-breadcrumbs">
                        <li>
                            <a href="{{ route('people.show', ['id' => $record->person->id]) }}">{{ $record->person->name }}</a>
                        </li>

                        <br>

                        <li>
                            <a href="{{ route('records.show', ['id' => $record->id]) }}">Protocolo {{ $record->protocol }}</a>
                        </li>

                        <br>

                        <li>Andamentos</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 offset-lg-2 form-bigger">
                <form id="formProgress" method="POST" action="{{ route('progresses.store') }}" class="form-with-labels">
                    @csrf

                    @if (isset($progress))
                        <input name="id" type="hidden" value="{{ $progress->id }}">
                    @endif

                    @if((!is_null($progress)) && !is_null($progress->id))
                        <input name="committee_id" type="hidden" value="{{ $progress->record->committee->id ?? '' }}">
                    @else
                        <input name="committee_id" type="hidden" value="{{ $record->committee->id ?? '' }}">
                    @endif

                    <input name="record_id" id="record_id"type="hidden" value="{{ $record->id }}">

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="protocol" class="col-form-label">Protocolo</label>
                            <input id="cpf_cnpj"
                                   class="form-control{{ $errors->getBag('validation')->has('protocol') ? ' is-invalid' : '' }}" name="protocol"
                                   value="{{is_null(old('protocol')) ? $record->protocol : old('protocol') }}"
                                   readonly="readonly">
                            @if ($errors->getBag('validation')->has('protocol'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->getBag('validation')->first('protocol') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="origin_id" class="col-form-label">Origem</label>
                            <select id="origin_id"
                                    class="form-control{{ $errors->getBag('validation')->has('origin_id') ? ' is-invalid' : '' }} select2" name="origin_id" @include('partials.disabled',['model'=>$progress])
                                    value="{{is_null(old('origin_id')) ? $progress->origin_id : old('origin_id') }}" autofocus required>
                                <option value="">SELECIONE</option>
                                @foreach ($origins as $key => $origin)
                                    @if(((!is_null($progress->id)) && (!is_null($progress->origin_id) && $progress->origin_id === $origin->id) ||
                                    (!is_null(old('origin_id'))) && old('origin_id') == $origin->id))
                                        <option value="{{ $origin->id }}" selected="selected">{{ $origin->name }}</option>
                                    @else
                                        <option value="{{ $origin->id }}">{{ $origin->name }}</option>
                                    @endif
                                @endforeach
                            </select>

                            @if ($errors->getBag('validation')->has('origin_id'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->getBag('validation')->first('origin_id') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label for="record_type_id" class="col-form-label">Tipo</label>
                            <select id="record_type_id" type="record_type_id"
                                    class="form-control{{ $errors->getBag('validation')->has('record_type_id') ? ' is-invalid' : '' }} select2" name="record_type_id"
                                    value="{{is_null(old('record_type_id')) ? $progress->record_type_id : old('record_type_id') }}" autofocus @include('partials.disabled',['model'=>$progress])>
                                <option value="">SELECIONE</option>
                                @foreach ($recordTypes as $key => $recordType)
                                    @if(((!is_null($progress->id)) && (!is_null($progress->record_type_id) && $progress->record_type_id === $recordType->id) ||
                                    (!is_null(old('record_type_id'))) && old('record_type_id') == $recordType->id))
                                        <option value="{{ $recordType->id }}" selected="selected">{{ $recordType->name }}</option>
                                    @else
                                        <option value="{{ $recordType->id }}">{{ $recordType->name }}</option>
                                    @endif                                @endforeach
                            </select>

                            @if ($errors->getBag('validation')->has('record_type_id'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->getBag('validation')->first('record_type_id') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="area_id" class="col-form-label">Área</label>
                            <select id="area_id" type="area_id"
                                    class="form-control{{ $errors->getBag('validation')->has('area_id') ? ' is-invalid' : '' }} select2" name="area_id"
                                    value="{{is_null(old('area_id')) ? $progress->area_id : old('area_id') }}" autofocus @include('partials.disabled',['model'=>$progress])>
                                <option value="">SELECIONE</option>
                                @foreach ($areas as $key => $area)
                                    @if(((!is_null($progress->id)) && (!is_null($progress->area_id) && $progress->area_id === $area->id) ||
                                    (!is_null(old('area_id'))) && old('area_id') == $area->id))
                                        <option value="{{ $area->id }}" selected="selected">{{ $area->name }}</option>
                                    @else
                                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                                    @endif
                                @endforeach
                            </select>

                            @if ($errors->getBag('validation')->has('area_id'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->getBag('validation')->first('area_id') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="progress_type_id" class="col-form-label">Tipo de Andamento</label>
                            <select id="progress_type_id" type="progress_type_id"
                                    class="form-control{{ $errors->getBag('validation')->has('progress_type_id') ? ' is-invalid' : '' }} select2" name="progress_type_id"
                                    value="{{is_null(old('progress_type_id')) ? $progress->progress_type_id : old('progress_type_id') }}" autofocus  @include('partials.disabled',['model'=>$progress])>
                                <option value="">SELECIONE</option>
                                @foreach ($progressTypes as $key => $progressType)
                                    @if(((!is_null($progress->id)) && (!is_null($progress->progress_type_id) && $progress->progress_type_id === $progressType->id) ||
                                    (!is_null(old('progress_type_id'))) && old('progress_type_id') == $progressType->id))
                                        <option value="{{ $progressType->id }}" selected="selected">{{ $progressType->name }}</option>
                                    @else
                                        <option value="{{ $progressType->id }}">{{ $progressType->name }}</option>
                                    @endif
                                @endforeach
                            </select>

                            @if ($errors->getBag('validation')->has('progress_type_id'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->getBag('validation')->first('progress_type_id') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="original" class="col-form-label">Solicitação</label>
                            <textarea id="original"
                                      class="form-control{{ $errors->getBag('validation')->has('original') ? ' is-invalid' : '' }}"
                                      name="original"
                                      value="{{is_null(old('original')) ? $progress->original : old('original') }}"
                                      required rows="15" @include('partials.disabled',['model'=>$progress])>{{$progress->original}}</textarea>
                            @if ($errors->getBag('validation')->has('original'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->getBag('validation')->first('original') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-4 mt-5 text-center">
                        <div class="col-md-12">
                            @include('partials.previous-button')

                            @if(isset($progress) && ! is_null($progress->id))
                                <button  type="button" v-on:click="editButton" class="btn btn-danger" id="vue-editButton" @can('committee-canEdit', !is_null($progress->committee) ? $progress->record->committee->id : ($record->committee->id ?? '')) :disabled="isEditing || isCreating" @else disabled @endcan>
                                    <i class="fas fa-pencil-alt"></i> Alterar
                                </button>
                            @endIf

                            <button class="btn btn-danger" id="saveButton" name="saveButton" @can('committee-canEdit', !is_null($progress->committee) ? $progress->record->committee->id : ($record->committee->id ?? '')) @include('partials.disabled',['model'=>$progress]) @else disabled @endcan>
                                <i class="far fa-save"></i> Gravar
                            </button>

                            <button id="cancelButton" class="btn btn-danger" v-on:click.prevent="cancel()"  :disabled="!(isEditing || isCreating)">
                                <i class="fas fa-ban"></i> Cancelar
                            </button>

                            @if ($record->resolved_at)
                                <button onclick="return false;" v-on:click="confirmForPost('{{route('progresses.store-and-reopen') }}', 'formProgress')" class="btn btn-danger btn-depth" @can('committee-canEdit', !is_null($progress->committee) ? $progress->record->committee->id : ($record->committee->id ?? '')) @include('partials.disabled',['model'=>$progress]) @else disabled @endcan>
                                    Gravar e reabrir
                                </button>
                            @else
                                <button onclick="return false;" v-on:click="confirmForPost('{{route('progresses.store-and-mark-as-resolved') }}', 'formProgress')" class="btn btn-danger" @can('committee-canEdit', !is_null($progress->committee) ? $progress->record->committee->id : ($record->committee->id ?? '')) @include('partials.disabled',['model'=>$progress]) @else disabled @endcan>
                                    <i class="fas fa-clipboard-check"></i> Gravar e finalizar
                                </button>
                            @endif

                            @if ($progress && $progress->id)
                                <a href="{{ route('progresses.notify', $progress->id) }}" class="btn btn-primary btn-depth"  @can('committee-canEdit', !is_null($progress->committee) ? $progress->record->committee->id : ($record->committee->id ?? '')) @include('partials.disabled',['model'=>$progress]) @else disabled @endcan>
                                    Notificar cidadão
                                </a>
                            @endif
                        </div>
                    </div>

                    <input name="files_array" type="hidden" v-model="filesJsonString">
                </form>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @include('callcenter.progress_files.index')
@endsection
