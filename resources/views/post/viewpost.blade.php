@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 mx-auto">

                <div>

                    <p>Category Name: {{$post->name}}</p>
                    <h3>{{$post->title}}</h3>
                    <img src="{{URL::to($post->image)}}" height="340px">
                    <p>{{$post->details}}</p>

                </div>


            </div>
        </div>
    </div>
@endsection
