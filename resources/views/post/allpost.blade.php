@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 mx-auto">
                <a href="{{ route('write.post') }}" class="btn btn-info">Write Post</a>

                <table class="table table-responsive">
                    <tr>
                        <th>SL</th>
                        <th>Category Name</th>
                        <th>Title</th>
                        <th>Details</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    @foreach($post as $row)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->title }}</td>
                            <td>{{ $row->details }}</td>
                            <td><img src="{{ URL::to($row->image) }}" style="height: 50px; width: 100px;" alt=""></td>
                            <td>
                                <a href="{{ URL::to('edit/post/'.$row->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{ URL::to('delete/post/'.$row->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                <a href="{{ URL::to('view/post/'.$row->id) }}" class="btn btn-sm btn-success">View</a>
                            </td>
                        </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </div>
@endsection
