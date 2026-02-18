<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'company' => ['required','array'],
            'company.name' => ['required','string'],
            'company.fullName' => ['required','string'],
            'company.email' => ['required','email'],
            'company.phone' => ['required','numeric'],
            'company.address' => ['required','string'],
            'company.city' => ['required','string'],
            'company.state' => ['required','string'],
            'company.zip' => ['required','string'],
            'company.country' => ['required','string'],


            'client' => ['required','array'],
            'client.name' => ['required','string'],
            'client.fullName' => ['required','string'],
            'client.email' => ['required','email'],
            'client.phone' => ['required','numeric'],
            'client.address' => ['required','string'],
            'client.city' => ['required','string'],
            'client.state' => ['required','string'],
            'client.zip' => ['required','string'],
            'client.country' => ['required','string'],

            'logo' => ['nullable', 'image', 'max:2048'],

            'items' => ['required','array','min:1'],
            'items.*.description' => ['required','string'],
            'items.*.quantity' => ['required','numeric','min:1'],
            'items.*.price' => ['required','numeric','min:0.01'],

            'tax' => ['required','numeric','min:0','max:100'],
            'discount' => ['required','numeric','min:0','max:100'],

            'mode' => ['required','in:product,service'],

            'meta' => ['required','array'],
            'meta.invoiceNumber' => ['required','string'],
            'meta.invoiceDate' => ['required','date'],
            'meta.dueDate' => ['required','date','after_or_equal:meta.invoiceDate'],

            'logo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp','max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'company.name.required' => 'Company name is required',
            'company.fullName.required' => 'Company legal name is required',
            'company.email.required' => 'Company email is required',
            'company.email.email' => 'Company email must be valid',
            'company.phone.required' => 'Company phone is required',
            'company.address.required' => 'Company address is required',
            'company.city.required' => 'Company city is required',
            'company.state.required' => 'Company state is required',
            'company.zip.required' => 'Company ZIP code is required',
            'company.country.required' => 'Company country is required',
            'company.phone.numeric' => 'Company phone must be a valid number',
            'client.name.required' => 'Client name is required',
            'client.email.required' => 'Client email is required',
            'client.email.email' => 'Client email must be valid',
            'client.phone.required' => 'Client phone is required',
            'client.phone.numeric' => 'Client phone must be a valid number',
            'client.fullName.required' => 'Client legal name is required',
            'client.address.required' => 'Client address is required',
            'client.city.required' => 'Client city is required',
            'client.state.required' => 'Client state is required',
            'client.zip.required' => 'Client ZIP code is required',
            'client.country.required' => 'Client country is required',

            'items.required' => 'At least one item is required',
            'items.*.description.required' => 'Item description is required',
            'items.*.quantity.required' => 'This value is required',
            'items.*.quantity.min' => 'The value must be greater than 1',
            'items.*.price.min' => 'Price must be greater than 0',
            'items.*.price.required' => 'Price is required',

            'tax.max' => 'Tax cannot exceed 100%',
            'tax.min' => 'Tax cannot be less than 0%',
            'discount.max' => 'Discount cannot exceed 100%',
            'discount.min' => 'Discount cannot be less than 0%',

            'meta.invoiceNumber.required' => 'Invoice number is required',
            'meta.invoiceDate.required' => 'Invoice date is required',
            'meta.dueDate.required' => 'Due date is required',
            'meta.dueDate.after_or_equal' => 'Due date must be after or equal to the invoice date',

            'logo.uploaded' => 'The logo failed to upload. Review the file size.',
            'logo.image' => 'Logo must be an image file',
            'logo.max' => 'Logo must not exceed 2MB in size',
            'logo.required' => 'Logo is required',
            'logo.mimes' => 'Logo must be a file of type: jpg, jpeg, png, webp',
        ];
    }


    protected function prepareForValidation()
    {
        $this->merge([
            'company' => json_decode($this->company, true),
            'client' => json_decode($this->client, true),
            'items' => json_decode($this->items, true),
            'meta' => json_decode($this->meta, true),
        ]);
    }

}

