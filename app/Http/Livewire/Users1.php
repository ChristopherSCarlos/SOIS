<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Organization;
use App\Models\UserPermission;
use App\Models\Role;
use App\Models\Team;

use Illuminate\Validation\Rule;
use Livewire\withPagination;

use Illuminate\Support\STR;

use Storage;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Auth;


class Users extends Component
{
    use WithPagination;

    // modals
    // public $createShowModel = false;
    // public $updateUserModel = false;
    // public $addPermissionModel = false;
    
    // modal functions
    public $modalFormVisible = false;
    public $modalUpdateUser = false;
    public $modelUpdateUserData = false;
    public $modaladdPermissionModel = false;
    public $modelUpdateUserPasswordData = false;
    public $modelConfirmUserDeleteVisible = false;
    public $modalAddRoleFormVisible = false;
    public $modalAddOrganizationFormVisible = false;
    public $modalCreateTeamsFormVisible = false;


    // variables
    public $name;
    public $email;
    public $password;

    public $userId;
    public $displayRoleData;
    // public $rolesList;
    public $role_type;
    public $roleModel=null;
    public $organizationModel=null;

    public $user;

    public $test;
    public $TeamNameData;
    public $TeamName;
    public $TeamNameString;
    public $PersonalTeam;

    public $resultArray;
    public $TeamId;
    public $newUserTeamId;

    public $v;
    public $latestCreatedUser;
    public $latestCreatedUserId;
    public $userFindForSyncRole;
    public $userNewCreatedId;

    // design
    public $isUserOrgAuthId;
    public $isUserOrgAuthArray = [];
    public $isUserOrgAuthData;
    public $isUserOrgAuthAffliatedOrg;

    public $isUserAuthId;
    public $isUserAuthArray = [];

    public $resultArrays;

