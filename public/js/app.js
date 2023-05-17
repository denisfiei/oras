$(window).on('load', function () {
    $('.text_numeric').keypress(function() {
        if (event.keyCode < 48 || event.keyCode > 57) {
            event.returnValue = false;
        }
    });
    $('.show_password').on('click', function (e) {
        e.preventDefault();
        var $this = $(this),
        inputGroupText = $this.closest('.form-password-toggle'),
        formPasswordToggleIcon = $this,
        formPasswordToggleInput = inputGroupText.find('input');

        if (formPasswordToggleInput.attr('type') === 'text') {
            formPasswordToggleInput.attr('type', 'password');
            formPasswordToggleIcon.find('i').replaceWith('<i class="far fa-eye"></i>');
        } else if (formPasswordToggleInput.attr('type') === 'password') {
            formPasswordToggleInput.attr('type', 'text');
            formPasswordToggleIcon.find('i').replaceWith('<i class="far fa-eye-slash"></i>');
        }
    });
});
function showMyImage(fileInput) {
    var files = fileInput.files;
    for (var i = 0; i < files.length; i++) {           
        var file = files[i];
        var imageType = /image.*/;     
        if (!file.type.match(imageType)) {
            continue;
        }           
        var img=document.getElementById("thumbnil");
        img.style.display = 'block';
        img.file = file;    
        var reader = new FileReader();
        reader.onload = (function(aImg) { 
            return function(e) { 
                aImg.src = e.target.result; 
            }; 
        })(img);
        reader.readAsDataURL(file);
    }    
}