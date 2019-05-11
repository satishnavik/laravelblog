@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="font-size:20px;">{{$blog['title']}}</div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12" style="margin: 10px" >{{$blog['description']}}</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">Created By: {{$blog['name']}}</div>
                        <div class="col-md-6" >@php 
                            echo date('F j, Y, g:i a',strtotime($blog['created_at']))
                        @endphp
                    </div>
                        
                    </div>
                   
                        
                       
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
