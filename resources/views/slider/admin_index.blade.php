@extends('redwerk')

@include('partials.draggable_scripts')

<span style="display: none;" href="#" id="token" data-token="{{ csrf_token() }}"></span>
@section('content')
    <h1 class="apage-title relative-apage-title">Slides</h1>
    <ol id="sortable" class="ui-sortable fake-table">
        <?php $i = 0; ?>
        <div class="fake-thead">
            <span class="fake-th fake-th-20">Slide</span>
            <span class="fake-th fake-th-30">Title</span>
            <span class="fake-th fake-th-30">Url</span>
            <span class="fake-th fake-th-10">Published</span>
            <span class="fake-th fake-th-10">Actions</span>
        </div>
            @foreach($sliders as $slider)
                <li id="list_{{$slider->id}}" class="ui-state-default col-md-12 clearfix">
                <div class="inner-div top-level">

                    <span class="fake-column draggable-20">
                        <span class="glyphicon glyphicon-move"></span>
                        <img class="mini-image" src="/images/slides/{{$slider->id}}/{{$slider->image}}" />
                    </span>

                    <span class="fake-column draggable-30">
                        <span>{{$slider->link_text}}</span>
                    </span>

                    <span class="fake-column draggable-30">
                        {{$slider->url}}
                    </span>

                    <span class="fake-column draggable-10">
                        @if($slider->published)
                            <span class="agreen">Yes</span>
                        @else
                            <span class="ared">No</span>
                        @endif
                    </span>

                    <div class='draggable-actions draggable-10'>
                        <span class="glyphicon glyphicon-edit glif-fake-btn">
                            <a class="atable-button" href="/adm/slider/{{$slider->id}}/edit">&nbsp;</a>
                        </span>
                        <span class="glyphicon glyphicon-remove glif-fake-btn">
                            {!! Form::open(array('url' => "/adm/slider/$slider->id/delete", 'method' => 'delete', 'class' => 'form')) !!}
                            {!! Form::submit('&nbsp;', ['class' => 'btn-delete hidden-button']) !!}
                            {!! Form::close() !!}
                        </span>
                    </div>

                </div>
                </li>
            @endforeach
    </ol>
@endsection

@include('partials.draggable-slider')
