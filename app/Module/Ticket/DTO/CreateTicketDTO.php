<?php

declare(strict_types=1);

namespace App\Module\Ticket\DTO;

use App\Module\Customer\DTO\CreateCustomerDTO;
use App\Module\Ticket\Requests\CreateTicketRequest;
use Illuminate\Http\UploadedFile;

final class CreateTicketDTO
{
    public CreateCustomerDTO $createCustomerDTO;
    public string $subject;
    public string $message;
    public ?UploadedFile $file;

    public static function fromRequest(CreateTicketRequest $request): CreateTicketDTO
    {
        $createTicketDTO                = new CreateCustomerDTO();
        $createTicketDTO->name          = $request->input('name');
        $createTicketDTO->phone_number  = $request->input('phone');
        $createTicketDTO->email         = $request->input('email');

        $self                       = new self();
        $self->createCustomerDTO    = $createTicketDTO;
        $self->subject              = $request->input('subject');
        $self->message              = $request->input('message');
        $self->file                 = $request->file('attachment');

        return $self;
    }
}
