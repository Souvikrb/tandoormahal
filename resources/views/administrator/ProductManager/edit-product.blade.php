<x-admin-header />

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Product</h3>
                            <a href="{{route('/admin/products')}}" class="btn bg-warning text-light float-right btn-sm"><b>View</b></a>
                            <!-- @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
@endif -->
                        </div>
                        <form  method="post" action="{{route('/admin/products/update')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="pId" value="{{$product_data->id}}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Product Name</label>
                                                    <input type="text"
                                                        class="form-control" placeholder="Product Name" required
                                                        name="product" value="<?=(old('product') != '')?old('product'):$product_data->product?>" id="product" >
                                                    @error('product')
                                                    <small class="error">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Regular Price</label>
                                                    <input type="text" 
                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                        maxlength="6" class="form-control number"
                                                        placeholder="Regular Price" value="<?=(old('rgPrice') != '')?old('rgPrice'):$product_data->rgPrice?>"  name="rgPrice"
                                                        id="rgPrice">
                                                        @error('rgPrice')
                                                            <small class="error">{{ $message }}</small>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Sale Price</label>
                                                    <input type="text" 
                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                        maxlength="6" class="form-control number"
                                                        placeholder="Sale Price" required value="<?=(old('slPrice') != '')?old('slPrice'):$product_data->slPrice?>"  name="slPrice" id="slPrice">
                                                        @error('slPrice')
                                                            <small class="error">{{ $message }}</small>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Half Price</label>
                                                    <input type="text" 
                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                        maxlength="6" class="form-control number"
                                                        placeholder="Half Price" value="<?=(old('hPrice') != '')?old('hPrice'):$product_data->halfPrice?>"   name="hPrice" id="hPrice">
                                                        @error('hPrice')
                                                            <small class="error">{{ $message }}</small>
                                                        @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Product Image</label>
                                            <input type="file" accept="image/png, image/jpeg, image/svg,image/webp" class="form-control number" name="prodImg" id="prodImg">
                                            @error('prodImg')
                                                <small class="error">{{ $message }}</small>
                                            @enderror
                                            
                                        </div>
                                        <div class="text-center">
                                            @if(old('prodImg') != '')
                                                <img style="width:150px" src="{{old('prodImg')}}">
                                            @else
                                                <img style="width:150px" id="preview" src="{{asset('storage/products/'.$product_data->prodImg)}}">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control " required name="category" id="category">
                                                <option value="">--select--</option>
                                                <option <?=($product_data->category == 'Thali')?'selected':''?> value="Thali">Thali</option>
                                                <option <?=($product_data->category == 'Breads')?'selected':''?>  value="Breads">Breads</option>
                                                <option <?=($product_data->category == 'Main Course')?'selected':''?>  value="Main Course">Main Course</option>
                                                <option <?=($product_data->category == 'Snacks')?'selected':''?>  value="Snacks">Snacks</option>
                                                <option <?=($product_data->category == 'Fusion')?'selected':''?>  value="Fusion">Fusion</option>
                                            </select>
                                            @error('category')
                                                <small class="error">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <select class="form-control " required name="type" id="type">
                                                <option value="">--select--</option>
                                                <option value="Veg" <?=($product_data->type == 'Veg')?'selected':''?>>Veg</option>
                                                <option value="Non-Veg" <?=($product_data->type == 'Non-Veg')?'selected':''?>>Non-Veg</option>
                                            </select>
                                            @error('type')
                                                <small class="error">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Tags</label>
                                            <input type="text" class="form-control " placeholder="Tags" 
                                                name="tags" id="tags" value="<?=(old('tags') != '')?old('tags'):$product_data->tags?>" >
                                            @error('tags')
                                                <small class="error">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Customize</label>
                                            <select class="form-control " name="customize" id="customize">
                                                <option value="No" <?=($product_data->customize == 'No')?'selected':''?>>No</option>
                                                <option value="Yes" <?=($product_data->customize == 'Yes')?'selected':''?>>Yes</option>
                                            </select>
                                            @error('customize')
                                                <small class="error">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control " name="status" id="status">
                                                <option value="Active" <?=($product_data->status == 'Active')?'selected':''?>> Active</option>
                                                <option value="Deactive" <?=($product_data->status == 'Deactive')?'selected':''?>>Deactive</option>
                                            </select>
                                            @error('status')
                                                <small class="error">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="form-control" name="description" placeholder="Enter your item description"><?=(old('description') != '')?old('description'):$product_data->description?></textarea>
                                                @error('description')
                                                    <small class="error">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save <span class="loader"></span></button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<x-admin-footer />

<script>
    prodImg.onchange = evt => {
    const [file] = prodImg.files
    if (file) {
        preview.src = URL.createObjectURL(file)
    }
    }
</script>