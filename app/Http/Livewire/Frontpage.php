<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;
use App\Models\Organization;
use App\Models\Event;
use App\Models\User;
use App\Models\Article;
use App\Models\DefaultInterface;
use Illuminate\Support\Facades\DB;

use Auth;

class Frontpage extends Component
{
    public $urlslug;
    public $title;
    public $content;
    public $sideBarLinks;
    public $topNavLinks;
    public $modalShowSystemModel = false;
    public $modalShowNewOrgModel = false;
    public $is_fornt_page_slug_null = null;

    public $frontPageTitle;
    public $page_type;
    public $userId;
    public $user;
    public $userArticle;
    public $articleCount = false;
    
    public $testFlex = 'flex-wrap-reverse';

    public $orgArticle = [];
    public $orgTableData;
    public $orgTableDataId;
    public $orgData;
    public $orgDataCount;

    public function getArticleOrganization()
    {
        // dd($this->urlslug);
        
        // $this->userId = Auth::user()->id;
        // $this->user = User::find($this->userId);
        // // $this->userArticle = $this->user->article;
        // $this->userArticle = DB::table('articles')
        //    ->where('user_id', '=', $this->userId)
        //    ->get();

        $this->orgTableData = DB::table('organizations')
           ->where('organization_slug', '=', $this->urlslug)
           ->first();
           // ->get()
           // ->pluck('id');

        // dd(gettype($this->orgTableData));
        // dd($this->orgTableData);

        $this->orgTableDataId = $this->orgTableData->id;
        // $this->orgTableDataId = $this->orgTableData;

        // dd($this->orgTableDataId);
        
        $this->orgData = Organization::find($this->orgTableDataId);
        // dd($this->orgData->articles->id);
        
        // // return $this->orgData->articles;
        // // // dd($orgData->roles);
        foreach ($this->orgData->articles as $this->arts) {
            $this->orgArticle[] = $this->arts->pivot->article_id;
            // $this->orgArticle = $this->arts->pivot->article_id;
            // echo $role->pivot->role_id;
        }
        print_r($this->orgArticle);
        $this->orgDataCount = count($this->orgArticle);
        // dd($this->orgDataCount);

        for ($i=0; $i < $this->orgDataCount; $i++) { 
            print_r("Hello");
        }

        // // // dd($this->OrgDataFromUser->id);
        // if($this->userArticle){
        //     $this->articleCount = true;
        //     // dd($this->articleCount);
        //     return DB::table('articles')
        //         ->where('user_id', '=', $this->userId)
        //         ->get();
        // }else{
        //     $this->articleCount = false;
        //     // dd($this->articleCount);
        //     // $this->orgCount = false;
        //     // return $this->orgCount;
        //     // dd("2");
        // }


        // dd($this->userArticle);


        // return DB::table('articles')
        //    ->where('user_id', '=', $this->userId)
        //    ->get();
    }



    public function mount($urlslug = null)
    {
        $this->retrieveContent($urlslug);
    }

    public function retrieveContent($urlslug)
    {
        if (empty($urlslug)) {
            $data = Page::where('is_default_home',true)->first();
            $data = Page::select('title')->first();
        } else {
            $data = Page::where('slug',$urlslug)->first();
        
            // if may error
            if (!$data) {
                $data = Page::where('is_default_not_found',true)->first();
            }
        }

        // $this->title = $data->title;
        // $this->content = $data->content;
    }

    public function sideBarLinks()
    {
        return DB::table('navigation_menus')
            ->where('type', '=', 'SidebarNav')
            ->orderBy('sequence','asc')
            ->orderBy('created_at','asc')
            ->get();
    }
    public function topNavLinks()
    {
        return DB::table('navigation_menus')
            ->where('type', '=', 'TopNav')
            ->orderBy('sequence','asc')
            ->orderBy('created_at','asc')
            ->get();
    }

    public function organizationLinks()
    {
        return DB::table('organizations')
            ->orderBy('created_at','asc')
            ->get();
    }

    public function getWebPageTitle()
    {
        return Page::select('id','is_default_home','is_default_not_found','title','slug','content','landingImage','page_type','created_at','updated_at','primary_color','secondary_color','tertiary_color','quarternary_color','status')->get();
    }

    public function getOrgPageData()
    {
        return Organization::select('id','organization_name','organization_logo','organization_details','organization_primary_color','organization_secondary_color','organization_carousel_image_1','organization_carousel_image_2','organization_carousel_image_3','organization_slug','page_type','created_at','updated_at')->get();
    }

    public function getEventData()
    {
        return DB::table('events')
            ->where('isEventFeat', '=', 'yes')
            ->orderBy('created_at','asc')
            ->get();
    }

    public function getDefaultInterfaceData()
    {
        return DB::table('default_interfaces')
            ->orderBy('id','asc')
            ->get();
    }

    public function ShowSystemModel()
    {
        $this->modalShowSystemModel = true;
    }
    public function ShowOrgWebModel()
    {
        $this->modalShowNewOrgModel = true;
    }
    public function validateFrontPageTitle()
    {
        $this->frontPageTitle = 'Student Organization Information System';
    }

    public function isSLugFrontPageNull()
    {
        $this->isSLugFrontPageNull = null;
    }

    public function test()
    {
        $this->testFlex = "flex-wrap-reverse";
    }


    public function render()
    {
        return view('livewire.frontpage',[
            'sidebarLinks' => $this->sideBarLinks(),
            'topnavLinks' => $this->topNavLinks(),
            'orgLinks' => $this->organizationLinks(),
            'frontPageTitle' => $this->validateFrontPageTitle(),
            'pageTableDataTitle' => $this->getWebPageTitle(),
            'pageOrgData' => $this->getOrgPageData(),
            'pageEventData' => $this->getEventData(),
            'pageDefaultInterfaceData' => $this->getDefaultInterfaceData(),
            'isFrontPageSlugNull' => $this->isSLugFrontPageNull(),
            'test' => $this->testFlex = "flex-wrap-reverse",
            // 'getArticleOrganizationData' => $this->getArticleOrganization(),
        ])->layout('layouts.frontpage');
    }

}
