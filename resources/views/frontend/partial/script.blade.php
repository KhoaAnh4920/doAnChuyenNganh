<script src="{{asset('public/frontend/js/jquery.js')}}"></script>
<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('public/frontend/js/price-range.js')}}"></script>
<script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('public/frontend/js/main.js')}}"></script>
<script src="{{asset('public/frontend/js/lightslider.js')}}"></script>
<script src="{{asset('public/frontend/js/lightgallery-all.min.js')}}"></script>
<script src="{{asset('public/frontend/js/prettify.js')}}"></script>

<!-- Hiện modal form thành công  -->

@if(!empty(Session::get('error_code')))
<script>
$(function() {
    $('#ignismyModal').modal('show');
});
</script>

@endif

<!-- <script type="text/javascript">
    load_more_product();
    function load_more_product(id = ''){
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
                url:'{{url('/load_more_product')}}',
                method:"POST",

                data:{id:id,_token:_token},
                success:function(data){
                    $('#load_more_button').remove();
                    $('#all_product').append(data);
                   
                }

        }); 
    }
    $(document).on('click','#load_more_button' ,function () {
        var id = $(this).data('id');
        load_more_product(id);
    });
</script> -->

<!-- <script type="text/javascript">
    $(document).ready(function(){
      
            var cate_id = $('.tabs_pro').data('id');
            var _token = $('meta[name="csrf-token"]').attr('content');
     
            $.ajax({
                url:'{{url('/product-tabs')}}',
                method:"POST",
                data:{cate_id:cate_id,_token:_token},
                success:function(data){
                    $('#tabs_product').html(data);
                   
                }

            });      
        $('.tabs_pro').click(function(){

            var cate_id = $(this).data('id');
        
            var _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url:'{{url('/product-tabs')}}',
                method:"POST",  
                data:{cate_id:cate_id,_token:_token},

                success:function(data){
                    $('#tabs_product').html(data);
                }

            }); 

        });
        
    });
    
</script> -->
<script type="text/javascript"> 
$(document).ready(function() {
    $('#imageGallery').lightSlider({
        gallery:true,
        item:1,
        loop:true,
        thumbItem:3,
        slideMargin:0,
        enableDrag: false,
        currentPagerPosition:'left',
        onSliderLoad: function(el) {
            el.lightGallery({
                selector: '#imageGallery .lslide'
            });
        }   
    });  
  });
</script>


<!-- <script>
function myFunction() {
  var x = document.getElementById("cf30671f83af9a4129b3585fe6c58297").value;
 
  alert(x);
}
</script> -->
