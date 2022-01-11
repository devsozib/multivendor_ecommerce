@extends('backend.layouts.master')

@section('content')


<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">                        
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Banners</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                        <li class="breadcrumb-item">Banner</li>
                        <li class="breadcrumb-item active">All Banner</li>
                    </ul>
                </div>            
              
            </div>
        </div>
        
        <div class="row clearfix">
            <div class="col-lg-12">
                @include('backend.layouts.notification')
            </div>
            <div class="col-lg-12">
                <div class="card">
                  
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Photo</th>
                                        <th>Condition</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                             
                                <tbody>
                                    @foreach ($banners as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td><img src="{{ $item->photo }}" style="max-width:120px; max-height:90px" alt=""></td>
                                        <td>
                                            @if ($item->condition=='banner')
                                                <span class="badge badge-success">{{ $item->condition }}</span>
                                                @else
                                                <span class="badge badge-primary">{{ $item->condition }}</span>

                                            @endif

                                       
                                        </td>
                                        <td><input value="{{ $item->id }}" name="toggle" {{ $item->status=='active'? 'checked':''}} type="checkbox" data-size="small" data-toggle="switchbutton"  data-onlabel="Active" data-offlabel="Inactive" data-onstyle="success" data-offstyle="danger"></td>
                                        <td>
                                            <a href="" data-placement="bottom"  data-toggle="tooltip" title="edit" class="btn btn-sm btn-outline-warning" >
                                                <i class="fas fa-edit"></i></a>

                                                <a href="" data-placement="bottom" data-toggle="tooltip" title="delete" class="btn btn-sm btn-outline-danger" >
                                                    <i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
         
        </div>

      

    </div>
</div>


@endsection
@section('scripts')
<script>
    $('input[name=toggle]').change(function(){
        var mode = $(this).prop('checked');
        var id = $(this).val();

        $.ajax({
             url:"{{ route('banner.status') }}",
             type:"POST",
             data:{
                 _token:'{{ csrf_token() }}',
                 mode:mode,
                 id:id,
             },

             success:function(response){
                
                if(response.status){
                    alert(response.message);
                }else{
                    alert('please try again');
                }
             }

        });
    });
</script>
@endsection