@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Vital Sign</h1>
          </div>
          <div class="col-sm-6">
            <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Advanced Form</li>
            </ol> -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
       <form action="{{route('VitalSignUpdate')}}" method="POST" enctype="multipart/form-data" class="needs-validation add-product-form" novalidate="">
        {{ csrf_field() }}
        @foreach($vitalsigns as $vitalsign)
        <input type="hidden" name="id" value="{{$vitalsign->id}}">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Vital Sign</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <div class="row">
                  <div class="col-2"> 
                    <label for="inputName">Code</label>
                    <input type="text" id="Code" name="txtcode" value="{{$vitalsign->code}}" class="form-control">
                  </div>
                  <div class="col-4">
                    <label for="inputName">Vital Sign</label>
                    <input type="text" id="inputReason" name="txtdescription" value="{{$vitalsign->description}}" class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="inputDescription">Note</label>
                <textarea id="inputNote" name="txtnote" class="form-control" rows="4">{{$vitalsign->note}}</textarea>
              </div>              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <a href="#" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Save" class="btn btn-success float-right">
        </div>
      </div>
      @endforeach
    </form>
    </section>
    <!-- /.content -->
  </div>
@endsection