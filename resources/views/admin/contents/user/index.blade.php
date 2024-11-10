@extends('admin.layouts.main')
@section('title', 'User')

@section('stylesheet')
@endsection
@section('breadcumbs')
@include('admin.templates.breadcrumbs')
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">{{$menu['breadcrumbs']->name}} Table</h4>
            </div>
            <div class="col-md-6">
                @php
                $current_path = \Request::route()->getName();
                getPagesAccess($current_path);
                @endphp
            </div>
        </div>
    </div>


    <div class="card-content">
        <div class="card-body">

            <form action="" id="formFilter">

                <div class="col-md-6 pl-2 mt-2">
                    <form class="form form-horizontal" id="formFilterReport">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-sm-3 col-form-label">
                                        <label for="province_id">Nik</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="nik" name="nik" placeholder="Input Nik">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-sm-3 col-form-label">
                                        <label for="name">Nama</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Input Nama">
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="col-6">
                                <div class="form-group row">
                                    <div class="col-sm-3 col-form-label">
                                        <label for="status">Status</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" id="status" name="status">
                                            <option value="" selected disabled>Pilih Status</option>
                                            <option value="1">Aktif</option>
                                            <option value="2">Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
                            </div> -->

                            <br />
                            <br />
                            <br />

                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-sm-9">
                                        <button type="button" class="btn btn-success text-bold submit-download" style="float: right !important;">
                                            <span>Download</span>
                                        </button>
                                    </div>

                                    <div class="col-sm-3">

                                        <button type="button" class="btn btn-primary text-bold submit-filter" style="float: right !important;">
                                            Filter
                                        </button>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>


                </div>

            </form>
            <div class="card-datatable table-responsive">
                <table id="contentTable" class="js-datatable table table-thead-bordered table-nowrap table-align-middle card-table table-striped table-hover" style="width:100%">
                    <thead class="thead-light">
                        <tr class="table100-head">
                            <th width="3%" class="text-center">No</th>
                            <th>Nama Lengkap</th>
                            <th>Profile</th>
                            <th>Dokument</th>
                            <th>Username</th>
                            <th>Kode Anggota</th>
                            <!-- <th>Email</th> -->
                            <th>Group</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">{{$menu['breadcrumbs']->name}} Table</h4>
                <p class="text-muted font-13 mb-4">
                    @php
                    $current_path = \Request::route()->getName();
                    getPagesAccess($current_path);
                    @endphp
                </p>

                <table id="contentTable" class="table dt-responsive nowrap w-100">
                    <thead class="thead-light">
                        <tr class="table100-head">
                            <th width="3%" class="text-center">No</th>
                            <th>Username</th>
                            <th>Fullname</th>
                            <th>Group</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div> -->
@include('admin.contents.user._modal')

@endsection

@section('script')

