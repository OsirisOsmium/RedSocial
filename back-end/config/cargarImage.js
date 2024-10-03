// Seccion de editar publicacion

let filePost = document.getElementById('filePub');
let imgPost = document.getElementById('imagenPostId');

let defaultImage = document.getElementById('imagenPostIdSave').src;

imgPost.src = defaultImage;

filePost.addEventListener('change', e => {
    if (e.target.files[0]){
        const fr=new FileReader();
        fr.onload = function(e) {
            imgPost.src = e.target.result;
        }
        fr.readAsDataURL(e.target.files[0]);
    }else{
        imgPost.src = defaultImage;
    }
});



