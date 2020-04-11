<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\card;

class ResturantController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cards=card::orderBy('id','desc')->paginate('5');
        $count=card::count();
        return view('posts.index',compact('cards','count'));
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->file('coverImage'));
        $request->validate([
            'title'=>'required|max:200',
            'body'=>'required|max:500',
            'coverImage'=>'image|mimes:jpeg,jpg,png|max:1999'
        ]);
        if($request->hasFile('coverImage')){
            $file=$request->file('coverImage');
            $ext=$file->getClientOriginalExtension();
            $filename='cover_image'.'_'.time().'.'.$ext;
            $file->store('public/coverImages',$filename);
            
        }
        else{
            $filename='noImage.png';
        }
        $card=new card();
        $card->title=$request->title;
        $card->body=$request->body;
        $card->image=$filename;
        $card->user_id=auth()->user()->id;
        $card->save();
        redirect('/dashboard')->with('status','the meal has been added to the menu !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $card =card::find($id);
        if(auth()->user()->id !==$card->user_id)
        {
            return redirect('/')->with('error','You are not authorized');
        }
        return view('posts.show',compact('card'));
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $card =card::find($id);
        return view('posts.edit',compact('card'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required|max:200',
            'body'=>'required|max:500',
        ]);
        $card=new card();
        $card->title=$request->title;
        $card->body=$request->body;
        $card->save();
        redirect('/dashboard')->with('status','the meal has been Updated to the menu !');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $card=card::find($id);
        $card->delete();
        redirect('/dashboard')->with('error','the meal has been deleted from the menu !');
    }
}
