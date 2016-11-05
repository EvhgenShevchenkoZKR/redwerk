@extends('redwerk')

@section('content')
    <div class="slider-form form-wrapper">
        <h1 class="apage-title">Create slide</h1>
        {{Form::open(['action' => ['SliderController@update', $slider], 'method' => 'PATCH', 'class' => 'form', 'files' => true])}}

        <div class="img-outer-wrapper col-md-12">
            <div class="img-wrapper thumbnail-wrapper">
                <img class="thumbnail" src="/images/slides/{{$slider->id}}/{{$slider->image}}" />
            </div>
        </div>

        <div id="selectImage" class="col-md-12">
            {!! Form::label('Image:') !!}
            {!! Form::file('image', ['class' => 'form-control img-upload', 'id' => 'file']) !!}
            <output id="result" /></output>
        </div>

        <div class="form-group col-md-6">
            {!! Form::label('link_text', 'Button text:', ['class' => 'title-label required']) !!}
            {!! Form::text('link_text', $slider->link_text, ['class' => 'form-control', 'placeholder' => 'Button text']) !!}
        </div>

        <div class="form-group col-md-6">
            {!! Form::label('url', 'Url:', ['class' => 'title-label required']) !!}
            {!! Form::text('url', $slider->url, ['class' => 'form-control', 'placeholder' => 'Url']) !!}
        </div>

        <div class="col-md-12 clearfix body-wrapper">
            {!! Form::label('body', 'Text:', ['class' => 'required']) !!}
            {!! Form::textarea('body', $slider->body, ['class' => 'form-control', 'size' => '50x5']) !!}
        </div>

        <div class="form-group checkbox-wrapper col-md-6">
            <label>Published:
                {!! Form::hidden('published', 0) !!}
                {!! Form::checkbox('published', 1, $slider->published, ['class' => 'checkbox-inline']) !!}
            </label>
        </div>

        <div class="form-group col-md-6">
            {!! Form::submit('Submit', ['class' => 'btn btn-success pull-right']) !!}
        </div>
        {{Form::close()}}
    </div>
@endsection

@include('partials.image_upload')
