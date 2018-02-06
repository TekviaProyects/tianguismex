
document.addEventListener('DOMContentLoaded', function() {
  anime.timeline({
      loop: !0
  }).add({
      targets: "#animacion .superior",
      translateY: -10,
      duration: 1500,
      easing: "linear"
  }).add({
      targets: "#animacion .superior",
      translateY: 0,
      duration: 500,
      easing: "linear"
  })
});
window.onload = function(){
  document.getElementById('animacionA').classList.remove('show');
};
