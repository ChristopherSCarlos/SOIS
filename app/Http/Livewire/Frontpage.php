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

    public $systemPagesDataForSlugSelection;
    public $organizationPagesDataForSlugSelection;
    public $organizationPagesDataForSlugSelectionId;
    public $organiationDataForNewsSelection;
    public $organiationPivotDataForNewsSelection;

    public $isOrgWebPageVisible = false;
    
    public $urlSlugOrganizationData;

    public $isOrgDataSimilarWithCurrentSlug = false;
    public $getOrganizationAllData;
    public $getOrganizationData;
    private $orgTableDataIdForCurrentSlugId;
    public $OrgDataInArticles;
    public $orgTableDataIdHolder;
    public $orgTableDataIdArray = [];

    public $orgTableGetUserIdInOrganizationData;
    public $isArtcilesInOrganization;

    public $findOrgData;

    public function selectSlugForSystemPagesViews()
    {
        $this->systemPagesDataForSlugSelection = DB::table('pages')
                                    ->orderBy('id','asc')
                                    ->get()
                                    ->pluck('slug');
        // dd($this->systemPagesDataForSlugSelection);                                    
        return $this->systemPagesDataForSlugSelection;
    }
    public function selectSlugForOrganizationPagesViews()
    {
        $this->organizationPagesDataForSlugSelection = DB::table('organizations')
                                    ->orderBy('id','asc')
                                    ->get()
                                    ->pluck('organization_slug');
        // dd($this->organizationPagesDataForSlugSelection);                                    
        return $this->organizationPagesDataForSlugSelection;
    }

    public function getArticleOrganization()
    {
        // dd($this->urlslug);
        
        // $this->userId = Auth::user()->id;
        // $this->user = User::find($this->userId);
        // // $this->userArticle = $this->user->article;
        // $this->userArticle = DB::table('articles')
        //    ->where('user_id', '=', $this->userId)
        //    ->get();

        // dd($this->urlslug);

        // GET ORGANIZATION DATA OF CURRENT ORGANIZATION WEBPAGE AND COMPARE IT TO THE SLUG
        $this->orgTableDataIdForCurrentSlugId = DB::table('organizations')->where('organization_slug','=',$this->urlslug)->first(); 

        // IF DATA EXISTS
        if($this->orgTableDataIdForCurrentSlugId){
            // $this->orgTableGetUserIdInOrganizationData = DB::table('organizations')->where('')
            // GET ORGANIZATION ID of user IN organization_user PIVOT TABLE
            // $this->orgTableDataId = DB::table('organization_user')
            //                         ->where('organization_id', '=', $this->orgTableDataIdForCurrentSlugId->id)
            //                         ->first();
            //                         // ->get()
            //                         // ->pluck('organization_id');

            // $this->orgTableDataIdHolder = $this->orgTableDataId->organization_id;
            // dd($this->orgTableDataId);

            $this->OrgDataInArticles = Organization::find($this->orgTableDataIdForCurrentSlugId->id);
            // dd($this->OrgDataInArticles);
            // dd($this->OrgDataInArticles->articles);
            // // return $this->OrgDataInArticles->articles;
            // // dd($this->OrgDataInArticles);
            // // dd(gettype($this->OrgDataInArticles));
            foreach ($this->OrgDataInArticles->articles as $OrgArticlesCurrentSlug) {
                $this->orgTableDataIdArray[] = $OrgArticlesCurrentSlug->pivot->article_id;
            }
            return $this->orgTableDataIdArray;
            // dd($this->orgTableDataIdArray);
            // return $this->orgTableDataIdArray;
            // $this->orgTableDataId = $this->orgTableData;

            // $this->getOrganizationData = DB::table('')

            // dd(gettype($this->orgTableDataIdForCurrentSlugId->id));
            // dd("Hello");
        }
        // IF DATA DOESNT EXISTS
        else{
            // dd("world");
        }


        
        // dd($this->orgTableDataId);
        // dd(gettype($this->orgTableData));
        // dd($this->orgTableData);

        // $this->orgTableDataId = $this->orgTableData->id;
        // $this->orgTableDataId = $this->orgTableData;

        // dd($this->orgTableDataId);
        
        // $this->orgData = Organization::find($this->orgTableDataId);
        // dd($this->orgData->articles->id);
        
        // // return $this->orgData->articles;
        // // // dd($orgData->roles);
        // foreach ($this->orgData->articles as $this->arts) {
            // $this->orgArticle[] = $this->arts->pivot->article_id;
            // $this->orgArticle = $this->arts->pivot->article_id;
            // echo $role->pivot->role_id;
        // }
        // print_r($this->orgArticle);
        // $this->orgDataCount = count($this->orgArticle);
        // dd($this->orgDataCount);

        // for ($i=0; $i < $this->orgDataCount; $i++) { 
        //     print_r("Hello");
        // }

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

    public function articlesQuery()
    {
        // dd($this->orgTableDataIdArray);

        $this->findOrgData = Article::find($this->orgTableDataIdArray);
        // dd($this->findOrgData);

        return $this->findOrgData;

        // return Article::select('id','article_title','article_subtitle','article_content','type','image','status','user_id','created_at','updated_at')->get();
        // $this->isArtcilesInOrganization = DB::table('articles')
        //                             ->orderBy('id','asc')
        //                             ->get()
        //                             ->pluck('user_id');
        // return $this->isArtcilesInOrganization;
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

        $this->title = $data->title;
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
        return Page::select('id','is_default_home','is_default_not_found','title','slug','content','header_image','page_type','created_at','updated_at','primary_color','secondary_color','tertiary_color','quarternary_color','status')->get();
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

    public function getArticleAllData()
    {
        return Article::select('id','article_title','article_subtitle','article_content','type','article_header','status','user_id','article_slug','created_at','updated_at')->get();
        // dd(Article::select('id','article_title','article_subtitle','article_content','type','image','status','user_id','article_slug','created_at','updated_at')->get());
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
            'isCurrentSlugInSystemPage' => $this->selectSlugForSystemPagesViews(),
            'isCurrentSlugInOrganizationPage' => $this->selectSlugForOrganizationPagesViews(),
            'getArticleOrganizationData' => $this->getArticleOrganization(),
            'getAllArticleData' => $this->articlesQuery(),
            'getDsiplayArticleDataOnNewsPage' => $this->getArticleAllData(),

        ])->layout('layouts.frontpage');
    }

}