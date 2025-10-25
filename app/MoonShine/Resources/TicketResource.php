<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Module\Ticket\Models\Ticket;
use App\Module\TicketStatus\Models\TicketStatus;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Support\Enums\PageType;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * @extends ModelResource<Ticket>
 */
class TicketResource extends ModelResource
{
    protected string $model = Ticket::class;

    protected bool $withPolicy = true;

    protected ?PageType $redirectAfterSave = PageType::INDEX;

    protected array $with = ['ticketStatus', 'customer'];

    public function getTitle(): string
    {
        return __('moonshine::ui.resource.tickets_title');
    }

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make(__('moonshine::ui.fields.customer'), 'customer', fn($customer) => $customer->name, CustomerResource::class)->sortable(),
            Text::make(__('moonshine::ui.fields.title'), 'title')->sortable(),
            BelongsTo::make(__('moonshine::ui.fields.ticket_status'), 'ticketStatus', fn(TicketStatus $ticketStatus) => $ticketStatus->name, TicketStatusResource::class)->sortable(),
            Date::make(__('moonshine::ui.fields.anwered_at'), 'anwered_at')->sortable()->format('Y-m-d H:i'),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make(__('moonshine::ui.fields.title'), 'title')->required(),
                Textarea::make(__('moonshine::ui.fields.description'), 'description')->required(),
            ])
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
        ];
    }

    /**
     * @param Ticket $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}
