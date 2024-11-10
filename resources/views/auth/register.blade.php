<!DOCTYPE html>
<html lang="en" data-layout="horizontal" data-topbar-color="dark">

<head>
    <meta charset="utf-8" />
    <title>Register & Signup | Carka Niskala</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('ubold/assets/images/favicon-cn.png')}}">

    <!-- third party css -->
    <link href="{{asset('ubold/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('ubold/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('ubold/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('ubold/assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->

    <!-- Plugins css -->
    <link href="{{asset('ubold/assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('ubold/assets/libs/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css" />

    <!-- Theme Config Js -->
    <script src="{{asset('ubold/assets/js/head.js')}}"></script>

    <!-- Bootstrap css -->
    <link href="{{asset('ubold/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- App css -->
    <link href="{{asset('ubold/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Icons css -->
    <link href="{{asset('ubold/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />


    <link rel="stylesheet" type="text/css" href="{{asset('tables/css/datatable/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('tables/css/datatable/responsive.bootstrap4.min.css')}}">


    <link rel="stylesheet" href="{{asset('lib/charts/css/chart-apex.css')}}">
    <link rel="stylesheet" href="{{asset('lib/charts/css/apexcharts.css')}}">


    <link rel="stylesheet" type="text/css" href="{{asset('lib/bootstrap-fileinput/css/fileinput.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('lib/font-awesome/css/font-awesome.min.css')}}">

    {{-- <link rel="stylesheet" type="text/css" href="{{asset('tables/css/pickers/flatpickr/flatpickr.min.css')}}">--}}

    <link rel="stylesheet" type="text/css" href="{{asset('lib/select2/css/select2.min.css')}}">
</head>
@php
use App\Models\Group;
use App\Models\Generator\Agama;
use App\Models\Generator\Category;
use App\Models\Generator\Sabuk;
use App\Models\Generator\Unlat;
$group = Group::all();
$agama = Agama::all();
$kategori = Category::all();
$sabuk = Sabuk::all();
$unlat = Unlat::all();
@endphp

