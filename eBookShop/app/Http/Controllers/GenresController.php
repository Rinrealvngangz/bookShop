<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenresRequest;
use App\Http\Requests\UpdateGenresRequest;
use Illuminate\Http\Request;
use App\Models\Genres;
use App\Models\Category;

class GenresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genres::all();
        return view('admin.genres.index',compact('genres'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $htmlOption='';
        $category= Category::all();
        foreach ($category as $cate)
        {
            $htmlOption.="<option  value=' ".$cate['id']. "'>".$cate['name']. "</option>>";
        }
        return view('admin.genres.create',compact('htmlOption'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGenresRequest $request)
    {
        $data = $request->all();
        $genres = Genres::where('name','=',$data['genres-name'])->first();
        if ($genres === null)
        {
            Genres::create(['name'=>$data['genres-name'],'categories_id' =>$data['cate-belong']]);
        }
        else
        {
            return redirect()->back()->withErrors(['Name existed']);
        }
        session()->flash('genres-delete','Create genres success !');
        return redirect()->route('genres.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $catename="";

        $genres = Genres::findOrFault($id)->first();
        if ($genres->categories_id === null)
        {
           dd($genres->categories_id);
        }
        else
        {
            $cateName= $genres->Categories->name;
        }

        return view(genres.index,compact('catename'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gen = Genres::findOrFail($id);

//        $htmlOption = "<option value='".$gen->Categories->id."'>{$gen->Categories->name}</option></br>";
//
//        $categories = Category::where('id','=',$gen->Categories->id);
        $category= Category::all();


        return  view('admin.genres.update',compact('gen', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGenresRequest $request, $id)
    {
        $input =$request->all();
        $genUpdate = Genres::findOrFail($id);
        $genSearch = Genres::where('name','=',$input['name-genres']);
        if ($genSearch !== null && $input['name-genres'] ===$genUpdate->name || $genUpdate ===null)
        {
            $genUpdate->name = $input['name-genres'];
            $genUpdate->categories_id=$input['genres-belong'];
            $genUpdate->save();
        }
        else
        {
            return redirect()->back()->withErrors('Name genres invalid!');
        }
        session()->flash('update-genres','Update Success!');
        return redirect()->route('genres.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Genres::destroy($id);

        session()->flash('genres-delete','Delete success');
        return redirect()->route('genres.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $cate_id
     * @return \Illuminate\Http\Response
     */
//    public function showNameCateById(Request $request)
//    {
//        $data = $request->all();
//         $nameCate = Category::where('categories_id','=',$data)->name;
//         return redirect('genres.index',compact('nameCate'));
//    }
}
