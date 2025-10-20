<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Module\Ticket\Models\Ticket;
use Carbon\Carbon;
use MoonShine\Apexcharts\Components\DonutChartMetric;
use MoonShine\Apexcharts\Components\LineChartMetric;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
#[\MoonShine\MenuManager\Attributes\SkipMenu]

class Dashboard extends Page
{
    /**
     * @return array<string, string>
     */
    public function getBreadcrumbs(): array
    {
        return [
            '#' => $this->getTitle()
        ];
    }

    public function getTitle(): string
    {
        return $this->title ?: 'Dashboard';
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
	{
		return [
            LineChartMetric::make()
                ->line(['tickets' => $this->getMontlyTicketStats()])
        ];
	}

    private function getMontlyTicketStats(): array
    {
        $from = Carbon::now()->subMonth();
        $to = Carbon::now();

        return Ticket::answeredBetween($from, $to)
            ->selectRaw('DATE(answered_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date')
            ->toArray();
    }
}
