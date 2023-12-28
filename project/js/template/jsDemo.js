$(document).ready(function () {
  // dialog("Notify", "Page finished loading !!");
  $("#exampleModal").on("click", function () {
    console.log("Modal is clicked");
  });

  $("#exampleModal").on("show.bs.modal", function () {
    console.log("Modal is being shown");
  });

  $("#exampleModal").on("shown.bs.modal", function () {
    console.log("Modal is shown");
  });

  $("#exampleModal").on("hide.bs.modal", function () {
    console.log("Modal is being hidden");
  });

  $("#exampleModal").on("hidden.bs.modal", function () {
    console.log("Modal is hidden");
  });

  $("#exampleModal").on("mouseover", function () {
    console.log("Mouse over");
  });

  $("#text-box").on("keydown", function (event) {
    console.log(event.originalEvent.key + " Key is pressed");
  });

  $("#text-box").on("keyup", function (event) {
    console.log(event.originalEvent.key + " Key is released");
  });

  $("#FetchModal").on("click", function () {
    $.get("/api/demo/modal", function (data, textSuccess) {
      $("main#main").append(data);
    });
  });

  $("#liveToastBtn").on("click", function () {
    $("#liveToast").toast("show");
  });

  
  $("#FetchToast").on("click", function () {
    console.log("Toast is being fetched");
    new Toast("Danger", "lab is throttling", "shdcvdhc hd c dc dhc ", {
      delay: 5000,
    }).show();
  });
});
