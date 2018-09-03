    <div class="card-body">

        <table id="progressesTable" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Tipo de Andamento</th>
                <th>Origem</th>
                <th>Área</th>
                <th>Solicitação</th>
                <th>Finalizador</th>
                <th>Criado em</th>
            </tr>
            </thead>

            @forelse ($progresses as $progress)
                <tr>
                    <td>
                        <a href="{{ $progress->link }}">
                            {{ $progress->progressType->name ?? '' }}
                        </a>
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
                    <td>
                        @if ($progress->record->resolve_progress_id == $progress->id)
                            @if($progress->finalize)
                                <span class="badge badge-success">Finalizador</span>
                            @endif
                        @else
                            <span class="badge badge-danger">Não finalizado</span>
                        @endif
                    </td>
                    <td>{{ $progress->created_at_formatted or '' }}</td>
                </tr>
            @empty
                <p>Nenhum andamento encontrado.</p>
            @endforelse
        </table>
        {{ $progresses->links() }}
    </div>
