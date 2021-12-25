<!DOCTYPE html>
<html lang="en">

<head>

    <title>@yield('title')</title>
    @include('backend.partial.head')
    {{--Styles custom--}}
    @yield('styles')
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        @include("backend.partial.sidebar")
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                @include("backend.partial.header")
                <!-- Topbar -->

                <!-- Container Fluid-->
                @yield('content')


                @include('sweet::alert')

                

                <!-- @if(!empty(Session::get('message')))
                @php Session::put('message', null); @endphp
            @endif -->

                <!--Model Popup ends-->

                <!-- Modal Logout -->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to logout?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-primary"
                                    data-dismiss="modal">Cancel</button>
                                <a href="{{URL::to('/logoutAdmin.html')}}" class="btn btn-primary">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            @include("backend.partial.footer")
            <!-- Footer -->
        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!--Start script-->
    @include('backend.partial.script')
    <!--End script-->
</body>

</html>