<script type="text/javascript">
    var url = {
        detail: "{{route('dashboard_user_detail')}}",
        delete: "{{route('dashboard_user_delete')}}",
        submit: "{{route('dashboard_user_post')}}",
        table: "{{route('dashboard_user_table')}}",
        generate_user_code: "{{route('dashboard_request_user_register_generate_code')}}"
    };
    var table;

    // $(document).on('change', '#status', function(e) {
    //     if ($(this).prop("checked")) {
    //         $(this).val('1');
    //     } else {
    //         $(this).val('0');
    //     }
    //     console.log($(this).val());
    // })

    // $(document).on('change', '#status', function(e) {
    //     if ($(this).prop("selected")) {
    //         $(this).val('1');
    //     } else {
    //         $(this).val('0');
    //     }
    //     console.log($(this).val());
    // })

    $(document).ready(function() {
        var CSRF_TOKEN = "{{@csrf_token()}}";
        const tglLahir = flatpickr("#tgl_lahir", {
            enableTime: false,
            dateFormat: "Y-m-d",
            required: true
        }); // flatpickr
        $(document).on('click', '.submit-filter', function(e) {
            $('#formFilter').submit();
        });
        loadDataTable();

        $('#formFilter').validate({ // initialize the plugin
            rules: {
                // termin_area: {
                //     required: true,
                // },
            },
            submitHandler: function(form) {
                let nik = $('#nik').val();
                let name = $('#name').val();
                $('#contentTable').dataTable().fnDestroy();
                loadDataTable(nik, name);
                // let data = $('#formFilter').serialize();


            }
        });


        $('.addModal').on('click', function() {
            // Lakukan AJAX request untuk flush cache
            $.ajax({
                url: '/flush-cache',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}' // Sertakan token CSRF
                },
                success: function(response) {
                    console.log('Cache flushed successfully', response);
                },
                error: function(xhr, status, error) {
                    console.error('Error flushing cache:', error);
                    console.log('XHR:', xhr); // Ini akan memberikan detail lebih tentang error
                    console.log('Status:', status);
                }
            });


            // Lanjutkan dengan fungsi lainnya
            resetFileInput();
            makeInput();
            makeInput2();
            generateUserCode();
            formReset(true);
            $(".modal").removeAttr("tabindex");

            modalShow('myModal', 'Add Data');
        });


        $(document).on('click', '.view', function(e) {
            let id = $(this).data('id');
            let code = $(this).data('code');
            e.preventDefault();
            formReset(true);
            formDisable();

            modalShow('myModal', 'View Data');
            $.get(url.detail, {
                id: id
            }, function(result) {

                let response = result.data;
                $('#fullname').val(response.fullname)
                $('#username').val(response.username)
                $('#nik').val(response.nik)
                $('#code').val(response.code)
                // $('#email').val(response.email)
                $('#no_hp').val(response.no_hp)
                $('#alamat').val(response.alamat)
                $('#tempat_lahir').val(response.tempat_lahir)
                $('#tgl_lahir').val(response.tgl_lahir)
                makeInput(response.profile_picture)
                makeInput2(response.dokument)
                $('#group').val(response.group.id).trigger('change')
                $('#unlat').val(response.unlat.id).trigger('change')
                $('#sabuk').val(response.sabuk.id).trigger('change')
                $('#kategori').val(response.kategori.id).trigger('change')
                $('#agama').val(response.agama.id).trigger('change')
                // $('#status').val(response.status).trigger('change')
                $('#status').val(response.status)
                // activeLogic(response.status, 'status')
            });

        });

        $(document).on('click', '.update', function(e) {
            let id = $(this).data('id');
            e.preventDefault();
            formReset(true);
            formEnable();
            modalShow('myModal', 'Update Data');
            $.get(url.detail, {
                id: id
            }, function(result) {
                let response = result.data;
                console.log(response);
                $('#id').val(response.id)
                $('#fullname').val(response.fullname)
                $('#username').val(response.username)
                $('#nik').val(response.nik)
                $('#code').val(response.code)
                // $('#email').val(response.email)
                $('#no_hp').val(response.no_hp)
                $('#alamat').val(response.alamat)
                $('#tempat_lahir').val(response.tempat_lahir)
                $('#tgl_lahir').val(response.tgl_lahir)
                makeInput(response.profile_picture)
                makeInput2(response.dokument)
                $('#group').val(response.group.id).trigger('change')
                $('#unlat').val(response.unlat.id).trigger('change')
                $('#sabuk').val(response.sabuk.id).trigger('change')
                $('#kategori').val(response.kategori.id).trigger('change')
                $('#agama').val(response.agama.id).trigger('change')
                // $('#status').val(response.status).trigger('change')
                $('#status').val(response.status).trigger('change.select2');
                // activeLogic(response.status, 'status')
            });

        });

        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                }
            });
            Swal.fire({
                title: `Are you sure delete ${$(this).data('name')}?`,
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                            url: url.delete,
                            method: 'GET',
                            data: {
                                id: $(this).data('id'),
                            },
                        })
                        .then((result) => {
                            Swal.fire({
                                title: 'Deleted!',
                                text: result.success,
                                icon: 'success',
                                showCancelButton: false,
                                showConfirmButton: false,
                                timer: 1000,
                            })
                        }).then(() => {
                            tableReload(table)
                        });
                }
            });
        });

        $('#confirm_password').on('keyup', function() {
            let confrim = $(this).val(),
                password = $('#password').val();

            console.log(confrim, password)

            if (password != confrim) {
                $('.invalid').removeAttr('hidden')
                $('#btn-submit').attr('hidden', true)
                // $("#btn-submit").attr('class', 'btn btn-block');

            } else {
                $('.invalid').attr('hidden', true)
                $('#btn-submit').removeAttr('hidden')
                // $("#btn-submit").attr('class', 'btn btn-outline-info');
            }
        });


        $(document).on('click', '#formSubmit', function() {
            $('#formModal').submit();
        })


        $('#formModal').validate({ // initialize the plugin
            rules: {
                username: {
                    required: true,
                },
                fullname: {
                    required: true,
                },
                email: {
                    required: true,
                },
                group_id: {
                    required: true,
                }

            },
            submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    }
                });
                let id = $('#id').val();
                let status = $('#status').val();


                let image = $('#image').prop('files')[0],
                    dokument = $('#dokument').prop('files')[0],
                    form_data = new FormData(document.getElementById('formModal'));

                form_data.append('_token', $("input[name=_token]").val());
                // form_data.append('_cache_id' , localStorage.getItem('cache_id'));

                // let fullname = $('#fullname').val();
                // let username = $('#username').val();
                // let nik = $('#nik').val();
                // let email = $('#email').val();
                // let no_hp = $('#no_hp').val();
                // let alamat = $('#alamat').val();
                // let tempat_lahir = $('#tempat_lahir').val();
                // let tgl_lahir = $('#tgl_lahir').val();
                // let profile_picture = $('#profile_picture').val();
                // let group = $('#group').val();
                // let unlat = $('#unlat').val();
                // let sabuk = $('#sabuk').val();
                // let kategori = $('#kategori').val();
                // let agama = $('#agama').val();
                // let status = $('#status').val();
                form_data.append('profile_picture', image);
                form_data.append('dokument', dokument);
                form_data.append('status', status);
                form_data.append('id', id);
                // form_data.append('fullname', fullname);
                // form_data.append('username', username);
                // form_data.append('nik', nik);
                // form_data.append('email', email);
                // form_data.append('no_hp', no_hp);
                // form_data.append('alamat', alamat);
                // form_data.append('tempat_lahir', tempat_lahir);
                // form_data.append('tgl_lahir', tgl_lahir);
                // form_data.append('group', group);
                // form_data.append('unlat', unlat);
                // form_data.append('sabuk', sabuk);
                // form_data.append('kategori', kategori);
                // form_data.append('agama', agama);
                // form_data.append('status', status);

                $.ajax({
                    url: url.submit,
                    data: form_data,
                    type: 'POST',
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // swalStatus(response, "myModal")
                        Swal.fire({
                            title: "Update Success",
                            text: response.message,
                            type: "success"
                        }).then(function() {
                            window.location.reload();
                        });
                    }
                });
                event.preventDefault();
                // let data = $('#formModal').serialize();

                // $.post(url.submit, data, function(result) {
                //     swalStatus(result, "myModal", '', table)
                // });
            }
        });

        // function activeLogic(param, field) {
        //     console.log(param);
        //     if (param == 1) {
        //         $(`#${field}`).prop("checked", true)
        //     } else {
        //         $(`#${field}`).prop("checked", false)
        //     }
        // }

        function activeLogic(param, field) {
            console.log(param);
            if (param == 1) {
                $(`#${field}`).prop("selected", true)
            } else {
                $(`#${field}`).prop("selected", false)
            }
        }

        function resetFileInput() {
            $('#image').fileinput('destroy');
            $('#ktp_image').fileinput('destroy');
        }

        function makeInput(value) {
            $('#image').fileinput('destroy');
            // $('#ktp_image').fileinput('destroy');

            if (value) {
                let url = "{{asset('storage/images/')}}" + '/' + `${value}`
                let filename = value.split('/')[1];
                $("#image").fileinput({
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
                $("#image").fileinput({
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

        function makeInput2(value) {
            // $('#image').fileinput('destroy');
            $('#dokument').fileinput('destroy');

            if (value) {
                let url = "{{asset('storage/images/')}}" + '/' + `${value}`
                let filename = value.split('/')[1];
                $("#dokument").fileinput({
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
                $("#dokument").fileinput({
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

        function generateUserCode(user_id) {
            let param = {
                'user_id': user_id
            }

            // console.log(param)
            $.get(url.generate_user_code, {
                user_id: user_id
            }, function(response) {
                let result = response.data;

                if (result !== null) {
                    $('#code').val(result);
                } else {

                    validateSwal("Code Belum Di Buat")
                    $('#code').val("");

                }



            })
        }

    });

    function loadDataTable(nik, name) {
        table = $('#contentTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                type: 'GET',
                url: url.table,
                data: {
                    'nik': nik,
                    'name': name,
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id',
                    title: '#',
                    width: '2%'
                },
                {
                    data: 'fullname',
                    name: 'fullname'
                },
                {
                    data: "profile_picture",
                    className: 'dt-center',
                    "render": function(data) {


                        @if(env('APP_ENV') == 'production')
                            (data ? img = `<img class="img-thumbnail img-responsive" style="max-width: 110px; max-height: 110px" src='{{asset('storage/images/${data}')}}'>` :
                                img = `<img class="img-thumbnail img-responsive" style="max-width: 110px; max-height: 110px" src='{{asset('img/no_image.jpg')}}'>`)
                        return img;
                        @else
                        let img = '';
                        (data ? img = `<img class="img-thumbnail img-responsive" style="max-width: 110px; max-height: 110px" src='{{asset('storage/images/${data}')}}'>` :
                            img = `<img class="img-thumbnail img-responsive" style="max-width: 110px; max-height: 110px" src='{{asset('img/no_image.jpg')}}'>`)
                        @endif
                        return img;
                    }
                },
                {
                    data: "dokument",
                    className: 'dt-center',
                    "render": function(data) {


                        @if(env('APP_ENV') == 'production')
                            (data ? img = `<img class="img-thumbnail img-responsive" style="max-width: 110px; max-height: 110px" src='{{asset('storage/images/${data}')}}'>` :
                                img = `<img class="img-thumbnail img-responsive" style="max-width: 110px; max-height: 110px" src='{{asset('img/no_image.jpg')}}'>`)
                        return img;
                        @else
                        let img = '';
                        (data ? img = `<img class="img-thumbnail img-responsive" style="max-width: 110px; max-height: 110px" src='{{asset('storage/images/${data}')}}'>` :
                            img = `<img class="img-thumbnail img-responsive" style="max-width: 110px; max-height: 110px" src='{{asset('img/no_image.jpg')}}'>`)
                        @endif
                        return img;
                    }
                },
                {
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'code',
                    name: 'code'
                },
                {
                    data: 'group.name',
                    name: 'group',
                    defaultContent: '#'
                },
                // {
                //     data: 'status',
                //     name: 'status',
                //     render: function(data, type, row) {
                //         if (data == 1) {
                //             return 'Aktif';
                //         } else if (data == 0) {
                //             return 'Tidak Aktif';
                //         } else {
                //             return '';
                //         }
                //     }
                // },
                {
                    data: 'status',
                    name: 'status',
                    "render": function(data) {
                        let color = activeInactiveColor(data);

                        return (data == 1 ? `<div class="badge bg-primary">Active</div>` : `<div class="badge bg-danger">Inactive</div>`)
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    width: '15%'
                },
            ]
        });
    }
</script>

@endsection