@extends('backend.layouts.master')

@section('content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">                        
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Form Validation</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="icon-home"></i></a></li>                            
                        <li class="breadcrumb-item">Categoies</li>
                        <li class="breadcrumb-item active">Add Category</li>
                    </ul>
                </div>            
                
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-12">
                @if ($errors->any())
                 <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}<li>    
                        @endforeach
                     
                    </ul>
                 </div>
                @endif
            </div>
            <div init class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>Add Category</h2>
                    </div>
                    <div class="body">
                        <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                           @csrf
                            <div class="form-group">
                                <label for="title">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" placeholder="title" value="{{ old('title') }}" class="form-control" required>
                            </div>
                        
                            <div class="form-group">
                                
                                <label>Summary</label>
                               <textarea id="summary" name="summary" placeholder="Write some text..." class="form-control">{{ old('summary') }}</textarea>
                            </div>

                            <div class="form-group">
                                
                                <label>Is Parent:</label>
                                <input id="is_parent" type="checkbox" name="is_parent" value="1"  checked id="">Yes
                            </div>

                            <div class="form-gropup d-none" id="parent_cat_div">
                                <label for="parent_category">Parent Category</label>
                                <select  name="parent_id" class="form-control show-tick">
                                    <option value="">--Parent Category--</option>
                                   @foreach ($parent_categories as $p_cats)
                                   <option value="{{ $p_cats->id }}" {{ old('parent_id') == $p_cats->id?'selected':'' }}>{{ $p_cats->title }}</option>  
                                   @endforeach
                                </select>
                            
                            </div>


                            <div class="form-group">
                                
                                <label>Choose Image</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                      </a>
                                    </span>
                                    <input id="thumbnail" class="form-control" type="text" name="photo">
                                  </div>
                                  <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                            </div> 

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select  name="status" class="form-control show-tick">
                                    <option>--Status--</option>
                                    <option value="active" {{ old('status')=='active'? 'selected':'' }}>Actice</option>
                                    <option value="inactive" {{ old('status')=='inactive'? 'selected':'' }}>Inactive</option>
                                   
                                </select>
                            
                            </div>

                          
                            <br>
                            <button type="submit" class="btn btn-primary">Create Category</button>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
</div>

@endsection

@section('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
     $('#lfm').filemanager('image');
</script>

<script>

    $(document).ready(function() {
        $('#summary').summernote();
    });
 
</script>

<script>
    $('#is_parent').change(function(e){
         e.preventDefault();
         var is_checked = $('#is_parent').prop('checked');
        if(is_checked){
            $('#parent_cat_div').addClass('d-none');
            $('#parent_cat_div').val('');
        }
        else{
            $('#parent_cat_div').removeClass('d-none');
        }
    });
</script>
@endsection