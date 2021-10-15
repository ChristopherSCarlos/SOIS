<?php

namespace App\Http\Livewire;

use Storage;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;

use Livewire\Component;
use App\Models\Page;

use Illuminate\Validation\Rule;
use Livewire\withPagination;

use Illuminate\Support\STR;


class Pages extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $modalFormVisible = false;
    public $updatemodalFormVisible = false;
    public $updateImagemodalFormVisible = false;
    public $modelConfirmDeleteVisible = false;
    public $modelId;
    public $slug;
    public $title;
    public $content;
    public $header_image;
    public $HeaderName;
    public $background_image;
    public $BackgroundName;
    public $isSetToDefaultHomePage;
    public $isSetToDefaultNotFoundPage;

    public function rules()
    {
        return [
            'title' => 'required',
            'slug' => ['required', Rule::unique('pages','slug')->ignore($this->modelId)],
            'content' => 'required',
        ];
    }

    public function mount()
    {
        $this->resetPage();
    }

    public function updatedtitle($value)
    {
        // $this->slug = $value;
        $this->slug = Str::slug($value);
    }

    // public function generateSlug($value)
    // {
    //     $process1 = str_replace(' ', '-',$value);
    //     $process2 = strtolower($process1);
    //     $this->slug = $process2;
    // }

    public function create()
    {
        $this->resetValidation();
        // dd($this);
        $this->validate(); 
        $this->unassignedDefaultHomePage(); 
        $this->unassignedDefaultNotFoundPage();

        $this->validate([
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required',
            'header_image' => 'file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
            'background_image' => 'file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
        ]);
        $data = [
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required',
            'header_image' => 'file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
            'background_image' => 'file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
        ];

        $title = $this->title;
        $slug = $this->slug;
        $content = $this->content;
        $header_image = $this->header_image;
        $background_image = $this->background_image;


        //for summernote content
       $content = $this->content;
       $dom = new \DomDocument();
       $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
       $imageFile = $dom->getElementsByTagName('imageFile');
       foreach($imageFile as $item => $image){
           $data = $img->getAttribute('src');

           list($type, $data) = explode(';', $data);
           list(, $data)      = explode(',', $data);

           $imgeData = base64_decode($data);
           $image_name= "/upload/" . time().$item.'.png';
           $path = public_path() . $image_name;
           file_put_contents($path, $imgeData);
           $image->removeAttribute('src');
           $image->setAttribute('src', $image_name);
        }
        $content = $dom->saveHTML();

        //for image uploads
        $HeaderName = time().'.'.$this->header_image->extension();
        $BackgroundName = time().'.'.$this->background_image->extension();
        $this->header_image->storeAs('files',$HeaderName, 'imgfolder');
        $this->background_image->storeAs('files',$BackgroundName, 'imgfolder');

        Page::create([
            'title' => $title,
            'slug' => $slug,
            'content' => $content,
            'header_image' => $HeaderName,
            'background_image' => $BackgroundName,
        ]);

        // Page::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset(); 

    }

    public function modelData()
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            // 'header_image' => $this->header_image,
            // 'background_image' => $this->background_image,
            'is_default_home' => $this->isSetToDefaultHomePage,
            'is_default_not_found' => $this->isSetToDefaultNotFoundPage,
        ];
    }


    public function createShowModel()
    {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
    }


    public function read()
    {
        return PAge::paginate(5);
    }

    public function update()
    {
        $this->validate(); 
        $this->unassignedDefaultHomePage(); 
        $this->unassignedDefaultNotFoundPage(); 
        Page::find($this->modelId)->update($this->modelData());
        $this->updatemodalFormVisible = false;
        $this->reset();
    }

    public function updateShowModal($id)
    {
        $this->resetValidation();
        $this->reset();
        $this->modelId = $id;
        $this->loadModel();
        // dd($this->content);
        $this->updatemodalFormVisible = true;
    }

    public function updatedisSetToDefaultHomePage()
    {
        $this->isSetToDefaultNotFoundPage = null;
    }

    public function updatedisSetToDefaultNotFoundPage()
    {
        $this->isSetToDefaultHomePage = null;
    }

    public function unassignedDefaultHomePage()
    {
        if ($this->isSetToDefaultHomePage != null) {
            Page::where('is_default_home',true)->update([
                'is_default_home' => false,
            ]);
        }
    }

    public function unassignedDefaultNotFoundPage()
    {
        if ($this->isSetToDefaultNotFoundPage != null) {
            Page::where('is_default_not_found',true)->update([
                'is_default_not_found' => false,
            ]);
        }
    }

    public function loadModel()
    {
        $data = Page::find($this->modelId);
        $this->title = $data->title;
        $this->slug = $data->slug;
        $this->content = $data->content;
        $this->isSetToDefaultHomePage = !$data->is_default_home ? null:true;
        $this->isSetToDefaultHomePage = !$data->is_default_not_found ? null:true;
    }


    public function deleteShowModal($id)
    {
        $this->modelId = $id;
        $this->modelConfirmDeleteVisible = true;
        $this->delete();
    }

    public function delete()
    {
        Page::destroy($this->modelId);
        $this->modelConfirmDeleteVisible = false;
        $this->resetPage();
        $this->reset();
    }


    public function updateImageShowModal($id)
    {
        $this->resetValidation();
        $this->reset();
        $this->updateImagemodalFormVisible = true;
        $this->modelId = $id;
        $this->loadImageModel();
    }

    public function ImagemodelData()
    {
        $HeaderName = time().'.'.$this->header_image->extension();
        $BackgroundName = time().'.'.$this->background_image->extension();
        return [
            'header_image' => $this->header_image->storeAs('files',$HeaderName, 'imgfolder'),
            'background_image' => $this->background_image->storeAs('files',$BackgroundName, 'imgfolder'),
            'header_image' => $HeaderName,
            'background_image' => $BackgroundName,

        ];
    }
    public function loadImageModel()
    {
        $data = Page::find($this->modelId);
        $this->header_image = $data->header_image;
        $this->background_image = $data->background_image;
    }

    public function Imageupdate()
    {
        // dd($this->ImagemodelData());
        $this->validate(['header_image' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',]);
        $this->validate(['background_image' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',]);
        Page::find($this->modelId)->update($this->ImagemodelData());
        $this->updateImagemodalFormVisible = false;
    }




    // liveware data rendering
    public function render()
    {
        return view('livewire.pages',[
            'data' => $this->read(),
        ]);
    }
}
