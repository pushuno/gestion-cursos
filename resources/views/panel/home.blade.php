@extends('layouts.panel')

@section('title',"Home")

@section('seccion','Principal')

@section('content')

    <div class="col-lg-8">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Home {{ $status ?? '' }}</h3>
            </div>
            <div class="card-body">
                
            </div>
            <div class="card-footer clearfix">
               <!-- <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item"><a class="page-link" href="#">«</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>-->
            </div>
        </div>
    </div>

@endsection

