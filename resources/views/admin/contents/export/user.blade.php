<html>
{{--{{ HTML::style('css/pdf/print_pdf.css') }}--}}

<style>
    .table th {
        border: 1px solid black;
    }

    .table tr td {
        border: 0.1px solid black;
    }

    .table thead tr th,
    .table tbody tr td {
        padding: 10px;
    }

    .table thead tr th,
    .table tbody tr td {
        padding: 10px;
    }

    .table thead tr th {
        text-align: center;
        background-color: #ccc;
    }

    table tbody tr td ol {
        margin: 5px;
        padding: 5px;
    }

    ol {
        margin: 0 0 0 10px;
        padding: 0;
    }
</style>

<table>
    <tr>
        <td rowspan="2" colspan="12" style="text-align: center; font-weight: bold; font-size: 20pt">
            <h1>USER - LIST</h1>
        </td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <!-- @if($filter === 'order_code')
        <tr>
            <td colspan="8" style="text-align: center; font-weight: bold; font-size: 10pt"><h1>ORDER CODE
                    : {{pg2form_word($filter['hub'])}}</h1></td>
        </tr>
    @endif -->
</table>

<table class="table">
    <thead>
        <tr class="table100-head">
            <th class="5%" style="text-align: center">#</th>
            <th class="">Nama Lengkap</th>
            <th class="">Username</th>
            <th class="">NIK</th>
            <th class="">Code Anggota</th>
            <th class="">No Hp</th>
            <th class="">Email</th>
            <th class="">Tempat Lahir</th>
            <th class="">Tanggal Lahir</th>
            <th class="">Alamat Lengkap</th>
            <th class="">Unlat</th>
            <th class="">KTA</th>
        </tr>
    </thead>

    <tbody>
        @foreach($reportOrder as $item => $value)
        <!-- $delivery_address = json_decode($value->delivery_address, true); -->
        <tr>
            <td>{{($item+1)}}</td>
            <td>{{ $value->fullname }}</td>
            <td>{{ $value->username }}</td>
            <td class="text-left">{{ ($value->nik ? $value->nik : '-') }}</td>
            <td class="text-left">{{ ($value->code ? $value->code : '-') }}</td>
            <td class="text-left">{{ ($value->no_hp ? $value->no_hp : '-') }}</td>
            <td class="text-left">{{ ($value->email ? $value->email : '-') }}</td>
            <td class="text-left">{{ $value->tempat_lahir }}</td>
            <td class="text-left">{{ $value->tgl_lahir ? \Carbon\Carbon::parse($value->tgl_lahir)->format('d-m-Y') : '-' }}</td>
            <td class="text-left">{{ ($value->alamat ? $value->alamat : '-') }}</td>
            <td>{{ $value->unlat->name }}</td>
            <td class="text-right">{{ ($value->is_kta == 0 ? "Tidak" : "Ya") }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</html>
