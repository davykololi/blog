@extends('layouts.author')
@section('title', '| Author Create Article')
  
@section('content')
<div class="card mt-5">
        <div class="card-header">
            <h2 style="text-transform: uppercase;">Create</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 mt-1 mr-1">
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('author.articles.index') }}">Back</a>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-12">
                    @include('partials.messages')
                </div>
                <div class="col-lg-12">
                    @include('partials.errors')
                
                    @can('isAuthor')  
                    <form action="{{ route('author.articles.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                         <div class="row">
                            @include('partials.article_create_form')
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-success">Create</button>
                            </div>
                        </div>
                    </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
