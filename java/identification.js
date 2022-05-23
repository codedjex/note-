// let b1 = document.getElementById('b1');
// let winSize = 'width=400, height=200';
// b1.addEventListener('click', moveWindowTo);
// b1.addEventListener ('click',openWindow);
// function openWindow(){
//     fenetre = window.open('PHP/identification.php','', winSize);
// }
// function moveWindowTo(){
//     fenetre.moveTo(5000,5000);
// }
const dialog= document.getElementById('dialog');
const b1 = document.getElementById('b1');
const bclose = document.getElementById('bclose');


b1.addEventListener('click',function(){
    dialog.setAttribute('open',true);
})
bclose.addEventListener('click',function(){
    dialog.removeAttribute('open');
})

// if (document.getElementsById('text-danger')){
// dialog.setAttribute('open',true);

// }
