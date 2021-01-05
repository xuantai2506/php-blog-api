// Get the modal
var modal_login = document.getElementById('id01');
var modal_register = document.getElementById('id02');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal_login) {
    modal_login.style.display = "none";
  }
  if (event.target == modal_register){
    modal_register.style.display = "none";
  }
}