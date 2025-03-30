const olho2 = document.getElementById("olho2");
const ConfSenha = document.getElementById("ConfSenha");

olho2.addEventListener("mouseover", mostrar);
olho2.addEventListener("mouseout" , esconder);

function mostrar(){
    ConfSenha.type = "text";
    olho2.className = "fa fa-eye";

}

function esconder(){
    ConfSenha.type = "password";
    olho2.className = "fa fa-eye-slash";
}