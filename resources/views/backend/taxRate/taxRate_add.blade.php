@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add Tax Rate</h4><br><br>
            <form method="post" action="{{ route('taxRate.store') }}" id="myForm" >
                @csrf
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Tax Rate Code</label>
                    <div class="form-group col-sm-10">
                    <input name="taxRateCode" class="form-control" type="number">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Description</label>
                    <div class="form-group col-sm-10">
                    <input name="descriptionTaxRate" class="form-control" type="text">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Tax Rate %</label>
                    <div class="form-group col-sm-10">
                    <input name="taxRate" class="form-control" type="number">
                    </div>
                </div>
                <input type="submit" class="btn btn-info waves-effect waves-light" value="Tax Rate Measure">
            </form>    
        </div>
    </div>
</div> <!-- end col -->
</div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function (){

    
        $('#myForm').validate({
            rules: {
                taxRateCode: {
                    required : true,
                },
                descriptionTaxRate: {
                    required : true,
                },
                taxRate: {
                    required : true,
                }
            },
            messages :{
                taxRateCode: {
                    required : 'Please Enter Tax Rate Code.',
                },
                descriptionTaxRate: {
                    required : 'Please Enter Text Rate Description.',
                },
                taxRate: {
                    required : 'Please Enter Text Rate %.',
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
