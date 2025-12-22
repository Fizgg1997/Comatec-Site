<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AwardsAndCertificate;
use App\Header;
use App\OurClient;
use App\OurIndustry;
use App\OurTarget;
use App\OurTeam;
use App\Project;
use App\ProjectsDetails;
use App\Statistic;
use App\NewsAndArticle;
use App\Page;
use Illuminate\Support\Facades\Validator;
use App\PromoteImage;
use App\OurIndustriesDetail;

class WebPageController extends Controller
{

    public function getContent() {
        $header = Header::select([
            'id', 'background_image', 'title', 'description'
        ])->first()?->toArray();

        $industries = OurIndustry::select([
            'id', 'title', 'summary', 'image', 'icon', 'color'
        ])->take(4)->get()->toArray();

        $our_industry = OurIndustry::select([
            'id', 'title', 'summary', 'image'
        ])->where('id', '>=', 5)->get()->toArray();

        $our_clients = OurClient::select([
            'id', 'logo', 'type'
        ])->where('type', 'client')->limit(12)->get()->toArray();

        $our_partners = OurClient::select([
            'id', 'logo', 'type'
        ])->where('type', 'partner')->limit(12)->get()->toArray();
                    
        $certificates = AwardsAndCertificate::select([
            'id', 'image'
        ])->where('type', 'certificate')->limit(12)->get()->toArray();

        $awards = AwardsAndCertificate::select([
            'id', 'image', 'title'
        ])->where('type', 'award')->limit(12)->get()->toArray();

        $news_and_articles = NewsAndArticle::select([
            'id', 'title', 'summary', 'image', 'date'
        ])->orderBy('date', 'DESC')->get()->toArray();

        $pages = Page::select([
            'id', 'image', 'title', 'body', 'icon', 'slug'
        ])->active()->limit(3)->get()->toArray();

        $our_team = OurTeam::select([
            'id', 'name', 'image', 'job_title', 'linkedIn_account'
        ])->limit(9)->get()->toArray();

        $projects = Project::select([
            'id', 'title', 'summary', 'image'
        ])->limit(4)->get()->toArray();

        $statistics = Statistic::select([
            'id', 'icon', 'achievement_number', 'title'
        ])->limit(5)->get()->toArray();

        return view('welcome', compact(
            'header',
            'industries',
            'our_industry',
            'our_clients',
            'our_partners',
            'certificates',
            'awards',
            'news_and_articles',
            'pages',
            'our_team',
            'projects',
            'statistics'
        ));
    }

    public function getData($type, $id) {
        $model = app()->make('App\\' . $type);

        $data = $model::where('id', $id)->first();

        return response()->json([ 
            'data' => $data
        ]);
    }

    public function getNewsAndArticles($id) {
        $validator = Validator::make(['id' => $id], [
            'id' => 'exists:news_and_articles,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'invalid id',
            ], 400);
        }

        $data = NewsAndArticle::where('id', $id)->first();

        $industries = $this->getIndustriesData();

        $news_and_articles = NewsAndArticle::select([
            'id', 'title', 'summary', 'image', 'date'
        ])->orderBy('date', 'DESC')->get()->toArray();

        return view('custom-page', compact('data', 'industries', 'news_and_articles'));
    }

    public function getProject($id) {
        $validator = Validator::make(['id' => $id], [
            'id' => 'exists:projects,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'invalid id',
            ], 400);
        }

        $data = Project::where('id', $id)->first();

        $industries = $this->getIndustriesData();

        $projects = Project::whereNot('id', $id)->get()->toArray();
        $projects_details = ProjectsDetails::where('project_id', $id)->get()->toArray();

        return view('project', compact('data', 'industries', 'projects', 'projects_details'));
    }

    public function getIndustry($id) {
        $validator = Validator::make(['id' => $id], [
            'id' => 'exists:our_industries,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'invalid id',
            ], 400);
        }

        $project_details = OurIndustriesDetail::where('business_id', $id)->get();

        $data = OurIndustry::where('id', $id)->first();

        $industries = $this->getIndustriesData(); # get first 4 for footer data


        $promote_images = PromoteImage::select('images', 'link')->get()->toArray();

        return view('industry', compact(
            'data', 
            'industries', 
            'promote_images',
            'project_details'
        ));
    }

    public function getPage($slug) {
        $validator = Validator::make(['slug' => $slug], [
            'slug' => 'exists:pages,slug',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'invalid slug',
            ], 400);
        }

        $data = Page::where('slug', $slug)->first();

        $industries = $this->getIndustriesData();  # get first 4 for footer data

        $pages = Page::active()->get()->toArray();

        return view('page', compact('data', 'industries', 'pages'));
    }

    public function getAwardsOrCertificates($id) {
        $validator = Validator::make(['id' => $id], [
            'id' => 'exists:awards_and_certificates,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'invalid id',
            ], 400);
        }

        $data = AwardsAndCertificate::where('id', $id)->first();

        $industries = $this->getIndustriesData(); # get first 4 for footer data

        $awards_and_certificates = AwardsAndCertificate::where('type', $data->type)->get()->toArray();

        return view('award_and_certificate', compact('data', 'industries' , 'awards_and_certificates'));
    }

    private function getIndustriesData() { # get industries data take first 4
        $industries = OurIndustry::select(['id', 'title', 'summary', 'image', 'icon', 'color'])
        ->take(4)->get()->toArray();
        return $industries;
    }

    public function getContactUs() {
        $industries = $this->getIndustriesData();

        return view('contact-us', compact('industries'));
    }

    public function displayCareer() {
        $industries = $this->getIndustriesData(); # get first 4 for footer data

        return view('career', compact('industries'));
    }

    public function getProjectDetails($id) {
        $validator = Validator::make(['id' => $id], [
            'id' => 'exists:projects_details,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'error' => 'invalid id',
            ], 400);
        }

        $data = ProjectsDetails::where('id', $id)->first();
        $industries = $this->getIndustriesData(); # get first 4 for footer data

        return view('project_details', compact('data', 'industries'));
    }

    public function getNews() {
        $data = NewsAndArticle::select([
            'id', 'title', 'summary', 'image', 'date'
        ])->orderBy('date', 'DESC')->get()->toArray();
        $industries = $this->getIndustriesData(); # get first 4 for footer data

        return view('news', compact('data', 'industries'));
    }

    // public function getOurIndustriesDetails($id) {
    //     $validator = Validator::make(['id' => $id], [
    //         'id' => 'exists:our_industries_details,id',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'error' => 'invalid id',
    //         ], 400);
    //     }


    //     return view('project_details', compact('data'));
    // }
}