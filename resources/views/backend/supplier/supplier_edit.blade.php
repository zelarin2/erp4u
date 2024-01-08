@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">EDIT SUPPLIER</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
                        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <form method="post" action="{{ route('supplier.update') }}" id="myForm" >
                    @csrf
                    <input type="hidden" name="id" value="{{$supplier->id}}">
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Supplier Code</label>
                        <div class="form-group col-sm-10">
                            <input name="code" class="form-control" type="number" value="{{$supplier->code}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                        <div class="form-group col-sm-10">
                        <input name="name" class="form-control" type="text" value="{{$supplier->name}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Address1</label>
                        <div class="form-group col-sm-10">
                        <input name="address1" class="form-control" type="text" value="{{$supplier->address1}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Address2</label>
                        <div class="form-group col-sm-10">
                        <input name="address2" class="form-control" type="text" value="{{$supplier->address2}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Postal Code</label>
                        <div class="form-group col-sm-10">
                        <select id="codePostal" name="postalCode" class="form-select select2" aria-label="Defaul select example">
                            <option id="iValor" atr_inputOption=""></option>
                            @foreach($postalCodes as $supp)
                                <option atrLocation = "{{ $supp->location }}" value ="{{ $supp->postalCode}}"
                                @if ($supp->postalCode == $supplier->postalCode)
                                    selected
                                @endif
                                >
                                {{$supp->postalCode}}</option>
                            @endforeach
                        </select>
                        </div>
                        <label for="example-text-input" id="lbLocation" name="lbLocation" class="col-sm-2 col-form-label">
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Town</label>
                        <div class="form-group col-sm-10">
                        <input name="town" class="form-control" type="text" value="{{$supplier->town}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">NIF</label>
                        <div class="form-group col-sm-10">
                        <input name="nif" class="form-control" type="text" value="{{$supplier->nif}}">
                        </div>
                    </div>
                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Supplier">
                </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->                    
    </div> <!-- container-fluid -->
</div>
 
<script type="text/javascript">
    $(document).ready(function (){
        $("#codePostal").change(function(){
            $("#lbLocation").text("");
            $("#lbLocation").text($("#codePostal option:selected").attr("atrLocation")); 
        });

        $('#codePostal'),trigger('change');

        $('#myForm').validate({
            rules: {
                code: {
                    required : true,
                },
                name: {
                    required : true,
                },
                address1: {
                    required : true,
                },
                postalCode: {
                    required : true,
                }, 
            },
            messages :{
                code: {
                    required : 'Please Enter Supplier Code.',
                },
                name: {
                    required : 'Please Enter Supplier Name.',
                },
                address1: {
                    required : 'Please Enter Supplier address.',
                },
                postalCode: {
                    required : 'Please Enter Supplier Postal Code.',
                }, 
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    }); 
</script>

@endsection