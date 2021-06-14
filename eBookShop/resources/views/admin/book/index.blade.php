@extends('layouts.main')
@section('style')
    <link rel="stylesheet" href="{{asset("https://cdn.datatables.net/v/dt/dt-1.10.16/r-2.2.1/datatables.min.css")}}">
@endsection
@section('name')
    <h1>Books</h1>
@endsection
@section('root')
    <a href="{{route('admin.index')}}">
        App
    </a>

@endsection
@section('model')
    Books
@endsection

@section('content')

    <div class="col-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom d-flex justify-content-between">
                <h2>Books</h2>

                <div class="m-lg-auto">
                    <button class="btn" id="btn-show-all-children" type="button">Expand All</button>
                    <button class="btn" id="btn-hide-all-children" type="button">Collapse All</button>

                </div>


                @if(auth()->user()->hasDirectPermission('Create')||auth()->user()->hasRole('Administrator'))
                    {!! Form::open(['method' => 'POST' ,'route' => ['book.import'],'enctype'=>'multipart/form-data']) !!}
                    <div class="form-group">
                        <label for="file"> Choose Excel</label>
                        <input type="file" name="file" class="form-control-file">

                    </div>
                    <button class="btn btn-success" type="submit">
                        Import Excel
                    </button>
                    {!! Form::close() !!}
                {!! Form::open(['method' => 'GET' ,'route' => ['book.create']]) !!}
                <button class="btn btn-success" type="submit">
                    <i class=" mdi mdi-plus-circle"></i> Create book
                </button>
                {!! Form::close() !!}
                    @endif

            </div>

            <div class="card-body">
                    <table id="expendable-data-table" class="display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Publisher</th>
                            <th>Publication_Date</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th></th>
                            <th class="none">id</th>
                            <th class="none">image</th>
                            <th class="none">weight</th>
                            <th class="none">size</th>
                            <th class="none">number of pages</th>
                            <th class="none">formality</th>
                            <th class="none">Type</th>
                            <th class="none">discount</th>
                            <th class="none">create_at</th>
                            <th class="none">updated_at</th>
                            <th class="none"></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($books as $item)
                        <tr id="sid{{$item->id}}">
                               <td>{{$item->title}}</td>
                                <td>{{$item->author->full_name}}</td>
                                <td>{{$item->publisher->name}}</td>
                                <td>{{$item->publication_date}}</td>
                                <td>{{$item->categories->name}}</td>
                                <td>{{$item->price}}</td>
                            <td class="text-right">
                                <div class="dropdown show d-inline-block widget-dropdown">
                                    <a class="dropdown-toggle icon-burger-mini" href="#" role="button"
                                       id="dropdown-recent-order5" data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false" data-display="static"></a>
                                    <ul class="dropdown-menu dropdown-menu-right"
                                        aria-labelledby="dropdown-recent-order5">
                                        <li class="dropdown-item">
                                            <a href="{{route('book.show',$item->id)}}">View</a>
                                        </li>
                                        @if(auth()->user()->hasDirectPermission('Edit')||auth()->user()->hasRole('Administrator'))
                                        <li class="dropdown-item">
                                            <a href="{{route('book.edit',$item->id)}}">edit</a>
                                        </li>
                                        @endif
                                        @if(auth()->user()->hasDirectPermission('Delete')||auth()->user()->hasRole('Administrator'))
                                        <li class="dropdown-item">
                                            <a type="button" id="btn-delete-book" data-value="{{$item->id}}" onclick="deleteBook(this)">Delete</a>
                                        </li>
                                            @endif
                                    </ul>
                                </div>
                            </td>

                                <td>{{$item->id}}</td>
                                <td>
                                    @if($item->imagebooks->count())
                            @foreach($item->imagebooks as $image)
                                        <img src="{{$image->file}}" alt="image_{{$item->title}}" border=3 height=100 width=100></img>
                                @endforeach
                                    @else
                                        no image
                                    @endif
                                </td>
                                <td>{{$item->weight}}</td>
                                <td>{{$item->size}}</td>
                                <td>{{$item->number_of_pages}}</td>
                                <td>{{$item->formality}}</td>

                                    @if($item->foreign_book ===0)
                                    <td>Nuoc ngoai</td>
                                @else
                                    <td>Trong nuoc</td>
                                   @endif
                              @if($item->percent_discount !== null)
                                <td>{{round ($item->percent_discount * 100 / 100) }}%</td>
                            @else
                                <td>No</td>
                            @endif
                                <td>{{$item->created_at}}</td>
                            <td>{{$item->updated_at}}</td>
                             <td>
                                 @if(auth()->user()->hasDirectPermission('Update')||auth()->user()->hasRole('Administrator'))
                                 <button data-value="{{$item->id}}" class="btn-sm btn-success" onclick="getPriceDiscount(this)" type="button" data-toggle="modal" href="#"
                                         data-target="#exampleModalSmall">
                                     Discount
                                 </button>
                                     @endif
                             </td>
                        </tr>

                        @endforeach
                        </tbody>
                    </table>
                @include('admin.book.discount')
           </div>
    </div>
    </div>
