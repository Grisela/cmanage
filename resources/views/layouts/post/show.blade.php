@extends('layouts.app')
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body">
                <div class="custom-card">
                    <nav class="breadcrumb d-flex justify-content-center" style="background-color: rgb(236, 236, 236)">
                        <a class="breadcrumb-item" href="{{ url('/home') }}">Home</a>
                        <span class="breadcrumb-item active">{{$post->title}}</span>
                    </nav>

                    <div class="d-flex flex-column align-items-center">
                        <h1 style="margin-bottom: -1vh; margin-top: 2vh">{{$post->title}}</h1>
                        <p class="c-text">Posted on <span>{{ date("F jS, Y", strtotime($post->created_at)) }}</span> by :  <span style="color: black">{{$post->user->name}} </p>
                        <img class="img-fluid" src="/storage/post_image/{{$post->post_image}}">
                    </div>
                       
                    <p style="margin-top: 5vh; margin-bottom: 5vh">{{$post->body}}</p>
                    
                    @if (!Auth::guest())
                        @if(Auth::user() == $post->user || Auth::user()->rolecheck == 1)

                        <div class="btn-show-post d-flex justify-content-end align-items-start">

                            <a class="btn btn-primary mx-2" href= "{{url('home/'.$post->id.'/edit')}}" role="button">Edit</a>

                        <form action="{{ route('home.destroy', $post->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                        </div>

                        @endif
                    @endif

                    <hr/>

                    @if (!Auth::guest())
                    <h4>Add comment</h4>

                    <form method="post" action="{{ route('comments.store') }}">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="body"></textarea>
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Add Comment" />
                        </div>
                    </form>    
                    @else
                        <h5>Login to comment</h5>
                    @endif

                    <h3 style="text-align: center; margin-top: 5vh; margin-bottom:5vh">Comments</h3>
                    @include('layouts.post.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])

                    @endsection


                </div> 
            </div>
        </div>
    </div>
</div>

