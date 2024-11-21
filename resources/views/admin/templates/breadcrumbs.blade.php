@section('breadcumbs')
@php
$breadrumbs = $menu['breadcrumbs'];
@endphp

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    @if(!empty($breadrumbs->parent))
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ucfirst($breadrumbs->parent->name)}} /</span> {{ucfirst($breadrumbs->name)}}</h4>
                    @endif
                </ol>
            </div>
            <h4 class="page-title">{{ucfirst($breadrumbs->name)}}</h4>
        </div>
    </div>
</div>
@endsection