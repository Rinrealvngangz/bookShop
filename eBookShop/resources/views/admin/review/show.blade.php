@extends('layouts.main')
@section('name')
    <h1>Review</h1>
@endsection
@section('root')
    <a href="{{route('review.index')}}">
        Review
    </a>
@endsection
@section('model')
    Review detail
@endsection
@section('content')


    <div class="container-fluid">

        <div class="row justify-content-center">

            <div class="col-lg-10 col-xl-6 col-xxl-2 mr-6">
                <div class="card card-default mt-6">
                    <div class="card-body text-center p-4">
                        <a href="javascript:0" data-toggle="modal" data-target="#modal-contact" class="text-secondary d-inline-block mb-3">
                            <h5 class="card-title text-dark">Tên:{{$review->customerReview}}</h5>

                            <ul class="list-unstyled">
                                <li class="d-flex mb-1">
                                    <td> <h6 class="text-dark">Nội dung đánh giá:</h6> <h6>{{$review->descRating}}</h6></td>
                                </li>
                                <li class="d-flex">
                                    <h6 class="text-dark">Số sao:</h6> <h6>{{$review->numberRating}} </h6>
                                </li>
                            </ul>
                        </a>
                        <div class="row justify-content-center">
                            <div class="m-sm-1">
                                @if($review->status == 0)
                                @if(auth()->user()->hasRole('Update')|| auth()->user()->hasRole('Administrator'))
                                    {!! Form::open(['method' => 'PATCH' ,'route' => ['review.update',$review->id] ]) !!}

                                          <input type="hidden" value="0" name="action">
                                    {{ Form::button('Kiểm duyệt', ['class' => 'btn btn-outline-primary', 'type' => 'submit']) }}


                                    {!! Form::close() !!}
                                    @endif
                                @else
                                    @if(auth()->user()->hasRole('Delete')|| auth()->user()->hasRole('Administrator'))
                                        {!! Form::open(['method' => 'DELETE' ,'route' => ['review.destroy',$review->id] ]) !!}

                                        {{ Form::button('Xóa đánh giá', ['class' => 'btn btn-outline-danger', 'type' => 'submit']) }}

                                        {!! Form::close() !!}
                                    @endif
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection


