@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Blogs @if(Auth::check() && Auth::user()->role_id == 2)<a href="{{config('app.url')}}/blog/create" class="btn btn-primary right" style="float: right">Create Blog</a>@endif</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="row">&nbsp;</div>
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">&nbsp;</div>
                    <form action="{{config('app.url')}}/home" method="post">
                         {{ csrf_field() }}
                         <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">Search</label>

                            <div class="col-md-6">
                            
                                <input type="text" class="form-control" name="searchtext" value="{{$searchtext}}">
            
                            </div>
                            <div class="col-md-1">
                                <input type="submit" value="Search" class="btn btn-primary">
                             </div>   
                        </div>
                
                    </form>

                    <div class="container">

                    <table class="table table-bordered">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Author</th>
                            <th>Status</th>   
                            <th>Date</th>       
                            <th>Action</th>
                        </tr>
                        @if(count($blogs) ==0)
                             <tr>
                                <td colspan="7" style="text-align: center">Empty Blogs</td>
                            </tr>
                        @else
                        @foreach($blogs as $k=>$blog)

                            <tr>
                                <td>{{$k+1}}</td>
                                <td><a href="{{config('app.url')}}/blog/show/{{$blog->id}}">{{$blog->title}}</a></td>
                                <td>{{$blog->description}}</td>
                                <td>{{$blog->name}}</td>
                                 <td>{{$blog->status == 1?'Active':'Inactive'}}</td>
                                  <td>{{date('Y-m-d',strtotime($blog->created_at))}}</td>

                                <td>

                                    @if(Auth::user()->role_id == 1)
                                        <a href="{{config('app.url')}}/blog/edit/{{$blog->id}}" class="btn btn-primary">Edit</a>&nbsp;<a href="{{config('app.url')}}/blog/delete/{{$blog->id}}" class="btn btn-primary">Delete</a>
                                    @endif
                                    @if(Auth::user()->id == $blog->user_id)
                                        <a href="{{config('app.url')}}/blog/edit/{{$blog->id}}" class="btn btn-primary">Edit</a>
                                    @endif

                                </td>
                            </tr>

                        @endforeach
                        @endif
                    </table>
                    <div class="pull-right">{{$blogs->appends(['searchtext' => $searchtext])->links()}}</div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

