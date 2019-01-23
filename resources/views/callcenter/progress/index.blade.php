<div class="card mt-4" id="vue-progress">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-7 col-md-4">
                <h3>
                    <i class="fas fa-tasks"></i> Andamentos
                </h3>
            </div>

            <div class="col-5 col-md-8 text-right">
                <a id="button-novo-andamento" href="{{ route('progresses.create',['record_id' => $record->id]) }}"
                   class="btn btn-primary btn-sm pull-right">
                    <i class="fa fa-plus"></i>
                    Novo Andamento
                </a>
            </div>
        </div>
    </div>

    @include('callcenter.progress.partials.table')
</div>
