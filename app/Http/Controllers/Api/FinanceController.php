<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Finance\FinanceTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Treatment\DateTreatment;
class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use FinanceTrait;
    public $dateTrait;

    public function __construct(){
        $this->dateTrait = new DateTreatment();
    }
    public function index($nunWeek=null,$year = null)
    {

        if($nunWeek === null) $nunWeek = $this->dateTrait->numberWeekByDay(now()->format('Y-m-d'));
        if($year === null) $year = now()->format('Y');
        $week = $this->dateTrait->getWeekByNumberWeek($nunWeek,$year);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
