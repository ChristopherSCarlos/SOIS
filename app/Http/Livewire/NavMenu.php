<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\User;
use App\Models\Role;
use App\Models\Organization;

use Auth;

class NavMenu extends Component
{
    public $te;
    public $userId;
    public $user;
    public $v;
    public $userRole;


    public function test()
    {
        $this->userId = Auth::user()->id;
        $this->user = User::find($this->userId);
        $this->v = $this->user->roles->first();
        $this->userRole = $this->v->role_type;
        return $this->userRole;
    }

    public function render()
    {
        return view('livewire.nav-menu',[
            'roel' => $this->test(),
        ]);
    }
}
