<?php

namespace App\Imports;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class BookImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

      $author =  Author::firstOrCreate(['firstName' => $row['firstname']],['lastName' => $row['lastname']]);
        $publisher =  Publisher::firstOrCreate(['name' => $row['publisher']]);
       $categories =  Category::firstOrCreate(['name' => $row['category']]);
        return new Book([
            'title' =>$row['title'],
            'author_id' => $author->id,
            'publisher_id' => $publisher->id,
            'publication_date'=>  Carbon::now(),
            'categories_id' => $categories->id,
            'weight' =>$row['weight'],
            'number_of_pages' =>$row['number_of_pages'],
            'formality' =>$row['formality'],
            'size' =>$row['size'],
            'foreign_book' => 0,
            'price' =>$row['price'],
            'original_Price' =>$row['price'],
            'describe' => $row['describe']
        ]);
    }
}
