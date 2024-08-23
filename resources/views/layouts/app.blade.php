<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Triger</title>

    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<!-- Custom styles for this template-->

<link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">


    <!-- Scripts -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>


</head>

{{-- <select onchange="location = this.value;">
    <option value="{{ url('changeLanguage', ['locale' => 'en']) }}" @if(app()->getLocale() == 'en') selected @endif>English</option>
    <option value="{{ url('changeLanguage', ['locale' => 'ar']) }}" @if(app()->getLocale() == 'ar') selected @endif>Arabic</option>
    <!-- Add more language options as needed... -->
</select>
 --}}
<body @if(app()->getLocale() == 'ar') dir="rtl" @else dir="ltr" @endif>
    <div id="app">
        <nav  class="navbar navbar-expand-md navbar-dark bg-gradient-primary text-white shadow-sm mb-3 accordion">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{__('main.dashboard')}}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <select class="form-control " onchange="location = this.value;">
                                        <option value="{{ url('locale/en') }}" @if(app()->getLocale() == 'en') selected @endif>English</option>
                                        <option value="{{ url('locale/ar') }}" @if(app()->getLocale() == 'ar') selected @endif>Arabic</option>
                                        <!-- Add more language options as needed... -->
                                    </select>
                                </a>


                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">

                                        {{ __('Logout') }}

                                    </a>

                                   {{-- old form log out --}}
                                </div>
                            </li>
                        @endguest



                    </ul>
                </div>
            </div>
        </nav>



          <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion " id="accordionSidebar">




            <!-- Sidebar - Brand -->

            <li  class="nav-item">

            <a class=" d-flex align-items-center justify-content-center nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities5">
                <div class="sidebar-brand-icon rotate-n-15">

                </div>


                @if(auth()->user()->admin == true)
                <div class="sidebar-brand-text mx-3"> Admin </div>
                @else
                <div class="sidebar-brand-text mx-3"> Agent </div>
                @endif


            </a>


            <div id="collapseUtilities5" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <a  class="collapse-item" href="#">

                        <form style="padding-bottom:20px;" id="logout-form" action="{{ route('logout') }}" method="POST" >
                            @csrf
                            <i  class="fas fa-sign-out-alt"></i>
                            <button style="margin-left: 10px;  " class="btn  btn-outline-danger " type="submit">Logout</button>
                        </form>
                    </a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif  class="nav-link" href="{{url('/')}}">
                    <i style="margin-left: 5px" class="fas fa-fw fa-tachometer-alt"></i>
                    <span >{{__('main.dashboard')}}</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div  @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif class="sidebar-heading">

                {{__('main.inquiries')}}
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif  class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i style="margin-left: 5px" class="fas fa-fw fa-cog"></i>
                    <span>{{__('main.calls')}}</span>
                </a>
                <div   id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif  class="collapse-item" href="{{url('calls')}}"> {{__('main.calls')}}</a>
                        <a @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif class="collapse-item" href="{{url('calls/create')}}">{{__('main.createRecord')}}</a>
                        <a @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif class="collapse-item" href="{{url('calls/pending')}}">{{__('main.InquiryinProgress')}}</a>
                        <a @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif class="collapse-item" href="{{url('calls/ground?ground=true')}}">{{__('main.TodaysInquiries')}}</a>
                        <a @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif class="collapse-item" href="{{url('dalyDate')}}">{{__('main.differentDay')}}</a>
                        <a @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif  class="collapse-item" href="{{url('noAnswoer')}}">{{__('main.Unanswered')}}</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i style="margin-left: 5px" class="fas fa-fw fa-wrench"></i>
                    <span>{{__('main.Delays')}}</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif class="collapse-header">{{__('main.Delays')}}</h6>
                        <a @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif class="collapse-item" href="{{url('arrears')}}">{{__('main.OverdueInquiries')}}</a>
                        <a @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif class="collapse-item" href="{{url('arrearsNoAnsower')}}">{{__('main.UnansweredDelays')}}</a>
                        <a @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif class="collapse-item" href="{{url('doneCustomer')}}">{{__('main.Inquired')}}</a>
                        <a @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif class="collapse-item" href="{{url('other')}}">{{__('main.other')}}</a>
                        <a @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif class="collapse-item" href="{{url('blanks')}}">{{__('main.blanks')}}</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif  class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i style="margin-left: 5px" class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif class="collapse-header">Login Screens:</h6>
                        <a @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif class="collapse-item" href="login.html">Login</a>
                        <a @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif class="collapse-item" href="register.html">Register</a>
                        <a @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif class="collapse-header">Other Pages:</h6>
                        <a @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif class="collapse-item" href="404.html">404 Page</a>
                        <a @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif class="nav-link" href="charts.html">
                    <i style="margin-left: 5px" class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                {{-- tables --}}
             </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            @if(app()->getLocale() == 'en')

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            @endif



        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">



                <!-- Begin Page Content -->
                <div class="container-fluid">


