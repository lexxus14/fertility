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
       <form id="quickForm" action="{{route('LabTestUpdate')}}" method="POST" enctype="multipart/form-data" class="needs-validation add-product-form" novalidate="">
        {{ csrf_field() }}
        @foreach($labtests as $labtest)
        <input type="hidden" name="id" value="{{$labtest->id}}">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Lab Test</h3>

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
                    <input type="text" id="Code" name="txtcode" value="{{$labtest->code}}" class="form-control">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-4">
                  <div class="form-group">
                  <label for="inputMedicine">Lab Test</label>
                  <input type="text" id="inputMedicine" name="txtdescription" value="{{$labtest->description}}" class="form-control">
                  </div>
                </div> 
                <div class="form-group">
                    <label for="inputPrice">Price</label>
                    <input type="number" id="inputPrice" name="txtprice" value="{{$labtest->price}}" class="form-control"> 
                </div>                                  
              </div>
              
              <div class="form-group">
                <label for="inputDescription">Note</label>
                <textarea id="inputNote" name="txtnote" class="form-control" rows="4">{{$labtest->note}}</textarea>
              </div>              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <a href="{{route('LabTestIndex')}}" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Save" class="btn btn-success float-right">
        </div>
      </div>
      @endforeach
    </form>
    </section>
    <!-- /.content -->
  </div>

  <script >
    $(document).ready(function(){
      $('#quickForm').validate({
        rules: {
          txtcode: {
            required: true
          },
          txtdescription: {
            required: true
          },
          txtprice: {
            required: true
          },
        },
        messages: {
          txtcode: {
            required: "Please enter a code."
          },
          txtdescription: {
            required: "Please provide the description."
          },
          txtprice: "Please enter the price."
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
</script>
@endsection