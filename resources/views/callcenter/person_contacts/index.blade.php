{{--
<div class="mt-4">
        <div class="row section-header align-items-center">
            <div class="col-4">
                <h5>
                    <i class="fas fa-phone"></i> Contatos
                </h5>
            </div>

            <div class="col-8 text-right">
                <a id="button-novo-contato" href="#" data-toggle="modal" data-target="#contactsModal"
                   class="btn btn-primary btn-sm pull-right">
                    <i class="fa fa-plus"></i>
                    Novo Contato
                </a>
            </div>
        </div>

        @include('callcenter.person_contacts.partials.form-modal')


        @include('callcenter.person_contacts.partials.table')
</div>

--}}



<div class="card mt-4">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-7 col-md-4">
                <h3>
                    <i class="fas fa-phone"></i> Contatos
                </h3>
            </div>

            <div class="col-5 col-md-8 text-right">
                <a id="button-novo-contato" href="#" data-toggle="modal" data-target="#contactsModal"
                   class="btn btn-primary btn-sm pull-right">
                    <i class="fa fa-plus"></i>
                    Novo Contato
                </a>
            </div>
        </div>

        @include('callcenter.person_contacts.partials.form-modal')
    </div>
    <div class="card-body">
        @include('callcenter.person_contacts.partials.table')
    </div>
</div>
