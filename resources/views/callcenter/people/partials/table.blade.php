<div class="row">
    <div class="col-12" v-if="form.search.search.length > 0 && tables.people && tables.people.length === 0">
        <h1 class="text-center text-danger no-results" >
            <i class="far fa-frown"></i>

            <br>

            <span v-if="errors">
                @{{ errors }}
            </span>

            <span v-else>
                Nenhum resultado encontrado
            </span>
        </h1>
    </div>

    <div class="col-12" v-if="tables.people && tables.people.length > 0">

        <div class="card">

            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-12 col-md-4">
                        <h3>
                            <i class="fas fa-users"></i> Cidadãos Cadastrados
                        </h3>
                    </div>
                    <div class="col-8 text-right">

                    </div>
                </div>
            </div>



            <div class="card-body d-none d-sm-block">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Endereços</th>
                        <th scope="col">Contatos</th>
                        <th scope="col">Protocolos</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr v-for="person in tables.people">
                        <td>
                            <a :href="'/callcenter/people/show/' + person.id">@{{ person.name }}</a>
                        </td>

                        <td>
                            <a :href="'/callcenter/people/show/' + person.id">@{{ person.cpf_cnpj }}</a>
                        </td>

                        <td>
                            <p v-for="address in person.addresses.slice(0, 15)">
                                @{{ address.street }}
                            </p>
                        </td>

                        <td>
                            <p v-for="contact in person.contacts.slice(0, 15)">
                                @{{ contact.contact }}
                            </p>
                        </td>

                        <td>
                            <p v-for="record in person.records.slice(0, 15)">
                                <a :href="'/callcenter/records/show/' + record.id">@{{ record.protocol }}</a>
                            </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>


            <!-------------------- Start of MOBILE VERSION -------------------->

            <div class="card-body d-block d-sm-none">

                <div class="mobile-tables"  v-for="person in tables.people" >

                    <div class="contact-line"><span class="mobile-label">Nome :</span>
                        <a :href="'/callcenter/people/show/' + person.id">@{{ person.name }}</a>
                    </div>
                    <div class="contact-line"><span class="mobile-label">CPF :</span>
                        <a :href="'/callcenter/people/show/' + person.id">@{{ person.cpf_cnpj }}</a>
                    </div>
                    <div class="contact-line"><span class="mobile-label">Endereços :</span>
                        <p v-for="address in person.addresses.slice(0, 15)">
                            @{{ address.street }}
                        </p>
                    </div>
                    <div class="contact-line"><span class="mobile-label">Contatos :</span>
                        <p v-for="contact in person.contacts.slice(0, 15)">
                            @{{ contact.contact }}
                        </p>
                    </div>
                    <div class="contact-line"><span class="mobile-label">Protocolos :</span>
                        <p v-for="record in person.records.slice(0, 15)">
                            <a :href="'/callcenter/records/show/' + record.id">@{{ record.protocol }}</a>
                        </p>
                    </div>


                </div>

            </div>

            <!-------------------- END of MOBILE VERSION -------------------->

        </div>


    </div>
</div>


