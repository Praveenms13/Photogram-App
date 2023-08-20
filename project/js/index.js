// this will happen when whole .album class tag is loaded completed
// to execute this we need masonry, imageuploaded lib, jquery cdn

var $grid = $("#masonry-area").masonry({
  percentPosition: true,
});
$grid.imagesLoaded().progress(function () {
  $grid.masonry("layout");
});
$.post(
  "/api/posts/count",
  {
    id: 54,
  },
  function (data) {
    $("#total-posts").html("Total Posts: " + data.Post_Count);
  }
);
