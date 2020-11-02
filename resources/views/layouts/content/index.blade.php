@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                        @if (count($post)>0)
                            @foreach ($post as $eachpost)
                                {{-- <div class="card">
                                    <div class="row">
                                        <div class="col-md-8">
                                        <h3><a href="{{url('home/'.$eachpost->id)}}">{{ $eachpost->title }}</a></h3>

                                        <small>Posted on : {{ date("F jS, Y", strtotime($eachpost->created_at)) }}</small>
                                        <img class="img-fluid" src="/storage/post_image/{{$eachpost->post_image}}">
                                        <p class="limit" style="max-width:20ch;">{{ $eachpost->body}}</p>
                                        <br>
                                        <small>comment : {{ $commentCount = DB::table('comments')->where('post_id', '=', $eachpost->id)->count() }}</small>
                                        </div>
                                    </div>
                                </div> --}}


                                <div class="primary py-4">
                                    <h3><a style="color:black;text-decoration:none;" href="{{url('home/'.$eachpost->id)}}">{{ $eachpost->title }}</a></h3>
                                    <p class="c-text">Posted on <span>{{ date("F jS, Y", strtotime($eachpost->created_at)) }}</span> | <span><a style="color:#3a3a3a;font-style:italic;text-decoration:none" href="{{url('home/'.$eachpost->id)}}">comment : {{ $commentCount = DB::table('comments')->where('post_id', '=', $eachpost->id)->count() }}</a> </span></p>
                                    <div class="main-content d-flex row justify-content-center">
                                        <a href="{{url('home/'.$eachpost->id)}}" style="margin-bottom:2vh"><img style="padding:3%" class="img-fluid" src="/storage/post_image/{{$eachpost->post_image}}"></a>
                                        <div class="bod">
                                            <h5 class="limit">{{ $eachpost->body}}</h5>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <hr>
                                 </div>



                            @endforeach
                        @else
                                <h5 align='center'>no post yet</h5>
                        @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection