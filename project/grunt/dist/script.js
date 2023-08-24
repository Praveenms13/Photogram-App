/* Developed By Praveen on Last Sync: 24/8/2023 @ 10:27:51*/
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
    console.log(data.Post_Count);
    $("#total-posts").html("Total Posts: " + data.Post_Count);
  }
);
$(".btn-delete").click(function () {
  post_id = $(this).parent().attr("data-id");
  d = new Dialog("Delete Post", "Are you sure you want to delete this post?");
  d.setButtons([
    {
      name: "Delete",
      class: "btn-danger",
      onClick: function (event) {
        $.post(
          "/api/posts/delete",
          {
            id: post_id,
          },
          function (data, textSuccess) {
            console.log(data);
            console.log(textSuccess);
            if (textSuccess == "success") {
              console.log("Post Deleted Successfully");
              $(`#post-${post_id}`).remove();
            } else {
              console.log("Post Not Deleted, error");
            }
            continueAfterTasks();
          }
        );
        $(event.data.modal).modal("hide");
      },
    },
    {
      name: "Cancel",
      class: "btn-secondary",
      onClick: function (event) {
        console.log("Post Not Deleted");
        $(event.data.modal).modal("hide");
        continueAfterTasks();
      },
    },
  ]);
  d.show();
});


// TODO: To make it more efficient, we can use this function to check if all tasks are completed
function continueAfterTasks() {
  if (allTasksCompleted()) {
    $grid.masonry("layout");
  }
}

function allTasksCompleted() {
  return true;
}


//# sourceMappingURL=script.js.map