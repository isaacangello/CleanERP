$(document).ready(function () {


/** colapsable materialize */
 $('.collapsible').collapsible();
 /** INITIALIZE SELECT*/
 $('select').formSelect();
/** INITIALIZE mobile side bar*/
 $('.sidenav').sidenav();
/** INITIALIZE modal*/
  // $('.modal').modal();


    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems, {
        preventScrolling: true,
        dismissible: false,
        inDuration: 400,
        outDuration:400,
        startingTop: '0%',
        endingTop: '10%',
    });

/** dropdown materialize */
/*
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.dropdown-trigger');
    var instances = M.Dropdown.init(elems, options);
  });
*/

  // Or with jQuery

  $('.dropdown-trigger').dropdown();

  var hidden = "true";
$("#buton-user-dropdown").click(function () {
    /*
    *   -moz-transition: 0.5s;
        -o-transition: 0.5s;
        -webkit-transition: 0.5s;
        transition: 0.5s;
    * */
             $("#dropdown-left-sidebar").css({
                    "-moz-transition":"left 0.5s",
                    "-o-transition":"left 0.5s",
                    "-webkit-transition":"left 0.5s",
                    "transition":"left 0.5s",
                 });

        if(hidden == "true"){
             hidden = "false";
            $("#dropdown-left-sidebar").show("500") ;
            // $("#site-content").css('margin-left',"315px");

        } else {
             hidden = "true";
            $("#dropdown-left-sidebar").hide("500");
            // $("#site-content").css('margin-left',"15px");

        };
    }

);
});
