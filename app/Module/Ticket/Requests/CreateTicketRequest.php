<?php

namespace App\Module\Ticket\Requests;

use App\Module\Ticket\DTO\CreateTicketDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Schema (
 *     required={
 *         "phone", "name", "email",
 *         "message", "subject"
 *     },
 *
 *     @OA\Property(property="phone", type="string", description="Телефон клиента"),
 *     @OA\Property(property="name", type="string", description="Имя клиента"),
 *     @OA\Property(property="email", type="string", description="Email клиента"),
 *     @OA\Property(property="message", type="string", description="Сообщение заявки"),
 *     @OA\Property(property="subject", type="string", description="Тема заявки"),
 *     @OA\Property(property="attachment", type="file", description="Документ"),
 * )
 */
class CreateTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phone'         => ['required', 'string', 'regex:/^\+7\d{10}$/'],
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:customers,email'],
            'message'       => ['required', 'string'],
            'subject'       => ['required', 'string', 'max:255'],
            'attachment'    => ['sometimes', 'file'],
        ];
    }

    public function getDTO(): CreateTicketDTO
    {
        return CreateTicketDTO::fromRequest($this);
    }
}
