@extends('layouts.master')
@section('title')
@endsection
@section('content')
<div class="row mt-2">
    <div class="col-md-9 offset-md-2">
        <div class="card mb-3" style="min-width: 18rem;">
            
            <div class="card-body">
                <div class="card-title">
                    <h4> {{$card->title}}</h4>
                </div>
                <img src="{{asset('storage/coverImages/'.$card->image)}}" alt="" height="400" width="700">

                <div class="card-text">
                    {{$card->body}}
                </div>
                <hr>
                <small class="text-muted"> 
                    <p> {{$card->created_at}}</p>
                </small>
                <p style="color:brown">  Created by: {{$card->user->name}}</p>
            @auth
            @if(auth()->user()->id==$card->user_id)
            <a href="{{'/cards/' .$card->id .'/edit'}}" class="btn btn-primary float-left"> Edit</a>
            
            <form action="{{route('posts.destroy',['id'=>$card->id])}}" method="POST">
                @csrf
                @method('Delete')
                <button type="submit" class="btn btn-danger float-left">Delete</button>
            </form>
            @endif
            @endauth
            
            </div>    
        </div>
    </div>
</div>
@endsection