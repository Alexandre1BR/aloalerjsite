    <div class="card-body d-none d-sm-block" id="vue-progress">

        <table id="progressesTable" class="table table-striped table-hover table-progress" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Tipo de Andamento</th>
                    <th>Origem</th>
                    <th>Área</th>
                    <th>Solicitação</th>
                    <th>Finalizador</th>
                    <th>Notificação</th>
                    <th>Criado em</th>
                </tr>
            </thead>

            @forelse ($progresses as $progress)
                <tr v-on:click='detail("{{$progress->link}}")' style="cursor: pointer;">
                    <td>
                        {{ $progress->progressType->name ?? '' }}
                    </td>

                    <td>
                        {{ $progress->origin->name ?? '' }}
                    </td>

                    <td>
                        {{ $progress->area->name ?? '' }}
                    </td>

                    <td>
                        {{ $progress->original }}
                    </td>

                    <td class="">
                        @if ($progress->record->resolve_progress_id == $progress->id)
                            @if($progress->finalize)
                                <h5><span class="badge badge-success">Sim</span></h5>
                            @endif
                        @else
                            <span class="label-group"><span class="label label-danger"><i class="fas fa-times-circle"></i></span><span class="label label-danger ng-binding">Não</span>
                            {{--<h5><span class="badge badge-danger">Não</span></h5>--}}
                        @endif
                    </td>

                    <td class="">
                        @if ($progress->email_sent_at)
                            <h5>
                                <span class="badge badge-success">
                                    E-mail
                                </span>
                            </h5>
                        @endif
                    </td>

                    <td>{{ $progress->created_at_formatted ?? '' }}</td>
                </tr>
            @empty
                <p>Nenhum andamento encontrado.</p>
            @endforelse
        </table>

        {{ $progresses instanceof \Illuminate\Contracts\Pagination\Paginator ? $progresses->links() : '' }}
    </div>


    <!-------------------- Start of MOBILE VERSION -------------------->

    <div class="card-body d-block d-sm-none" id="vue-progress">
        @forelse ($progresses as $progress)
        <div class="mobile-tables"  v-on:click='detail("{{$progress->link}}")' style="cursor: pointer;">

            <div class="contact-line"><span class="mobile-label">Tipo de Andamento :</span> {{ $progress->progressType->name ?? '' }}</div>
            <div class="contact-line"><span class="mobile-label">Origem :</span> {{ $progress->origin->name ?? '' }}</div>
            <div class="contact-line"><span class="mobile-label">Área :</span> {{ $progress->area->name ?? '' }}</div>
            <div class="contact-line"><span class="mobile-label">Solicitação :</span> {{ $progress->original }}</div>
            <div class="contact-line"><span class="mobile-label">Finalizador :</span>
                @if ($progress->record->resolve_progress_id == $progress->id)
                    @if($progress->finalize)
                        <h5><span class="badge badge-success">Sim</span></h5>
                    @endif
                @else
                    <span class="label-group"><span class="label label-danger"><i class="fas fa-times-circle"></i></span><span class="label label-danger ng-binding">Não</span>
                    {{--<h5><span class="badge badge-danger">Não</span></h5>--}}
                @endif
            </div>
            <div class="contact-line">
                <span class="mobile-label">Notificação :</span>@if ($progress->email_sent_at)
                    <span class="label-group"><span class="label label-primary"><i class="far fa-envelope"></i></span><span class="label label-primary ng-binding"> E-Mail </span>
                @endif
            </div>
            <div class="contact-line"><span class="mobile-label">Criado em :</span> {{ $progress->created_at_formatted ?? '' }}</div>


        </div>
        @empty
            <p>Nenhum andamento encontrado.</p>
        @endforelse
        {{ $progresses instanceof \Illuminate\Contracts\Pagination\Paginator ? $progresses->links() : '' }}

    </div>

    <!-------------------- Start of MOBILE VERSION -------------------->