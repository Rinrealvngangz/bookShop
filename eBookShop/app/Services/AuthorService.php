<?php


namespace App\Services;


use App\Contracts\AuthorContract;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class AuthorService implements AuthorContract
{
    public function getAll()
    {
        $author= Author::all()->each->fullname;
        return $author;
    }

    public function create($request)
    {
          Author::create([
            'firstName' =>$request->input('add-firstname-author'),
            'lastName' =>$request->input('add-lastname-author')
        ]);
    }
    public function update($Request)
    {
        $input = $Request->all();
        $firstName = $input['firstname_edit_author'];
        $lastName = $input['lastname_edit_author'];
        $id = $input['idAuthor'];
        $author = Author::findOrFail($id);
        $author->firstName = $firstName;
        $author->lastName = $lastName;
        $author->save();
        $result= "Cập nhật thành công";
        return $result;
    }
    public function delete($Request)
    {
        $ids = $Request['idAuthor'];
        $result = array('error' => 'error', 'success' => 'success');
        Author::destroy($ids);
        return $result['success'];
    }
    public function showBook($id)
    {
        global $html ;
        $author = Author::findOrFail($id);
        $books = $author->books;
                foreach($books as $item){
                       $html .= '<tr id="sid'.$item->id .'">'.
                               '<td>'. $item->title .'</td>'.
                                '<td>'. $item->author->full_name .'</td>'.
                                '<td>'. $item->publisher->name .'</td>'.
                                '<td>'. $item->publication_date .'</td>'.
                                '<td>'. $item->categories->name .'</td>'.
                                '<td>'.$item->price .'</td>'.
                                '<td class="text-right">'.
                                '<div class="dropdown show d-inline-block widget-dropdown">'.
                                    '<a class="dropdown-toggle icon-burger-mini" href="#" role="button"'.
                                       ' id="dropdown-recent-order5" data-toggle="dropdown" aria-haspopup="true"'.
                                       ' aria-expanded="false" data-display="static"></a>'.
                                    '<ul class="dropdown-menu dropdown-menu-right"'.
                                        ' aria-labelledby="dropdown-recent-order5">'.
                                        ' <li class="dropdown-item">'.
                                            ' <a href="' .route('book.show',$item->id) . '">View</a>'.
                                        '</li>';
                                        if(auth()->user()->hasDirectPermission('Edit')||auth()->user()->hasRole('Administrator')){
                                        $html .= '<li class="dropdown-item">'.
                                            '<a href="'.route('book.edit',$item->id) .'">edit</a>'.
                                        '</li>';
                                        }
                                        if(auth()->user()->hasDirectPermission('Delete')||auth()->user()->hasRole('Administrator')) {
                                           $html .= '<li class="dropdown-item">'.
                                            '<a type="button" id="btn-delete-book" data-value="' . $item->id . '" onclick="deleteBook(this)">Delete</a>' .
                                            '</li>';
                                        }
                                   $html.= '</ul>'.
                                '</div>'.
                            '</td>'.
                                '<td>'.$item->id .'</td>'.
                                '<td>';

                                    if($item->imagebooks->count()) {
                                        foreach ($item->imagebooks as $image) {
                                           $html .= '<img src= "'.$image->file .'" alt= "' .$item->title . '" border = 3 height = 100 width = 100 ></img >';
                                       }
                                    }else {
                                       $html .= '<span>no image </span>';
                                    }
                                $html .= '</td>'.
                                '<td>' . $item->weight .'</td>'.
                                '<td>'.$item->size .'</td>'.
                                '<td>'. $item->number_of_pages .'</td>'.
                                '<td>'.$item->formality .'</td>';
                                    if($item->foreign_book ===0){
                                    $html .='<td>Nuoc ngoai</td>';
                                }else {
                                        $html .='<td> Trong nuoc </td >';
                                   }
                              if($item->percent_discount !== null) {
                                 $html .= '<td>'.round($item->percent_discount * 100 / 100).'%</td>';
                            }
                              else{
                                      $html .='<td > No</td>';
                           }
                               $html .= '<td>'. $item->created_at .'</td>'.
                            '<td>'.$item->updated_at .'</td>'.
                             '</td>';
                                 if(auth()->user()->hasDirectPermission('Update')) {
                                    $html.= '<button data-value = "'.$item->id .'" class="btn-sm btn-success" onclick = "getPriceDiscount(this)" type = "button" data-toggle = "modal" href = "#"'.
                                         ' data-target = "#exampleModalSmall" > Discount'.
                                 '</button >';
                                     }
                            $html .= '</td>'.
                        '</tr>';
                      }
                         return $html;

    }
}
