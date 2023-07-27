makePrice();
$("#termin-zhotoveni, #pevne-desky, #krouzkove-vazby, #pocet-listu, #kapsy-cd-dvd, #chlopne-na-prilohy").each(function() {
    $(this).change(function() {
        makePrice();
    });
});