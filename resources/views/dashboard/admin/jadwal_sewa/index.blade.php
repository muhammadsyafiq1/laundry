@extends('layouts.app')

@section('title')
    Jadwal sewa
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif
<div class="card">
    <div class="card-header float-right">
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="table_id" class="table table-striped">
        <thead>
            <tr>
                <th>Nama Laundry</th>
                <th>Mulai sewa</th>
                <th>Habis sewa</th>
                <th>Info</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwalsewa as $jadwal)
            <tr class="bg-dark">
                <td>{{$jadwal->dataBuktiBayar->laundry->nama_laundry}}</td>
                <td>{{date('d M Y',strtotime($jadwal->mulai_sewa))}}</td>
                <td>{{date('d M Y',strtotime($jadwal->habis_sewa))}}</td>
                <td>
                    @if( date('Y-m-d') >= $jadwal->habis_sewa )
                        <p class="text-danger">Masa sewa habis</p>
                    @else
                        <p class="text-success">Masa sewa aktif</p>
                    @endif   
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
    </script>
@endpush