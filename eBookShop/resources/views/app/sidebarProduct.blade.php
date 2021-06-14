<div class="left-sidebar">
    <h2>Thể Loại Sách</h2>
    <div class="panel-group category-products" id="accordian"><!--category-productsr-->

        @foreach($products->getListCategory() as $item)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <input type="hidden" name="parent-name" value="{{$item->getId()}}">
                        <a id="category" data-name="{{$item->getTitleSlug()}}" data-value="{{$item->getId()}}"
                           href='http://127.0.0.1:8000/product/{{$item->getTitleSlug()}}/{{$item->getId()}}'>

                            {{$item->getName()}}
                        </a>
                        <span id="span-collapse"  data-toggle="collapse" data-parent="#accordian" href="#{{$item->getId()}}" class="badge pull-right"><i class="fa fa-plus"></i></span>
                    </h4>
                </div>


                <div id="{{$item->getId()}}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @foreach($item->getChilds() as $child)
                                <li> <a id="category" data-name="{{$child->getTitleSlug()}}"
                                        data-value="{{$child->getId()}}"  href='http://127.0.0.1:8000/product/{{$item->getTitleSlug()}}/{{$item->getId()}}/{{$child->getTitleSlug()}}/{{$child->getId()}}'>

                                        {{$child->getName()}}
                                    </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>


            </div>
        @endforeach


    </div><!--/category-products-->

    <div class="brands_products formality_sidebar"><!--brands_products-->
        <h2>Hình Thức</h2>
        <div class="brands-name">
            <ul class="nav nav-pills nav-stacked">
                <li><a id="category"  data-name="{{$products->getpathName()}}" data-sort="biaMem"  data-type="sortFormality"
                        data-value="{{$products->getpathId()}}" href="{{route('home.product',['category'=>$products->getpathName(),'id'=>$products->getpathId(),'sortFormality'=>'biaMem'])}}" >
                        <span class="pull-right"></span>Bìa Mềm</a>

                </li>
                <li><a id="category"  data-name="{{$products->getpathName()}}" data-sort="biaCung"  data-type="sortFormality"
                         data-value="{{$products->getpathId()}}" href="{{route('home.product',['category'=>$products->getpathName(),'id'=>$products->getpathId(),'sortFormality'=>'biaCung'])}}"> <span class="pull-right"></span>Bìa Cứng</a></li>
            </ul>
        </div>
    </div><!--/brands_products-->
    <div class="brands_products sort_sidebar"><!--brands_products-->
        <h2>Sắp xếp theo</h2>
        <div class="brands-name">
            <ul class="nav nav-pills nav-stacked">
                <li><a id="category" data-name="{{$products->getpathName()}}" data-sort="gia-cao" data-type="sort"
                       data-value="{{$products->getpathId()}}" href="{{route('home.product',['category'=>$products->getpathName(),'id'=>$products->getpathId(),'sort'=>'gia-cao'])}}">
                        <span class="pull-right"></span>Giá cao</a></li>
                <li><a id="category" data-name="{{$products->getpathName()}}" data-sort="gia-thap" data-type="sort"
                       data-value="{{$products->getpathId()}}" href="{{route('home.product',['category'=>$products->getpathName(),'id'=>$products->getpathId(),'sort'=>'gia-thap'])}}" >
                        <span class="pull-right"></span>Giá rẽ</a>
                </li>
                <li><a id="category" data-name="{{$products->getpathName()}}" data-sort="ten-giam" data-type="sortname"
                       data-value="{{$products->getpathId()}}" href="{{route('home.product',['category'=>$products->getpathName(),'id'=>$products->getpathId(),'sortname'=>'ten-giam'])}}">
                        <span class="pull-right"></span>Giảm theo tên sách</a>
                </li>
                <li><a  id="category" data-name="{{$products->getpathName()}}" data-sort="ten-tang"  data-type="sortname"
                        data-value="{{$products->getpathId()}}" href="{{route('home.product',['category'=>$products->getpathName(),'id'=>$products->getpathId(),'sortname'=>'ten-tang'])}}" >
                        <span class="pull-right"></span>Tăng theo tên sách</a></li>
            </ul>
        </div>
    </div><!--/brands_products-->


</div>
