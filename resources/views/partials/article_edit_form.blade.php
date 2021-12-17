<div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Title:</strong>
                                    <input type="text" name="title" value="{{ $article->title }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Image:</strong>
                                    <input type="file" name="image" value="{{ $article->image }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Description:</strong>
                                    <input type="text" name="description" value="{{ $article->description }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Caption:</strong>
                                    <input type="text" name="caption" value="{{ $article->caption }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Keywords:</strong>
                                    <input type="text" name="keywords" value="{{ $article->keywords }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Content:</strong>
                                    <textarea class="form-control" id="summary-ckeditor" name="content" rows="5" cols="40">
                                        {{ $article->content }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Category:</strong>
                                    <select id="category" type="category" class="form-control" name="category">
                                        <option value="">Select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{!! $category->id !!}" @if($article->category_id == $category->id) selected @endif>
                                                {!! $category->name !!}
                                            </option>
                                        @endforeach
                                    </select>

                                    @if($errors->has('category'))
                                        <span class="help-block">
                                            <strong>{!! $errors->first('category') !!}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Tags:</strong>
                                    {!! Form::select('tags[]',$tags,$articleTags,['class'=>'form-control','multiple'=>'multiple']) !!}
                                </div>
                            </div>
                            @cannot('isAuthor')
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Written By:</strong>
                                    <select id="author" type="author" class="form-control" name="author">
                                        <option value="">Select Author</option>
                                        @foreach ($authors as $author)
                                            <option value="{!! $author->id !!}" @if($article->user_id == $author->id) selected @endif>
                                                {!! $author->name !!}
                                            </option>
                                        @endforeach
                                    </select>

                                    @if($errors->has('category'))
                                        <span class="help-block">
                                            <strong>{!! $errors->first('category') !!}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @endcannot
                            @can('isEditor')
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <input type="checkbox" class="custom-control-input" name="publish" id="publish-post" @if($article->is_published) checked @endif>
                                    <label class="custom-control-label" for="publish-post">Publish</label>
                                </div>
                            </div>
                            @endcan