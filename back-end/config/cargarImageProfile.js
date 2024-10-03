
// Seccion de Editar perfil

// BANNER

let fileBanner = document.getElementById('bannerPhoto');
let imgBanner = document.getElementById('bannerEdit');

let defaultBanner = document.getElementById('bannerEditSave').src;

console.log(fileBanner);
console.log(imgBanner);
console.log(defaultBanner);

imgBanner.src = defaultBanner;

fileBanner.addEventListener('change', e => {
    if (e.target.files[0]){
        const fr2=new FileReader;
        fr2.onload = function(e){
            imgBanner.src = e.target.result;
        }
        fr2.readAsDataURL(e.target.files[0]);
    }else{
        imgBanner.src = defaultBanner;
    }
});


// IMG PROFILE


let fileProfile = document.getElementById('fotoPerfil');
let imgProfile = document.getElementById('profilePhtoEdit');

let defaultProfile = document.getElementById('profilePhtoEditSave').src;

console.log(fileProfile);
console.log(imgProfile);
console.log(defaultProfile);

imgProfile.src = defaultProfile;

fileProfile.addEventListener('change', e => {
    if (e.target.files[0]){
        const fr3=new FileReader;
        fr3.onload = function(e){
            imgProfile.src = e.target.result;
        }
        fr3.readAsDataURL(e.target.files[0]);
    }else{
        imgProfile.src = defaultProfile;
    }
});