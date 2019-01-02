<?php

namespace App\Http\Controllers\Affiliate;

use Illuminate\Http\Request;
use App\Affiliate;
use App\Content;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Page;
use Auth;
use Session;
use Storage;

class AffiliateController extends Controller
{
    protected $view = 'affiliate';

    public function index(){
        return view($this->view.'.index');
    }

    public function settings(){
        $affiliate = Affiliate::where('id',Auth::user()->affiliate_id)->first();
        $pages = Page::where('affiliate_id',Auth::user()->affiliate_id)->get();
        $contents = Content::where('affiliate_id',Auth::user()->affiliate_id)->get();
        return view($this->view.'.settings',compact('affiliate','pages','contents'));
    }

    public function updateSettings(Requests\UpdateSettingsRequest $request){

        $post = $request->except('_token');
        
        if (!empty($post['logo'])){
            $path = 'affiliates/'.Auth::user()->affiliate_id;
            $saveFile = Storage::disk('gcs')->put($path, $request->logo, 'public');
            $post['logo'] = $path.'/'.basename($saveFile);
        }
        if (!empty($post['favicon'])){
            $path = 'affiliates/'.Auth::user()->affiliate_id;
            $saveFile = Storage::disk('gcs')->put($path, $request->favicon, 'public');
            $post['favicon'] = $path.'/'.basename($saveFile);
        }
        Affiliate::where('id', Auth::user()->affiliate_id)->update($post);

        return redirect()->back();
    }

    public function login(Request $request) {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect(route('affiliate.settings'));
        } else {
            Session::flash('message-error', 'Maaf Email / Password anda salah.');
            return redirect(route('affiliate.index'));    
        }
    }
    public function logout() {
        Auth::logout();
        return redirect(route('affiliate.index'));
    }

    public function import(){
        $pages = Page::where('affiliate_id',Auth::user()->affiliate_id)->first();
        if (empty($pages)){
            $imports = Page::where('affiliate_id',0)->where('slug', '<>', 'hello-world')->get();
            foreach ($imports as $import) {
                $page = [
                    'affiliate_id' => Auth::user()->affiliate_id,
                    'title' => $import['title'],
                    'author_id' => Auth::user()->id,
                    'slug' => $import['slug'],
                    'status' => 'ACTIVE',
                    'body' => $import['body']
                ] ;
                Page::firstOrCreate($page);
            }
        }

        $contents = Content::where('affiliate_id',Auth::user()->affiliate_id)->first();
        if (empty($contents)){
            $imports = Content::where('affiliate_id',0)->where('key', '<>', 'jadilah-partner-kami')->get();
            foreach ($imports as $import) {
                $page = [
                    'affiliate_id' => Auth::user()->affiliate_id,
                    'title' => $import['title'],
                    'description' => $import['description'],
                    'key' => $import['key']
                ] ;
                Content::firstOrCreate($page);
            }
        }

        Session::flash('message-success', 'Anda telah sukses diimportkan Page dan Content Anda ');
        return redirect()->back();
    }
}
