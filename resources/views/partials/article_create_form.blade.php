                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Title:</strong>
                                    <input type="text" name="title" class="form-control" id="title" value="{!! old('title') !!}" placeholder="Title"> 
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Image:</strong>
                                    <input type="file" name="image" class="form-control" id="image" value="{!! old('image') !!}" placeholder="Image"> 
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Description:</strong>
                                    <input type="text" name="description" class="form-control" id="description" value="{!! old('description') !!}" placeholder="Description"> 
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Caption:</strong>
                                    <input type="text" name="caption" class="form-control" id="caption" value="{!! old('caption') !!}" placeholder="Caption"> 
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Content:</strong>
                                    <textarea class="form-control" id="summary-ckeditor" rows="6" name="content" placeholder="Content"></textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Category:</strong>
                                    <select id="category" type="category" value="{!! old('category') !!}" class="form-control" name="category">
                                        <option value="">Select category</option>
                                        @foreach ($categories as $category)
                                        <option value="{!! $category->id !!}">{!! $category->name !!}</option>
                                            @endforeach
                                    </select>

                                    @if($errors->has('category'))
                                        <span class="help-block">
                                            <span class="text-danger">{!! $errors->first('category') !!}</span>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Tags:</strong>
                                    {!! Form::select('tags[]',$tags,old('tags'),['class'=>'form-control','multiple'=>'multiple']) !!}
                                    @error('tags')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Keywords:</strong>
                                    <input type="text" name="keywords" class="form-control" id="keywords" value="{!! old('keywords') !!}" placeholder="Keywords">
                                </div>
                            </div>
                            