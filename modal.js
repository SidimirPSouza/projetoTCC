document.getElementById("open-modal").addEventListener("click", function() {
  document.getElementById("fade").classList.remove("hide");
  document.getElementById("modal").classList.remove("hide");
});

document.getElementById("close-modal").addEventListener("click", function() {
  document.getElementById("fade").classList.add("hide");
  document.getElementById("modal").classList.add("hide");
});
