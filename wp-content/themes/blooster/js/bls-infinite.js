/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
"use strict";
jQuery().ready(function($) {
    $(function(){

        var $container = $('#main');

        $container.imagesLoaded(function(){
          $container.masonry({
            itemSelector: '.blooster-box'

          });
        });

        $container.infinitescroll({
          navSelector  : '.navigation',    // selector for the paged navigation 
          nextSelector : '.navigation ul li a',  // selector for the NEXT link (to page 2)
          itemSelector : '.blooster-box',     // selector for all items you'll retrieve
          loading: {
              finishedMsg: '---',
              img: 'wp-content/themes/blooster/img/preloader.gif'
            }
          },
          // trigger Masonry as a callback
          function( newElements ) {
            // hide new items while they are loading
            var $newElems = $( newElements ).css({ opacity:0});
            // ensure that images load before adding to masonry layout
            $newElems.imagesLoaded(function(){
              // show elems now they're ready
              $newElems.animate({ opacity: 1 });
              $container.masonry( 'appended', $newElems, true ); 
            });
          }
        );

      });
  });