// this will happen when whole .album class tag is loaded completed
// to execute this we need masonry, imageuploaded lib, jquery cdn

var $grid = $("#masonry-area").masonry({
  percentPosition: true,
});
$grid.imagesLoaded().progress(function () {
  $grid.masonry("layout");
});

$.post("/api/posts/count", function (data) {
  console.log(data.Post_Count);
  $("#total-posts").html("Total Posts: " + data.Post_Count);
});
function setCookie(name, value, daystoExpire) {
  // console.log("Setting Cookie");
  // console.log("Cookie name: " + name + " Cookie Value: " + value);
  var date = new Date();
  date.setTime(date.getTime() + daystoExpire * 24 * 60 * 60 * 1000);
  document.cookie = name + "=" + value + "; expires=" + date.toGMTString();
  // console.log(document.cookie);
}

$(".btn-delete").click(function () {
  post_id = $(this).parent().attr("data-id");
  d = new Dialog("Delete Post", "Are you sure you want to delete this post?");
  d.setButtons([
    {
      name: "Cancel",
      class: "btn-secondary",
      onClick: function (event) {
        $(event.data.modal).modal("hide");
        continueAfterTasks();
      },
    },
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
            // console.log(data);
            // console.log(textSuccess);
            if (textSuccess == "success") {
              console.log("Post Deleted Successfully");
              $(`#post-${post_id}`).remove();
            } else {
              console.log("Post Not Deleted, error");
            }
            continueAfterTasks();
          }
        ).fail(function (jqXHR, textStatus, errorThrown) {
          console.log("AJAX Request Failed:", textStatus, errorThrown);
          console.log("Response Text:", jqXHR.responseText); // Add this line
        });
        $(event.data.modal).modal("hide");
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

// TODO: TO Fix Console.log error(Not Working)
$(".btn-like").click(function () {
  post_id = $(this).parent().attr("data-id");
  $this = $(this);
  $(this).html() === "Like" ? $(this).html("Liked") : $(this).html("Like");
  $(this).hasClass("btn-outline-primary") ? $(this).removeClass("btn-outline-primary").addClass("btn-primary") : $(this).removeClass("btn-primary").addClass("btn-outline-primary");
  $.post(
    "/api/posts/like",
    {
      id: post_id,
    },
    function (data, textSuccess, jqXHR) {
      console.log(data);
      console.log(textSuccess);
      if (textSuccess == "success") {
        if (data.Liked) {
          $($this).html("Liked");
          $($this).removeClass("btn-outline-primary").addClass("btn-primary");
        } else {
          $($this).html("Like");
          $($this).removeClass("btn-primary").addClass("btn-outline-primary");
        }
      }
    }
  ).fail(function (jqXHR, textStatus, errorThrown) {
    console.log("AJAX Request Failed:", textStatus, errorThrown);
    console.log("Response Text:", jqXHR.responseText);
  });
});
