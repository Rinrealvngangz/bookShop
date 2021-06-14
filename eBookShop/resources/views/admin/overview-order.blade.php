@extends('layouts.main')

@section('overview-order')
<div class="row">
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="media widget-media p-4 bg-white border">
            <div class="icon rounded-circle mr-4 bg-info">
                <i class="mdi mdi-cart-outline text-white "></i>
            </div>
            <div class="media-body align-self-center">
                <h4 class="text-primary mb-2">{{$overviewOrderModel->getAmountAccepted()}}</h4>
                <p>Accepted</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="media widget-media p-4 bg-white border">
            <div class="icon rounded-circle bg-warning mr-4">
                <i class="mdi mdi-rotate-left text-white "></i>
            </div>
            <div class="media-body align-self-center">
                <h4 class="text-primary mb-2">{{$overviewOrderModel->getAmountWaitingAccepted()}}</h4>
                <p>Waiting accepted</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="media widget-media p-4 bg-white border">
            <div class="icon rounded-circle mr-4 bg-secondary">
                <i class="mdi mdi-truck-delivery text-white "></i>
            </div>
            <div class="media-body align-self-center">
                <h4 class="text-primary mb-2">{{$overviewOrderModel->getAmountWaitingDelivery()}}</h4>
                <p>Waiting delivery</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="media widget-media p-4 bg-white border">
            <div class="icon bg-success rounded-circle mr-4">
                <i class="mdi mdi-diamond text-white "></i>
            </div>
            <div class="media-body align-self-center">
                <h4 class="text-primary mb-2">{{$overviewOrderModel->getAmountSuccess()}}</h4>
                <p>Successfully delivered</p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <!-- Recent Order Table -->
        <div class="card card-table-border-none" id="recent-orders">
            <div class="card-header justify-content-between">
                <h2>Recent Orders</h2>
                <div class="date-range-report ">
                    <span></span>
                </div>
            </div>
            <div class="card-body pt-0 pb-5">
                <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th class="d-none d-lg-table-cell">City</th>
                        <th class="d-none d-lg-table-cell">Order Date</th>
                        <th class="d-none d-lg-table-cell">Order Cost</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($overviewOrderModel->getListRecentOrders() as $item)
                    <tr id="sid{{$item->getId()}}">
                        <td>{{$item->getId()}}</td>
                        <td >
                            <a class="text-dark" href="{{route('order.orderShow',[$item->getId(),$item->getUserId()])}}">{{$item->getFullName()}}</a>
                        </td>
                        <td class="d-none d-lg-table-cell">{{$item->getCity()}}</td>
                        <td class="d-none d-lg-table-cell">{{$item->getCreate_at()}}</td>
                        <td class="d-none d-lg-table-cell">${{$item->getTotalPrice()}}</td>
                        <td>
                            @if($item->getStatus() === "Waiting accepted")
                                <span class="badge badge-warning">{{$item->getStatus()}}</span>
                            @elseif($item->getStatus() === "Waiting delivery")
                                <span class="badge badge-secondary">{{$item->getStatus()}}</span>
                            @elseif($item->getStatus() === "Successfully delivered")
                                <span class="badge badge-success">{{$item->getStatus()}}</span>
                            @elseif($item->getStatus() === "Accepted")
                                <span class="badge badge-info">{{$item->getStatus()}}</span>
                            @else
                                <span class="badge badge-danger">{{$item->getStatus()}}</span>
                            @endif
                        </td>
                        <td class="text-right">
                            <div class="dropdown show d-inline-block widget-dropdown">
                                <a class="dropdown-toggle icon-burger-mini" href="" role="button" id="dropdown-recent-order1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order1">
                                    <li class="dropdown-item">
                                        <a href="{{route('order.orderShow',[$item->getId(),$item->getUserId()])}}">View</a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a type="button" data-value="{{$item->getId()}}" onclick="removeOrder(this)" >Remove</a>
                                    </li>
                                </ul>
                            </div>
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
@section('script')

@endsection
