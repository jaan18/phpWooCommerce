function wp_dereg_script_comment_reply(){wp_deregister_script( 'comment-reply' );}
add_action('init','wp_dereg_script_comment_reply');

add_action('wp_head', 'wp_reload_script_comment_reply');
function wp_reload_script_comment_reply() {
    ?>
<script>
// La función comprueba si un script dado ya está cargado
function isScriptLoaded(src){
    return document.querySelector('script[src="' + src + '"]') ? true : false;
}
// Cuando se hace click en un link, revisa si el script de respuesta esta cargado, si no, lo cara y emula el click
var repLinks = document.getElementsByClassName("comment-reply-link");
for (var i=0; i < repLinks.length; i++) {
    repLinks[i].onclick = function() { 
    if(!(isScriptLoaded("/wp-includes/js/comment-reply.min.js"))){
        var script = document.createElement('script');
        script.src = "/wp-includes/js/comment-reply.min.js";
    script.onload = emRepClick(event.target.getAttribute('data-commentid'));        
        document.head.appendChild(script);
    }
}
};
// La funcion espera 50ms antes de emular el click en el link cuando el script esta cargado
function emRepClick(comId) {
sleep(50).then(() => {
document.querySelectorAll('[data-commentid="'+comId+'"]')[0].dispatchEvent(new Event('click'));
});
}
// La funcion no hace nada por el tiempo dado
function sleep (time) {
  return new Promise((resolve) => setTimeout(resolve, time));
}
</script>
    <?php
}
