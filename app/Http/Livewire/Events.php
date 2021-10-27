<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Event;
use App\Models\Organization;

use Livewire\withPagination;
use Illuminate\Support\Facades\DB;


use Auth;

class Events extends Component
{
    // traits
    use withPagination;

    // modals
    public $createEventsShowModalFormVisible = false;
    public $updateEventsShowModalFormVisible = false;
    public $deleteEventsShowModalFormVisible = false;
    
    // variables
    public $userId;
    public $eventId;
    public $status;
    public $data;

    public $semester;
    public $school_year;
    public $course;
    public $organization;
    public $date;
    public $time;
    public $name_of_activity;
    public $objectives;
    public $participants;
    public $sponsor;
    public $venue;
    public $type_of_activity;
    public $projected_budget;
    public $isEventFeat;


    /*=============================================
    =            crete Events comment block            =
    =============================================*/
    public function createEventsShowModel()
    {
        $this->reset();
        $this->resetValidation();
        $this->createEventsShowModalFormVisible = true;
    }
    public function create()
    {
        $this->userId = Auth::user()->id;
        Event::create($this->uploadEventModel());
        $this->createEventsShowModalFormVisible = false;
        $this->reset();
        $this->resetValidation();
    }
    /*=====  End of crete Events comment block  ======*/
    
    /*==================================================
    =            Update Event comment block            =
    ==================================================*/
    public function updateEventsModel($id)
    {
        $this->userId = Auth::user()->id;
        $this->eventId = $id;
        $this->updateEventsShowModalFormVisible = true;
        $this->loadEventModel($this->eventId);
        // dd($this->loadEventModel($this->eventId));
    }
    public function update()
    {
        Event::find($this->eventId)->update($this->updateEventModel());
        $this->updateEventsShowModalFormVisible = false;
        $this->reset();
        $this->resetValidation();
    }
    /*=====  End of Update Event comment block  ======*/
    
    /*=========================================================
    =            Delete EventSection comment block            =
    =========================================================*/
    public function deleteEventsModal($id)
    {
        $this->eventId = $id;
        $this->deleteEventsShowModalFormVisible = true;
    }
    public function delete()
    {
        Event::find($this->eventId)->update($this->deleteEventModel());
        $this->updateEventsShowModalFormVisible = false;
        $this->reset();
        $this->resetValidation();
    }
    /*=====  End of Delete EventSection comment block  ======*/
    


    /*=========================================================
    =            Event Model Section comment block            =
    =========================================================*/
    /**
     *
     * UPLOAD EVENT MODEL
     *
     */
    public function deleteEventModel()
    {
        return [
            'status' => "0",
        ];
    }
    public function uploadEventModel()
    {
        return [
            'user_id' => $this->userId,
            'status' => $this->status,
            'semester' => $this->semester,
            'school_year' => $this->school_year,
            'course' => $this->course,
            'organization' => $this->organization,
            'date' => $this->date,
            'time' => $this->time,
            'name_of_activity' => $this->name_of_activity,
            'objectives' => $this->objectives,
            'participants' => $this->participants,
            'sponsor' => $this->sponsor,
            'venue' => $this->venue,
            'type_of_activity' => $this->type_of_activity,
            'projected_budget' => $this->projected_budget,
            'isEventFeat' => $this->isEventFeat,
            'status' => "1",
        ];
    }
    public function updateEventModel()
    {
        return [
            'status' => $this->status,
            'semester' => $this->semester,
            'school_year' => $this->school_year,
            'course' => $this->course,
            'organization' => $this->organization,
            'date' => $this->date,
            'time' => $this->time,
            'name_of_activity' => $this->name_of_activity,
            'objectives' => $this->objectives,
            'participants' => $this->participants,
            'sponsor' => $this->sponsor,
            'venue' => $this->venue,
            'type_of_activity' => $this->type_of_activity,
            'projected_budget' => $this->projected_budget,
            'isEventFeat' => $this->isEventFeat,
        ];
    }
    public function loadEventModel($id)
    {
        $this->eventId = $id;
        $this->data = Event::find($this->eventId);
        $this->userId = $this->data->userId;
        $this->status = $this->data->status;
        $this->semester = $this->data->semester;
        $this->school_year = $this->data->school_year;
        $this->course = $this->data->course;
        $this->organization = $this->data->organization;
        $this->date = $this->data->date;
        $this->time = $this->data->time;
        $this->name_of_activity = $this->data->name_of_activity;
        $this->objectives = $this->data->objectives;
        $this->participants = $this->data->participants;
        $this->sponsor = $this->data->sponsor;
        $this->venue = $this->data->venue;
        $this->type_of_activity = $this->data->type_of_activity;
        $this->projected_budget = $this->data->projected_budget;
        $this->isEventFeat = $this->data->isEventFeat;
    }
    /*=====  End of Event Model Section comment block  ======*/
    






    /**
     *
     * GET ORGANIZATION DATA
     *
     */
    public function organizationDataDatabase()
    {
        return DB::table('organizations')->orderBy('id','asc')->get();
    }
    /**
     *
     * Get Event Data
     *
     */
    public function eventDataDatabase()
    {

        return Event::where(['status' => 1, 'user_id' => Auth::user()->id,])->paginate(10);
        // dd(Event::where(['status' => 1, 'user_id' => Auth::user()->id,])->paginate(10));
    }

    public function render()
    {
        return view('livewire.events',[
            'getEventDataFromDB' => $this->eventDataDatabase(),
            'getOrganizationtDataFromDB' => $this->organizationDataDatabase(),
        ]);
    }
}