@endsection

@section('script')
    <script src={{asset("error-handler/exception.js")}}></script>
    <script src={{asset("https://cdn.datatables.net/v/dt/dt-1.10.16/r-2.2.1/datatables.min.js")}}> </script>
    <script>
        $(document).ready(function (){
            var table = $('#expendable-data-table').DataTable({
                'responsive': true
            });

            // Handle click on "Expand All" button
            $('#btn-show-all-children').on('click', function(){
                // Expand row details
                table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
            });

            // Handle click on "Collapse All" button
            $('#btn-hide-all-children').on('click', function(){
                // Collapse row details
                table.rows('.parent').nodes().to$().find('td:first-child').trigger('click');
            });
        });

        @if(Session::has('create-book'))
        $(".alert-highlighted span").text("{{session('create-book')}}");
        $('.alert-highlighted').show();
        $('.alert-highlighted').fadeOut(5000);
        @elseif(Session::has('update-book'))
        $(".alert-highlighted span").text("{{session('update-book')}}");
        $('.alert-highlighted').show();
        $('.alert-highlighted').fadeOut(5000);
        @endif

            $overlay = $('<div id="overlay"/>').css({
            position: 'fixed',
            display: 'none',
            top: 0,
            left: 0,
            color: '#adbcbf',
            width: '100%',
            height: $(window).height() + 'px',
            opacity: 0.4,
            background: '#f5f6f7 url("/images/Blocks-1s-200px.gif") no-repeat center'
        })
        function deleteBook(item){

            var id = item.getAttribute("data-value");
            console.log(id);
            Swal.fire({
                title: 'Are you sure delete book ?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#29CC97',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                $overlay.appendTo("body");

                if (result.isConfirmed) {
                    $('#overlay').show();
                    $.ajax({
                        type: 'DELETE',
                        catch: false,
                        url: 'book/' + id,

                        data: {
                            "_token": '{{csrf_token()}}'
                        },
                        success: function (data) {
                            console.log(data.result);
                            $('#overlay').hide();
                            Swal.fire(
                                'Deleted!',
                                data.result,
                                'success'
                            )
                          $("tr#sid"+id).remove();
                            $('#overlay').hide();
                        },
                        error:function (error){
                            console.log(error);
                        }
                    })
                }
            })
        }
        function savePriceChange(){
                var id =$('#idBook').val();
            $.ajax({
                type: 'POST',
                catch: false,
                url: 'book/' +id+'/discount/update',
                data: {
                    "_token": '{{csrf_token()}}',
                "price": $('#price').val(),
                "discount": $('#discount').val(),
                },
                success: function (data) {
                    location.reload();
                },
                error:function (error){
                    $.fn.handlerError(error);
                }
            })
        }
  function getPriceDiscount(item){

    var id = item.getAttribute("data-value");
      $.ajax({
          type: 'GET',
          catch: false,
          url: 'book/' +id+'/discount',

          data: {
              "_token": '{{csrf_token()}}'
          },
          success: function (data) {

              var price = data.result[0];
              var discountPercent =data.result[1];
              $('#price').val(price);
              if( discountPercent !== null){
                  $('#discount').val(discountPercent);
              }
              $('#idBook').val(id);
              priceChange(price);

          },
          error: function (error){
              console.log(error)

          }
      })
  }
   function priceCal(price,discountPercent){
               return (price * (100- discountPercent))/100;
   }
   function priceChange(price){
       $("#discount").bind('keyup mouseup', function () {
           var discount = $('#discount').val();
           var resultCal = priceCal(price,discount);
           way.set("someScope", { with: { something: resultCal }})
       });
   }
        function binderDiscount(item){
            if (item.value < 0) item.value = 0;
            if (item.value > 100) item.value = 100;
            var discount  =  item.value;
            way.set("someScope", { with: { something: discount }})
        }
        $("tbody")
    </script>

@endsection
