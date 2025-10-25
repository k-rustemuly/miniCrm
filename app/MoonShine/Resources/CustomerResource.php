<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Module\Customer\Models\Customer;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Support\Enums\PageType;
use MoonShine\UI\Fields\Text;

/**
 * @extends ModelResource<Customer>
 */
class CustomerResource extends ModelResource
{
    protected string $model = Customer::class;

    protected bool $withPolicy = true;

    protected ?PageType $redirectAfterSave = PageType::INDEX;

    public function getTitle(): string
    {
        return __('moonshine::ui.resource.customers_title');
    }

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make(__('moonshine::ui.fields.name'), 'name')->sortable(),
            Text::make(__('moonshine::ui.fields.email'), 'email')->sortable(),
            Text::make(__('moonshine::ui.fields.phone_number'), 'phone_number')->sortable(),
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
     * @param Customer $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}
