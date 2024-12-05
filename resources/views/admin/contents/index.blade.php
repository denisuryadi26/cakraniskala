@extends('admin.layouts.main')

@section('title', 'Dashboard')

@section('breadcumbs')
@include('admin.templates.breadcrumbs')
@endsection

@section('content')

<!-- <div class="row">
  <div class="col-12">
    <div class="page-title-box">
      <div class="page-title-right">
        <form class="d-flex align-items-center mb-3">
          <div class="input-group input-group-sm">
            <input type="text" class="form-control border" id="dash-daterange">
            <span class="input-group-text bg-blue border-blue text-white">
              <i class="mdi mdi-calendar-range"></i>
            </span>
          </div>
          <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-2">
            <i class="mdi mdi-autorenew"></i>
          </a>
          <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-1">
            <i class="mdi mdi-filter-variant"></i>
          </a>
        </form>
      </div>
      <h4 class="page-title">Dashboard</h4>
    </div>
  </div>
</div> -->

<div class="row" id="filterArea">
    <div class="col-sm-9">

    </div>
    <div class="col-sm-3">
        <fieldset class="form-group floating-label-form-group">
            <div class="controls">

                <select class="select2 form-control form-control-lg" id="unlat_id" style="padding:10px !important;">
                    <option value="" selected class="text-center">-- SELECT UNLAT --</option>
                    @foreach($allunlat as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach

                </select>

            </div>
        </fieldset>
    </div>
</div>
<br />

<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                            <i class="fe-user font-22 avatar-title text-primary"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $user_aktif }}</span></h3>
                            <p class="text-muted mb-1 text-truncate">Anggota Aktif</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div>
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                            <i class="fe-user-x font-22 avatar-title text-success"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $user_inaktif }}</span></h3>
                            <p class="text-muted mb-1 text-truncate">Tidak Aktif</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div>
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                            <i class="fe-home font-22 avatar-title text-info"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $unlat }}</span></h3>
                            <p class="text-muted mb-1 text-truncate">Total Unlat</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div>
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                            <i class="fe-eye font-22 avatar-title text-warning"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $all_user }}</span></h3>
                            <p class="text-muted mb-1 text-truncate">Total Anggota</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div>
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->
</div>
<!-- end row-->


@endsection

@section('script')
<script type="text/javascript">
    var url = {
        getData: "{{route('dashboard_get_card_data')}}"
    };
    $(document).ready(function() {
        // getMapData();
        // console.log(mapData)
        // getMapData();
        generateCardData();
        getChartData();
        // chartData = getChartData();
        // console.log(chartData);
        // generateChart(chartData,'reseller-chart','donut');
        var CSRF_TOKEN = "{{@csrf_token()}}";
        table = $('#contentTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: url.table,
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    title: '#',
                    width: '2%'
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

        $(document).on('change', '#unlat_id', function(e) {
            let areaId = $(this).val();

            showLoading();
            generateCardData(areaId)
            // chartData = getChartData(areaId);
            // generateChart(chartData,'reseller-chart','donut')
            let resp = {
                'status': 'success',
                'message': 'Data is successfully updated'
            }
            swalStatus(resp, "", '');
        })

    });

    function generateCardData(areaId) {
        $.get(url.getData, {
            area_id: areaId
        }, function(response) {
            // let result = JSON.parse(response);

            $('#tot_reseller').text(thousands_separators(response.data.total_reseller))
            // $('#tot_agent').text(thousands_separators(response.data.total_agent))
            $('#tot_approval').text(thousands_separators(response.data.total_approval))
            $('#tot_product').text(thousands_separators(response.data.total_product))
            $('#tot_category').text(thousands_separators(response.data.total_category))
            $('#tot_principal').text(thousands_separators(response.data.total_principal))
            $('#tot_brand').text(thousands_separators(response.data.total_brand))
        });
    }

    function callData(ajaxurl, areaId) {

        return $.ajax({
            url: ajaxurl,
            type: 'GET',
            data: {
                "area_id": areaId
            },
        });
    };
</script>
@endsection
