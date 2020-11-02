@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                        @if (count($post)>0)
                            @foreach ($post as $eachpost)
                                <div class="card">
                                    <div class="row">
                                        <div class="col-md-8">
                                        <h3><a href="{{url('home/'.$eachpost->id)}}">{{ $eachpost->title }}</a></h3>
                                        <small>posted by : {{ $eachpost->user->name }}</small>
                                        
                                        <small>comment : {{ $commentCount = DB::table('comments')->where('post_id', '=', $eachpost->id)->count() }}</small>
                                        </div>
                                    </div>
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