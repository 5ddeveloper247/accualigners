$(document).ready(function () {
    function readURL(input) {

        var fileInputShow = $('.fileInputShow');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                fileInputShow.attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }else{
            var defaultImage = fileInputShow.data('default');
            fileInputShow.attr('src', defaultImage);
        }
    }

    function readFileURL(input) {

        var fileInputShow = $('.fileInputShow');

        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function(e) {
                fileInputShow.attr('src', fileInputShow.data('hasfile'));
            }

            reader.readAsDataURL(input.files[0]);

        }else{
            var defaultImage = fileInputShow.data('default');
            fileInputShow.attr('src', defaultImage);
        }
    }

    $(".fileInput").change(function() {
        readURL(this);
    });

    $(".noImageFileInput").change(function() {
        readFileURL(this);
    });
});
