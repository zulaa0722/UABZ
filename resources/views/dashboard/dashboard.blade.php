@extends('layouts.layout_master')
@section('css')

@endsection
@section('content')
  <div class="row align-items-center">


      <div class="col-sm-6">
          <div class="page-title-box">
              <h4 class="font-size-18">Dashboard</h4>
              <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item active">Welcome to Veltrix Dashboard</li>
              </ol>
          </div>
      </div>

      <div class="col-sm-6">
          <div class="float-right d-none d-md-block">
              <div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle waves-effect waves-light"
                      type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="mdi mdi-settings mr-2"></i> Settings
                  </button>
                  <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <a class="dropdown-item" href="#">Something else here</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Separated link</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection

@section('js')

@endsection
