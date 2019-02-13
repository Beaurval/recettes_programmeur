    $(function(){
        $('.show-recette').on("click", function(event) {
            event.preventDefault();
            var idRecette = $(this).attr("data-id-recette");
            window.location.href='/maListe.php?idRecette=' + idRecette;
        }); 
    });