<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Auth;
use Storage;


use App\Models\User;
use App\Models\Organization;
use App\Models\Article;

use Livewire\withPagination;
use Illuminate\Support\STR;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Articles extends Component
{
    use WithPagination;
    use WithFileUploads;
    // modal variables
    public $modalCreateNewsFormVisible = false;
    public $modalUpdateNewsFormVisible = false;
    public $modalDeleteNewsFormVisible = false;
    
    // variables
    public $userId;
    public $user;
    public $OrgDataFromUser;
    public $OrgDataFromUserOrganizationNameString;

    // form variables
    public $article_title;
    public $article_subtitle;
    public $article_content;
    public $user_id;
    public $type = 'Featured';
    public $status = 'active';
    public $article_header;
    public $data;
    public $articleId;
    public $artId;
    public $seed;

    public $selectedOrganizations = [];
    public $latestArticleCreated;
    public $latestArticleCreatedData;
    
    public $articleData;
    public $OrgDataFromArt;
    public $artOrg;
    public $artsCount;
    public $artOrgData = [];

    // public $i;
    // public $a = 1;
    // public $b = 1;
    // public $c;

    // public $articleCreatedDataId;
    public $userData;
    public $userRoles;
    public $userRolesString;

    public function getArticleTableData()
    {
        $this->userId = Auth::user()->id;
        // dd($this->articleCreatedDataId);
        $this->userData = User::find($this->userId);
        $this->userRoles = $this->userData->roles->first();
        $this->userRolesString = $this->userRoles->role_type;
        // dd($this->userRolesString);
        // dd(gettype($this->userRolesString));
        return $this->userRolesString;
    }

    // create news
    public function createNews()
    {
        $this->resetValidation();
        $this->reset();
        $this->modalCreateNewsFormVisible = true;
        // dd($this->syncArticleOrganization());
        // dd($this->OrgDataFromUserOrganizationNameString);
        // dd(gettype($this->OrgDataFromUser));

        // $this->orgUserId = $this->OrgDataFromUser->id;
            // $this->userOrganization = $this->OrgDataFromUser->organization_name;
           //  $this->orgCount = true;
           //  // dd($this->orgCount);
           //  return DB::table('organizations')
           // ->where('id', '=', $this->orgUserId)
           // ->get();
    }
    public function create()
    {
        $this->userId = Auth::user()->id;
        // dd($this->userId);

        $this->user = User::find($this->userId);
        $this->OrgDataFromUser = $this->user->organization->first();
        $this->OrgDataFromUserOrganizationNameString = $this->OrgDataFromUser->organization_name;
        // dd($this->OrgDataFromUserOrganizationNameString);
        // dd($this->selectedOrganizations);
        // dd($this->article_subtitle);
        // dd($this->syncArticleOrganization());
        // dd($this->syncArticleOrganization());


        // Article::create($this->createModel());

        $article_title = $this->article_title;
        $article_header = $this->article_header;
        $article_subtitle = $this->article_subtitle;
        $article_content = $this->article_content;
        $type = $this->type;
        $status = $this->status;
        $user_id = $this->user_id;

        //for image uploads
        $HeaderName = time().'.'.$this->article_header->extension();
        $this->article_header->storeAs('files',$HeaderName, 'imgfolder');

        Article::create([
            'article_title' => $article_title,
            'article_header' => $HeaderName,
            'article_subtitle' => $article_subtitle,
            'article_content' => $article_content,
            'type' => $type,
            'status' => $status,
            'user_id' => $user_id,
        ]);

        $this->syncArticleOrganization();
        $this->modalCreateNewsFormVisible = false;
        
        $this->reset();
        $this->resetValidation();
    }
    public function createModel()
    {
        return [
            'article_title' => $this->article_title,
            'article_subtitle' => $this->article_subtitle,
            'article_content' => $this->article_content,
            'type' => $this->type,
            'status' => $this->status,
            'user_id' => $this->user_id,
        ];
    }
    public function syncArticleOrganization()
    {
        $this->userId = Auth::user()->id;
        $this->user = User::find($this->userId);
        $this->OrgDataFromUser = $this->user->organization->first();
        $this->OrgDataFromUserOrganizationNameString = $this->OrgDataFromUser->id;
        // dd($this->OrgDataFromUserOrganizationNameString);

        // return DB::table('files')->latest('id')->first();
        $this->latestArticleCreated = DB::table('articles')->latest('id')->first();
        // dd($this->latestArticleCreated->id);


        // $this->latestArticleCreatedData = Article::find($this->latestArticleCreated->id);
        // dd($this->latestArticleCreatedData);
        // $this->latestArticleCreatedData->organizations()->sync($this->selectedOrganizations);

        // $this->resetValidation();
        // $this->modalSyncRolePermissionVisible = false;
        // $this->reset();
    }
    // create news


    // update news
    public function updateNewsShowModal($id)
    {
        $this->articleId = $id;
        // dd($this->articleId);
        $this->modalUpdateNewsFormVisible = true;
        $this->loadModel();
    }
    public function loadModel()
    {
        $this->data = Article::find($this->articleId);
        $this->article_title = $this->data->article_title;
        $this->article_subtitle = $this->data->article_subtitle;
        $this->article_content = $this->data->article_content;
        $this->type = $this->data->type;
    }
    public function updateModelData()
    {
        return [
            'article_title' => $this->article_title,
            'article_subtitle' => $this->article_subtitle,
            'article_content' => $this->article_content,
            'type' => $this->type,
        ];
    }
    public function update()
    {
        $this->validate([
            'article_title' => 'required',
            'article_subtitle' => 'required',
            'article_content' => 'required',
            'type' => 'required',
        ]);
        Article::find($this->articleId)->update($this->updateModelData());
        $this->syncUpdateArticleOrganization();
        $this->modalUpdateNewsFormVisible = false;
        $this->reset();
        $this->resetValidation();
    }
    public function syncUpdateArticleOrganization()
    {
        $this->articleData = Article::find($this->articleId);
        $this->OrgDataFromUser = $this->articleData->organizations->first();
        $this->articleData->organizations()->sync($this->selectedOrganizations);
        $this->resetValidation();
        $this->modalSyncRolePermissionVisible = false;
        $this->reset();
    }
    // update news

    // delete news
    public function deleteNewsShowModal($id)
    {
        $this->articleId = $id;
        // dd($this->articleId);
        $this->modalDeleteNewsFormVisible = true;
    }
    public function delete()
    {
        // $users = Article::find($this->articleId)->roles;
        $this->artId = Article::find($this->articleId);
        $this->seed = Article::find($this->articleId)->organizations;
        $this->artId->organizations()->detach($this->seed);
        Article::destroy($this->articleId);
        $this->modalDeleteNewsFormVisible = false;
        $this->reset();
        $this->resetValidation();
        // $this->resetPage();
    }
    // delete news

    public function getArticleOrganization()
    {
        $this->userId = Auth::user()->id;

        return DB::table('articles')
           ->where('user_id', '=', $this->userId)
           ->get();
    }
    public function getOrganizationData()
    {
        return DB::table('organizations')->get();
    }
    public function getArtData()
    {
        return Article::paginate(5);
    }
    public function render()
    {
        return view('livewire.articles',[
            'organizationData' => $this->getorganizationdata(),
            'articleOrganization' => $this->getArticleOrganization(),
            'articleDatas' => $this->getArtData(),
            'articleDataController' => $this->getArticleTableData(),
        ]);
    }
}
