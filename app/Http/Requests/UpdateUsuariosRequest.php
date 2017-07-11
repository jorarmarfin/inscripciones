<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;
class UpdateUsuariosRequest extends FormRequest
{
    private $route;

    function __construct(Route $route)
    {
        $this->route = $route;
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'dni'=>'unique:users,dni,'.$this->route->getParameter('id')
        ];
    }
    public function messages()
    {
        return[
            'dni.unique'=>'Este DNI que ha ingresado ya existe en la base de datos'
        ];
    }

}
