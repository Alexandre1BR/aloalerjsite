<?php
namespace App\Http\Requests;

class PersonRequest extends Request
{
    protected $errorBag = 'validation';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cpf_cnpj' => 'required_if:person_id,null|cpf_cnpj',
            'name' => 'required',
            'identification' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return ['unique' => 'Este CPF já consta da nossa base de dados'];
    }

    /**
     * @return array
     */
    public function sanitize()
    {
        if (!empty($this->get('cpf_cnpj'))) {
            $input = $this->all();

            $input['cpf_cnpj'] = only_numbers($input['cpf_cnpj']);

            $this->replace($input);
        }

        if (!empty($this->get('identification'))) {
            $input = $this->all();

            preg_match(
                '/(n[a-ã]+o)\s+(informado)/mi',
                trim($input['identification']),
                $output_array
            );

            if (
                isset($output_array) &&
                isset($output_array[1]) &&
                isset($output_array[2])
            ) {
                $input['identification'] = 'NÃO INFORMADO';
            }

            $this->replace($input);
        }

        return $this->all();
    }
}
