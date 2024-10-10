<?php

namespace App\View\Components;

use App\Helpers\Finance\FinanceTrait;
use App\Treatment\DateTreatment;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WeekNavigator extends Component
{
    use FinanceTrait;
    /**
     * Create a new component instance.
     */
    public string $selectedWeek = '';
    public string|null $selectedYear = '';
    public function __construct(string $selectedWeek = "",string $selectedYear='')
    {
        $dateTrait = new DateTreatment();
        if($selectedWeek === ''){
            $selectedWeek = $dateTrait->numberWeekByDay(now()->format('Y-m-d'));
        }
        if($selectedYear === ''){
            $selectedYear = now()->format('Y');
        }
        $this->selectedWeek = $selectedWeek;
        $this->selectedYear = $selectedYear;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout.week-navigator');
    }
}
