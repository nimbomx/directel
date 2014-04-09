<script>
var baseurl='<?=base_url()?>';
var defstate='<?=$state?>';

var doUpdate = function(state){
    if(state===null){
        state=defstate;
    }
    console.log(state);
    part=state.split('/');
    tab=part[0];
    form='';
    if(part.length>1){form=part[1];}
    $('#toolBar div').removeClass('selected');
    $('#toolBar div[title='+tab+']').addClass('selected');
    $.post('<?=base_url('acciones/getTab')?>',{tab:tab,form:form},function(e){
        $('#tabs').html(e);
    });
};

var updateURL=function(to){
    if(typeof history.pushState !== 'undefined'){
        window.history.pushState(to,null,baseurl+to);
    }else{
        window.location.hash(to);
    }
    doUpdate(to);
};
function changeTab(tab){
    updateURL(tab); 
}
function changeForm(tab,form){
    updateURL(tab+'/'+form);
}
///OPEN CLOSE FORMS
function openForm(id){
    closeForms(0);
    $('#'+id).show('normal');
    $('#columnaPrincipal').stop().animate({'right':'50%'},300);
}
var closeForms= function(speed){
    speed = typeof speed !== 'undefined' ? speed : 300;
    $('.form').hide(speed);
    $('#columnaPrincipal').stop().animate({'right':'0%'},speed);
};
    

$(function(){
   $('#toolBar div').unbind('click').bind('click',function(){
        changeTab($(this).attr('title'));
   });
   $('.listBtns div').die('click').live('click',function(){
        changeForm($(this).attr('tab'),$(this).attr('form'));
   });
   window.onpopstate=function(e){doUpdate(e.state);};
   
});



</script>