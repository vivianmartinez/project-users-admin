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
            console.log(item.value);
            if(item.value){
                last_password.toggleAttribute('disabled');
                new_password.toggleAttribute('disabled');
            }
        }));
    }

});
