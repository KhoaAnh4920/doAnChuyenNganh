<script src="{{asset('public/backend/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('public/backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('public/backend/js/ruang-admin.min.js')}}"></script>
<script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('public/backend/vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('public/backend/js/demo/chart-area-demo.js')}}"></script>

<!-- Show ckeditor  -->
<script>
CKEDITOR.replace('ckeditor_addProduct');
CKEDITOR.replace('ckeditor_editProduct');
</script>

<!-- Hiện modal form thành công  -->

<!-- @php session()->forget('error_code'); @endphp -->


@if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
<script>
$(function() {
    $('#ignismyModal').modal('show');
});
</script>
@endif

<script language="javascript">
function ChangeToSlug() {
    var title, slug;

    //Lấy text từ thẻ input title 
    title = document.getElementById("title_slug").value;

    //Đổi chữ hoa thành chữ thường
    slug = title.toLowerCase();

    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    //In slug ra textbox có id “slug”
    document.getElementById('convert_slug').value = slug;
}
</script>

 <!-- Load danh mục hình sản phẩm  -->
<script type="text/javascript">
// load_gallery();


// function load_gallery() {
//     var pro_id = $('.pro_id').val();
//     var _token = $('meta[name="csrf-token"]').attr('content');
//     $.ajax({
//         url: "{{url('/hien-thi-danh-muc-hinh')}}",
//         method: "POST",
//         data: {
//             pro_id: pro_id,
//             _token: _token
//         },
//         success: function(data) {
//             $('#gallery_load').html(data);
//         }
//     });
// }

$('#file').change(function() {
    var error = '';
    var files = $('#file')[0].files;
    console.log(files);
    exit;

    if (files.length > 5) {
        error += '<p>Bạn chọn tối đa chỉ được 5 ảnh</p>';
    } else if (files.length == '') {
        error += '<p>Bạn không được bỏ trống ảnh</p>';
    } else if (files.size > 2000000) {
        error += '<p>File ảnh không được lớn hơn 2MB</p>';
    }

    if (error == '') {

    } else {
        $('#file').val('');
        $('#error_gallery').html('<span class="text-danger">' + error + '</span>');
        return false;
    }

});

// Sự kiện sửa lại ảnh // 
$(document).on('change', '.file_image', function() {

    var gal_id = $(this).data('gal_id');
    var image = document.getElementById("file-" + gal_id).files[0];

    var form_data = new FormData();

    form_data.append("file", document.getElementById("file-" + gal_id).files[0]);
    form_data.append("gal_id", gal_id);



    $.ajax({
        url: "{{url('/update-gallery')}}",
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: form_data,

        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            load_gallery();
            $('#error_gallery').html(
                '<span class="text-danger">Sửa hình ảnh thành công</span>');
        }
    });

});
</script>

<script type="text/javascript">
$('.update_quantity_order').click(function() {
    var order_product_id = $(this).data('product_id'); // Mã sản phẩm của đơn hàng
    var order_id = $('.order_code').val(); // Mã đơn hàng // 
    var order_qty = $('.order_qty_' + order_product_id).val(); // Số lượng sản phẩm của đơn hàng //

    var _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '{{url(' / update - qty - product ')}}',

        method: 'POST',

        data: {
            _token: _token,
            order_product_id: order_product_id,
            order_qty: order_qty,
            order_id: order_id
        },
        // dataType:"JSON",
        success: function(data) {
            $('#ignismyModal').modal('show');
        }
    });


});
</script>
<script>
function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#blah')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
    console.log(input.files.length);
}

// function previewImages() {

//     var preview = document.querySelector('#preview');

//     if (this.files) {
//         [].forEach.call(this.files, readAndPreview);
//     }

//     function readAndPreview(file) {

//         // Make sure `file.name` matches our extensions criteria
//         if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
//             return alert(file.name + " is not an image");
//         } // else...

//         var reader = new FileReader();

//         reader.addEventListener("load", function() {
//             var image = new Image();
//             image.width = 100;
//             image.src = this.result;
//             preview.appendChild(image);
//         });

//         reader.readAsDataURL(file);

//     }

// }

//document.querySelector('#file-input').addEventListener("change", previewImages);
</script>

<script>
$(document).ready(function() {

    if (window.File && window.FileList && window.FileReader) {
        $("#files").on("change", function(e) {
            //alert("ok");
            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                    var file = e.target;
                    //   $("<span class=\"pip\">" +
                    //     "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                    //     "<br/><span class=\"remove\">Remove image</span>" +
                    //     "</span>").insertAfter("#preview");

                    $("#preview").append("<span class=\"pip\">" +
                        "<img class=\"imageThumb\" src=\"" + e.target.result + "\"/>" +
                        "<br/><span class=\"remove\">Xóa</span>" +
                        "</span>");
                    $(".remove").click(function() {
                        $(this).parent(".pip").remove();
                    });
                });
                fileReader.readAsDataURL(f);
            }
        });
    } else {
        alert("Your browser doesn't support to File API")
    }
});
</script>

<script>
$(document).ready(function() {
    var gal_del = [];
    $(".removeDefault").click(function() {
        //alert('bbb');
        var gal_id = $(this).data('gal_id');
        gal_del.push(gal_id);
        //alert(gal_del.toString());
        $(this).parent(".pip").remove();

        //ajax call 
        var _token = $('meta[name="csrf-token"]').attr('content');


        $.ajax({
            url: "{{url('/set-gallerySession')}}",
            method: 'POST',
            data: {
                gal_del: gal_del,
                _token: _token
            }
        });
    });


});
</script>