const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});
$('#recipeCarousel').carousel({
    interval: 10000
})

$('.carousel .carousel-item').each(function() {
    var minPerSlide = 3;
    var next = $(this).next();
    if (!next.length) {
        next = $(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));

    for (var i = 0; i < minPerSlide; i++) {
        next = next.next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }

        next.children(':first-child').clone().appendTo($(this));
    }
});
$(document).ready(function() {

    $(".buddy").on("swiperight", function() {
        $(this).addClass('rotate-left').delay(700).fadeOut(1);
        $('.buddy').find('.status').remove();

        $(this).append('<div class="status like">Like!</div>');
        if ($(this).is(':last-child')) {
            $('.buddy:nth-child(1)').removeClass('rotate-left rotate-right').fadeIn(300);
        } else {
            $(this).next().removeClass('rotate-left rotate-right').fadeIn(400);
        }
    });

    $(".buddy").on("swipeleft", function() {
        $(this).addClass('rotate-right').delay(700).fadeOut(1);
        $('.buddy').find('.status').remove();
        $(this).append('<div class="status dislike">Dislike!</div>');

        if ($(this).is(':last-child')) {
            $('.buddy:nth-child(1)').removeClass('rotate-left rotate-right').fadeIn(300);
            alert('OUPS');
        } else {
            $(this).next().removeClass('rotate-left rotate-right').fadeIn(400);
        }
    });

});