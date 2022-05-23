const texteanim = document.querySelector('.logo-anim');
new Typewriter(texteanim,{
    deleteSpeed:60,
    loop:true
})
.typeString('Une note pour : <strong>Vivre</strong>')
.pauseFor( 1500)
.deleteChars(5)
.typeString('<strong>Rêver</strong>')
.pauseFor( 1500)
.deleteChars(5)
.typeString('<strong>Aimer</strong>')
.pauseFor( 1500)
.deleteChars(5)
.typeString('<strong>S\'évader</strong>')
.pauseFor( 10000)

.start()