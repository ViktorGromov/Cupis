/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

"use strict";

jQuery().ready(function($) {
    $(window).scroll(function() {

        if ($(this).scrollTop() > 1){  
            $('#masthead').addClass("menu_sticky");
        }
        else{
            $('#masthead').removeClass("menu_sticky");
        }
    });
});


