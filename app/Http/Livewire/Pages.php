<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;

use Illuminate\Validation\Rule;
use Livewire\withPagination;

use Illuminate\Support\STR;


class Pages extends Component
{
    use WithPagination;
    public $modalFormVisible = false;
    public $updatemodalFormVisible = false;
    public $modelConfirmDeleteVisible = false;
    public $modelId;
    public $slug;
    public $title;
    public $content;
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
        dd($this);
        $this->validate(); 
        $this->unassignedDefaultHomePage(); 
        $this->unassignedDefaultNotFoundPage();

        $this->validate([
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required',
        ]);
 
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
        Page::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset(); 
    }

    public function modelData()
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
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





    // liveware data rendering
    public function render()
    {
        return view('livewire.pages',[
            'data' => $this->read(),
        ]);
    }
}
