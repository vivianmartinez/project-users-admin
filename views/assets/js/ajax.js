window.addEventListener('load',()=>{
    console.log('listo')
    const userDelete = document.querySelectorAll('.delete-user');

    if(userDelete){
        userDelete.forEach((item)=>item.addEventListener('click',()=>{
            let parent = item.parentNode;
            let input_id = parent.querySelector('.user-id');
            if(input_id){
                let user_id = input_id.value;
                if(user_id == item.getAttribute('id').slice(5)){
                    if(confirm('¿Are you sure you want to delete this user?')){
                        let dataform = new FormData();
                        dataform.append('id_user_delete',parseInt(user_id));
                    } 
                }
            }

        }));
    }


})
