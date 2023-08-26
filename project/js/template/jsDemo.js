$(document).ready(function () {
  dialog("Notify", "Page finished loading !!");

  $.get("/api/demo/modal", function (data, textSuccess) {
    console.log(data);
  });
});
