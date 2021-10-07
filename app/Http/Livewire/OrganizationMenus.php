<?php

namespace App\Http\Livewire;

use Storage;

use App\Models\Organization;
use App\Models\User;

use Livewire\Component;
use Livewire\withPagination;

use Illuminate\Support\STR;

use Illuminate\Validation\Rule;

use Livewire\WithFileUploads;

use Intervention\Image\ImageManager;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;

class OrganizationMenus extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $modalFormVisible = false;
    public $updatemodalFormVisible = false;
    // public $viewmodalFormVisible = false;
    public $updateImagemodalFormVisible = false;
    public $modelConfirmDeleteVisible = false;
    
    public $modelId;
    
    public $organization_name;
    public $organization_logo;
    public $organization_details;
    public $organization_primary_color;
    public $organization_secondary_color;
    public $organization_carousel_image_1;
    public $organization_carousel_image_2;
    public $organization_carousel_image_3;
    public $organization_slug;
    
    public $isSetToDefaultHomePage;
    public $isSetToDefaultNotFoundPage;

    public $content;

    public $featuredImage;
    public $title;

    public $authUser;
    public $OrgDataFromUser;
    public $user;
    public $userOrganization;
    public $orgCount = false;
    public $organizationUserData;
    public $orgUserId;

    public $authUserId;
    public $authUserData;
    public $authUserRole;
    public $authUserRoleType;

    public function countOrganization()
    {
        $this->authUser = Auth::user()->id;
        // dd($this->authUser);
        $this->user = User::find($this->authUser);
        $this->OrgDataFromUser = $this->user->organization->first();
        if($this->OrgDataFromUser){
            $this->userOrganization = $this->OrgDataFromUser->organization_name;
            $this->orgCount = true;
            // dd($this->orgCount);
            return $this->orgCount;
        }else{
            $this->orgCount = false;
            return $this->orgCount;
            // dd("2");
        }
        // dd($this->userOrganization);
        // dd($this->OrgDataFromUser);
        // // dd(gettype($this->userRole));
    }

    public function specificOrganization()
    {
        $this->authUser = Auth::user()->id;
        $this->user = User::find($this->authUser);
        $this->OrgDataFromUser = $this->user->organization->first();
        // dd($this->OrgDataFromUser->id);
        if($this->OrgDataFromUser){
            $this->orgUserId = $this->OrgDataFromUser->id;
            // $this->userOrganization = $this->OrgDataFromUser->organization_name;
            $this->orgCount = true;
            // dd($this->orgCount);
            return DB::table('organizations')
           ->where('id', '=', $this->orgUserId)
           ->get();
        }else{
            $this->orgCount = false;
            return $this->orgCount;
            // dd("2");
        }
        // dd($this->orgUserId);
        // $this->organizationUserData = Organization::find($this->orgUserId);        
        // return $this->organizationUserData;
        // dd(gettype(Organization::where($this->orgUserId)));
        // return Organization::where($this->orgUserId);
                
        // dd($this->organizationUserData);
        // dd(gettype($this->OrgDataFromUser));        

        // $this->user = User::find($this->userId);
        // dd($this->OrgDataFromUser->organization_name);
    }


    public function createOrg()
    {
        echo "hello";
    }

    public function fileUploadPost(Request $request)
    {
        $request->validate([
            'organization_name' => 'required',
            'organization_details' => 'required',
            'organization_primary_color' => 'required',
            'organization_secondary_color' => 'required',
            'organization_slug' => 'required',
            'organization_logo' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
        ]);
    
        $data = [
            'organization_name' => 'required',
            'organization_details' => 'required',
            'organization_primary_color' => 'required',
            'organization_secondary_color' => 'required',
            'organization_slug' => 'required',
            'organization_logo' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip', 
        ];

        $fileName = time().'.'.$request->organization_logo->extension();  
     
        $organization_name = $request->organization_name;
        $organization_details = $request->organization_details;
        $organization_primary_color = $request->organization_primary_color;
        $organization_secondary_color = $request->organization_secondary_color;
        $organization_slug = $request->organization_slug;
        $organization_logo = $request->organization_logo;



        $request->organization_logo->move(public_path('files'), $fileName);

  
        /* Store $fileName name in DATABASE from HERE */
        // Organization::create($request->all());
        Organization::create([
            'organization_logo' => $fileName,
            'organization_details' => $organization_details,
            'organization_name' => $organization_name,
            'organization_primary_color' => $organization_primary_color,
            'organization_secondary_color' => $organization_secondary_color,
            'organization_slug' => $organization_slug,
        ]);

        $this->cleanVars();
        return redirect()->route('organization-menus')->with('success','User has been created');
    }



    private function cleanVars()
    {
        $this->organization_name = null;    
        $this->organization_details = null; 
        $this->organization_primary_color = null;   
        $this->organization_secondary_color = null; 
        $this->organization_slug = null;    
        $this->organization_logo = null;    
    }


    public function rules()
    {
        return [
            'organization_name' => 'required',
            'organization_details' => 'required',
            'organization_primary_color' => 'required',
            'organization_secondary_color' => 'required',
            'organization_slug' => 'required',
            'organization_logo' => 'file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip', 
        ];
    }

    
    public function createShowModel()
    {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
    }

    public function create()
    {
        $this->validate([
            'organization_name' => 'required',
            'organization_details' => 'required',
            'organization_primary_color' => 'required',
            'organization_secondary_color' => 'required',
            'organization_slug' => 'required',
            'organization_logo' => 'file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
        ]);
    
        $data = [
            'organization_name' => 'required',
            'organization_details' => 'required',
            'organization_primary_color' => 'required',
            'organization_secondary_color' => 'required',
            'organization_slug' => 'required',
            'organization_logo' => 'file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip', 
        ];

        $fileName = time().'.'.$this->organization_logo->extension();  
     
        $organization_name = $this->organization_name;
        $organization_details = $this->organization_details;
        $organization_primary_color = $this->organization_primary_color;
        $organization_secondary_color = $this->organization_secondary_color;
        $organization_slug = $this->organization_slug;
        $organization_logo = $this->organization_logo;

       
        // $this->organization_logo->store('files', 'imgfolder',$fileName);

        $this->organization_logo->storeAs('files',$fileName, 'imgfolder');
        


  
        /* Store $fileName name in DATABASE from HERE */
        // Organization::create($request->all());
        Organization::create([
            'organization_logo' => $fileName,
            'organization_details' => $organization_details,
            'organization_name' => $organization_name,
            'organization_primary_color' => $organization_primary_color,
            'organization_secondary_color' => $organization_secondary_color,
            'organization_slug' => $organization_slug,
            ]);

        $this->modalFormVisible = false;
        $this->reset();
    }

    public function modelData()
    {
        // $fileName = time().'.'.$this->organization_logo->extension();
        return [
            'organization_name' => $this->organization_name,
            // 'organization_logo' => $this->organization_logo->storeAs('files',$fileName, 'imgfolder'),
            // 'organization_logo' => $fileName,
            // 'organization_logo' => $this->organization_logo,
            'organization_details' => $this->organization_details,
            'organization_primary_color' => $this->organization_primary_color,
            'organization_secondary_color' => $this->organization_secondary_color,
            'organization_slug' => $this->organization_slug,
        ];
    }

    public function updateShowModal($id)
    {
        $this->resetValidation();
        $this->reset();
        $this->updatemodalFormVisible = true;
        $this->modelId = $id;
        $this->loadModel();
    }
    // public function viewShowModal($id)
    // {
    //     $this->resetValidation();
    //     $this->reset();
    //     $this->viewmodalFormVisible = true;
    //     $this->modelId = $id;
    //     $this->loadModel();
    // }

    public function loadModel()
    {
        $data = Organization::find($this->modelId);
        $this->organization_name = $data->organization_name;
        $this->organization_details = $data->organization_details;
        $this->organization_primary_color = $data->organization_primary_color;
        $this->organization_secondary_color = $data->organization_secondary_color;
        $this->organization_slug = $data->organization_slug;
        // $this->organization_logo = $data->organization_logo;
    }

    public function update()
    {
        // dd($this->modelData());
        $this->validate([
            'organization_name' => 'required',
            'organization_details' => 'required',
            'organization_primary_color' => 'required',
            'organization_secondary_color' => 'required',
            'organization_slug' => 'required',
        ]);
        Organization::find($this->modelId)->update($this->modelData());
        $this->updatemodalFormVisible = false;
    }

    public function ImagemodelData()
    {
        $fileName = time().'.'.$this->organization_logo->extension();
        return [
            'organization_name' => $this->organization_name,
            'organization_logo' => $this->organization_logo->storeAs('files',$fileName, 'imgfolder'),
            'organization_logo' => $fileName,
            // 'organization_logo' => $this->organization_logo,
            'organization_details' => $this->organization_details,
            'organization_primary_color' => $this->organization_primary_color,
            'organization_secondary_color' => $this->organization_secondary_color,
            'organization_slug' => $this->organization_slug,
        ];
    }

    public function updateImageShowModal($id)
    {
        $this->resetValidation();
        $this->reset();
        $this->updateImagemodalFormVisible = true;
        $this->modelId = $id;
        $this->loadImageModel();
    }

    public function loadImageModel()
    {
        $data = Organization::find($this->modelId);
        $this->organization_name = $data->organization_name;
        $this->organization_details = $data->organization_details;
        $this->organization_primary_color = $data->organization_primary_color;
        $this->organization_secondary_color = $data->organization_secondary_color;
        $this->organization_slug = $data->organization_slug;
        $this->organization_logo = $data->organization_logo;
    }

    public function Imageupdate()
    {
        // dd($this->ImagemodelData());
        $this->validate(['organization_logo' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',]);
        Organization::find($this->modelId)->update($this->ImagemodelData());
        $this->updateImagemodalFormVisible = false;
    }

    public function deleteShowModal($id)
    {
        $this->modelId = $id;
        $this->modelConfirmDeleteVisible = true;
    }

    public function delete()
    {
        Organization::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
    }

    public function read()
    {
        return Organization::paginate(10);
    }

    public function getAuthUserRole()
    {
        $this->authUserId = Auth::user()->id;
        $this->authUserData = User::find($this->authUserId);        
        $this->authUserRole = $this->authUserData->roles->first();
        $this->authUserRoleType = $this->authUserRole->role_type;         
        return $this->authUserRoleType;
    }

    public function render()
    {
        return view('livewire.organization-menus',[
            'posts' => $this->read(), 
            'userAffliatedOrganizationCount' => $this->countOrganization(), 
            'userAffliatedOrganization' => $this->specificOrganization(), 
            'userAuthRole' => $this->getAuthUserRole(), 
        ]);
    }

}