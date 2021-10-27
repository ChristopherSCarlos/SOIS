<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Auth;
use Storage;

use App\Models\User;
use App\Models\Organization;
use App\Models\Article;
use App\Models\Announcement;

use Livewire\withPagination;
use Illuminate\Support\STR;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use \Carbon\Carbon;
use Datetime;
use DatePeriod;
use DateInterval;

class Announcements extends Component
{
    // modals
        public $modalCreateAnnouncementFormVisible = false;
        public $modalUpdateAnnouncementFormVisible = false;
        public $modalDeleteAnnouncementFormVisible = false;

    // variables
        public $announcement_id;

        public $title;
        public $content;
        public $signature;
        public $signer_position;
        public $exp_date;
        public $exp_time;
        public $user_id;
        public $status = true;

        public $date;
        public $param;

        public $currentDate;
        public $newDate;
        public $currentTime;

        public $checkCurrentTime;
        public $checkCurrentDate;
        public $dateArray = [];

        public $getAnnouncementDateFromDB;
        public $getExpiredAnnouncements;
        public $getExpiredAnnouncementsID;
        public $count = 0;
        public $time;
        public $dataArray = [];
        public $dataArrayTime = [];
        public $dateIDExpired = [];

    //get data
    public function getTimezoneDate()
    {
        date_default_timezone_set('Asia/Manila');
        $this->currentDate = date('d-m-y');
        $this->currentTime = date('h:i:s');
        $this->newDate=date('d-m-y', strtotime("+2 months"));

        dd($this->newDate);
    }
    public function mount()
    {
        date_default_timezone_set('Asia/Manila');
        $this->currentDate = date('d-m-y');
        $this->currentTime = date('h:i:s');
        $this->newDate=date('d-m-Y', strtotime("+2 months"));
        $this->changeAnnouncementStatusOnRefresh();
    }

    public function changeAnnouncementStatusOnRefresh()
    {
        date_default_timezone_set('Asia/Manila');
        $this->checkCurrentDate = date('Y-m-d');
        $this->checkCurrentTime = date('H:i:s');
        $this->getAnnouncementDateFromDB = DB::table('announcements')->get();
        foreach ($this->getAnnouncementDateFromDB as $this->data) {
            /**
             *
             * LOOP ON ALL EVENTS
             *
             */
            for ($i=0; $i < count(array($this->data->id)); $i++) { 
                /**
                 *
                 * CHECK IF EXP_DATE ON DATABASE IS GREATER THAN THE CURRENT IME
                 *
                 */
                if($this->data->exp_date < $this->checkCurrentDate){
                    $this->dateIDExpired = $this->data->id;
                    if ($this->data->exp_time < $this->checkCurrentTime) {
                        for ($p=0; $p < count(array($this->dateIDExpired)); $p++) { 
                            Announcement::where('id', '=', $this->dateIDExpired)->update(['status' => '0']);
                        }
                    }
                }
                /**
                 *
                 * CHECK IF EXP_DATE ON DATABASE IS LESSER THAN THE CURRENT IME
                 *
                 */
                if($this->data->exp_date > $this->checkCurrentDate){
                    $this->dateIDExpired = $this->data->id;
                    for ($p=0; $p < count(array($this->dateIDExpired)); $p++) { 
                        Announcement::where('id', '=', $this->dateIDExpired)->update(['status' => '1']);
                    }
                }
            }
        }
    }
    // CREATE ANNOUNCEMENTS
    public function createAnnouncement()
    {
        $this->reset();
        $this->resetValidation();
        $this->modalCreateAnnouncementFormVisible = true;
    }
    public function createAnnouncementProcess()
    {
        $this->user_id = Auth::user()->id;
        Announcement::create($this->createAnnouncementModel());
        $this->modalCreateAnnouncementFormVisible = false;
        $this->reset();
        $this->resetValidation();
    }
    public function createAnnouncementModel()
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
            'signature' => $this->signature,
            'signer_position' => $this->signer_position,
            'status' => $this->status,
            'exp_date' => $this->exp_date,
            'exp_time' => $this->exp_time,
            'user_id' => $this->user_id,
        ];
    }

    // UPDATE ANNOUNCEMENTS
    public function updateAnnouncementShowModal($id)
    {
        $this->announcement_id = $id;
        $this->modalUpdateAnnouncementFormVisible = true;
        $this->loadModel();
    }
    public function loadModel()
    {
        $this->data = Announcement::find($this->announcement_id);
        $this->title = $this->data->title;
        $this->content = $this->data->content;
        $this->signature = $this->data->signature;
        $this->signer_position = $this->data->signer_position;
    }
    public function updateAnnouncementProcess()
    {
        Announcement::find($this->announcement_id)->update($this->updateAnnouncementModel());
        $this->modalUpdateAnnouncementFormVisible = false;
        $this->reset();
        $this->resetValidation();
    }
    public function updateAnnouncementModel()
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
            'signature' => $this->signature,
            'signer_position' => $this->signer_position,
        ];
    }

    // TRASH ANNOUNCEMENT
    public function deleteAnnouncementShowModal($id)
    {
        $this->announcement_id = $id;
        $this->modalDeleteAnnouncementFormVisible = true;
    }
    public function deleteAnnouncementProcess()
    {
        $this->status = false;
        Announcement::find($this->announcement_id)->update($this->deleteAnnouncementModel());
        $this->modalDeleteAnnouncementFormVisible = false;
        $this->reset();
        $this->resetValidation();
    }
    public function deleteAnnouncementModel()
    {
        return [
            'status' => $this->status,
        ];
    }


    // DISPLAY ANNOUNCEMENTS
    public function getAnnouncements()
    {
        return Announcement::paginate(5);
        // dd(Announcement::paginate(10));
    }
    // DISPLAY RENDER
    public function render()
    {
        return view('livewire.announcements',[
            'displayAnnouncements' => $this->getAnnouncements(),
        ]);
    }
}
