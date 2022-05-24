function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(".image-upload-wrap").hide();

            $(".file-upload-image").attr("src", e.target.result);
            $(".file-upload-content").show();

            $(".image-title").html(input.files[0].name);
        };

        reader.readAsDataURL(input.files[0]);
    } else {
        removeUpload();
    }
}

function removeUpload() {
    $(".file-upload-input").replaceWith($(".file-upload-input").clone());
    $(".file-upload-content").hide();
    $(".image-upload-wrap").show();
}
$(".image-upload-wrap").bind("dragover", function () {
    $(".image-upload-wrap").addClass("image-dropping");
});
$(".image-upload-wrap").bind("dragleave", function () {
    $(".image-upload-wrap").removeClass("image-dropping");
});

// Mobile Navbar
const mobileNavButton = document.querySelector('.hamburger-button');
mobileNavButton.addEventListener('click', (event) => {
    // Toggle mobile menu
    document.querySelector('.mobile-nav').classList.toggle('hide-element');

    // Toggle navbar icon
    mobileNavButton.querySelector('.hamburger').classList.toggle('hide-element');
    mobileNavButton.querySelector('.close').classList.toggle('hide-element');

})

window.addEventListener("resize", () => {
    if (window.innerWidth > 1000) {
        // Toggle mobile menu
        let mobileNav = document.querySelector('.mobile-nav');

        if (!mobileNav.classList.contains('hide-element')) {
            mobileNav.classList.add('hide-element');
            mobileNavButton.querySelector('.hamburger').classList.toggle('hide-element');
            mobileNavButton.querySelector('.close').classList.toggle('hide-element');

        }
    }
})
