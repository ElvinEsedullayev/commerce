 <div class="form-group">
                    <label for="">Select Category Level</label>
                    <select name="parent_id" id="" class="form-control" style="width: 100%;">
                      <option value="0" @if(isset($category['parent_id']) && $category['parent_id'] == 0) selected @endif>Main Category</option>
                      @if(!empty($getSubategory))
                      @foreach($getSubategory as $parentcategory)
                      <option value="{{$parentcategory['id']}}" @if(isset($category['parent_id']) && $category['parent_id'] == $parentcategory['id']) selected @endif>{{$parentcategory['category_name']}}</option>
                       @if(!empty($parentcategory['subcategories']))
                      @foreach($parentcategory['subcategories'] as $subcategory)
                       <option value="{{$subcategory['id']}}" @if(isset($subcategory['parent_id']) && $subcategory['parent_id'] == $subcategory['id']) selected @endif>&nbsp;&raquo;&nbsp;{{$subcategory['category_name']}}</option>
                      @endforeach
                      @endif
                      @endforeach
                     
                      @endif
                    </select>
                  </div>