// this will happen when whole .album class tag is loaded completed
// to execute this we need masonry, imageuploaded lib, jquery cdn

var $grid = $("#masonry-area").masonry({
  percentPosition: true,
});
$grid.imagesLoaded().progress(function () {
  $grid.masonry("layout");
});

$("#share-memory").click(function () {
  var formData = new FormData();
  var file = $("#post_image")[0].files[0];
  console.log("File: ", file);
  console.log("Text: ", $("#post_text").val());
  if ($("#post_text").val().length == 0) {
    new Toast("Error", "now", "Please enter some text").show();
    return;
  }
  if (file) {
    formData.append("post_image", file);
    formData.append("post_text", $("#post_text").val());
    $.ajax({
      url: "/api/posts/create",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (data) {
        new Toast(
          "Success",
          "now",
          "Post Created Successfully, Post not visible? refresh the page !!palan"
        ).show();
        console.log("Post Created Successfully");
        console.log(data);
        data = $(data);
        $grid.prepend(data).masonry("prepended", data).masonry("layout");
        $grid.imagesLoaded().progress(function () {
          $grid.masonry("layout");
        });
        var inputs = document.querySelectorAll("input");
        for (var i = 0; i < inputs.length; i++) {
          inputs[i].value = "";
        }
        var textarea = document.querySelectorAll("textarea");
        for (var i = 0; i < textarea.length; i++) {
          textarea[i].value = "";
        }
        refreshTotalPostCount();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log("AJAX Request Failed:", textStatus, errorThrown);
        console.log("Response Text:", jqXHR.responseText);
        try {
          var responseJson = JSON.parse(jqXHR.responseText);
          var postId = responseJson["Post Id"];
          var errorMsg = responseJson.msg;
          console.log("Post ID:", postId);
          console.log("Error:", errorMsg);
          new Toast(textStatus, "now", "Error: " + errorMsg).show();
        } catch (e) {
          console.log("Error parsing response JSON:", e);
          new Toast("Error occurred", "now", e).show();
        }
      },
    });
  } else {
    console.log("No Image Selected");
    new Toast("Error", "now", "Please select a file to upload").show();
  }
});

$.post("/api/posts/count", function (data) {
  // console.log(data.Post_Count);
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

$(document).on("click", ".album .btn-delete", function () {
  post_id = $(this).attr("data-id");
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
            if (textSuccess == "success") {
              console.log("Post Deleted Successfully");
              var del_element = $(`#post-${post_id}`)[0];
              $grid.masonry("remove", del_element).masonry("layout");
              refreshTotalPostCount();
              new Toast("Success", "now", "Post Deleted Successfully").show();
            } else {
              console.log("Post Not Deleted, error");
              new Toast("Error", "now", "Post Not Deleted").show();
            }
            continueAfterTasks();
          }
        ).fail(function (jqXHR, textStatus, errorThrown) {
          console.log("AJAX Request Failed:", textStatus, errorThrown);
          console.log("Response Text:", jqXHR.responseText);
          try {
            var responseJson = JSON.parse(jqXHR.responseText);
            var postId = responseJson["Post Id"];
            var errorMsg = responseJson.msg;
            console.log("Post ID:", postId);
            console.log("Error:", errorMsg);
            new Toast(textStatus, "now", "Error: " + errorMsg).show();
          } catch (e) {
            console.log("Error parsing response JSON:", e);
            new Toast("Error occurred", "now", e).show();
          }
        });
        $(event.data.modal).modal("hide");
      },
    },
  ]);
  d.show();
});

function refreshTotalPostCount() {
  $.post("/api/posts/count", function (data) {
    $("#total-posts").html("Total Posts: " + data.Post_Count);
  });
}

function continueAfterTasks() {
  if (allTasksCompleted()) {
    $grid.masonry("layout");
  }
}

function allTasksCompleted() {
  return true;
}

$(document).on("click", ".album .btn-like", function () {
  post_id = $(this).parent().attr("data-id");
  $this = $(this);
  $(this).html() === "Like" ? $(this).html("Liked") : $(this).html("Like");
  $(this).hasClass("btn-outline-primary")
    ? $(this).removeClass("btn-outline-primary").addClass("btn-primary")
    : $(this).removeClass("btn-primary").addClass("btn-outline-primary");
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
        new Toast("Success", "now", "Post Liked Successfully").show();
      }
    }
  ).fail(function (jqXHR, textStatus, errorThrown) {
    console.log("AJAX Request Failed:", textStatus, errorThrown);
    console.log("Response Text:", jqXHR.responseText);
    try {
      var responseJson = JSON.parse(jqXHR.responseText);
      var postId = responseJson["Post Id"];
      var errorMsg = responseJson.msg;
      console.log("Post ID:", postId);
      console.log("Error:", errorMsg);
      new Toast(textStatus, "now", "Error: " + errorMsg).show();
    } catch (e) {
      console.log("Error parsing response JSON:", e);
      new Toast("Error occurred", "now", e).show();
    }
  });
});
