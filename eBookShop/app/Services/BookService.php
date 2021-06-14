<?php


namespace App\Services;

use App\Contracts\BookContract;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\ImageBook;
use App\Models\Publisher;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class BookService implements BookContract
{

    public function getAll()
    {
      $books =  Book::all();
      return $books;
    }

    public function show($id)
    {
         $book =  Book::findOrFail($id);
         return $book;
    }

    public function create()
    {
        $result = array();
        $author =   Author::all();
        array_push($result,$author);
        $publisher = Publisher::all();
        array_push($result,$publisher);
        $categories = Category::all();
        array_push($result,$categories);
        return $result ;

    }

    public function update($request, $id)
    {
        $input =$request->all();
        unset($input['input24']);
        unset($input['_token']);
        unset($input['_method']);
        $dateUpdate =Carbon::now();
        $input['updated_at'] =$dateUpdate->toDateTimeString();
        $input['original_Price'] = $input['price'];
        $input['percent_discount'] =0;
        DB::table('books')->where('id', $id)->update($input);

        if($request['input24'] !== null){
            foreach ($request->file('input24')  as $file){
                $name = time() . $file->getClientOriginalName();
                $file->move('imagesBook', $name);
                ImageBook::create(['file' => $name,'book_id'=>$id]);
            }
        }
        return "Update success!";
    }

    public function delete($id)
    {
         $book = Book::findOrFail($id);
         $images = $book->imagebooks;
         foreach ($images as $img){
             unlink(public_path() . $img->file);
             ImageBook::destroy($img->id);

         }
         $book->delete();
         return "Delete success!";
    }

    public function edit($id)
    {
        $result = array();
        $book =  Book::findOrFail($id);
        array_push($result,$book);
        $author =   Author::all();
        array_push($result,$author);
        $publisher = Publisher::all();
        array_push($result,$publisher);
        $categories = Category::all();
        array_push($result,$categories);
        return $result ;
    }

    public function deleteImage($request, $id)
    {

        ImageBook::destroy($request['id']);


        return "Delete success!";
    }

    public function store($request)
    {
        $input =$request->all();

         if($input['author'] !== null){
             $index =count(explode(' ',$input['author']));
             $firstName = explode(' ',$input['author'])[$index-1];
             global $lastName;
             for($i =0 ;$i < count(explode(' ',$input['author'])) -1 ;$i++ ){
                 $lastName .= explode(' ',$input['author'])[$i] . ' ';
             }
            $author =  Author::firstOrCreate(['firstName'=>$firstName], ['lastName' => $lastName]);
             $input['author_id'] = $author->id;
         }
         if($input['publisher'] !== null){
             $publisher = Publisher::firstOrCreate(['name'=>$input['publisher']]);
             $input['publisher_id'] = $publisher->id;
         }
         if($input['category'] !== null){
             $category = Category::firstOrCreate(['name'=>$input['category']]);
             $input['categories_id'] = $category->id;
         }
        unset($input['input-file']);
        $input['original_Price'] =$input['price'];
        $book = Book::create($input);
        if($request['input-file'] !== null) {
            foreach ($request->file('input-file') as $file) {
                $name = time() . $file->getClientOriginalName();
                $file->move('imagesBook', $name);
                ImageBook::create(['file' => $name, 'book_id' => $book->id]);
            }
        }
        return "Create success!";
    }

    public function discountBook($id)
    {
         $data = Book::findOrFail($id)->price_discount;
         return $data;
    }

    public function updateDiscountBook($request, $id)
    {
        $book = Book::findOrFail($id);
        $book->price=$request['price'];
        $book->percent_discount =$request['discount'];
        $book->save();
        return "Update price success!";
    }
}
