
@extends('admin.layouts.main')
@section('title', 'Category')

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

                <div class="card-datatable table-responsive">
                    <table id="contentTable" class="js-datatable table table-thead-bordered table-nowrap table-align-middle card-table table-striped table-hover" style="width:100%">
                        <thead class="thead-light">
                        <tr class="table100-head">
                            <th width="3%" class="text-center">No</th>
                            <th>Name</th>
                                           
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
    @include('admin.contents.category._modal')
@endsection

@section('script')

    <script type="text/javascript">
        var url = {
            detail : "{{route('dashboard_categories_detail')}}",
            delete : "{{route('dashboard_categories_delete')}}",
            submit : "{{route('dashboard_categories_post')}}",
            table : "{{route('dashboard_categories_table')}}"
        };
        var table;


        $(document).ready(function () {
            var CSRF_TOKEN = "{{@csrf_token()}}";
            table = $('#contentTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: url.table,
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', title: '#', width: '2%'},
                    {data: 'name', name: 'name'},
                    
                    {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center',width: '15%'},
                ]
            });

            $(document).on('click', '.view', function (e) {
                let id = $(this).data('id');
                e.preventDefault();
                formDisable();
                modalShow('myModal','View Data');
                $.get(url.detail, {id : id}, function (result){

                    let response = result.data;
                    $('#name').val(response.name)
                    

                });

            });

            $(document).on('click', '.update', function (e) {
                let id = $(this).data('id');
                e.preventDefault();
                formEnable();
                modalShow('myModal','Update Data');

                $.get(url.detail,{id : id}, function (result){
                    let response = result.data;
                    $('#id').val(response.id)
                    $('#name').val(response.name)
                    

                });

            });
            $(document).on('click', '.delete', function (e) {
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
                                swalStatus(result,"myModal")
                            }).then(() => {
                            tableReload(table)
                        });
                    }
                });
            });


            $('#formModal').validate({ // initialize the plugin
                rules: {
                    name: {
                        required: true,
                    },
                    

                },
                submitHandler: function (form) {
                    let data = $('#formModal').serialize();

                    $.post(url.submit, data, function (result) {
                        swalStatus(result, "myModal", '', table)
                    });
                }
            });

        });
    </script>


@endsection

