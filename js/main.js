(function($) {

  'use strict';

  var App = {

    /**
     * Init Function
     */
    init: function() {
      App.mobileMenu();
      App.menu();
    },

    menu: function() {
      //console.log('asdasd');
      /*
      $('#navigation li > a').html(function(i, v) {
        return v.replace(/\s(.*?)\s/, ' <span>$1</span> ');
      });
      */
      $('#navigation > li a').each(function(){

          var text = $(this).text().split(' ');
          if(text.length < 2)
              return;

          text[1] = '<span>'+text[1]+'</span>';

          $(this).html( text.join(' ') );

      });

    },

    /**
     * mobileMenu
     */

    mobileMenu: function() {

      var menu = $("#navigation");
      var openBtn = $('#toggle-menu');
      var closeBtn = $('#toggle-menu-close');

      openBtn.on('click', openBtn, function(e) {

        // menu is closed
        menu.show();
        menu.addClass('open');
        closeBtn.show();
        openBtn.hide();

        e.preventDefault();

      });

      closeBtn.on('click', openBtn, function(e) {

        if (menu.hasClass("open")) {
          // menu is open
          menu.removeClass('open');
          menu.hide();
          closeBtn.hide();
          openBtn.show();
        }

        e.preventDefault();

      });

    },

  };

  $(function() {
    App.init();
  });

})(jQuery);
