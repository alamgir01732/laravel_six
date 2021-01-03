@extends('welcome')

@section('content')
    <div class="col-lg-8 col-md-10 mx-auto">
        @foreach($post as $row)
        <div class="post-preview">
            <a href="post.html">
                <img src="{{URL::to($row->image)}}" alt="" style="height: 300px;">
                <h2 class="post-title">
                    {{ $row->title }}
                </h2>
            </a>
            <p class="post-meta">Category
                <a href="#">{{ $row->name }}</a>
                on slug {{$row->slug}}</p>
            <p>
                {{ $row->details }}
            </p>
        </div>
        <hr>
        @endforeach


        <!-- Pager -->
        <div class="clearfix">

            <a class="btn btn-primary float-right" href="{{ $post->nextPageUrl() }}">Older Posts &rarr;</a>
            @if($post->previousPageUrl())
            <a class="btn btn-primary float-left" href="{{ $post->previousPageUrl() }}">&larr; Newer Post</a>
            @endif
        </div>
    </div>
@endsection
