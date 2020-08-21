@extends('admin.base')
@section('admincontent')

<h1>{{$post->title}}</h1>
<img class="img-fluid" src="/storage/post_image/{{$post->post_image}}">
<p>{{$post->body}}</p>

@if(Auth::user() == $post->user || Auth::user()->rolecheck == 1)
<a class="btn btn-primary" href= "{{url('admin/dashboard/post/'.$post->id.'/edit')}}" role="button">Edit</a>

<form action="{{ route('post.destroy', $post->id)}}" method="POST">
    @method('DELETE')
    @csrf
    <button class="btn btn-danger" type="submit">Delete</button>
</form>
@endif

@endsection