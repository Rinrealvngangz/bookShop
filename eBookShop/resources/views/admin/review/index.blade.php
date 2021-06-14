@extends('layouts.main')

@section('name')
    <h1>Đánh giá</h1>
@endsection
@section('root')
    <a href="{{route('admin.index')}}">
        App
    </a>

@endsection
@section('model')
    Đánh giá
@endsection

@section('content')

    <div class="col-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom d-flex justify-content-between">
                <h2>Đánh giá</h2>
            </div>
            <div class="card-body">
                <div class="basic-data-table">

                    <table id="basic-data-table" class="table nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>Review ID</th>
                            <th>Sản phẩm</th>
                            <th>Name reviewer</th>
                            <th class="d-none d-lg-table-cell">Review Date</th>
                            <th>Number star</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ratings as $item)

                            <tr>
                                <td>{{$item->id}}</td>
                                <td>   <a href="{{route('book.show',$item->book->id)}}">{{$item->book->title}}</a></td>
                                <td >
                                    <a href="{{route('review.show',$item->id)}}">{{$item->customerReview}}</a>
                                </td>
                                <td class="d-none d-lg-table-cell">{{$item->created_at}}</td>
                                <td>{{$item->numberRating}}</td>
                                <td>{{$item->descRating}}</td>
                                <td>
                                    @if($item->status === 0)
                                        <span class="badge badge-danger">Chưa kiểm duyệt</span>
                                    @else
                                        <span class="badge badge-success">Đã kiểm duyệt</span>
                                    @endif
                                </td>

                                @if(auth()->user()->hasDirectPermission('Update')||auth()->user()->hasRole('Administrator'))
                                    {!! Form::open(['method' => 'PATCH' ,'route' => ['review.update',$item->id] ]) !!}
                                <td>

                                        <select class="form-select"  name="action">
                                            <option class="badge badge-info" value="0">Chấp nhận</option>
                                            <option class="badge badge-warning" value="1">Ẩn nội dung</option>
                                        </select>


                                </td>
                                <td>
                                        <button  class="mb-1 btn btn-sm btn-primary" type="submit">Save</button>

                                </td>
                                {!! Form::close() !!}
                                @endif

                                <td>
                                    @if(auth()->user()->hasDirectPermission('Delete')||auth()->user()->hasRole('Administrator'))
                                        {!! Form::open(['method' => 'DELETE' ,'route' => ['review.destroy',$item->id] ]) !!}
                                        <button  class="mb-1 btn btn-sm btn-danger" type="submit">Delete</button>
                                        {!! Form::close() !!}
                                    @endif

                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection

