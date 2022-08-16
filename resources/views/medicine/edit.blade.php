@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Medicine</h1>
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
       <form action="{{route('MedicineUpdate')}}" method="POST" enctype="multipart/form-data" class="needs-validation add-product-form" novalidate="">
        {{ csrf_field() }}
        @foreach($medicines as $medicine)
        <input type="hidden" name="id" value="{{$medicine->id}}">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Medicine</h3>

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
                    <input type="text" id="Code" name="txtcode" value="{{$medicine->code}}" class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-4">
                    <label for="inputMedicine">Medicine</label>
                    <input type="text" id="inputReason" name="txtdescription" value="{{$medicine->description}}" class="form-control">
                  </div>
                  <div class="col-2">
                    <label for="inputPrice">Price</label>
                    <input type="text" id="inputPrice" name="txtprice" value="{{$medicine->price}}" class="form-control"> 
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col 2">
                    <div class="icheck-primary d-inline">
                      @if($medicine->prod_type==0)
                      <input type="checkbox" id="checkboxPrimary1" name="chkIsTreament">
                      @else
                      <input type="checkbox" id="checkboxPrimary1" name="chkIsTreament" checked>
                      @endif
                      <label for="checkboxPrimary1">Is Treatment
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="inputDescription">Note</label>
                <textarea id="inputNote" name="txtnote" class="form-control" rows="4">{{$medicine->note}}</textarea>
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