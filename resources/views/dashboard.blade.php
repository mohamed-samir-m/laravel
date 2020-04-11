@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                

                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{session('status')}}
                            </div>
                        @endif

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                        <tbody>
                            @foreach ($cards as $card )
                                <tr>
                                    <th scope="row">{{$card->id}}</th>
                                    <td>{{$card->title}}</td>
                                    <td><a href="{{'/cards/' . $card->id}}" class="btn btn-primary">Show More</a></td>
                                </tr>
                                
                            @endforeach
                            
                        </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
