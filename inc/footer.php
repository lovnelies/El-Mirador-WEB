<DIV class="container-fluid bg-dark mt-5">
        <div class="row">
            <div class="col-lg-4 p-4">
                <h3 class= "white fw-bold fs-3 mb-2"> </h3>
                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sunt, accusamus voluptate. Similique fuga, accusantium 
                    officiis reprehenderit sapiente eius non laborum minima unde vero ea provident cupiditate rem repudiandae soluta animi.
                </p>
            </div>
            <div class=" col-lg-4 p-4">
                    <h5 class="mb-3">LINKS</h5>
                    <a href="index.php" class="d-inline-block mb-2 text-white text-decoration-none">HOME</a> <br>
                    <a href="contact.php" class="d-inline-block mb-2 text-white  text-decoration-none">CONTACTO </a> <br>
                    <a href="about.php" class="d-inline-block mb-2 text-white text-decoration-none">ACERCA</a> <br>


            </div>
        </div>
    </DIV>

<script>

function alert(type, msg, position='body')
{
    let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
    let element = document.createElement('div');
    element.innerHTML =`
    <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
    <strong class="me-3">${msg}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
    </div>
    `;
    if(position=='body'){
        document.body.append(element);
        element.classList.add('custom-alert');
    }
    else{
    document.getElementById(position).appendChild(element);
    }
    setTimeout(remAlert, 3000);
}

function remAlert(){
    document.getElementByClassName('alert')[0].remove();
}

let register_form = document.getElementById('register-form');

register_form.addEventListener('submit',(e)=>{
    e.preventDefault();

    let data = new FormData();

    data.append('name', register_form.elements['name'].value);
    data.append('email', register_form.elements['email'].value);
    data.append('phonenum', register_form.elements['phonenum'].value);
    data.append('adress', register_form.elements['adress'].value);
    data.append('pincode', register_form.elements['pincode'].value);
    data.append('dob', register_form.elements['dob'].value);
    data.append('pass', register_form.elements['pass'].value);
    data.append('cpass', register_form.elements['cpass'].value);
    data.append('profile', register_form.elements['profile'].files[0]);
    data.append('register', '');

    var myModal = document.getElementById('registerModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/login_register.php",true);

    xhr.onload = function(){
        if (this.responseText == 'pass_mismatch'){
                alert('error', "Las contraseñas no coinciden");
            }
            else if (this.responseText == 'phone_already'){
                alert('error', "El número ya está registrado");
            }
            else if (this.responseText == 'email_already'){
                alert('error', "El correo ya está registrado");
            }
            else if (this.responseText == 'inv_img'){
                alert('error', "SOLO JPG WEBP Y PNG");
            }
            else if (this.responseText == 'upd_failed'){
                alert('error', "No se pudo subir la imagen");
            }
            else if (this.responseText == 'mail_failed'){
                alert('error', "Error en el servidor, inténtelo más tarde");
            }
            else if (this.responseText == 'ins_failed') {
                alert('success', "NO SE MANDO EL CORREO");
            }
            else {
                alert('successss', "registration exitoso xd");
                register_form.reset();
            }        
    }

xhr.send(data);
});

</script>
