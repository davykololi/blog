@extends('layouts.author')
@section('title')
    {{$title}}
@endsection

@section('content')
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ucwords(Auth::user()->role) }} Dashboard</div>
                        <div class="card-body">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif

                        You are in {{ucwords(Auth::user()->role) }} Dashboard!
                    </div>
                </div>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection