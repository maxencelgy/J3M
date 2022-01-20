////////////////////// Menu BURGER /////////////////////////////////////////////
    const burger = $('#burger');
    const croix = $('#croix');
    const nav = $('nav');
    const navigation = $('.header_btn');

    burger.on('click',function (){
      navigation.fadeIn();
      nav.css('flex-direciton', 'column');
      burger.css('display', 'none');
      croix.css('display', 'block');
    });

    croix.on('click',function (){
      navigation.fadeOut();
      burger.css('display', 'block');
      croix.css('display', 'none');
    });