@yield('content')




                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>


    <script>
        function num(id){
            // اختيار عنصر الحقل النصي
            const input = document.getElementById(id);

            // إضافة حدث الإدخال للحقل النصي
            input.addEventListener('input', function() {
                // الحصول على قيمة الحقل
                const value = input.value;

                // استخدام تعبير منتظم لإزالة أي أحرف غير رقمية
                const cleanedValue = value.replace(/\D/g, '');

                // تحديث قيمة الحقل بالنص المنقى
                input.value = cleanedValue;
            });

        }
        num("number");
        num("number2");
        num("nationalid");
        num("journey");

    </script>

    <script>
            setInterval(() => {
                if($("#message_success")){
                    $(document).ready(function(){
                    $("#message_success").hide(2000,function(){
                        $("#message_success").remove();

                    });

                    });

                }

            }, 2000);



    </script>

    </div>
    <script>
            var hied = document.getElementById("hied");
            var cho = document.getElementById("cho");

            function showhiednn(){
                if( cho.value == "Cancelled" ||  cho.value == "Postponed" ||  cho.value == "Credit" ){
                   hied.style.display = "block";
                }else{
                    hied.style.display = "none";
                }
            }

    </script>

    <script>
        var code = document.getElementById("code");
        var pending = document.getElementById("pending");
        var pendinginput = document.getElementById("pendinginput");
        function codeshow(){
            if(pending.value != "" && pendinginput.value != "" ){

                code.style.display = "block";
            }else{

                code.style.display = "none";
            }
        }

    </script>
    <script>
        var code2 = document.getElementById("code2");
        var sel = document.getElementById("sel");

        function intype(){
            if(sel.value == "منزل+عمل" || sel.value == "منزل+عمل ضامن" || sel.value == "منزل مشتري+ضامن" || sel.value == "عمل مشتري+ضامن"){

                code2.style.display = "block";
            }else{

                code2.style.display = "none";
            }
        }

    </script>

<script>
    var address2 = document.getElementById("address2");
    var sel = document.getElementById("sel");

    function addresstype(){
        if(sel.value == "منزل+عمل" || sel.value == "منزل+عمل ضامن" || sel.value == "منزل مشتري+ضامن" || sel.value == "عمل مشتري+ضامن"){


            address2.style.display = "block";
        }else{

            address2.style.display = "none";
        }
    }

</script>



<script>
    $(document).ready(function() {
        $('.modal-body form').on('submit', function(event) {
            event.preventDefault(); // منع إرسال النموذج بالطريقة التقليدية

            var $form = $(this); // الحصول على النموذج الذي تم تقديمه
            var formData = $form.serialize(); // تحويل البيانات إلى سلسلة استعلام

            $.ajax({
                url: $form.attr('action'), // عنوان URL الذي يتم إرسال البيانات إليه
                method: 'POST', // طريقة الطلب
                data: formData, // البيانات المرسلة
                success: function(response) {

                    var row = $('table').find('tr[data-id="' + response.id + '"]');

                    // تحديث محتوى الصف
                    row.find('td:eq(1)').text(response.customer_name);
                    row.find('td:eq(2)').text(response.phone);
                    row.find('td:eq(3)').text(response.phone2);
                    row.find('td:eq(4)').text(response.national_id);
                    row.find('td:eq(5)').text(response.date_in);
                    row.find('td:eq(6)').text(response.date_pending);
                    row.find('td:eq(7)').text(response.date_out);
                    row.find('td:eq(8)').text(response.code);
                    row.find('td:eq(9)').text(response.code2);
                    row.find('td:eq(10)').text(response.address);
                    row.find('td:eq(11)').text(response.address2);
                    row.find('td:eq(12)').text(response.city);
                    row.find('td:eq(13)').text(response.status);
                    // إغلاق المودال
                    $('#exampleModal' + response.id).modal('hide');
                    alert('تم التحديث بنجاح!');

                },
                error: function(xhr) {
                    alert('حدث خطأ!'); // عرض رسالة خطأ
                }
            });
        });
    });
    </script>
</body>
</html>
