// nav bar transition
window.addEventListener('scroll', function () {
    if (window.scrollY > 200) {
        $('nav').addClass('background');
    } else {
        $('nav').removeClass('background');
    }
});

// email verification
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

// password verification function by Jon P (Stackoverflow)
function ValidatePassword() {
    var rules = [{
        Pattern: "[A-Z]",
        Target: "UpperCase"
    },
    {
        Pattern: "[a-z]",
        Target: "LowerCase"
    },
    {
        Pattern: "[0-9]",
        Target: "Numbers"
    },
    {
        Pattern: "[!@@#$%^&*]",
        Target: "Symbols"
    }
    ];

    var password = $(this).val();

    $("#Length").removeClass(password.length > 6 ? "glyphicon-remove" : "glyphicon-ok");
    $("#Length").addClass(password.length > 6 ? "glyphicon-ok" : "glyphicon-remove");

    for (var i = 0; i < rules.length; i++) {

        $("#" + rules[i].Target).removeClass(new RegExp(rules[i].Pattern).test(password) ? "glyphicon-remove" : "glyphicon-ok");
        $("#" + rules[i].Target).addClass(new RegExp(rules[i].Pattern).test(password) ? "glyphicon-ok" : "glyphicon-remove");
    }
}

