<script src={{asset("assets/plugins/jquery/jquery.min.js")}}></script>
<script src={{asset("assets/plugins/slimscrollbar/jquery.slimscroll.min.js")}}></script>
<script src={{asset("assets/plugins/jekyll-search.min.js")}}></script>
<script src={{asset("assets/plugins/charts/Chart.min.js")}}></script>
<script src={{asset("assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js")}}></script>
<script src={{asset("assets/plugins/jvectormap/jquery-jvectormap-world-mill.js")}}></script>
<script src={{asset("assets/plugins/daterangepicker/moment.min.js")}}></script>
<script src={{asset("assets/plugins/daterangepicker/daterangepicker.js")}}></script>
<script src={{asset("assets/plugins/toastr/toastr.min.js")}}></script>
<script src={{asset("assets/js/sleek.bundle.js")}}></script>
<script src={{asset("assets/plugins/data-tables/jquery.datatables.min.js")}}></script>
<script src={{asset("assets/plugins/data-tables/datatables.bootstrap4.min.js")}}></script>
<script src={{asset("assets/plugins/jquery-mask-input/jquery.mask.min.js")}}></script>
<script src={{asset("assets/plugins/select2/js/select2.full.min.js")}}></script>
<script src={{asset("assets/plugins/treeview/gijgo.min.js")}}></script>
<script src={{asset("assets/plugins/sweet-alert/sweetalert2.min.js")}}></script>


<script src="{{asset("https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js")}}"></script>
<script src="{{asset("https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js")}}"></script>
<script src="{{asset("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js")}}"></script>
<script src={{asset("assets/plugins/slider/unslider.js")}}></script>
<script src={{asset("assets/plugins/fileInput/fileInput.js")}}></script>
<script src={{asset("assets/plugins/fileInput/theme.js")}}></script>
<script src={{asset("assets/plugins/fileInput/explorer-fas/theme.js")}}></script>
<script src={{asset("assets/plugins/fileInput/piexif.js")}}></script>
<script src={{asset("assets/plugins/fileInput/sortable.js")}}></script>
<script src={{asset("assets/plugins/way/way.js")}}></script>
<script src="{{asset("https://js.pusher.com/7.0/pusher.min.js")}}"></script>

<script>
    $(function () {
        $(".alert").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert").slideUp(500);
        });

    });
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('a1554335c7a7b1d59640', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('cancelOrder-detail', function(result) {
        var user = result.userName;
        var userId = result.userId;
        var order =result.order;
        $htmlOrder =' <a class="learn-more" href="'+'/order/'+order.id +'/customer/'+userId+'/show'+'">xem đơn hàng<i class="fa fa-angle-right ml-2"></i></a>';
        $htmlUser = '<a class="nameOrder" href="' +'/user/'+userId+'"> <span>'+user+'</span></a>'+'<span>'+ ' đã hủy đơn đặt hàng.'+'</span>';
        $('#notification-user-order .info-user').html("");
        $('#notification-user-order .info-user').append($htmlUser);
        $('#notification-user-order .see-order').html("");
        $('#notification-user-order .see-order').append($htmlOrder);
        $('#notification-user-order').show();

    });
    channel.bind('review-detail', function(result) {
        console.log(result);
        var review = result.review;
        var titleBook =result.titleBook;
        $htmlUser = '<span>'+review.customerReview+  ' đã đánh giá ' +review.numberRating+' sao cho sách '+'<a href="http://127.0.0.1:8000/book/'+review.book_id+'">'+titleBook+'</a>'+'</span>';
        $htmlOrder =' <a class="learn-more" href="http://127.0.0.1:8000/review/'+review.id+'">xem đánh giá<i class="fa fa-angle-right ml-2"></i></a>';
        $('#notification-user-order .info-user').html("");
        $('#notification-user-order .info-user').append($htmlUser);
        $('#notification-user-order .see-order').html("");
        $('#notification-user-order .see-order').append($htmlOrder);
        $('#notification-user-order').show();
    });
    channel.bind('order-detail', function(result) {
        var user = result.user;
        var order =result.order;
        $htmlOrder =' <a class="learn-more" href="'+'/order/'+order.id +'/customer/'+user.id+'/show'+'">xem đơn hàng<i class="fa fa-angle-right ml-2"></i></a>';
        $htmlUser = '<a class="nameOrder" href="' +'/user/'+user.id+'"> <span>'+ user.lastName +" "+ user.firstName+'</span></a>'+'<span>'+ ' đã đặt đơn đặt hàng mới.'+'</span>';
        $('#notification-user-order .info-user').html("");
        $('#notification-user-order .info-user').append($htmlUser);
        $('#notification-user-order .see-order').html("");
        $('#notification-user-order .see-order').append($htmlOrder);
        $('#notification-user-order').show();

    });
    function removeNotification(){
        $('#notification-user-order').hide();

    }
    function removeOrder(item){
        $id = item.getAttribute("data-value");
        $("tr#sid"+$id).remove();
    }
</script>

<script>
    jQuery(document).ready(function() {
        jQuery('#basic-data-table').DataTable({
            "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">'
        });
    });
    $(function () {
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

    });

    $(document).ready(function(){
        // Create overlay and append to body:
        $('<div id="overlay"/>').css({
            position: 'fixed',
            display:'none',
            top: 0,
            left: 0,
            color:'#adbcbf',
            width: '100%',
            height: $(window).height() + 'px',
            opacity:0.4,
            background: '#f5f6f7 url("/images/Blocks-1s-200px.gif") no-repeat center'
        }).appendTo('#exampleModalForm');

    });

</script>

