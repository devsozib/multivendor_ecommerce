@extends('backend.layouts.master')

@section('content')


<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-12 col-md-8 col-sm-12">                        
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('category.create') }}"><i class="icon-plus"></i> Create Category</a>
                    </h2>
                    <ul class="breadcrumb float-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="icon-home"></i></a></li>                            
                        <li class="breadcrumb-item">Categories</li>
                        <li class="breadcrumb-item active">All Category</li>
                    </ul>
                    <p class="float-right">Total Category:{{ \App\Models\Category::count() }}</p>
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
                                        <th>Photo</th>
                                        <th>Is Parent</th>
                                        <th>Parents</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                             
                                <tbody>
                                    @foreach ($categories as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                     
                                        <td><img src="{{ $item->photo }}" style="max-width:120px; max-height:90px" alt=""></td>
                                        <td>
                                            
                                            {{ $item->is_parent===1?'Yes':'No' }}
                                       
                                        </td>
                                        <td>{{ \App\Models\Category::where('id',$item->parent_id)->value('title') }}</td>
                                        <td><input value="{{ $item->id }}" name="toggle" {{ $item->status=='active'? 'checked':''}} type="checkbox" data-size="small" data-toggle="switchbutton"  data-onlabel="Active" data-offlabel="Inactive" data-onstyle="success" data-offstyle="danger"></td>
                                        <td>
                                            <a href="{{route('category.edit',$item->id)}}" data-placement="bottom"  data-toggle="tooltip" title="edit" class="float-left btn btn-sm btn-outline-warning" >
                                                <i class=" fas fa-edit"></i></a>

                                            <form class="float-left ml-2" action="{{ route('category.destroy',$item->id) }}" method="POST">
                                               @csrf
                                                  @method('delete')
                                                  <a href="" data-id="{{ $item->id }}" data-placement="bottom" data-toggle="tooltip" title="delete" class="btn btn-sm btn-outline-danger" >
                                                    <i class="dltBtn fas fa-trash-alt"></i></a>
                                            </form>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
}); 

$('.dltBtn').click(function(e){
       var form = $(this).closest('form');
       var dataId = $(this).data('id');

       e.preventDefault();
       swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                form.submit();
                swal("Poof! Your imaginary file has been deleted!", {
                icon: "success",
                });
            } else {
                swal("Your imaginary file is safe!");
            }
});

});

</script>
<script>
    $('input[name=toggle]').change(function(){
        var mode = $(this).prop('checked');
        var id = $(this).val();

        $.ajax({
             url:"{{ route('category.status') }}",
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