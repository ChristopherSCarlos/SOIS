<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Organization;
use App\Models\Roles;
use App\Models\UserPermission;

use Illuminate\Validation\Rule;
use Livewire\withPagination;

use Illuminate\Support\STR;

use Storage;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class UserPermissions extends Component
{
    use WithPagination;

    // modals
    public $modalCreatePermissionFormVisible = false;
    public $modalUpdatePermissionFormVisible = false;
    public $modelConfirmPermissionDeleteVisible = false;

    // variables
    public $permission;
    public $i;
    public $create;
    public $permsId;

    public function rules()
    {
        return [
            'permission' => 'required',
        ];
    }

    public function getUserPermissionData()
    {
        return UserPermission::paginate(5);
    }

    // permission data
    public function permissionData()
    {

        return [
            'permission' => $list,
        ];
    }

    // create Permission
    public function createShowPermissionModel()
    {
        $this->resetValidation();
        $this->reset();
        $this->modalCreatePermissionFormVisible = true;
    }

    public function create()
    {
        // dd($create);
        // $this->resetValidation();
        // $this->validate(); 
        $list = $this->permission."-list";
        $create = $this->permission."-create";
        $edit = $this->permission."-edit";
        $delete = $this->permission."-delete";

        $PermissionData = [
           $this->permission.'-list',
           $this->permission.'-create',
           $this->permission.'-edit',
           $this->permission.'-delete',
        ];
        // dd($data);
     
        foreach ($PermissionData as $permsData) {
             UserPermission::create(['permission' => $permsData]);
        }
        $this->modalCreatePermissionFormVisible = false;
        $this->reset(); 
    }

    // update permission data
    public function updatePermission($id)
    {
        $this->resetValidation();
        $this->reset();
        $this->permsId = $id;
        $this->modalUpdatePermissionFormVisible = true;
        $this->modelUpdatePermissionDatas();
    }
    public function modelUpdatePermissionDatas()
    {
        $data = UserPermission::find($this->permsId);
        $this->permission = $data->permission;
    }
    public function modelUpdatePermission()
    {
        return [
            'permission' => $this->permission,
        ];
    }
    public function updateUserPassword()
    {
        $this->validate();
        UserPermission::find($this->permsId)->update($this->modelUpdatePermission());
        $this->modalUpdatePermissionFormVisible = false;
        $this->resetValidation();
        $this->reset();
        $this->cleanPermissionVars();
    }  
    public function cleanPermissionVars()
    {
        $this->permission = null;
    }
    // update permission data

    // delete permission
    public function deleteShowPermissionModal($id)
    {
        $this->permsId = $id;
        $this->modelConfirmPermissionDeleteVisible = true;
    }

    public function deletePermissionData()
    {
        UserPermission::destroy($this->permsId);
        $this->modelConfirmPermissionDeleteVisible = false;
        $this->resetValidation();
        $this->reset();
        $this->resetPage();
    }
    // delete permission










    
    public function render()
    {
        return view('livewire.user-permissions',[
            'displayData' => $this->getUserPermissionData(),
        ]);
    }
}
