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
CKEDITOR.replace('ckeditor_addContentNews');
CKEDITOR.replace('ckeditor_addDescNews');
CKEDITOR.replace('ckeditor_addSliderDesc');
</script>


<!-- Convert chuỗi tên, tiêu đề thành slug  -->
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


<script>
function readURL(input) {

    // FileReader đọc dữ liệu từ input file //
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        // Xử lý cho sự kiện load
        reader.onload = function(e) {
            $('#blah')
                .attr('src', e.target.result);
            // add data vào src img
            // thiết lập thuộc tính src và gán bằng dữ liệu data base64 của reader result
        };
        // Tiến hành đọc file bằng phương thức readAsDataURL, fileReader.result sẽ là một URL đại diện cho dữ liệu đọc được.
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<script>
$(document).ready(function() {

    //kiem tra trinh duyet co ho tro File API
    if (window.File && window.FileList && window.FileReader) {
        $("#files").on("change", function(e) {
            // lấy thông tin của file đã tải lên bằng property event.target.files
            var files = e.target.files,
                filesLength = files.length; // Lấy số lượng file//
            // Kiểm tra số lượng hình ảnh //
            if(filesLength > 5){
                var error = '<p>Chỉ được chọn tối đa 5 ảnh</p>';
                $('#error_gallery').html('<span class="text-danger">' + error + '</span>');
                return false;   
            }
                
            for (var i = 0; i < filesLength; i++) {
                var f = files[i]
                var fileReader = new FileReader();
                //onload được kích hoạt khi quá trình đọc kết thúc thành công
                fileReader.onload = (function(e) {
                    // e là event của kết quả fileReader.readAsDataURL(f);

                    $("#preview").append("<span class=\"pip\">" +
                        "<img class=\"imageThumb\" src=\"" + e.target.result + "\"/>" +
                        "<br/><span class=\"remove\">Xóa</span>" +
                        "</span>");
                    $(".remove").click(function() {
                        $(this).parent(".pip").remove();
                    });
                });
                // Tiến hành đọc file bằng phương thức readAsDataURL, fileReader.result sẽ là một URL đại diện cho dữ liệu đọc được.
                fileReader.readAsDataURL(f);
            }
        });
    } else {
        alert("Your browser doesn't support to File API")
    }
});
</script>

<!-- Sự kiện khi người dùng click nút xóa hình ảnh trong danh mục hình của sản phẩm -->
<script>
$(document).ready(function() {
    var gal_del = []; // Khai báo mảng gal_del chứa id của hình ảnh mà người dùng click xóa //
    $(".removeDefault").click(function() {
        //alert('bbb');
        // Gán id hình vào biến gal_id
        var gal_id = $(this).data('gal_id');
        gal_del.push(gal_id); // Gán biến gal_id vào mảng gal_del
        // Xóa preview của hình ảnh //
        $(this).parent(".pip").remove();

        //ajax call truyenf vào id của các hình ảnh và token để gán vào session //
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