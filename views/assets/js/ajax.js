window.addEventListener('load',()=>{
    const userDelete = document.querySelectorAll('.delete-user');

    if(userDelete){
        userDelete.forEach((item)=>item.addEventListener('click',()=>{
            let parent = item.parentNode;
            let input_id = parent.querySelector('.user-id');

            /** if exists input we can get it's value */
            if(input_id){
                /** get user id */
                let user_id = input_id.value;
                /** select the user row tr element */
                let row_user = document.querySelector(`.table-row-${user_id}`);
                
                if(row_user && user_id){
                    /** get user email to confirm */
                    let email = row_user.querySelector('.table-value-em').textContent;
                    /** confirm delete user */
                    if(confirm(`¿Are you sure you want to delete user ${email}?`)){
                        let dataform = new FormData();
                        dataform.append('id_user_delete',parseInt(user_id));

                        fetch('../app/ajax/user-ajax.php',{
                            method: 'POST',
                            mode: "cors", // no-cors, *cors, same-origin
                            cache: "no-cache", 
                            credentials: "same-origin",
                            body: dataform
                        }).then(response => response.json())
                        .then(json => {
                            //console.log(json.error);
                            if(!json.error){
                                //delete user row on table
                                row_user.parentNode.removeChild(row_user);
                                alert('The user was deleted succesfuly');
                            }else{
                                alert('An error has ocurred, please contact support.');
                            }
                        })
                        .catch(error => console.log('Failed request', error));
                    } 
                }else{
                    alert('Wrong user id');
                }
            }

        }));
    }


})
