$(document).ready(()=> {
    // sidebar dropdown
    $('.dropdown').click((res)=> {
        $(res.currentTarget).find('.sub-nav').toggleClass('hide');
    });

    // navbar dropdown
    $('#nav-dropdown').click((res)=> {
        $(res.currentTarget).find('.sub-navbar').toggleClass('hide');
    });
    
})