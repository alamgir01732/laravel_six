@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">

                <a href="{{route('add.category')}}" class="btn btn-danger">Add Category</a>
                <a href="{{ route('all.category') }}" class="btn btn-info">All Category</a>
                <a href="{{ route('all.post') }}" class="btn btn-info">All Post</a>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('store.post') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Post Title</label>
                            <input type="text" class="form-control" placeholder="Title" name="title" required>

                        </div>
                    </div>

                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Category</label>
                            <select class="form-control" name="category_id">
                                <option value="">Please Select</option>
                                @foreach($category as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Image</label>
                            <input type="file" class="form-control" placeholder="Post Image" name="image" required>

                        </div>
                    </div>

                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Details</label>
                            <textarea rows="5" class="form-control" placeholder="Details" name="details" required></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <br>
                    <div id="success"></div>
                    <button type="submit" class="btn btn-primary">Post</button>
                </form>
            </div>
        </div>
    </div>
@endsection
