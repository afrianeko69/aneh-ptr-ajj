<?php

namespace App\Http\Controllers\Affiliate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use Auth;
use Session;
use App\Http\Requests;

class PagesController extends Controller
{
    private $view = 'affiliate.pages';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::where('affiliate_id',Auth::user()->affiliate_id)->get();
        return view($this->view.'.index', compact('pages'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::where('id',$id)->first();
        return view($this->view.'.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdatePageRequest $request, $id)
    {
        $data = $request->all();
        $page = Page::where('id',$id)->update([
            'title' => $data['title'],
            'body' => $data['body']
        ]);

        if ($page) {
            Session::flash('message-success', 'Halaman Anda telah tersimpan.');
            return redirect(route('pages.index'));
        }
        else{
            Session::flash('message-error', 'Maaf telah terjadi kesalahan.');
        }
        return redirect()->back();
    }
}
