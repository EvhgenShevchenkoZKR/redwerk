@section('footerscripts')
    <script>
        $(document).ready(function(){

            if(window.File && window.FileList && window.FileReader)
            {
                var filesInput = document.getElementById("file");
                filesInput.addEventListener("change", function(event){
                    var output = document.getElementById("result");
                    var regex = /^.*(.jpg|.jpeg|.gif|.png)$/;
                    $($(this)[0].files).each(function () {
                        var file = $(this);
                        if (regex.test(file[0].name.toLowerCase())) {
                            $('#result div').remove();// removing old images on uploading new
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var div = document.createElement("div");
                                div.innerHTML = "<div class='thumbnail-wrapper'><img class='thumbnail' src='" + e.target.result + "'" +
                                        "title='" + file[0].name + "'/></div>";
                                output.insertBefore(div,null);
                            }
                            reader.readAsDataURL(file[0]);
                        } else {
                            dvPreview.html("");
                            return false;
                        }
                    });
                });
            }
            else
            {
                console.log("Your browser does not support File API");
            }
        });

    </script>
@endsection