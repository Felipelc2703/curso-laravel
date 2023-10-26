<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreCategoryRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        $this->merge([
            // 'slug' => Str::slug($this->title)
            // 'slug' => Str::of($this->title)->slug()->append("-adicional")
            'slug' => str($this->title)->slug()
        ]);
    }
    static function myRules()
    {
        return [
            "title" => "required|min:5|max:255",
            "slug" => "required|min:5|max:255|unique:categories",
        ];
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return false;
        return true;
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        // return [
        //     "title" => "required|min:5|max:255",
        //     "slug" => "required|min:5|max:255",
        //     "content" => "required|min:7",
        //     "category_id" => "required|integer",
        //     "description" => "required|min:7",
        //     "posted" => "required",
        // ];
        return $this->myRules();
    }
}
