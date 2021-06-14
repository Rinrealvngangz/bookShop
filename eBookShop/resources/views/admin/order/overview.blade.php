@extends('layouts.main')
@section('style')
 <style>
     @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

     * {
         margin: 0;
         padding: 0;
         box-sizing: border-box
     }

     body {
         background-color: #eee
     }

     nav,
     .wrapper {
         padding: 10px 50px
     }

     nav .logo a {
         color: #000;
         font-size: 1.2rem;
         font-weight: bold;
         text-decoration: none
     }

     nav div.ml-auto a {
         text-decoration: none;
         font-weight: 600;
         font-size: 0.8rem
     }

     header {
         padding: 20px 0px
     }

     header .active {
         font-weight: 700;
         position: relative
     }

     header .active .fa-check {
         position: absolute;
         left: 50%;
         bottom: -27px;
         background-color: #fff;
         font-size: 0.7rem;
         padding: 5px;
         border: 1px solid #008000;
         border-radius: 50%;
         color: #008000
     }

     .progress {
         height: 2px;
         background-color: #ccc
     }

     .progress div {
         display: flex;
         align-items: center;
         justify-content: center
     }

     .progress .progress-bar {
         width: 40%
     }

     #details {
         padding: 30px 50px;
         min-height: 300px
     }

     input {
         border: none;
         outline: none
     }

     .form-group .d-flex {
         border: 1px solid #ddd
     }

     .form-group .d-flex input {
         width: 95%
     }

     .form-group .d-flex:hover {
         color: #000;
         cursor: pointer;
         border: 1px solid #008000
     }

     select {
         width: 100%;
         padding: 8px 5px;
         border: 1px solid #ddd;
         border-radius: 5px
     }

     input[type="checkbox"]+label {
         font-size: 0.85rem;
         font-weight: 600
     }

     #address,
     #cart,
     #summary {
         padding: 20px 50px
     }

     #address .d-md-flex p.text-justify,
     #register p.text-muted {
         margin: 0
     }

     #register {
         background-color: #d9ecf2
     }

     #register a {
         text-decoration: none;
         color: #333
     }

     #cart,
     #summary {
         max-width: 500px
     }

     .h6 {
         font-size: 1.2rem;
         font-weight: 700
     }

     .h6 a {
         text-decoration: none;
         font-size: 1rem
     }

     .item img {
         object-fit: cover;
         border-radius: 5px
     }

     .item {
         position: relative
     }

     .number {
         position: absolute;
         font-weight: 800;
         color: #fff;
         background-color:#20c997;
         padding-left: 7px;
         border-radius: 50%;
         border: 1px solid #fff;
         width: 25px;
         height: 25px;
         top: -5px;
         right: -5px
     }

     .display-5 {
         font-size: 1.2rem
     }

     #cart~p.text-muted {
         margin: 0;
         font-size: 0.9rem
     }

     tr.text-muted td {
         border: none
     }



     .fa-minus,
     .fa-plus {
         font-size: 0.7rem
     }

     .table td {
         padding: 0.3rem
     }

     .btn.text-uppercase {
         border: 1px solid #333;
         font-weight: 600;
         border-radius: 0px
     }

     .btn.text-uppercase:hover {
         background-color: #333;
         color: #eee
     }

     .btn.text-white {
         background-color: #e35d6a;
         border-radius: 0px
     }

     .btn.text-white:hover {
         background-color: #dc3545;
     }

     .wrapper .row+div.text-muted {
         font-size: 0.9rem
     }

     .mobile,
     #mobile {
         display: none
     }

     .buttons {
         vertical-align: text-bottom
     }

     #register {
         width: 50%
     }
     .view-order {
         height:400px;
         overflow-y: scroll;
         border-radius: 10px;
     }

     /* Let's get this party started */
     ::-webkit-scrollbar {
         width: 12px;
     }

     /* Track */
     ::-webkit-scrollbar-track {
         -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
         -webkit-border-radius: 10px;
         border-radius: 10px;
     }

     /* Handle */
     ::-webkit-scrollbar-thumb {
         -webkit-border-radius: 10px;
         border-radius: 10px;
         background: #3d8bfd;
         -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
     }
     ::-webkit-scrollbar-thumb:window-inactive {
         background: #6ea8fe;
     }

     @media(min-width:768px) and (max-width: 991px) {
         .progress .progress-bar {
             width: 33%
         }

         #cart,
         #summary {
             max-width: 100%
         }

         .wrapper div.h5.large,
         .wrapper .row+div.text-muted {
             display: none
         }

         .mobile.h5,
         #mobile {
             display: block
         }
     }

     @media(min-width: 576px) and (max-width: 767px) {
         .progress .progress-bar {
             width: 29%
         }

         #cart,
         #summary {
             max-width: 100%
         }

         .wrapper div.h5.large,
         .wrapper .row+div.text-muted {
             display: none
         }

         .mobile.h5,
         #mobile {
             display: block
         }

         .buttons {
             width: 100%
         }
     }

     @media(max-width: 575px) {
         .progress .progress-bar {
             width: 38%
         }

         #cart,
         #summary {
             max-width: 100%
         }

         nav,
         .wrapper {
             padding: 10px 30px
         }

         #register {
             width: 100%
         }
     }

     @media(max-width: 424px) {
         body {
             width: fit-content
         }
     }

     @media(max-width: 375px) {
         .progress .progress-bar {
             width: 35%
         }

         body {
             width: fit-content
         }
     }
 </style>