    public function isUserHaveOganization()
    {
        $this->isUserOrgAuthId = DB::table('organization_user')
                                    ->orderBy('id','asc')
                                    ->get()
                                    ->pluck('user_id');
        $this->isUserOrgAuthArray = array($this->isUserOrgAuthId); 
        // dd($this->isUserOrgAuthArray);
        // $this->isUserAuthId = DB::table('users')
        //                             ->orderBy('id','asc')
        //                             ->get()
        //                             ->pluck('id');

        // $this->isUserAuthArray = array($this->isUserAuthId); 
        // dd($this->isUserAuthArray);

        // $this->resultArrays = array_intersect($this->isUserAuthArray,$this->isUserOrgAuthArray);
        // dd($this->resultArrays);


        // return $this->isUserOrgAuthArray;
        // dd($this->isUserOrgAuthId->count());
        // dd(gettype($this->isUserOrgAuthArray));
        return $this->isUserOrgAuthId;
        // dd($this->isUserOrgAuthId);
        // $this->isUserOrgAuthId = Auth::user()->id;
        // $this->isUserOrgAuthData = User::find($this->isUserOrgAuthId);        
        // $this->isUserOrgAuthAffliatedOrg = $this->isUserOrgAuthData->organization->first();
        // $this->authUserRoleType = $this->authUserRole->role_type;         
        // return $this->authUserRoleType;
        // dd($this->isUserOrgAuthId);
        // return $this->isUserOrgAuthAffliatedOrg;
    }
    
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ];
    }

    
    // create user
    public function createShowModel()
    {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
    }

    public function create()
    {
        $this->resetValidation();
        $this->validate(); 
        User::create($this->modelCreateUser());
        $this->syncUserToRole();
        $this->createTeamWithRoles();
        $this->modalFormVisible = false;
        $this->reset(); 
        $this->resetValidation(); 
    }

    public function modelCreateUser()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ];
    }
    public function syncUserToRole()
    {
        $this->latestCreatedUser = DB::table('users')->latest('id')->first();
        $this->latestCreatedUserId = $this->latestCreatedUser->id;
        // dd($this->latestCreatedUserId);
        $this->userFindForSyncRole = User::find($this->latestCreatedUserId);
        // dd($this->userFindForSyncRole);
        $this->userFindForSyncRole->roles()->sync([5]);
        // $this->reset();
        // $this->resetValidation();
    }
    public function createTeamWithRoles()
    {
        $this->latestCreatedUser = DB::table('users')->latest('id')->first();
        $this->latestCreatedUserId = $this->latestCreatedUser->id;
        // dd($this->latestCreatedUser);
        $this->TeamNameData = DB::table('users')->where('id',$this->latestCreatedUserId)->get();
        // dd($this->TeamNameData);
        $this->resultArray = $this->TeamNameData->toArray();
        // dd($this->resultArray);
        // dd($this->resultArray);
        $this->TeamNameString = $this->resultArray[0]->name;
        // dd($this->TeamNameString);
        $this->TeamName = $this->TeamNameString."'s Team";
        // dd($this->TeamName);
        $this->PersonalTeam = true;
        $this->modalCreateTeamsFormVisible = true;

        Team::create([
            'user_id' => $this->latestCreatedUserId,
            'name' => $this->TeamName,
            'personal_team' => $this->PersonalTeam,
        ]);

        $this->TeamId = DB::table('teams')->where('user_id',$this->latestCreatedUserId)->first();;
        $this->newUserTeamId = $this->TeamId->id;
        // dd($this->newUserTeamId);        
        $this->userNewCreatedId = User::find($this->latestCreatedUserId);
        // dd(gettype($this->userNewCreatedId->id));
        User::where('id',$this->userNewCreatedId->id)->update(['current_team_id' => $this->newUserTeamId]);

        // $this->modalCreateTeamsFormVisible = false;
        $this->resetValidation();
        $this->reset();
    }
    // create user

    // add team
    
    public function addShowTeamsModel($id)
    {
        $this->reset();
        $this->test = User::find($this->userId);
        // $this->name = $test->name;
        // dd($test);
        $this->userId = $id;
        $this->TeamNameData = DB::table('users')->where('id',$this->userId)->get();
        $this->resultArray = $this->TeamNameData->toArray();
        $this->TeamNameString = $this->resultArray[0]->name;
        $this->TeamName = $this->TeamNameString."'s Team";
        // dd($this->resultArray[0]->name);
        // dd(gettype($this->resultArray));
        // dd($this->TeamName);
        // $this->TeamName = $this->TeamNameData."'s Team";
        // $this->TeamNameString = $this->TeamNameData;
        // $this->TeamName = $this->TeamNameString."'s Team";
        $this->PersonalTeam = true;
        // // dd(gettype($this->TeamNameString));
        // dd($this->TeamNameData);
        // // dd($this->userId);
        $this->modalCreateTeamsFormVisible = true;
    }
    public function modelAddTeam()
    {
        return [
            'user_id' => $this->userId,
            'name' => $this->TeamName,
            'personal_team' => $this->PersonalTeam,
        ];
    }
    public function addTeam()
    {
        Team::create([
            'user_id' => $this->userId,
            'name' => $this->TeamName,
            'personal_team' => $this->PersonalTeam,
        ]);

        $this->TeamId = db::table('teams')->where('user_id',$this->userId)->first();;

        User::where('id',$this->userId)->update(['current_team_id' => $this->TeamId->id]);

        $this->modalCreateTeamsFormVisible = false;
        $this->resetValidation();
        $this->reset();
    }
    // add team

    // update user data functions
    public function updateUserModel($id)
    {
        $this->userId = $id;
        $this->modelUpdateUserData = true;
        $this->modelUpdateUserDatas();
    }

    public function modelUpdateUserDatas()
    {
        $data = User::find($this->userId);
        $this->name = $data->name;
        $this->email = $data->email;
        // $this->organization_primary_color = $data->organization_primary_color;
        // $this->organization_secondary_color = $data->organization_secondary_color;
        // $this->organization_slug = $data->organization_slug;
    }
    public function modelUpdateUser()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        User::find($this->userId)->update($this->modelUpdateUser());
        $this->modelUpdateUserData = false;
        $this->resetValidation();
        $this->reset();
        $this->cleanUserDataVars();
    }
    public function cleanUserDataVars()
    {
        $this->name = null;
        $this->email = null;
    }
    // update user data functions

    // update passowrd
    public function updateUserPasswordModel($id)
    {
        $this->resetValidation();
        $this->reset();
        $this->userId = $id;
        $this->modelUpdateUserPasswordData = true;
        $this->modelUpdateUserPasswordDatas();
    }
    public function modelUpdateUserPasswordDatas()
    {
        $data = User::find($this->userId);
        $this->password = $data->password;
    }
    public function modelUpdateUserPassword()
    {
        return [
            'password' => Hash::make($this->password),
        ];
    }
    public function updateUserPassword()
    {
        $this->validate([
            'password' => 'required',
        ]);
        User::find($this->userId)->update($this->modelUpdateUserPassword());
        $this->modelUpdateUserPasswordData = false;
        $this->resetValidation();
        $this->reset();
        $this->cleanUserPasswordVars();
    }  
    public function cleanUserPasswordVars()
    {
        $this->password = null;
    }
    // update passowrd

    // delete user data
    public function deleteShowUserModal($id)
    {
        $this->userId = $id;
        $this->modelConfirmUserDeleteVisible = true;
    }

    public function deleteUserData()
    {
        // dd($userId);
        $userId = $this->userId;
        $users = User::find($userId)->roles;
        $userId->roles()->detach($role_id);
        User::destroy($this->userId);
        $this->modelConfirmUserDeleteVisible = false;
        $this->resetValidation();
        $this->reset();
        $this->cleanUserPasswordVars();
        // $this->resetPage();
    }
    // delete user data





    // add permissions functions
    public function loadAddPermissionModel()
    {
        $data = User::find($this->userId);
        $this->name = $data->name;
        $this->email = $data->email;
        $this->password = $data->password;
    }

    public function addRoleModel()
    {
        $this->validate(); 
        User::find($this->userId)->update($this->loadAddPermissionModelata());
        $this->updateUserModel = false;
        $this->reset();
    }
    // add permissions functions

    // add Role Function
    public function addShowRoleModel($id)
    {
        $this->userId = $id;
        $this->modalAddRoleFormVisible = true;
    }

    public function displayRole()
    {
        return DB::table('roles')
            ->orderBy('id','asc')
            ->get();
    }
    public function addRoleToUser()
    {
        $user = User::find($this->userId);
        $user->roles()->sync($this->roleModel);
        $this->modalAddRoleFormVisible = false;
        $this->reset();
        $this->resetAddRoleUserValidation();
    }
    public function resetAddRoleUserValidation()
    {
        $this->roleModel = null;
        $this->userId = null;
    }
    // add Role Function


    // add organization
    public function addShowOrganizationModel($id)
    {
        $this->userId = $id;
        // dd($this->userId);
        $this->modalAddOrganizationFormVisible = true;
    }
    public function displayOrganization()
    {
        return DB::table('organizations')
            ->orderBy('id','asc')
            ->get();
    }
    public function addOrganizationToUser()
    {
        $user = User::find($this->userId);
        $user->organization()->sync($this->organizationModel);
        $this->modalAddOrganizationFormVisible = false;
        $this->reset();
        $this->resetAddRoleUserValidation();
    }
    // add organization


    public function userDisplayDataInTable()
    {
        $user = DB::table('users')
            ->orderBy('id','asc')
            ->get();

        return $user;
    }

    public function userDisplayRoleInTable()
    {
        $userRoleData = User::with('roles')->get();

        return $userRoleData;
    }

    public function read()
    {
        // return User::paginate(10);
        return DB::table('users')
                ->orderBy('id','asc')
                ->paginate(10);
                // ->get();
    }


    public function listOfRoles()
    {
        return DB::table('roles')
            ->orderBy('id','asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.users',[
            'displayData' => $this->read(),
            'displayRoleData' => $this->displayRole(),
            'displayOrganizationData' => $this->displayOrganization(),
            'rolesList' => $this->listOfRoles(),
            'usersDataInTable' => $this->userDisplayDataInTable(),
            'usersRoleDataInTable' => $this->userDisplayRoleInTable(),
            'isUsersHaveAffliatedOrganization' => $this->isUserHaveOganization(),
        ]);
    }
}
