<?php

namespace App\Http\Controllers;

use App\Contracts\BookContract;
use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Requests\UpdatePriceRequest;
use App\Models\Book;
use App\Models\ImageBook;
use Faker\Provider\Image;
use Illuminate\Http\Request;

use App\Imports\BookImport;
use Maatwebsite\Excel\Facades\Excel;


class BookController extends Controller
{
    protected $BookStore;

    public function __construct(BookContract $BookStore){

         $this->BookStore = $BookStore;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $books =  $this->BookStore->getAll();
          return  view('admin.book.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $result = $this->BookStore->create();
        return view('admin.book.create',['authors'=>$result[0],'publishers'=>$result[1],'categories'=>$result[2]]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBookRequest $request)
    {
        $result = $this->BookStore->store($request);
        $request->session()->flash('create-book',$result);
        return redirect()->route('book.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $book = $this->BookStore->show($id);
         return view('admin.book.show',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = $this->BookStore->edit($id);
        return view('admin.book.edit',['book'=>$result[0],'authors'=>$result[1],'publishers'=>$result[2],'categories'=>$result[3]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, $id)
    {
        $result = $this->BookStore->update($request,$id);
        $request->session()->flash('update-book',$result);
        return redirect()->route('book.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $result = $this->BookStore->delete($id);
        return  response()->json(['result'=>$result]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteImage(Request $request,$id){
                  $result =  $this->BookStore->deleteImage($request,$id);
              return  response()->json(['filesuccessremove'=>$result]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function discountBook($id){

        $result = $this->BookStore->discountBook($id);
       return  response()->json(['result'=>$result]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDiscountBook(UpdatePriceRequest $request,$id){
        $result = $this->BookStore->updateDiscountBook($request,$id);
        return  response()->json(['result'=>$result]);
    }

    public function importExcel(Request $request){

             Excel::import(new BookImport(),$request->file);
             session()->flash('import-success',"Thêm dữ liệu thành công");
             return redirect()->back();
    }
}
