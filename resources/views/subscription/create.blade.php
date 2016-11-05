    <div class="front-form front-form-wrapper">
        <h1 class="front-title">Get in touch <br> with our team</h1>

        {!! Form::open(['action' => 'SubscriptionController@store', 'method' => 'POST', 'class' => 'subscription-form form clearfix']) !!}

            <div class="clearfix">
                <div class="form-group col-md-6">
                    @if ($errors->has('email')) @php $extra = 'error-item'; @endphp @else @php $extra = ''; @endphp @endif
                    {!! Form::label('email', 'Email', ['class' => 'front-label']) !!}
                    {!! Form::text('email', old('email'), ['class' => "form-control $extra", 'placeholder' => 'E-mail address']) !!}
                    @if ($errors->has('email'))
                        <span class="inline-error">{{ $errors->first('email', ":message") }}</span>
                    @endif
                </div>

                <div class="form-group budget-wrapper col-md-6">
                    {!! Form::label('budget', 'Budget', ['class' => 'front-label']) !!}
                    {!! Form::select('budget', [
                       '500' => '$500 - $1000',
                       '1000' => '$1000 - $5000',
                       '5000' => '$5000 - $50000'],
                       old('budget'),
                       ['class' => 'form-control budget-select']
                    ) !!}
                </div>
            </div>

            <div class="col-md-12 clearfix message-wrapper">
                @if ($errors->has('message')) @php $extra = 'error-item'; @endphp @else @php $extra = ''; @endphp @endif
                {!! Form::label('message', 'Message', ['class' => 'front-label']) !!}
                {!! Form::textarea('message', old('message'), ['class' => "form-control $extra", 'size' => '50x5']) !!}
                @if ($errors->has('message'))
                    <span class="inline-error">{{ $errors->first('message', ":message") }}</span>
                @endif
            </div>

            <div class="down-part clearfix">
                <div class="privacy-protected pull-right col-md-5">
                    <span class="privacy-lock">Your privacy is protected</span>
                </div>

                <div class="form-group checkbox-wrapper col-md-7">
                    <label>
                        <span class="checkboxRed">
                        {!! Form::checkbox('agree', 1, old('agree'), ['class' => 'checkbox-inline', 'id' => 'agreeCh']) !!}
                        <label for="agreeCh"></label>
                        </span>
                        @if ($errors->has('agree')) @php $extra = 'error-item'; @endphp @else @php $extra = ''; @endphp @endif
                        <span class="checkbox-label {{$extra}}">I agree to the <a target="_blank" href="/terms">terms of use and privacy policy</a></span>
                    </label>
                    <label>
                        {!! Form::hidden('callback', 0) !!}
                        <span class="checkboxRed">
                        {!! Form::checkbox('callback', 1, old('callback'), ['class' => 'checkbox-inline', 'id' => 'callbackCh']) !!}
                        <label for="callbackCh"></label>
                        </span>
                        <span class="checkbox-label">I want that you callback me as soon as possible</span>
                    </label>
                </div>
            </div>


            <div class="subscribe-radio col-md-12">
                <span class="buttons-label-wrapper">
                    {!! Form::label('subscribe', 'Want to subscribe our news?', ['class' => 'rb-label']) !!}
                </span>
                <span class="buttons-wrapper">
                    <input id="subscribeY" type="radio" name="subscribe" value="1" checked="checked"><label for="subscribeY"><span><span></span></span><b>Yes</b></label>
                    <input id="subscribeN" type="radio" name="subscribe" value="0"><label for="subscribeN"><span><span></span></span><b>No</b></label>
                </span>
            </div>

            <div class="form-group col-md-6">
                {!! Form::submit('SEND', ['class' => 'btn btn-red pull-left']) !!}
            </div>
        {!! Form::close() !!}
</div>
