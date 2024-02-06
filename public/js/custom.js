$(document).ready(function() {
    //====== sidebar icon open and close script

    $('.collapse-icon').click(function() {
        $(this).toggleClass('collapsed')
        $('.sidebar').toggleClass('collapse-sidebar')
        $('.main-content').toggleClass('main-content-collapsed')
    })

    //====== listing detail page description show more button script 

    $('.detail-description button ').on('click', function() {
        $(this).css('display', 'none')
        $(this).prev('p').addClass('show-more')
    })

    //====== profile page upload profile image script

    $('#profile-image').change( function() {
        var file = this.files[0]
        if(file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#dp').attr('src', e.target.result)
            }
            reader.readAsDataURL(file)
        }
    })

   
    //====== add property page upload images and videos script

    // for images 
    $('#property-img').on('change', function(event) {
        const imageContainer = $('#property-images');
        const files = event.target.files;

        for (const file of files) {
          const reader = new FileReader();

          reader.onload = function (e) {
            const imageUrl = e.target.result;

            const imagePreview = $('<div class="image-preview"></div>');

            const image = $('<img>').attr({
              src: imageUrl,
              width: 100 // Adjust the width as needed
            });

            const closeIcon = $('<span class="close-icon">&times;</span>');

            closeIcon.on('click', function () {
              imagePreview.remove();
            });

            imagePreview.append(image, closeIcon);
            imageContainer.append(imagePreview);
          };

          reader.readAsDataURL(file);
        }
      });

    //   for videos 
    $('#property-video').on('change', function(event) {
        const videoContainer = $('#property-videos');
        const files = event.target.files;

        for (const file of files) {
          const reader = new FileReader();

          reader.onload = function (e) {
            const videoUrl = e.target.result;

            const videoElement = $('<video controls width="300"></video>').attr({
              src: videoUrl,
              type: file.type
            });

            const closeIcon = $('<span class="close-icon">&times;</span>').click(function() {
              videoPreview.remove();
            });

            const videoPreview = $('<div class="video-preview"></div>').append(videoElement, closeIcon);

            videoContainer.append(videoPreview);
          };

          reader.readAsDataURL(file);
        }
      });

      // data tables 
      let table = new DataTable('#myTable');
    
})