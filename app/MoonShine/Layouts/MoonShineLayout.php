<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use App\Module\Ticket\Models\Ticket;
use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Laravel\Components\Layout\{Locales, Notifications, Profile, Search};
use MoonShine\UI\Components\{Breadcrumbs,
    Components,
    Layout\Flash,
    Layout\Div,
    Layout\Body,
    Layout\Burger,
    Layout\Content,
    Layout\Footer,
    Layout\Head,
    Layout\Favicon,
    Layout\Assets,
    Layout\Meta,
    Layout\Header,
    Layout\Html,
    Layout\Layout,
    Layout\Logo,
    Layout\Menu,
    Layout\Sidebar,
    Layout\ThemeSwitcher,
    Layout\TopBar,
    Layout\Wrapper,
    When};
use App\MoonShine\Resources\TicketStatusResource;
use MoonShine\MenuManager\MenuItem;
use App\MoonShine\Resources\TicketResource;

final class MoonShineLayout extends AppLayout
{
    protected function assets(): array
    {
        return [
            ...parent::assets(),
        ];
    }

    protected function menu(): array
    {
        return [
            MenuItem::make(__('moonshine::ui.resource.ticket_status_title'), TicketStatusResource::class)
                ->canSee(fn () => auth()->user()->hasRole('admin')),
            MenuItem::make(__('moonshine::ui.resource.tickets_title'), TicketResource::class)
                ->canSee(fn () => auth()->user()->can('view tickets', Ticket::newModel())),
        ];
    }

    /**
     * @param ColorManager $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);
    }

    public function build(): Layout
    {
        return parent::build();
    }
}
