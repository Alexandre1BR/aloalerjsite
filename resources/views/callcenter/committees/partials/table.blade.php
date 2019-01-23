
<table id="committeesTable" class="table table-striped table-hover d-none d-sm-block" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Nome Resumido</th>
            <th>Telefone</th>
            <th>Telefone Gabinete</th>
            <th>Presidente</th>
            <th>Vice-Presidente</th>
            <th>Criado em</th>
        </tr>
    </thead>

    <tr v-for="committee in tables.committees">
        <td><a :href="'/callcenter/committees/show/' + committee.id">@{{ committee.name }}</a></td>
        <td>@{{ committee.short_name  }}</td>
        <td>@{{ committee.phone  }}</td>
        <td>@{{ committee.office_phone  }}</td>
        <td>@{{ committee.president  }}</td>
        <td>@{{ committee.vice_president  }}</td>
        <td></td>
    </tr>
</table>



<!-------------------- Start of MOBILE VERSION -------------------->

<div class="mobile-tables d-block d-sm-none" v-for="committee in tables.committees" >

    <div class="contact-line"><span class="mobile-label">Nome :</span>
        <a :href="'/callcenter/committees/show/' + committee.id">@{{ committee.name }}</a>

    </div>
    <div class="contact-line"><span class="mobile-label">Nome Resumido :</span>
        @{{ committee.short_name  }}
    </div>
    <div class="contact-line"><span class="mobile-label">Telefone :</span>
        @{{ committee.phone  }}
    </div>
    <div class="contact-line"><span class="mobile-label">Telefone Gabinete :</span>
        @{{ committee.office_phone  }}
    </div>
    <div class="contact-line"><span class="mobile-label">Presidente :</span>
        @{{ committee.president  }}
    </div>
    <div class="contact-line"><span class="mobile-label">Vice-Presidente :</span>
        @{{ committee.vice_president  }}
    </div>
    <div class="contact-line"><span class="mobile-label">Criado em :</span>
        @{{ committee.created_at  }}
    </div>



</div>

<!-------------------- END of MOBILE VERSION -------------------->