@extends('admin.base')
@section('admincontent')

<h1>{{$post->title}}</h1>
    <img class="img-fluid" src="/storage/post_image/{{$post->post_image}}">
<p>{{$post->body}}</p>

@if(Auth::user() == $post->user || Auth::user()->rolecheck == 1)
<a class="btn btn-primary" href= "{{url('home/'.$post->id.'/edit')}}" role="button">Edit</a>

<form action="{{ route('home.destroy', $post->id)}}" method="POST">
    @method('DELETE')
    @csrf
    <button class="btn btn-danger" type="submit">Delete</button>
</form>
@endif

<hr />

<h4>Display Comments</h4>



@include('admin.post.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])



<hr />

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
@endsection