<body class="authentication-bg authentication-bg-pattern">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-12">
                    <div class="card bg-pattern">

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <div class="auth-brand text-center text-lg-start">
                                    <div class="auth-brand">
                                        <a href="{{ route('register') }}" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <img src="{{asset('ubold/assets/images/logo-dark-cn.png')}}" alt="" height="22">
                                            </span>
                                        </a>

                                        <a href="{{ route('register') }}" class="logo logo-light text-center">
                                            <span class="logo-lg">
                                                <img src="{{asset('ubold/assets/images/logo-light-cn.png')}}" alt="" height="22">
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <p class="text-muted mb-4 mt-3">Silahkan isi data diri dengan benar.</p>
                                @if ($errors->has('nik'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('nik') }}
                                </div>
                                @endif

                            </div>

                            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="user-name">Nama Lengkap</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" required data-validation-required-message="Harap Masukkan Nama Lengkap">
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="nik">NIK</label>
                                            <div class="controls">
                                                <input type="number" class="form-control" id="nik" name="nik" placeholder="NIK" required data-validation-required-message="Harap Masukkan NIK" pattern="\d{16}" title="NIK harus terdiri dari 16 digit angka">
                                            </div>
                                        </fieldset>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" required data-validation-required-message="Harap Masukkan Tempat Lahir">
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="tgl_lahir">Tanggal Lahir</label>
                                            <div class="controls">
                                                <input type="date" class="form-control" name="tgl_lahir" required>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>


                                <fieldset class="form-group floating-label-form-group">
                                    <label for="alamat">Alamat Lengkap</label>
                                    <div class="controls">
                                        <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat Lengkap" required data-validation-required-message="Harap Masukan Alamat Lengkap"></textarea>
                                    </div>
                                </fieldset>

                                <fieldset class="form-group floating-label-form-group">
                                    <label for="no_hp">No. Hp</label>
                                    <div class="controls">
                                        <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Nomor HP" required data-validation-required-message="Harap Masukan Nomor HP">
                                    </div>
                                </fieldset>

                                <div class="row">
                                    <div class="col-md-6">
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="group">Jabatan</label>
                                            <div class="controls">
                                                <select class="select2 form-control form-control-lg" id="group" name="group_id" style="padding:10px !important;" required data-validation-required-message="Harap Masukkan Email">
                                                    <option value="" selected disabled>Pilih Jabatan</option>
                                                    @foreach($group as $item)
                                                    @if($item->name === 'Anggota' || $item->name === 'Pengurus/Pelatih' || $item->name === 'Anggota Kehormatan')
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="agama">Agama</label>
                                            <div class="controls">
                                                <select class="select2 form-control form-control-lg" id="agama_id" name="agama_id" style="padding:10px !important;" required data-validation-required-message="Harap Masukkan Email">
                                                    <option value="" selected disabled>Pilih Agama</option>
                                                    @foreach($agama as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>


                                <!-- <div class="row">
                                    <div class="col-md-6">
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="kategori">Kategori</label>
                                            <div class="controls">
                                                <select class="select2 form-control form-control-lg" id="kategori" name="kategori_id" style="padding:10px !important;">
                                                    <option value="" selected disabled>Pilih Kategori</option>
                                                    @foreach($kategori as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="sabuk">Sabuk</label>
                                            <div class="controls">
                                                <select class="select2 form-control form-control-lg" id="sabuk" name="sabuk_id" style="padding:10px !important;">
                                                    <option value="" selected disabled>Pilih Sabuk</option>
                                                    @foreach($sabuk as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div> -->




                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- <fieldset class="form-group floating-label-form-group">
                                            <label for="email">Email</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" required data-validation-required-message="Harap Masukkan Email">
                                            </div>
                                        </fieldset> -->
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="unlat">Unlat</label>
                                            <div class="controls">

                                                <select class="select2 form-control form-control-lg" id="unlat" name="unlat_id" style="padding:10px !important;" required>
                                                    <option value="" selected disabled>Pilih Unlat</option>
                                                    @foreach($unlat as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach

                                                </select>

                                            </div>
                                        </fieldset>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="user-name">User Name</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" id="username" name="username" placeholder="User Name" required data-validation-required-message="Harap Masukkan Username">
                                            </div>
                                        </fieldset>
                                    </div> -->
                                </div>


                                <div class="row">
                                    <input type="hidden" name="password" id="password" value="123123">
                                    <input type="hidden" name="confirm_password" value="123123">
                                    <!-- <div class="col-md-6">
                                        <fieldset class="form-group floating-label-form-group mb-1">
                                            <label for="user-password">Enter Password</label>
                                            <div class="controls">
                                                <input type="password" name="password" id="password" class="form-control" required data-validation-required-message="Harap Masukkan Password" placeholder="Enter Password">
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="form-group floating-label-form-group mb-1">
                                            <label for="user-password">Confirm Password</label>
                                            <div class="controls">
                                                <input type="password" data-validation-match-match="password" class="form-control mb-1" placeholder="Re-type Password" required>
                                            </div>
                                        </fieldset>
                                    </div> -->
                                </div>

                                <div class="row">
                                    <fieldset class="form-group floating-label-form-group mb-1">
                                        <label for="user-name">Foto Memakai Seragam (Hanya Foto)</label>
                                        <input type="file" class="files" id="avatar" name="avatar" accept=".jpg,.png,.svg" required>
                                    </fieldset>

                                    <!-- <fieldset class="form-group floating-label-form-group">
                                        <label for="user-name">Foto Ijazah/Akte Kelahiran (Hanya Foto)</label>
                                        <input type="file" class="files" id="dokument" name="dokument" accept=".jpg,.png,.svg">
                                    </fieldset> -->
                                </div>

                                </br>
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-white-50">Sudah Punya Akun? <a href="{{ route('login') }}" class="text-white ms-1"><b>Log In</b></a></p>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <script>
        function resetFileInput() {
            $('#fileUpload').fileinput('destroy');
        }

        function makeInput(value) {
            $('#fileUpload').fileinput('destroy');

            if (value) {
                let url = "{{asset('storage/images/')}}" + '/' + `${value}`
                let filename = value.split('/')[1];
                $("#fileUpload").fileinput({
                    'showUpload': false,
                    theme: 'fa',
                    showClose: false,
                    showMove: false,
                    initialPreviewConfig: [{
                        caption: `${filename}`,
                        downloadUrl: url,
                        key: 1
                    }],
                    initialPreview: url,
                    initialPreviewAsData: true,
                    layoutTemplates: {
                        progress: '',
                        remove: ''
                    },
                    allowedFileExtensions: ["jpg", "png", "gif"],
                    initialPreviewShowDelete: false,
                    //{{--deleteUrl: '{{route('file_delete')}}',--}}
                    elErrorContainer: '#kartik-file-errors',
                });

                $(".glyphicon").removeClass("glyphicon-download").removeClass('glyphicon').addClass('fa fa-download');

            } else {
                $("#fileUpload").fileinput({
                    'showUpload': false,
                    theme: 'fa',
                    'previewFileType': 'any',
                    fileActionSettings: {
                        showDrag: false,
                    },
                    allowedFileExtensions: ['jpg', 'gif', 'png', 'jpeg'],
                    initialPreviewAsData: true,
                    layoutTemplates: {
                        progress: '',
                        remove: ''
                    },
                    initialPreviewShowDelete: true
                        //, deleteUrl: '{{route('file_delete')}}'
                        ,
                    elErrorContainer: '#kartik-file-errors',
                });
            }
        }
    </script>
    <!-- <script src="{{asset('ubold/assets/js/pages/authentication.init.js')}}"></script> -->
    <!-- Vendor js -->
    <script src="{{asset('ubold/assets/js/vendor.min.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('ubold/assets/js/app.min.js')}}"></script>

    <!-- Plugins js-->
    <script src="{{asset('ubold/assets/libs/flatpickr/flatpickr.min.js')}}"></script>
    <!-- <script src="{{asset('ubold/assets/libs/apexcharts/apexcharts.min.js')}}"></script> -->
    <script src="{{asset('ubold/assets/libs/selectize/js/standalone/selectize.min.js')}}"></script>

    <!-- third party js -->
    <script src="{{asset('ubold/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('ubold/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('ubold/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('ubold/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>
    <script src="{{asset('ubold/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('ubold/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>
    <script src="{{asset('ubold/assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('ubold/assets/libs/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('ubold/assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('ubold/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('ubold/assets/libs/datatables.net-select/js/dataTables.select.min.js')}}"></script>
    <script src="{{asset('ubold/assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('ubold/assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
    <!-- third party js ends -->

    <!-- Datatables init -->
    <!-- <script src="{{asset('ubold/assets/js/pages/datatables.init.js')}}"></script> -->

    <!-- Dashboar 1 init js-->
    <!-- <script src="{{asset('ubold/assets/js/pages/dashboard-1.init.js')}}"></script> -->

    <!-- jquery-validation Js -->

    <script src="{{asset('lib/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('lib/form/form-validation.js')}}"></script>
    <script src="{{asset('lib/sweetalert2/sweetalert2.js')}}"></script>

    <!-- JS Front -->
    <script src="{{asset('tables/js/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('tables/js/datatable/datatables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('tables/js/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('tables/js/datatable/responsive.bootstrap4.js')}}"></script>
    <script src="{{asset('js/core.js')}}"></script>

    <script src="{{asset('lib/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('lib/select2/js/form-select2.js')}}"></script>

    <script src="{{asset('lib/bootstrap-fileinput/js/fileinput.js')}}"></script>
    <script src="{{asset('lib/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('lib/fa-theme/theme.js')}}"></script>
    <script src="{{asset('lib/charts/js/chart-apex.js')}}"></script>
    <script src="{{asset('lib/charts/js/apexcharts.js')}}"></script>

</body>

</html>