<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Laravel crud never seen before</title>
</head>
<body>
<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="title" style="float:left;">
                        <h2>BSP Laravel Crud</h2>
                    </div>
                    <div class="add-button" style="float:right;">
                        <a class="btn btn-dark" href="{{ route('add.new.record') }}">Add New Record</a>
                    </div>
                </div>
                <div class="card-body">
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <table class="table table-bordered">
                       <thead>
                        <tr>
                            <th>ID</th>
                            <th>Company Logo</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Services</th>
                            <th>Country</th>
                            <th>State</th>
                            <th>City</th>
                            <th>Branch</th>
                            <th>Action</th>
                        </tr>
                       </thead>
                       <tbody>
                        @foreach($all_records as $key=>$record)
                        <tr>
                            <td>{{ $record->id }}</td>
                            {{-- <td><img src="{{ asset('images/profile/'.$record->$image) }}" alt="Logo" style="width:150px; height:120px;"></td> --}}
                            <td><img src="{{ asset('images/profile/'.$record->image) }}" alt="Image" style="width:150px; height:120px;"></td>

                            <td>{{ $record->name }}</td>
                            <td>{{ $record->email }}</td>
                            <td>{{ $record->phone }}</td>
                            <td>{{ $record->services }}</td>
                            <td>{{ $record->country }}</td>
                            <td>{{ $record->state }}</td>
                            <td>{{ $record->city }}</td>
                            <td>{{ $record->branch }}</td>
                            <td>
                                <a class="btn btn-success btn-sm" href="{{ route('edit.record',$record->id) }}">Edit</a>
                                <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?')" href="{{ route('delete.record',$record->id) }}">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                       </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {!! $all_records->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</x-app-layout>
