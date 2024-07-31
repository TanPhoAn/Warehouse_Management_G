document.addEventListener("DOMContentLoaded", function () {
  function handleBlockClick(blockId, infoId) {
    document.getElementById(blockId).addEventListener("click", function () {
      showInfo(infoId);
      setActive(blockId);
    });
  }

  handleBlockClick("blockA", "blockAInfo");
  handleBlockClick("blockB", "blockBInfo");
  handleBlockClick("blockC", "blockCInfo");

  // Add event listeners for the date picker buttons
  document.querySelectorAll(".date-picker-button").forEach(button => {
    button.addEventListener("click", function () {
      const datePickerId = button.getAttribute("data-datepicker");
      var datePicker = document.getElementById(datePickerId);
      datePicker.style.display =
        datePicker.style.display === "block" ? "none" : "block";
      if (datePicker.style.display === "block") {
        datePicker.focus();
      }
    });
  });

  // Add event listeners for the "New Stock" buttons
  document.querySelectorAll("#newStockButton").forEach(button => {
    button.addEventListener("click", function () {
      window.location.href = "../InsertStock.php";
    });
  });

  // Add event listeners for the "Pick Stock" buttons
  document.querySelectorAll("#pickStockButton").forEach(button => {
    button.addEventListener("click", function () {
      window.location.href = "../pick/Pick.php";
    });
  });
});

function showInfo(infoId) {
  var infos = document.querySelectorAll(".block-info");
  infos.forEach(function (info) {
    info.style.display = "none";
  });
  document.getElementById(infoId).style.display = "block";
}

function setActive(activeId) {
  var buttons = document.querySelectorAll(".block-button");
  buttons.forEach(function (button) {
    button.classList.toggle("active", button.id === activeId);
  });
}
