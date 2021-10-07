<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Validation\Rule;
use Livewire\withPagination;

use Illuminate\Support\STR;

use Storage;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\DefaultInterface;
use App\Models\User;
use App\Models\Role;

class DefaultInterfaces extends Component
{
    use WithPagination;

    // modal variables
    public $createDefaultInterfaceShowModalFormVisible = false;
    public $modelUpdateDefaultInterfaceData = false;
    public $modelConfirmDeleteDefaultInterface = false;

    // contrller variables
    public $homepage_title;
    public $homepage_subtitle;
    public $homepage_details;
    public $homepage_logo;
    public $homepage_background_image;
    public $homepage_text_color;
    public $homepage_background_color_1;
    public $homepage_background_color_2;
    public $homepage_background_color_3;
    public $status;

    public $defUIid;
    public $data;

    // deleteData pero update talaga to ng active HAHHAHAHHA
    public $deleteData = 'inactive';


    public function rules()
    {
        return [
            'homepage_title' => 'required',
            'homepage_subtitle' => 'required',
            'homepage_details' => 'required',
        ];
    }


    // create default interface
    public function createDefaultInterfaceShowModel()
    {
        // $this->resetValidation();
        // $this->validate();
        // dd(User::roles()->role_type);
        // dd("hello");
        $user = User::find(1);
        
        // dd($user->roles);
        foreach ($user->roles as $role) {
            $c = $role->pivot->role_type;
            // echo $role->pivot->role_id;
        }
        dd($c);
        // $this->createDefaultInterfaceShowModalFormVisible = true;
        // dd("Hello");
    }
    public function modelCreateDefaultInterface()
    {
        return [
            'homepage_title' => $this->homepage_title,
            'homepage_subtitle' => $this->homepage_subtitle,
            'homepage_details' => $this->homepage_details,
            // 'homepage_logo' => $this->homepage_logo,
            // 'homepage_background_image' => $this->homepage_background_image,
            'homepage_text_color' => $this->homepage_text_color,
            'homepage_background_color_1' => $this->homepage_background_color_1,
            'homepage_background_color_2' => $this->homepage_background_color_2,
            'homepage_background_color_3' => $this->homepage_background_color_3,
        ];
    }
    public function create()
    {
        $this->resetValidation();
        $this->validate(); 
        DefaultInterface::create($this->modelCreateDefaultInterface());
        $this->createDefaultInterfaceShowModalFormVisible = false;
        $this->reset(); 
        $this->cleanDefaultInterfaceDataVars();
    }
    // create default interface

    
    public function cleanDefaultInterfaceDataVars()
    {
        $this->homepage_title = null;
        $this->homepage_subtitle = null;
        $this->homepage_details = null;
        $this->homepage_text_color = null;
        $this->homepage_background_color_1 = null;
        $this->homepage_background_color_2 = null;
        $this->homepage_background_color_3 = null;
    }

    // update Default interface
    public function updateDefaultInterfaceModel($id)
    {
        $this->resetValidation();
        $this->reset();
        $this->defUIid = $id;
        $this->modelUpdateDefaultInterfaceData = true;
        $this->modelUpdateDefaultInterfaceDatas();
    }
    public function modelUpdateDefaultInterfaceDatas()
    {
        $data = DefaultInterface::find($this->defUIid);
        $this->homepage_title = $data->homepage_title;
        $this->homepage_subtitle = $data->homepage_subtitle;
        $this->homepage_details = $data->homepage_details;
        $this->homepage_text_color = $data->homepage_text_color;
        $this->homepage_background_color_1 = $data->homepage_background_color_1;
        $this->homepage_background_color_2 = $data->homepage_background_color_2;
        $this->homepage_background_color_3 = $data->homepage_background_color_3;
    }
    public function modelUpdateDefaultInterface()
    {
        return [
            'homepage_title' => $this->homepage_title,
            'homepage_subtitle' => $this->homepage_subtitle,
            'homepage_details' => $this->homepage_details,
            'homepage_text_color' => $this->homepage_text_color,
            'homepage_background_color_1' => $this->homepage_background_color_1,
            'homepage_background_color_2' => $this->homepage_background_color_2,
            'homepage_background_color_3' => $this->homepage_background_color_3,
        ];
    }
    public function update()
    {
        $this->validate([
            'homepage_title' => 'required',
            'homepage_subtitle' => 'required',
            'homepage_details' => 'required',
            'homepage_text_color' => 'required',
            'homepage_background_color_1' => 'required',
            'homepage_background_color_2' => 'required',
            'homepage_background_color_3' => 'required',
        ]);
        DefaultInterface::find($this->defUIid)->update($this->modelUpdateDefaultInterface());
        $this->modelUpdateDefaultInterfaceData = false;
        $this->resetValidation();
        $this->reset();
        $this->resetData();
    }
    public function resetData()
    {
        $this->homepage_title = null;
        $this->homepage_subtitle = null;
        $this->homepage_details = null;
        $this->homepage_text_color = null;
        $this->homepage_background_color_1 = null;
        $this->homepage_background_color_2 = null;
        $this->homepage_background_color_3 = null;
    }
    // update Default interface
    
    // delete deefault interface
    public function deleteDefaultInterfaceModel($id)
    {
        $this->defUIid = $id;
        $this->modelConfirmDeleteDefaultInterface = true;
    }

    public function delete()
    {
        DefaultInterface::destroy($this->defUIid);
        $this->modelConfirmDeleteDefaultInterface = false;
        $this->resetValidation();
        $this->reset();
        $this->resetPage();
    }
    // delete deefault interface



    public function displayDefaultInterfaceData()
    {
        return DefaultInterface::paginate(10);
    }

    public function render()
    {
        return view('livewire.default-interfaces',[
            'displayInterface' => $this->displayDefaultInterfaceData(),
        ]);
    }
}
