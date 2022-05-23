const slidingtableau = document.querySelector('.tableau');
// on va chercher l Element sur lequel on agit
window.addEventListener('scroll', () => {
// on lance une fonction scroll
    const {scrollTop, clientHeight} = document.documentElement;
// On creé une constante a partir de l'objet document.documentelement 
// scrolltop= scroll depuis le top et clientheight= hauteur parti visible de la fenetre

    const topElementToTopViewport = slidingtableau.getBoundingClientRect().top;

    console.log(topElementToTopViewport);
    if(scrollTop > (scrollTop + topElementToTopViewport).toFixed() - clientHeight * 0.8){
        slidingtableau.classList.add('active')
    }
})