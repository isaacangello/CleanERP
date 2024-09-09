<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Treatment\DateTreatment;

class DateTreatmentTest extends TestCase
{

    public function test_example(): void
    {

        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_return_array_of_days_with_repetitions():void{
        $dateTreatment = new DateTreatment();
        $arr_result = $dateTreatment->MakeArrayDays('09/06/2024','Mon',3);
        expect($arr_result)->toEqual([]);
    }
}
