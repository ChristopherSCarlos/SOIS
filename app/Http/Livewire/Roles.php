<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Organization;
use App\Models\Role;
use App\Models\UserPermission;

use Illuminate\Validation\Rule;
use Livewire\withPagination;

use Illuminate\Support\STR;

use Storage;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

class Roles extends Component
{

    use WithPagination;

    // modals
    public $modalCreateRolesFormVisible = false;
    public $modalSyncRolePermissionVisible = false;
    public $modalDeleteRolesFormVisible = false;

    // variables
    public $role_type;
    public $roleId;
    public $selectedPermsOnRoles = [];
    public $selectedRole;

    


    // role data
    public function roleData()
    {
        return [
            'role_type' => $this->role_type,
        ];
    }

    // create roles
    public function createShowRolesModel()
    {
        $this->resetValidation();
        $this->reset();
        $this->modalCreateRolesFormVisible = true;
    }

    public function create()
    {
        $this->resetValidation();
        $this->validate(); 
        Role::create($this->roleData());
        $this->modalCreateRolesFormVisible = false;
        $this->reset(); 
    }


    // delete roles
    public function deleteRoleModal($id)
    {
        $this->roleId = $id;
        // dd($roleId);
        $this->modalDeleteRolesFormVisible = true;
    }
    public function deleteRoleData()
    {
        // dd($this->roleId);
        Role::destroy($this->roleId);
        $this->modalDeleteRolesFormVisible = false;
        $this->resetValidation();
        $this->reset();
        $this->resetPage();
    }
    // delete roles


    // sync permission
    public function syncPermissionModel($id)
    {
        $this->roleId = $id;
        // dd($roleId);
        // $this->resetValidation();
        // $this->reset();
        $this->modalSyncRolePermissionVisible = true;
    }


    public function syncPermissionRole()
    {
        // $this->validate(); 

        $selectedRole = Role::find($this->roleId);
        $selectedRole->userpermission()->sync($this->selectedPermsOnRoles);

        $this->resetValidation();
        $this->modalSyncRolePermissionVisible = false;
        $this->reset();
    }

    public function getPermissionData()
    {
        return DB::table('user_permissions')->get();
    }

    public function getRolesData()
    {
        $roles = DB::table('roles')->get();
        return $roles;
    }

    public function rules()
    {
        return [
            'role_type' => 'required',
        ];
    }

    public function render()
    {
        return view('livewire.roles',[
            'displayData' => DB::table('roles')->paginate(5),
            'displayPermsData' => $this->getPermissionData(),
        ]);
    }
}
