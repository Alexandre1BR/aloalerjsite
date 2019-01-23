<div class="card-body d-none d-sm-block" id="vue-addresses">
    <table id="addressesTable" class="table table-striped table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Endereço</th>
            <th>Número</th>
            <th>Complemento</th>
            <th>Bairro</th>
            <th>Cidade</th>
            <th>Situação</th>
            <th>Criado em</th>
        </tr>
        </thead>

        @forelse ($addresses as $address)
            <tr v-on:click='detail("{{route('people_addresses.show', ['id' => $address->id])}}")' style="cursor: pointer;">
                <td>{{ $address->street }}</td>

                <td>{{$address->number}}</td>

                <td>{{$address->complement}}</td>

                <td>{{$address->neighbourhood}}</td>

                <td>{{$address->city}}</td>

                <td>
                    @if($address->active)
                        {{--<span class="badge badge-success">{{$address->active_string}}</span>--}}
                        <span class="label-group"><span class="label label-primary"><i class="fas fa-folder-open"></i></span><span class="label label-primary ng-binding">{{$address->active_string}}</span>
                    @else
                        {{--<span class="badge badge-danger">{{$address->active_string}}</span>--}}
                        <span class="label-group"><span class="label label-danger"><i class="fas fa-times-circle"></i></span><span class="label label-danger ng-binding">{{$address->active_string}}</span>
                    @endif
                </td>

                <td>{{ $address->created_at_formatted ?? '' }}</td>
            </tr>
        @empty
            <p>Nenhum Endereço encontrado</p>
        @endforelse
    </table>
</div>

{{ $addresses->links() }}





<!-------------------- Start of MOBILE VERSION -------------------->

<div class="card-body d-block d-sm-none" id="vue-addresses">

    @forelse ($addresses as $address)
    <div class="mobile-tables" v-on:click='detail("{{route('people_addresses.show', ['id' => $address->id])}}")' style="cursor: pointer;">

        <div class="contact-line"><span class="mobile-label">Endereço :</span> {{ $address->street }}  </div>
        <div class="contact-line"><span class="mobile-label">Número :</span>  {{$address->number}} </div>
        <div class="contact-line"><span class="mobile-label">Complemento :</span> {{$address->complement}}  </div>
        <div class="contact-line"><span class="mobile-label">Bairro :</span>  {{$address->neighbourhood}} </div>
        <div class="contact-line"><span class="mobile-label">Cidade :</span>  {{$address->city}} </div>
        <div class="contact-line"><span class="mobile-label">Situação :</span>
            @if($address->active)
                {{--<span class="badge badge-success">{{$address->active_string}}</span>--}}
                <span class="label-group"><span class="label label-primary"><i class="fas fa-folder-open"></i></span><span class="label label-primary ng-binding">{{$address->active_string}}</span>
                    @else
                        {{--<span class="badge badge-danger">{{$address->active_string}}</span>--}}
                        <span class="label-group"><span class="label label-danger"><i class="fas fa-times-circle"></i></span><span class="label label-danger ng-binding">{{$address->active_string}}</span>
            @endif
        </div>
        <div class="contact-line"><span class="mobile-label">Criado em :</span> {{ $address->created_at_formatted ?? '' }}  </div>
    </div>
    @empty
        <p>Nenhum Endereço encontrado</p>
    @endforelse

        {{ $addresses->links() }}
</div>


<!-------------------- END of MOBILE VERSION -------------------->



