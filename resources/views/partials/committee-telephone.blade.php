<div class="sidebar-content">
    <div class="infos text-center">
        <p class="titulo-comissao">{{ $title }}</p>
        <div class="linha-info"></div>
        <div class="tel-comissao">{{ $telephone }}</div>
        <div class="linha-info"></div>
        {!! isset($site) ? $site : '' !!}
        <p class="outras-info text-center">
            @if (! isset($hours))
                Atendimento das @include('partials.horario')
            @else
               {{ $hours }}
            @endif
        </p>
    </div>
</div>

