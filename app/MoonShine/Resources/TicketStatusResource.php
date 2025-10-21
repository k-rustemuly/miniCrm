<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Module\TicketStatus\Models\TicketStatus;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Support\Enums\PageType;
use MoonShine\UI\Fields\Text;

/**
 * @extends ModelResource<TicketStatus>
 */
class TicketStatusResource extends ModelResource
{
    protected string $model = TicketStatus::class;

    protected bool $withPolicy = true;

    protected ?PageType $redirectAfterSave = PageType::INDEX;

    public function getTitle(): string
    {
        return __('moonshine::ui.resource.ticket_status_title');
    }

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make(__('moonshine::ui.fields.name'), 'name')->sortable(),
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
                Text::make(__('moonshine::ui.fields.name'), 'name')->required(),
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
            Text::make(__('moonshine::ui.fields.name'), 'name'),
        ];
    }

    /**
     * @param TicketStatus $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
        ];
    }
}
