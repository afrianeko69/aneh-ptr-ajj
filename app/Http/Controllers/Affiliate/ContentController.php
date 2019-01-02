<?php

namespace App\Http\Controllers\Affiliate;

use Illuminate\Http\Request;
use App\Content;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Auth;
use Session;

class ContentController extends Controller
{
    protected $view = 'affiliate.content';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $contents = Content::where('affiliate_id',Auth::user()->affiliate_id)->get();
        return view($this->view.'.index',compact('contents'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $content = Content::where('id',$id)->first();
        return view($this->view.'.edit', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateContentRequest $request, $id)
    {
        $data = $request->all();
        $content = Content::where('id',$id)->update([
            'title' => $data['title'],
            'description' => $data['description']
        ]);

        if ($content) {
            Session::flash('message-success', 'Halaman Anda telah tersimpan.');
            return redirect(route('content.index'));
        }
        else{
            Session::flash('message-error', 'Maaf telah terjadi kesalahan.');
        }
        return redirect()->back();
    }
}