@endsection
@section('name')
    <h1>Overview</h1>
@endsection
@section('root')
    <a href="{{route('order.index')}}">
        Order
    </a>

@endsection
@section('model')
    Overview
@endsection

@section('content')

        <div class="h5 large">Billing Address</div>
        <div class="row">

            <div class="col-lg-6 col-md-8 col-sm-10 offset-lg-0 offset-md-2 offset-sm-1">

                <div id="details" class="bg-white rounded pb-5">

                        <div class="form-group"> <label class="text-muted">Name</label> <input type="text" value="{{$item->getName()}}" class="form-control"> </div>
                        <div class="form-group"> <label class="text-muted">Email</label>
                            <div class="d-flex jusify-content-start align-items-center rounded p-2"> <input type="email" value="{{$item->getEmail()}}"> <span class="fas fa-check text-success pr-sm-2 pr-0"></span> </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group"> <label>Full name</label>
                                    <div class="d-flex jusify-content-start align-items-center rounded p-2"> <input type="text" value="{{$item->getFullName()}}"> <span class="fas fa-check text-success pr-2"></span> </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group"> <label>City</label>
                                    <div class="d-flex jusify-content-start align-items-center rounded p-2"> <input type="text" value="{{$item->getCity()}}"> <span class="fas fa-check text-success pr-2"></span> </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group"> <label>Phone number</label>
                                    <div class="d-flex jusify-content-start align-items-center rounded p-2"> <input type="text" value="{{$item->getPhoneNumber()}}"> <span class="fas fa-check text-success pr-2"></span> </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group"> <label>Address</label>
                                    <div class="d-flex jusify-content-start align-items-center rounded p-2"> <input type="text" value="{{$item->getAddress()}}"> <span class="fas fa-check text-success pr-2"></span> </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group"> <label>Country</label>
                                    <div class="d-flex jusify-content-start align-items-center rounded p-2"> <input type="text" value="{{$item->getCountry()}}"> <span class="fas fa-check text-success pr-2"></span> </div>
                                </div>
                            </div>

                        </div>

                </div> <input type="checkbox" checked> <label>Shipping address is same as billing</label>
                <div id="address" class="bg-light rounded mt-3">
                    <div class="h5 font-weight-bold text-primary"> Shopping Address </div>
                    <div class="d-md-flex justify-content-md-start align-items-md-center pt-3">
                        <div class="mr-auto"> <b>Home Address</b>
                            <p class="text-justify text-muted">{{$item->getAddress()}}</p>
                        </div>
                        <div class="rounded py-2 px-3" id="register">
                            <a href="#"> <b>Phone number</b> </a>
                            <p class="text-muted">{{$item->getPhoneNumber()}}</p>
                            <a href="#"> <b>Name</b> </a>
                            <p class="text-muted">{{$item->getName()}}</p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-8 col-sm-10 offset-lg-0 offset-md-2 offset-sm-1 pt-lg-0 pt-3">
                <div id="cart" class="bg-white rounded">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="h6">Cart Summary</div>
                    </div>
                    <div class="view-order">
                         @foreach($item->getListBookViewModel() as $bookModel)
                        <div class="d-flex jusitfy-content-between align-items-center pt-3 pb-2 border-bottom">
                            <div class="item pr-2"> <img src="{{asset($bookModel->getImages())}}" alt="img-{{$bookModel->getTitle()}}" width="80" height="80">
                                <div class="number">{{$bookModel->getAmount()}}</div>
                            </div>
                            <div class="d-flex flex-column px-3"> <b class="h5">{{$bookModel->getTitle()}}</b> <a href="{{route('book.show',$bookModel->getId())}}" class="h5 text-primary">B-{{$bookModel->getId()}}</a> </div>
                            <div class="ml-auto"> <b class="h5"> ${{$bookModel->getPrice()}}</b> </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="my-3"></div>
                    <div class="d-flex align-items-center py-2">
                        <div class="display-5">Total</div>
                        <div class="ml-auto d-flex">
                            <div class="text-primary text-uppercase px-3">vnd</div>
                            <div class="font-weight-bold">{{number_format($item->getTotalPriceFee(), 0)}}</div>
                        </div>
                    </div>
                </div>

                    <p class="text-muted h5">Status Order</p>
                @if($item->getStatus() === "Waiting accepted")
                    <p class="text-warning">{{$item->getStatus()}}</p>
                @elseif($item->getStatus() === "Waiting delivery")
                    <p class="text-secondary">{{$item->getStatus()}}</p>
                @elseif($item->getStatus() === "Successfully delivered")
                    <p class="text-success">{{$item->getStatus()}}</p>
                @elseif($item->getStatus() === "Accepted")
                    <p class="text-info">{{$item->getStatus()}}</p>
                @else
                    <p class="text-danger">{{$item->getStatus()}}</p>
                @endif


                    <div class="row pt-lg-3 pt-2 buttons mb-sm-0 mb-2">
                        <div class="col-md-6">
                            <div> <a class="btn text-uppercase" href="{{route('order.index')}}">back to order</a> </div>
                        </div>
                        @if(auth()->user()->hasDirectPermission('Delete')||auth()->user()->hasRole('Administrator'))
                         <form>
                             @csrf
                             @method("DELETE")
                        <div class="col-md-6 pt-md-0 pt-3">
                            <button class="btn text-white ml-auto" onclick="deleteOrder(this)" data-user="{{$item->getUserId()}}" data-value="{{$item->getId()}}" type="button"><span class="fas fa-lock"></span> Clear order</button>
                        </div>
                         </form>
                            @endif
                    </div>



                <div class="text-muted pt-3" id="mobile"> <span class="fas fa-lock"></span> Your information is save </div>
            </div>

        </div>

        <div class="text-muted"> <span class="fas fa-lock"></span> Your information is save </div>

