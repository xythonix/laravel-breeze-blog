<style>
    .outer_spinner
    {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        z-index: 9999;
        background: #fff
    }
    .inner_spinner  
    {
        position: relative;
        width: 100%;
        height: inherit;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 3rem;
    }
</style>

<div class="outer_spinner">
    <div class="inner_spinner">
        <span><i class="fas fa-spinner fa-spin"></i></span>
    </div>
</div>

<script src="https://cdn.tiny.cloud/1/ei1sc0w0o08jrbleydugh6uil5rfuurccp29k4m01kqpclc2/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    window.addEventListener('load', function(){
        var spinner = document.querySelector('.outer_spinner');
        spinner.style.display = 'none'
        tinymce.init({
            selector: 'textarea.tinymce-editor',
            height: 300,
            plugins: 'autolink lists link image',
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            automatic_uploads: true,
            images_upload_url: '/upload-image', // Replace with your image upload route
            images_upload_handler: function (blobInfo, success, failure) {
                // Implement your image upload logic here
            }
        });
    })
</script>