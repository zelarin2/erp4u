@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 

<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Add Product</h4><br><br>
            

            <form method="post" action="{{ route('product.store') }}" id="myForm" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Product Code</label>
                <div class="form-group col-sm-10">
                    <input name="code" class="form-control" type="text">
                </div>
            </div>
            <!-- end row -->

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Description</label>
                <div class="form-group col-sm-10">
                    <input name="description" class="form-control" type="text">
                </div>
            </div>
            <!-- end row -->


            <div class="form-group row mb-3">
            <label for="example-text-input" class="col-sm-1 col-form-label">Family</label>
            <div class="form-group col-sm-2">
                    <select id="product_family" name="product_family" class="form-select select2" aria-label="Default select example">
                    <option selected=""></option>
                        @foreach($families as $prod)
                            <option iOption = "" value="{{ $prod-> family }}">{{ $prod-> family }}</option>
                        @endforeach
                    </select>
                </div>


            <!-- end row -->

            <label for="example-text-input" class="col-sm-1 col-form-label">Unit Measure</label>
            <div class="form-group col-sm-2">
                    <select id="product_unit" name="product_unit" class="form-select select2" aria-label="Default select example">
                    <option selected=""></option>
                        @foreach($unitMeasures as $prod)
                            <option iOption = "" value="{{ $prod-> unit}}">{{ $prod-> unit }}</option>
                        @endforeach
                    </select>
                </div>
            <!-- end row -->


            <label for="example-text-input" class="col-sm-1 col-form-label">Tax Rate</label>
            <div class="form-group col-sm-1">
                    <select id="product_taxRateCode" name="taxRateCode_Product" class="form-select select2" aria-label="Default select example">
                    <option selected=""></option>
                        @foreach($taxRates as $prod)
                            <option iTaxDescription = "{{ $prod->descriptionTaxRate }} - {{ $prod->taxRate }}% "
                         value="{{$prod->taxRateCode}}">{{$prod->taxRateCode}}</option>
                        @endforeach
                    </select>
                </div>
                <label for="example-text-imput" id="lbTaxDescription" name="lbTaxDescription" class="col-sm-4 col-form-label"></label>
            </div>
            <!-- end row -->

            <div class="form-group row mb-3">
                <div class="col-sm-11">
       <input name="profile_image" class="form-control" type="file"  id="image">
                </div>
            </div>
            <!-- end row -->

            <div class="form-group row mb-3">
                 <label for="example-text-input" class="col-sm-2 col-form-label">  </label>
                <div class="col-sm-11">
                    <img id="showImage" class="rounded avatar-lg" 
                    src="{{ (!empty($editData->profile_image))? 
                        url('upload/admin_images/'.$editData->profile_image):
                        url('upload/no_image.jpg') }}" alt="Card image cap">
                </div>
            </div>
            <!-- end row -->

                <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Product">
            </form>
        </div>
    </div>
</div> <!-- end col -->
</div>
</div>
</div>

<script type="text/javascript">

    $('showImage').click(function(){
        $('image').click();
    });
    
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

    $("#product_taxRateCode").change(function(){
        $("#lbTaxDescriptions").text("");
        $("#lbTaxDescriptions").text($("#product_taxRateCode option:selected").attr("iTaxDescription"));
    })

 
        $('#myForm').validate({
            rules: {
                postalCode: {
                    required : true,
                },  
                location: {
                    required : true,
                },
            }
        });
            

        $('#myForm').validate({
            rules: {
                code: {
                    required : true,
                },
                description: {
                    required : true,
                },
                product_family: {
                    required : true,
                },  
                product_unit: {
                    required : true,
                },
                taxRateCode_Product: {
                    required : true,
                },  
                profile_image: {
                    required : true,
                },    
            },
            messages :{
                code: {
                    required : 'Please Enter Code.',
                },               
                description: {
                    required : 'Please Enter Name.',
                },
                product_family: {
                    required : 'Please Enter Product Family.',
                },                
                product_unit: {
                    required : 'Please Enter Product Unit.',   
                },
                taxRateCode_Product: {
                    required : 'Please Enter Tax Rate Code.',   
                },
                profile_image: {
                    required : 'Please Enter Image Product.',   
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
</script>


 
@endsection 