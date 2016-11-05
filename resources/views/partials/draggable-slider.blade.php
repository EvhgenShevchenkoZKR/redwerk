@section('footerscripts')
    <script>

        $(document).ready(function(){
            $('.ui-sortable').nestedSortable({
                handle: 'div',
                items: 'li',
                toleranceElement: '> div',
                maxLevels: 1,
                stop: function() { save_order(); }
            });
        });

        function save_order(){
            var serialized = $('#sortable').nestedSortable('serialize');

            var data = {
                _token:$('#token').data('token'),
                menudata: serialized
            };

            $.ajax({
                url: "/ajax-slider",
                type:"POST",
                data: data,
                success:function(data){
                    $('.logs').prepend('<div id="panel-absolute" class="alert alert-success">' + data.msg + '</div>');
                    $("#panel-absolute").fadeIn( 600 ).delay( 800 ).fadeOut( 800 );
                },
                error:function(){
                    console.log("Something wrong with menu items reorder");
                }
            });
        }

    </script>
@endsection