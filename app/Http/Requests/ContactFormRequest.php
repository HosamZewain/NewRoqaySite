<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255'],
            'business_type' => ['nullable', 'string', 'max:255'],
            'interested_product' => ['nullable', 'string', 'max:255'],
            'message' => ['nullable', 'string', 'max:5000'],
            'website_url' => ['nullable', 'string'], // Honeypot field
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        $locale = app()->getLocale();

        if ($locale === 'ar') {
            return [
                'name.required' => 'الاسم مطلوب.',
                'name.max' => 'الاسم يجب ألا يتجاوز 255 حرفاً.',
                'email.required' => 'البريد الإلكتروني مطلوب.',
                'email.email' => 'يرجى إدخال بريد إلكتروني صحيح.',
                'message.max' => 'الرسالة يجب ألا تتجاوز 5000 حرف.',
            ];
        }

        return [
            'name.required' => 'Name is required.',
            'name.max' => 'Name must not exceed 255 characters.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'message.max' => 'Message must not exceed 5000 characters.',
        ];
    }
}
