@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Family All</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
                        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <a href="{{ route('family.add') }}" class="btn btn-secondary btn-rounded waves-effect waves-light"
                    style="float:right;">Add Family</a> <br> <br>
                        <h4 class="card-title">Family All Data </h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Ln</th>
                                    <th>Family</th> 
                                    <th>Action</th> 
                                </tr>
                            </thead>
                            <tbody> 
                        	   @foreach($families as $key => $item)
                                    <tr>
                                        <td> {{ $key+1}} </td>
                                        <td> {{ $item->family }} </td>
                                        <td>
                                            <a href="{{ route('family.edit', $item->id) }}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>
                                            <a href="{{ route('family.delete', $item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete">  <i class="fas fa-trash-alt"></i> </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->                    
    </div> <!-- container-fluid -->
</div>
 

@endsection