@endsection
@section('script')
    <script>
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

      function deleteOrder(item){

          var id = item.getAttribute("data-value");
          var userId = item.getAttribute("data-user");
          Swal.fire({
              title: 'Are you sure delete order ?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#29CC97',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
              $overlay.appendTo(".swal2-container");
              $('#overlay').show();
              if (result.isConfirmed) {
                  $.ajax({
                      type: 'DELETE',
                      catch: false,
                      url: '/order/'+id+'/customer/'+userId+'/delete',

                      data: {
                          "_token": '{{csrf_token()}}'
                      },
                      success: function (data) {
                          console.log(data.result);
                          if(data.result.localeCompare("Delete success!") === -1){
                              $('#overlay').hide();
                              $(".alert-highlighted").removeClass('alert-success');
                              $(".alert-highlighted").addClass('alert-danger');
                              $(".alert-highlighted span").text(data.result);
                              $('.alert-highlighted').show();
                              $('.alert-highlighted').fadeOut(5000);

                          }else{
                              $('#overlay').hide();
                              Swal.fire(
                                  'Deleted!',
                                  data.result,
                                  'success'
                              )
                              window.location = '/order/';
                          }

                      },
                      error:function (error){
                          console.log(error);
                      }
                  })
              }
          })
      }
    </script>


@endsection
