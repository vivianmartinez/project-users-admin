window.addEventListener('load',()=>{
    //show password when click on eye and change icon
    const icon = document.querySelectorAll('.eye-password');
    if(icon){
        icon.forEach((item)=> item.addEventListener('click',(e)=>{
            const password_login = document.getElementById('login_password');
            const password_register = document.getElementById('register_password');
            const password_profile_last = document.getElementById('last_password');
            const password_profile_new = document.getElementById('new_password');

            const svg = item.querySelector('.svg-inline--fa'); //select icon
            svg.classList.add('fa-regular');

            if(svg.classList.contains('fa-eye-slash')){
                svg.classList.remove('fa-eye-slash');
                svg.classList.add('fa-eye');
                svg.setAttribute('data-icon','eye');
                if(password_login) password_login.type = 'text';
                if(password_register) password_register.type = 'text';
                if(password_profile_last && svg.parentNode.getAttribute('id') == 'eye-last-password') password_profile_last.type = 'text';
                if(password_profile_new && svg.parentNode.getAttribute('id') == 'eye-new-password') password_profile_new.type = 'text';
            }else{
                svg.classList.remove('fa-eye');
                svg.classList.add('fa-eye-slash');
                svg.setAttribute('data-icon','eye-slash');
                if(password_login) password_login.type = 'password';
                if(password_register) password_register.type = 'password';
                if(password_profile_last && svg.parentNode.getAttribute('id') == 'eye-last-password') password_profile_last.type = 'password';
                if(password_profile_new && svg.parentNode.getAttribute('id') == 'eye-new-password') password_profile_new.type = 'password';
            }
        }));
    }
    //modify user password form profile
    const change_password = document.querySelectorAll('.form-check-input');
    if(change_password){
        change_password.forEach((item)=>item.addEventListener('click',()=>{
            const icon_eye_last = document.getElementById('eye-last-password');
            const icon_eye_new  = document.getElementById('eye-new-password');
            const last_password = document.getElementById('last_password');
            const new_password  = document.getElementById('new_password');
            if(item.value == 'yes'){
                if(last_password) last_password.removeAttribute('disabled');
                if(new_password) new_password.removeAttribute('disabled');
                if(icon_eye_last) icon_eye_last.classList.remove('disabled-eye');
                if(icon_eye_new) icon_eye_new.classList.remove('disabled-eye');
            }
            if(item.value == 'no'){
                if(last_password)  last_password.setAttribute("disabled",true);
                if(new_password)  new_password.setAttribute("disabled",true);
                if(icon_eye_last) icon_eye_last.classList.add('disabled-eye');
                if(icon_eye_new) icon_eye_new.classList.add('disabled-eye');
            }
        }));
    }

    //user image validation register form
    const register_image = document.getElementById('register_image');
    if(register_image){
        register_image.addEventListener('change',()=>{
            preview_image(register_image,'submit-register');
        });
    }
    //user image validation profile form
    const profile_image = document.getElementById('profile_image');
    if(profile_image){
        profile_image.addEventListener('change',()=>{
            preview_image(profile_image,'submit-profile');
        });
    }
    //function preview image
    const preview_image = (element,after_element) =>{
        if(document.querySelector('.alert')){
            document.querySelector('.alert').remove();
        }
        const file = element.files[0];
        const el_after = document.getElementById(after_element);
        let error = document.createElement('div');
        error.classList.add('alert');
        error.classList.add('alert-danger'); 
        if(file.size > 1000000){                  
            error.innerHTML = `<strong>Error:</strong> Image no longer than 1MB`;
            el_after.after(error);
            element.value = '';
            return;
        }else if(file.type != 'image/jpeg' && file.type && 'image/jpg' && file.type != 'image/png'){
            error.innerHTML = `<strong>Error:</strong> Image type only JPG, JPEG or PNG.`;
            el_after.after(error);
            element.value = '';
            return;
        }else{
            let data_image = new FileReader;
            data_image.readAsDataURL(file);
            console.log(data_image);
            data_image.addEventListener('load',(e)=>{
                let route_img = e.target.result;
                let preview = document.querySelector('.preview');
                preview.src = route_img;
            });
        }
    }    

    //Tooltips initialized 
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
    })
});
