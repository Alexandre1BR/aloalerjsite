<?php
namespace App\Http\Controllers;

use App\Data\Models\ContactTypeModel;
use App\Data\Models\PersonContactModel;
use App\Data\Models\PersonModel;
use App\Data\Repositories\CallsRepository;
use App\Data\Repositories\PersonsAddressesRepository;
use App\Data\Repositories\PersonsContactsRepository;
use App\Data\Repositories\PersonsRepository;
use App\Http\Requests\PersonRequest;
use Illuminate\Http\Request;

class PersonsContactsController extends BaseController
{
    /**
     * @return $this
     */
    public function create($person_id)
    {
        $person = $this->personsRepository->findById($person_id);

        return view('callcenter.personsContacts.form')
            ->with('person', $person)
            ->with(['contact' => $this->personsContactsRepository->new()]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PersonRequest $request)
    {
        $view = 'callcenter.persons.form';
        $message = $this->messageDefault;
        if ($request->get('workflow')) {
            $message = 'Reclamação cadastrada com sucesso.';

            $this->createPersonContact($request, 'mobile');
            $this->createPersonContact($request, 'whatsapp');
            $this->createPersonContact($request, 'email');
            $this->createPersonContact($request, 'phone');
        }

        //$request->merge(['id' => $request->get('contact_id')]);
        //$this->personsContactsRepository->createFromRequest($request);

        $person = $this->personsRepository->findById(
            $request->get('person_id')
        );
        $calls = $this->callsRepository->findByPerson($person->id);
        $addresses = $this->personsAddressesRepository->findByPerson(
            $person->id
        );
        $contacts = $this->personsContactsRepository->findByPerson($person->id);

        return view($view)
            ->with('person', $person)
            ->with('calls', $calls)
            ->with('addresses', $addresses)
            ->with('contacts', $contacts)

            ->with($this->getComboBoxMenus())

            ->with('message', $message);
        //->with('workflow', $request->get('workflow'));
    }

    /**
     * @param $cpf_cnpj
     *
     * @return $this
     */
    public function show($id)
    {
        $contact = $this->personsContactsRepository->findById($id);
        $person = $this->personsRepository->findById($contact->person_id);

        return view('callcenter.personsContacts.form')
            ->with($this->getComboBoxMenus())
            ->with('contact', $contact)
            ->with('person', $person);
    }

    /**
     * @param PersonRequest $request
     */
    private function createPersonContact(PersonRequest $request, $code)
    {
        if ($request->get($code)) {
            PersonContactModel::create([
                'person_id' => $request->get('person_id'),
                'contact_type_id' =>
                    ContactTypeModel::where('code', $code)->first()->id,
                'contact' => $request->get($code),
            ]);
        }
    }
}