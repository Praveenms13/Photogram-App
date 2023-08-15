/* Developed By Praveen on Last Sync: 15/8/2023 @ 10:52:53*/
// this will happen when whole .album class tag is loaded completed
// to execute this we need masonry, imageuploaded lib, jquery cdn

var $grid = $("#masonry-area").masonry({
  // itemSelector: ".album",
  // columnWidth: ".album",
  percentPosition: true,
});
$grid.imagesLoaded().progress(function () {
  console.log("image loaded");
  $grid.masonry("layout");
});

//# sourceMappingURL=script.js.map