<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eve =  [
            [
              'event_name' => 'Event Name 1',
              'event_details' => 'Event Details 1',
              'isEventFeat' => 'yes',
            ],
            [
              'event_name' => 'Event Name 2',
              'event_details' => 'Event Details 2',
              'isEventFeat' => 'yes',
            ],
            [
              'event_name' => 'Event Name 3',
              'event_details' => 'Event Details 3',
              'isEventFeat' => 'yes',
            ],
            [
              'event_name' => 'Event Name 4',
              'event_details' => 'Event Details 4',
              'isEventFeat' => 'no',
            ],
            [
              'event_name' => 'Event Name 5',
              'event_details' => 'Event Details 5',
              'isEventFeat' => 'yes',
            ],
            
          ];

            foreach($eve as $events){
                Event::create($events);
            }
    }
}
