<div class="card-body d-none d-sm-block" id="vue-contacts">
    <table id="contactsTable" class="table table-striped table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Tipo de Contato</th>
            <th>Contato</th>
            <th>Situação</th>
            <th>Criado em</th>
        </tr>
        </thead>
        @forelse ($contacts as $contact)
            <tr v-on:click='detail("{{route('people_contacts.show',['id' => $contact->id])}}")' style="cursor: pointer;">
                <td>{{ $contact->contactType->name }}</td>

                <td>{{ $contact->contact }}</td>

                <td>

                        @if($contact->active)
                            {{--<span class="badge badge-success">{{$contact->active_string}}</span>--}}
                        <span class="label-group"><span class="label label-primary"><i class="fas fa-folder-open"></i></span><span class="label label-primary ng-binding">{{$contact->active_string}}</span>
                        @else
                            {{--<span class="badge badge-danger">{{$contact->active_string}}</span>--}}
                                <span class="label-group"><span class="label label-danger"><i class="fas fa-times-circle"></i></span><span class="label label-danger ng-binding">{{$contact->active_string}}</span>
                        @endif

                </td>

                <td>{{ $contact->created_at_formatted ?? '' }}</td>
            </tr>
        @empty
            <p>Nenhum Contato encontrado</p>
        @endforelse
    </table>
</div>




<!-------------------- Start of MOBILE VERSION -------------------->
<div class="card-body d-block d-sm-none" id="vue-contacts">
    @forelse ($contacts as $contact)
        <div class="mobile-tables" v-on:click='detail("{{route('people_contacts.show',['id' => $contact->id])}}")' style="cursor: pointer;">
            <div class="contact-line"><span class="mobile-label">Tipo de Contato:</span> {{ $contact->contactType->name }}</div>

            <div class="contact-line"><span class="mobile-label">Contato:</span> {{ $contact->contact }}</div>

            <div class="contact-line"><span class="mobile-label">Situação :</span>

                @if($contact->active)
                    {{--<span class="badge badge-success">{{$contact->active_string}}</span>--}}
                    <span class="label-group"><span class="label label-primary"><i class="fas fa-folder-open"></i></span><span class="label label-primary ng-binding">{{$contact->active_string}}</span>
                        @else
                            {{--<span class="badge badge-danger">{{$contact->active_string}}</span>--}}
                            <span class="label-group"><span class="label label-danger"><i class="fas fa-times-circle"></i></span><span class="label label-danger ng-binding">{{$contact->active_string}}</span>
                @endif

            </div>

            <div class="contact-line"><span class="mobile-label">Criado em:</span> {{ $contact->created_at_formatted ?? '' }}</div>
        </div>
    @empty
        <p>Nenhum Contato encontrado</p>
    @endforelse

</div>
<!-------------------- END of MOBILE VERSION -------------------->