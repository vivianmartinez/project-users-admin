window.addEventListener('load',()=>{
    const icon = document.getElementById('eye_password');
    if(icon){
        icon.addEventListener('click',(e)=>{
            const password = document.getElementById('login_password');
            const svg = icon.querySelector('.svg-inline--fa');
            svg.classList.add('fa-regular');
            if(svg.classList.contains('fa-eye-slash')){
                svg.classList.remove('fa-eye-slash');
                svg.classList.add('fa-eye');
                svg.setAttribute('data-icon','eye');
                password.type = 'text';
            }else{
                svg.classList.remove('fa-eye');
                svg.classList.add('fa-eye-slash');
                svg.setAttribute('data-icon','eye-slash');
                password.type = 'password';
            }
        });
    }
    //modify user password form profile
    const change_password = document.querySelectorAll('.form-check-input');
    if(change_password){
        change_password.forEach((item)=>item.addEventListener('click',()=>{
            if(item.value == 'true'){
                last_password.removeAttribute('disabled');
                new_password.removeAttribute('disabled');               
            }
            if(item.value == 'false'){
                last_password.setAttribute("disabled",true);
                new_password.setAttribute("disabled",true);
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
});
