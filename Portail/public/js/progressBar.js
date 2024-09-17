
var next = document.querySelectorAll('input[type="button"]');
var	steps = document.querySelector(".step");

next.bind("click", function() { 
    document.querySelector.each( steps, function( i ) {
        if (!document.querySelector(steps[i]).hasClass('current') && !document.querySelector(steps[i]).hasClass('done')) {
            document.querySelector(steps[i]).addClass('current');
            document.querySelector(steps[i - 1]).removeClass('current').addClass('done');
            return false;
        }
    })		
});
back.bind("click", function() { 
    document.querySelector.each( steps, function( i ) {
        if (document.querySelector(steps[i]).hasClass('done') && document.querySelector(steps[i + 1]).hasClass('current')) {
            document.querySelector(steps[i + 1]).removeClass('current');
            document.querySelector(steps[i]).removeClass('done').addClass('current');
            return false;
        }
    })		
});
