    
    <?php /*
    <div class="row">   
        <div class="col-lg-6">
            <div class="form-group" >
                <label>Select Sort Category</label> 
                <select class="form-control" style="width:200px;" name ="sort_category"  >
                <option   value="sku" <?php if($q->sort_category == "sku") echo "selected";?> >SKU</option>
                <option   value="price" <?php if($q->sort_category == "price") echo "selected";?>>Price</option>
                </select>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group" >
                <label>Select Sort Type</label> 
                <select class="form-control" style="width:200px; " name ="sort_type" >
                <option   value="asc" <?php if($q->sort_type == "asc") echo "selected";?> >Accending</option>
                <option   value="desc" <?php if($q->sort_type == "desc") echo "selected";?> >Decending</option>
                </select>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                
            </div>
        </div>
    </div>

    */?>
        
                    
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group" >
            <?php inputfield("Title","text","page_title","form-control",'page_title',$q->page_title,'',"Enter contact text",'','',"",''); ?>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group" >
            <?php inputfield("Contact","text","contact","form-control",'contact',$q->contact,'',"Enter contact text",'','',"",''); ?>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-6">
            <div class="form-group" >
            <?php inputfield("Email","email","email","form-control",'email',$q->email,'',"Enter email",'','',"",''); ?>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
            
            </div>
        </div>
    </div>

   
    <div class="form-group">
        <input type="submit" value="SAVE" class="btn btn-success">
        <input type="hidden" value="{{$q->id}}"  name="id">
        
    </div>