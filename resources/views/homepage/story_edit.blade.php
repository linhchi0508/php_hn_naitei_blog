@extends('homepage.app')

@section('content')
	<section>
        <div class="gap2 gray-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row merged20" id="page-contents">
                            <div class="col-lg-12">
                                <div class="central-meta item">
                                    <div class="user-post">
                                        <div>
                                            <b><h2 class="text-primary text-center">{{ trans('homepage.edit_story') }}</h2></b>
                                        </div>
                                        <div class="col-12">
                                            <form action="{{ route('stories.update', $story->id) }}" method="post" enctype="multipart/form-data">
                                                @method('put')
                                                @csrf
                                                <div class="form-group">
                                                    <label><h5 class="text-primary">{{ trans('homepage.content_story') }}</h5></label>
                                                    <b><textarea name="content" >{{ $story->content }}</textarea></b>
                                                </div>
                                                <div class="form-group">
                                                    <label><h5 class="text-primary">{{ trans('homepage.avatar') }}</h5></label>
                                                    <input type="file"  name="photos[]" multiple>
                                                </div>
                                                <div class="form-group filled">
                                                    <label><h5 class="text-primary">{{ trans('homepage.category') }}</h5></label>
                                                    <select class="form-control1 ng-invalid ng-invalid-required" name="category" value="{{ $story->categories_id }}" ng-model="model.select" required="">
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group filled">
                                                    <label><h5 class="text-primary">{{ trans('homepage.status') }}</h5></label>
                                                    <select class="form-control1 ng-invalid ng-invalid-required" name="status" ng-model="model.select" required="">
                                                        <option value="public">{{ trans('homepage.public') }}</option>
                                                        <option value="draft">{{ trans('homepage.draft') }}</option>
                                                        <option value="unlisted">{{ trans('homepage.unlisted') }}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group d-flex align-items-center flex-column">
                                                    <button type="submit" class="btn btn-primary rounded">{{ trans('homepage.submit') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>	
                    </div>
                </div>
            </div>
        </div>	
    </section>
@endsection
