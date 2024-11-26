@extends('layout.mastar')
@section('title','Billing')
@section('content')
<div class="card p-3">
    <h3>Billing</h3>
    <div class="table-responsive text-nowrap">
        <table class="table table-striped">
            <thead>
                <th>Customer Email</th>
                <th>Purchased date</th>
                <th>Action</th>
            </thead>
            <tbody>
                @if (count($list) > 0)
                @foreach ($list as $data)
                <tr>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->created_at ? date('d, M Y',strtotime($data->created_at)) : '-' }}</td>
                    <td><a href="{{ url('generated-bill/'.$data->id) }}">View</a></td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection