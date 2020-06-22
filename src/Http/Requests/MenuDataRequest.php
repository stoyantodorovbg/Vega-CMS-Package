<?php


namespace Vegacms\Cms\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class MenuDataRequest extends FormRequest
{
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
            'menu_id' => 'required|numeric|exists:menus,id',
        ];
    }
}
