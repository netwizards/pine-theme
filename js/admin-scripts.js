jQuery(document).ready(function(){

  $select=jQuery('#_cmb_header');
  $wysiwyg=jQuery('#wp-_cmb_complex_header_content-wrap');

  $select.change(function(){
        if( this.value != 2 ) 
          $wysiwyg.hide('medium');
        else
          $wysiwyg.show('medium');
    });

});