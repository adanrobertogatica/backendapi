<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductPaginateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'start' => ['required','integer','min:0'],
            'length' => ['required','integer'],
            'orderdir' => ['required','in:ASC,DESC'],
            'ordercolumn' => ['required','in:name,description,image,brand,price,price_sale,category,stock']
        ];
    }
}
