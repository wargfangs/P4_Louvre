  $(document).ready(function() {
    // On récupère la balise <div> en question qui contient l'attribut « data-prototype » qui nous intéresse.
    var $container = $('div#nt_platformbundle_command_tickets');

    // On définit un compteur unique pour nommer les champs qu'on va ajouter dynamiquement
    var index = $('div#nt_platformbundle_command_tickets > div').size();

    // On ajoute un nouveau champ à chaque clic sur le lien d'ajout.
    $('#add_ticket').click(function(e) {
      addTicket($container);

      e.preventDefault(); // évite qu'un # apparaisse dans l'URL
      return false;
    });

    // On ajoute un premier champ automatiquement s'il n'en existe pas déjà un (cas d'une nouvelle annonce par exemple).
    if (index == 0) {
      addTicket($container);
    } 
    else {
      // S'il existe déjà des billets, on ajoute un lien de suppression pour chacune d'entre elles
      $container.children('div').each(function() {
        addDeleteLink($(this));
      });
    }

    // La fonction qui ajoute un formulaire TicketType
    function addTicket($container) {
      // Dans le contenu de l'attribut « data-prototype », on remplace :
      // - le texte "__name__label__" qu'il contient par le label du champ
      // - le texte "__name__" qu'il contient par le numéro du champ
      var template = $container.attr('data-prototype')
        .replace(/__name__label__/g, 'Billet n°' + (index+1))
        .replace(/__name__/g,        index)
      ;      



      // On crée un objet jquery qui contient ce template
      var $prototype = $(template);

      // On ajoute au prototype un lien pour pouvoir supprimer le billet
      addDeleteLink($prototype);
      
      // On ajoute un titre "Billet n° + son numéro" à chaque billet généré
      var $ticketnumber = $("<h3>Billet n°" + (index + 1) + "</h3>");

      $prototype.prepend($ticketnumber);

      // On ajoute le prototype modifié à la fin de la balise <div>
      $container.append($prototype);

      // Enfin, on incrémente le compteur pour que le prochain ajout se fasse avec un autre numéro
      index++;
          
        var disableddates = ["5-1", "11-1", "12-25"];

        function DisableSpecificDates(date) {

         /** Jours fériés à désactiver */
         
         var m = date.getMonth();
         var d = date.getDate(); 
         // En premier on convertit les dates dans le format mm-dd
         // On incrémente le mois par 1 
         var currentdate = (m + 1) + '-' + d ;

         for (var i = 0; i < disableddates.length; i++) {

           // On vérifie que la date actuelle est dans disabled dates array. 
           if ($.inArray(currentdate, disableddates) != -1 ) {
             return [false];
           }
         }
 
         // Désactiver les mardis et les dimanches
 
         var day = date.getDay();
         // Si day == 1 alors c'est mardi ou si day == 0 alors c'est dimanche
         if (day == 2 || day == 0) {

           return [false] ; 

         } 
         else 
         { 

           return [true] ;
         }

        }        

        $(function() {
          $('.js-datepicker').datepicker({
            dateFormat: 'dd-mm-yy',
             beforeShowDay: DisableSpecificDates,
             minDate:0
          });
        });
        

    }

    // La fonction qui ajoute un lien de suppression d'un billet
    function addDeleteLink($prototype) {
      // Création du lien
      var $deleteLink = $('<a href="#" class="btn btn-danger">Supprimer</a>');

      // Ajout du lien
      $prototype.append($deleteLink);

      // Ajout du listener sur le clic du lien pour effectivement supprimer le billet
      $deleteLink.click(function(e) {
        $prototype.remove();
      
        e.preventDefault(); // évite qu'un # apparaisse dans l'URL
        return false;
      });
    }
    
  });