<div class="card mt-4"  id="vue-record">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-7 col-md-4">
                <h3>
                    <i class="fas fa-list-ol"></i> Protocolos

                    @if (isset($onlyNonResolved))
                        Não Resolvidos
                    @endif
                </h3>
            </div>
            <div class="col-5 col-md-8 text-right">
                @if(isset($person))
                    <a id="button-novo-protocolo"
                       href="{{ route('records.create',['person_id'=>$person->id]) }}"
                       class="btn btn-primary btn-sm pull-right"
                    >
                        <i class="fa fa-plus"></i>
                        Novo Protocolo
                    </a>
                @endif
            </div>
        </div>
    </div>


    <div class="card-body d-none d-sm-block">

        <table id="recordsTable" class="table table-striped table-hover" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Protocolos</th>
                @if(!isset($person)) {{-- Apenas para Protocolos não resolvidos:: http://aloalerj.com/callcenter/records/non-resolved  --}}
                <th>Nome</th>
                @endif
                <th>Comissão</th>
                <th>Tipo de Protocolo</th>
                <th>Área</th>
                <th>Situação</th>
                <th>Criado em</th>
            </tr>
            </thead>

            @forelse ($records as $record)
                <tr v-on:click='detail("{{route('records.show', ['id' => $record->id])}}")' style="cursor: pointer;">
                    <td>{{ $record->protocol }}</td>

                    @if(!isset($person)) {{-- Apenas para Protocolos não resolvidos:: http://aloalerj.com/callcenter/records/non-resolved  --}}
                    <td>
                        <a href="{{ route('people.show',['id' => $record->person->id]) }}" >{{ $record->person->name }}</a>
                    </td>
                    @endif

                    <td>{{ $record->committee->name ?? '' }}</td>

                    <td>{{ $record->recordType->name ?? '' }}</td>

                    <td>{{ $record->area->name ?? '' }}</td>

                    <td>

                            @if($record->resolved_at)

                            <span class="label-group"><span class="label label-danger"><i class="fas fa-times-circle"></i></span><span class="label label-danger ng-binding">Finalizado</span>

                            @else
                                {{--<span class="badge badge-success">Em aberto</span>--}}
                            <span class="label-group"><span class="label label-primary"><i class="fas fa-folder-open"></i></span><span class="label label-primary ng-binding">Em Aberto</span>

                            @endIf

                    </td>

                    <td>{{ $record->created_at_formatted ?? '' }}</td>
                </tr>
            @empty
                <p>Nenhum Protocolo encontrado</p>
            @endforelse
        </table>

        <div class="d-flex justify-content-center">
                {{ $records->links() }}
        </div>
    </div>

    <!-------------------- Start of MOBILE VERSION -------------------->

    <div class="card-body" >

        <div class="d-block d-sm-none">
            @forelse ($records as $record)
                <div class="mobile-tables" v-on:click='detail("{{route('records.show', ['id' => $record->id])}}")' style="cursor: pointer;" >
                    <div class="contact-line"><span class="mobile-label">Protocolo Nº</span>{{ $record->protocol }}</div>
                    @if(!isset($person)) {{-- Apenas para Protocolos não resolvidos:: http://aloalerj.com/callcenter/records/non-resolved  --}}
                    <div class="contact-line"><span class="mobile-label">Nome : </span> <a href="{{ route('people.show',['id' => $record->person->id]) }}" >{{ $record->person->name }}</a> </div>
                    @endif
                    <div class="contact-line"><span class="mobile-label">Comissão : </span>{{ $record->committee->name ?? '' }} </div>
                    <div class="contact-line"><span class="mobile-label">Tipo de Protocolo : </span>{{ $record->recordType->name ?? '' }} </div>
                    <div class="contact-line"><span class="mobile-label">Área : </span>{{ $record->area->name ?? '' }} </div>
                    <div class="contact-line">
                        <span class="mobile-label">Situação : </span>
                        @if($record->resolved_at)
                            <span class="label-group"><span class="label label-danger"><i class="fas fa-times-circle"></i></span><span class="label label-danger ng-binding">Finalizado</span>
                                @else
                                    <span class="label-group"><span class="label label-primary"><i class="fas fa-folder-open"></i></span><span class="label label-primary ng-binding">Em Aberto</span>
                            @endIf
                    </div>
                    <div class="contact-line"><span class="mobile-label">Criado em : </span> {{ $record->created_at_formatted ?? '' }} </div>
                </div>
            @empty
                <p>Nenhum Protocolo encontrado</p>
            @endforelse
        </div>


            <div class="d-flex justify-content-center">
                {{ $records->links() }}
            </div>
    </div>



    <!-------------------- END of MOBILE VERSION -------------------->



</div>

