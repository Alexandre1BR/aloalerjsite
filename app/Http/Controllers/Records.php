<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ViaRequest;
use App\Data\Repositories\Vias as ViasRepository;

class Records extends Controller
{
    /**
     * @return $this
     */
    public function create($person_id)
    {
        $person = $this->peopleRepository->findById($person_id);

        $workflow = is_null(session('data'))
            ? null
            : session('data')['workflow'];

        return view('callcenter.records.form')
            ->with('person', $person)
            ->with('workflow', $workflow)
            ->with('record', $this->recordsRepository->new())
            ->with($this->getComboBoxMenus());
    }

    protected function makeViewDataFromRecord($record)
    {
        return array_merge($this->getComboBoxMenus(), [
            'person' => $record->person,
            'record' => $record,
            'records' => $this->recordsRepository->findByPerson(
                $record->personid
            ),
            'addresses' => $this->peopleAddressesRepository->findByPerson(
                $record->personid
            ),
            'contacts' => $this->peopleContactsRepository->findByPerson(
                $record->personid
            ),
            'workflow' => request()->get('workflow')
        ]);
    }

    /**
     * @param Request $request
     */
    protected function showSuccessMessage(Request $request): void
    {
        $this->flashMessage(
            $request->get('workflow')
                ? 'Protocolo cadastrado com sucesso.'
                : $this->messageDefault
        );
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $record = $this->recordsRepository->create(coollect($request->all()));

        $this->showSuccessMessage($request);

        return redirect()
            ->route(
                $request->get('workflow')
                    ? 'persons_addresses.create'
                    : 'persons.show',
                ['person_id' => $record->person->id]
            )
            ->with('data', $this->makeViewDataFromRecord($record));
    }

    /**
     * @param $cpf_cnpj
     *
     * @return $this
     */
    public function show($id)
    {
        $record = $this->recordsRepository->findById($id);
        $person = $this->peopleRepository->findById($record->person_id);

        return view('callcenter.records.form')
            ->with($this->getComboBoxMenus())
            ->with('record', $record)
            ->with('person', $person);
    }
}
