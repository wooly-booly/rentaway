<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Trip;

class TripsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
        $this->product = factory(\App\Models\Product::class)->create();
    }

    public function testTripStartMustBeGreaterThenCurrentTime()
    {
        $data = [
            'product_id' => $this->product->id,
            'date_start' => 'Fri, Nov 10, 2017',
            'time_start' => '12:00 AM',
            'date_end' => 'Thu, Dec 01, 2050',
            'time_end' => '12:00 AM', 
        ];

        $this->post(
            '/products/' . $this->product->id, $data, ['HTTP_X-Requested-With' => 'XMLHttpRequest']
        )->assertSee('trip_start');
    }

    public function testTripStartCantBeGreaterTripEnd()
    {
        $data = [
            'product_id' => $this->product->id,
            'date_start' => 'Fri, Dec 02, 2050',
            'time_start' => '12:00 AM',
            'date_end' => 'Thu, Dec 01, 2050',
            'time_end' => '12:00 AM', 
        ];

        $this->post(
            '/products/' . $this->product->id, $data, ['HTTP_X-Requested-With' => 'XMLHttpRequest']
        )->assertSee('trip_end');
    }

    public function testIntervalBetweenStartAndEndMustBe24Hours()
    {
        $data = [
            'product_id' => $this->product->id,
            'date_start' => 'Thu, Dec 01, 2050',
            'time_start' => '11:00 PM',
            'date_end' => 'Fri, Dec 02, 2050',
            'time_end' => '12:00 AM', 
        ];

        $this->post(
            '/products/' . $this->product->id, $data, ['HTTP_X-Requested-With' => 'XMLHttpRequest']
        )->assertSee('trip_end');
    }

    public function testShouldNotBeAlreadyBookedTripsAtTimeWeWantToBook()
    {   
        $trip = factory(\App\Models\Trip::class)->create([
            'product_id' => $this->product->id,
            'trip_start' => new Carbon('Fri, Nov 13, 2037 02:00 AM'),
            'trip_end' => new Carbon('Sat, Nov 14, 2037 02:00 AM'),
        ]);

        $data = [
            'product_id' => $this->product->id,
            'date_start' => 'Thu, Nov 12, 2037',
            'time_start' => '11:00 PM',
            'date_end' => 'Fri, Nov 13, 2050',
            'time_end' => '05:00 AM', 
        ];

        $this->post(
            '/products/' . $this->product->id, $data, ['HTTP_X-Requested-With' => 'XMLHttpRequest']
        )->assertSee('trip_end')
        ->assertSee('already booked');
    }
}
