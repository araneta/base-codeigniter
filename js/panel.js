function initPanels(){
    $('.panel h3').click(function(){
       var el = $(this);  
       var cont = el.parent().find('div.pnlcontent');
       if(el.hasClass('pane-toggler-down')){
           el.removeClass('pane-toggler-down').addClass('pane-toggler-up');
           cont.hide();
       }else{
           el.removeClass('pane-toggler-up').addClass('pane-toggler-down');
           cont.show();
       }
   });    
}
