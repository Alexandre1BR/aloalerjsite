<?php

namespace App\Http\Controllers\CallCenter;

use App\Services\Workflow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PersonRequest;
use App\Http\Controllers\Controller;

class People extends Controller
{
    /**
     * @param Request     $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $pesquisa = $request->get('pesquisa');

        if ($pesquisa) {
            $person = $this->peopleRepository->findByColumn(
                'cpf_cnpj',
                $pesquisa
            );
            if ($person) {
                $records = $this->recordsRepository->findByPerson($person->id);

                $addresses = $this->peopleAddressesRepository->findByPerson(
                    $person->id
                );
                $contacts = $this->peopleContactsRepository->findByPerson(
                    $person->id
                );

                return view('callcenter.people.form')
                    ->with('person', $person)
                    ->with('records', $records)
                    ->with('addresses', $addresses)
                    ->with('contacts', $contacts)
                    ->with(['origins' => $this->originsRepository->all()]);
            }
        } else {
            return view('callcenter.people.index');
        }
    }

    /**
     * @return $this
     */
    public function create()
    {
        Workflow::start();

        $newPerson = $this->peopleRepository->new();

        $newPerson->cpf_cnpj = request()->get('cpf_cnpj');

        $newPerson->name = request()->get('name');

        return view('callcenter.people.form')
            ->with(['person' => $newPerson])
            ->with($this->getComboBoxMenus());
    }

    /**
     * @param Request     $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PersonRequest $request)
    {
        $person_id = $this->userAlreadyRegistered($request);

        $route = 'people.show';

        if (!$person_id) {
            $route = 'records.create';
        }

        $with = [];
        $with = array_merge($with, $this->getComboBoxMenus());

        if ($person_id) {
            $person = $this->peopleRepository->findById($person_id);
            $records = $this->recordsRepository->findByPerson($person->id);
            $addresses = $this->peopleAddressesRepository->findByPerson(
                $person->id
            );
            $contacts = $this->peopleContactsRepository->findByPerson(
                $person->id
            );

            $with['records'] = $records;
            $with['addresses'] = $addresses;
            $with['contacts'] = $contacts;
        } else {
            $with['record'] = $this->recordsRepository->new();
        }

        $request->merge(['id' => $person_id]);
        $request->merge(['created_by_id' => Auth::user()->id]);
        $person = $this->peopleRepository->createFromRequest($request);

        $with['person'] = $person;

        $this->showSuccessMessage('Usuário cadastrado com sucesso.');

        return redirect()->route($route, ['person_id' => $person->id]);
    }

    /**
     * @param $cpf_cnpj
     *
     * @return $this
     */
    public function show($person_id)
    {
        $view = view('callcenter.people.form');

        $data = is_null(session('data')) ? [] : session('data');

        if (!empty($data)) {
            foreach ($data as $key => $item) {
                $view->with($key, $item);
            }

            return $view;
        } else {
            $person = $this->peopleRepository->findById($person_id);
            $records = $this->recordsRepository->allWherePaginate(
                'person_id',
                $person_id,
                15
            );

            Workflow::end();

            return $view
                ->with('person', $person)
                ->with('records', $records)
                ->with('addresses', $person->addresses()->paginate())
                ->with('contacts', $person->contacts()->paginate())
                ->with($this->getComboBoxMenus());
        }
    }

    /**
     * @param PersonRequest $request
     * @return $person_id
     */
    private function userAlreadyRegistered(PersonRequest $request)
    {
        $person = null;
        if (!$request->get('$person_id') and $request->get('cpf_cnpj')) {
            $person = $this->peopleRepository->findByColumn(
                'cpf_cnpj',
                $request->get('cpf_cnpj')
            );
        }
        return $person ? $person->id : $request->get('person_id');
    }
}
