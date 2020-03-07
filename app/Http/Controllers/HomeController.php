<?php

namespace App\Http\Controllers;

use App\Jobs\RenderVideo;
use App\PresignedUrlGenerator;
use App\User;
use App\Video;
use Aws\S3\S3Client;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     * @param PresignedUrlGenerator $initiateFileUpload
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(PresignedUrlGenerator $initiateFileUpload)
    {
        // $url = $initiateFileUpload->get();

        return view('home');
    }
}
