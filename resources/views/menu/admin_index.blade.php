@extends('redwerk')

@include('partials.draggable_scripts')

<span style="display: none;" href="#" id="token" data-token="{{ csrf_token() }}"></span>
@section('content')
    <h1 class="apage-title relative-apage-title">Menu items</h1>
    {{--<table>--}}
    <ol id="sortable" class="ui-sortable fake-table">
        <?php $i = 0; ?>
        <div class="fake-thead">
            <span class="fake-th fake-th-40">Title</span>
            <span class="fake-th fake-th-40">Url</span>
            <span class="fake-th fake-th-10">Published</span>
            <span class="fake-th fake-th-10">Actions</span>
        </div>
            @foreach($main_menus as $main_menu)
                <li id="list_{{$main_menu['id']}}" class="ui-state-default col-md-12 clearfix">
                <div class="inner-div top-level">

                    <span class="fake-column draggable-40">
                        <span class="glyphicon glyphicon-move"></span>
                        <span>{{$main_menu['title']}}</span>
                    </span>

                    <span class="fake-column draggable-40">{{$main_menu['url']}}</span>

                    <span class="fake-column draggable-10">
                        @if($main_menu['published'])
                            <span class="agreen">Yes</span>
                        @else
                            <span class="ared">No</span>
                        @endif
                    </span>

                    <div class='draggable-actions draggable-10'>
                        <span class="glyphicon glyphicon-edit glif-fake-btn">
                            <a class="atable-button" href="/adm/menu/{{$main_menu['id']}}/edit">&nbsp;</a>
                        </span>
                        <span class="glyphicon glyphicon-remove glif-fake-btn">
                            <?php $main_menuId = $main_menu['id']; ?>
                            {!! Form::open(array('url' => "/adm/menu/$main_menuId/delete", 'method' => 'delete', 'class' => 'form')) !!}
                            {!! Form::submit('&nbsp;', ['class' => 'btn-delete hidden-button']) !!}
                            {!! Form::close() !!}
                        </span>
                    </div>

                </div>
                    @if(isset($main_menu['subtypes']))
                        <ol class="sub-level-ol">
                            @foreach($main_menu['subtypes'] as $subtype)
                            <li id="list_{{$subtype['id']}}" class="ui-state-default col-md-12 clearfix">
                                <div class="inner-div sub-level">

                                    <span class="fake-column draggable-40">
                                        <span class="glyphicon glyphicon-move"></span>
                                        <span>{{$subtype['title']}}</span>
                                    </span>

                                    <span class="fake-column url draggable-40">{{$subtype['url']}}</span>

                                    <span class="fake-column draggable-10">
                                        @if($subtype['published'])
                                            <span class="agreen">Yes</span>
                                        @else
                                            <span class="ared">No</span>
                                        @endif
                                    </span>

                                    <div class='draggable-actions draggable-10'>
                                        <span class="glyphicon glyphicon-edit glif-fake-btn">
                                            <a class="atable-button" href="/adm/menu/{{$subtype['id']}}/edit">&nbsp;</a>
                                        </span>
                                        <span class="glyphicon glyphicon-remove glif-fake-btn">
                                            <?php $subtype_id = $subtype['id']; ?>
                                            {!! Form::open(array('url' => "/adm/menu/$subtype_id/delete", 'method' => 'delete', 'class' => 'form')) !!}
                                            {!! Form::submit('&nbsp;', ['class' => 'btn-delete hidden-button']) !!}
                                            {!! Form::close() !!}
                                        </span>
                                    </div>

                                </div>
                            </li>
                            @endforeach
                        </ol>
                    @endif
                </li>
            @endforeach
    </ol>
@endsection

@include('partials.draggable')
