<!DOCTYPE html>
<html>
<head>
  <title>My Gallery</title>
  <style>
    /* CSS for the image grid */
    .image-grid {
      display: flex;
      flex-wrap: wrap;
    }
    .image-grid img {
      width: 20%;
      padding: 10px;
    }
  </style>
</head>
<body>
  <h1>My Gallery</h1>
  <div class="image-grid">
    <?php
    // The directory where your images are stored
    $image_dir = 'images/';

    // Get a list of all the image files in the directory
    $images = glob($image_dir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

    // Loop through the list of images and display them in the grid
    foreach ($images as $image) {
      echo '<img src="' . $image . '" alt="">';
    }
    ?>
  </div>
  <script>
    // JavaScript for infinite scroll function
    var imageGrid = document.querySelector('.image-grid');
    var nextPage = 2;
    var loading = false;

    window.onscroll = function() {
      if (loading) return;

      if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
        loading = true;

        // Use fetch API to load the next page of images
        fetch('gallery.php?page=' + nextPage)
          .then(function(response) {
            return response.text();
          })
          .then(function(html) {
            imageGrid.innerHTML += html;
            nextPage++;
            loading = false;
          });
      }
    }
  </script>
</body>
</html>
