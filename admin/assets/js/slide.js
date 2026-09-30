function updateCurrentPageHistory(a) {
    if (DEBUG) {
        console.info("updateCurrentPageHistory(title : " + a + ")")
    }
    State = History.getState();
    data = State.data;
    data.destinationPage = currentPage;
    $(window).off("statechange");
    History.replaceState(data, a, document.location);
    $(window).on("statechange", statechange)
}
/* ntm */
$(function(){$(document).on('click','.go',function(){var direction=$(this).attr('dir'),show=(direction=='left')?'.team:not(".second")':'.team.second';$('.team').fadeOut(0);$(show).fadeIn(0);$('.switch > .go').removeClass('slc');$(this).addClass('slc');return false;});$(document).on('click','.staff[tooltip]',function(){var tthis=$(this);$('.showStaff').fadeIn(0);$('.showStaff > .avatar > .badges').html('');$('> .loader',tthis).fadeIn(0);$.get(actionURL+'get_staff_info.php',{id:tthis.attr('id')},function(data){$('> .loader',tthis).fadeOut(0);if(data.type=='error'){$('.showStaff').fadeOut(0);$.error.top(data,{'scroll':'top'});}else{$('.showStaff').css('background','url("'+ data.message.pdc+'")');$('.showStaff > .avatar > .img > img').attr('src',data.message.look);$('.showStaff > .avatar > .infos > p.username > span').text(data.message.username);$('.showStaff > .avatar > .infos > p.motto > span').text(data.message.motto);$('.showStaff > .avatar > .infos > p.last_online > span').text('Il y a '+ data.message.last_online);var htmlBadges="";for(var i=0;i<data.message.badges.length;i++){var badgecode=data.message.badges[i],badgeurl='https://www.habbocity.me/swfs/c_images/album1584/'+ badgecode+'.gif';htmlBadges+='<img src="'+ badgeurl+'" title="'+ badgecode+'" alt="'+ badgecode+'"/>';}
$('.showStaff > .avatar > .badges').html(htmlBadges);$('> .avatar',tthis).fadeIn(0);}})});});
/*ntm */
$(document).ready(function() {
 
    /* Messages */
    var text_pos = 0;
    var texts = ["Bienvenue sur CITYWISH", "Le site est actuellement hors ligne", "Les recrutements ouvrent leurs portes !"];
    $("#txt").text(texts[0]);
 
    /* Timer */
    setInterval(function() {
 
        /* Slider timer */
        $(".slideshow ul").animate({
            marginLeft: -0
        }, 100, function() {
            $(this).css({
                marginLeft: 0
            }).find("li:last").after($(this).find("li:first"));
        });
 
        /* Messages timer */
        $("#txt").fadeOut(100, function() {
            $("#txt").text(texts[text_pos]);
            $("#txt").fadeIn();
        });
 
        text_pos++;
        if (text_pos > (texts.length - 1)) {
            text_pos = 0;
        }
 
    }, 3500);
 
});

/* ntm */
//###################################################################################### 
// Author: ricocheting.com 
// For: public release (freeware) 
// Date: 4/24/2003 (update: 6/26/2009) 
// Description: displays the amount of time until the "dateFuture" entered below. 


// NOTE: the month entered must be one less than current month. ie; 0=January, 11=December 
// NOTE: the hour is in 24 hour format. 0=12am, 15=3pm etc 
// format: dateFuture = new Date(year,month-1,day,hour,min,sec) 
// example: dateFuture = new Date(2003,03,26,14,15,00) = April 26, 2003 - 2:15:00 pm 

dateFuture = new Date(2017,08,02,18,0,0); 

// TESTING: comment out the line below to print out the "dateFuture" for testing purposes 
//document.write(dateFuture +"<br />"); 


//################################### 
//nothing beyond this point 
function GetCount(){ 

dateNow = new Date(); //grab current date 
amount = dateFuture.getTime() - dateNow.getTime();  //calc millisecondes between dates 
delete dateNow; 

// time is already past 
if(amount < 0){ 
document.getElementById('countbox').innerHTML="Now!"; 
} 
// date is still good 
else{ 
jours=0;heures=0;mins=0;secs=0;out=""; 

amount = Math.floor(amount/1000);//kill the "millisecondes" so just secs 

jours=Math.floor(amount/86400);//jours 
amount=amount%86400; 

heures=Math.floor(amount/3600);//heures 
amount=amount%3600; 

mins=Math.floor(amount/60);//minutes 
amount=amount%60; 

secs=Math.floor(amount);//secondes 

if(jours != 0){out += jours +" <b id='test'>JOURS</b>&nbsp;&nbsp;"+((jours!=1)?"":"")+"  ";} 
if(jours != 0 || heures != 0){out += heures +" <b id='test'>HEURES</b>&nbsp;&nbsp;"+((heures!=1)?"":"")+"  ";} 
if(jours != 0 || heures != 0 || mins != 0){out += mins +" <b id='test'>MINUTES</b>&nbsp;&nbsp;"+((mins!=1)?"":"")+"  ";} 
out += secs +" <b id='test'>SECONDES</b>"; 
document.getElementById('countbox').innerHTML=out; 

setTimeout("GetCount()", 1000); 
} 
} 

window.onload=GetCount;//call when everything has loaded 

// overlay
function connexion(id)
{
  if (document.getElementById(id).style.display == 'none') {
       document.getElementById(id).style.display = 'block';
  }
  else {
       document.getElementById(id).style.display = 'none';
  }

}
$(document).ready(function(){
    $('.close').click(function(){
        $('#connexion').fadeOut(100);
    });
});
function inscription(id)
{
  if (document.getElementById(id).style.display == 'none') {
       document.getElementById(id).style.display = 'block';
  }
  else {
       document.getElementById(id).style.display = 'none';
  }

}
$(document).ready(function(){
    $('.close').click(function(){
        $('#inscription').fadeOut(100);
    });
});