@extends('redwerk')


@section('content')

    <h4 class="sending description">You can immediately send email for all subscribers with this form</h4>
    {!! Form::open(['action' => 'SubscriptionController@delivery', 'method' => 'POST', 'class' => 'form']) !!}
    <div class="col-md-12 clearfix message-wrapper">
        {!! Form::label('message', 'Message', ['class' => 'front-label']) !!}
        {!! Form::textarea('message', old('message'), ['class' => 'form-control', 'size' => '50x5']) !!}
    </div>
    <div class="form-group col-md-12">
        {!! Form::submit('Submit', ['class' => 'btn btn-red pull-right']) !!}
    </div>
    {!! Form::close() !!}

    <h1 class="apage-title relative-apage-title">Menu items</h1>
    <ul id="subscriptions" class="subscriptions fake-table">
        <?php $i = 0; ?>
        <div class="fake-thead">
            <span class="fake-th fake-th-20">Email</span>
            <span class="fake-th fake-th-10">Budget</span>
            <span class="fake-th fake-th-40">Message</span>
            <span class="fake-th fake-th-9">Callback</span>
            <span class="fake-th fake-th-10">Subscribed</span>
            <span class="fake-th fake-th-10">Remove</span>
        </div>
            @foreach($subscriptions as $subscription)
                <li class="clearfix">
                    <span class="fake-column draggable-20">
                        <span>{{$subscription->email}}</span>
                    </span>

                    <span class="fake-column draggable-10">
                        <span>{{$subscription->budget}}</span>
                    </span>

                    <span class="fake-column draggable-40">
                        <span>{{$subscription->message}}</span>
                    </span>

                    <span class="fake-column draggable-9">
                        @if($subscription->callback)
                            <span class="agreen">Yes</span>
                        @else
                            <span class="ared">No</span>
                        @endif
                    </span>
                    <span class="fake-column draggable-10">
                        @if($subscription->subscribe)
                            <span class="agreen">Yes</span>
                        @else
                            <span class="ared">No</span>
                        @endif
                    </span>

                    <div class='draggable-actions draggable-10'>
                        <span class="glyphicon glyphicon-remove glif-fake-btn">
                            {!! Form::open(array('url' => "/adm/subscription/$subscription->id/delete", 'method' => 'delete', 'class' => 'form')) !!}
                            {!! Form::submit('&nbsp;', ['class' => 'btn-delete hidden-button']) !!}
                            {!! Form::close() !!}
                        </span>
                    </div>
                </li>
            @endforeach
    </ul>
@endsection

