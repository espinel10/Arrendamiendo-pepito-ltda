function verifyPassword(){
    var password = document.getElementById('password');
    var confirmPassword = document.getElementById('confirm');
    if (parseInt(password.value) < 8 && parseInt(confirmPassword.value) < 8){
        alert('8 caractéres como mínimo');
        return false;
    }   
    if (password.value != confirmPassword.value){
        alert('Las contraseñas no coinciden');
        return false;
    }else{
        alert('Las contraseñas ESTÁN CORRECTAS');       
    }   
 }

var submit = document.getElementById('send-form');
submit.addEventListener("click", verifyPassword);
