window.onload = function() {

    var setting = document.getElementById('setting-section');
    var settingpic = document.getElementById('setting-pic');
    var settingname = document.getElementById('setting-name');
    var chatapp = document.getElementById('chat-app');
    var header = document.getElementById('header');
    var userlist = document.getElementById('chat-list');
    var hamburg = document.getElementById('hamburg');
    var cross = document.getElementById('cross');
    var back = document.getElementById('chat-app-back');
    var chatbody = document.getElementById('chat-body');
    var chattype = document.getElementById('chat-type');

    chatbody.style.height = (document.documentElement.clientHeight - 160) + "px";

    chatapp.classList.add('chat-app-hide-comp');
    setting.classList.add('setting-section-hide-comp');

    /*setting-open-script*/
    hamburg.addEventListener('click', function() {
        setting.classList.remove('setting-section-hide');
        setting.classList.remove('setting-section-hide-comp');
        setting.style.opacity = 0;
        setTimeout(function() {
            setting.classList.add('setting-section-show');
            setting.style.opacity = 1;
        }, 400);


        header.classList.add('header-hide');
        setTimeout(function() {
            header.classList.add('header-hide-comp');
        }, 400);
        header.classList.remove('header-show');

        userlist.classList.add('chat-list-hide');
        setTimeout(function() {
            userlist.classList.add('chat-list-hide-comp');
        }, 400);
        userlist.classList.remove('chat-list-show');

        settingpic.style.opacity = '1';
        settingname.style.opacity = '1';
    });

    cross.addEventListener('click', function() {

        setting.classList.add('setting-section-hide');
        setting.classList.remove('setting-section-show');
        setting.style.opacity = 0;
        setTimeout(function() {
            setting.classList.add('setting-section-hide-comp');
            setting.style.opacity = 1;
        }, 400);


        header.classList.remove('header-hide');
        header.classList.add('header-show');
        header.classList.remove('header-hide-comp');


        userlist.classList.remove('chat-list-hide');
        userlist.classList.add('chat-list-show');
        userlist.classList.remove('chat-list-hide-comp');

        settingpic.style.opacity = '0';
        settingname.style.opacity = '0';
    });


    /*chat open script*/
    for (var i = 0; i < document.getElementsByClassName('user-details').length; i++) {
        document.getElementsByClassName('user-details')[i].addEventListener('click', function() {
            chatapp.classList.remove('chat-app-hide');
            chatapp.classList.remove('chat-app-hide-comp')
            chatapp.style.opacity = 0;
            setTimeout(function() {
                chatapp.classList.add('chat-app-show');
                chatapp.style.opacity = 1;
            }, 1);

            header.classList.add('header-hide');
            setTimeout(function() {
                header.classList.add('header-hide-comp');
            }, 400);
            header.classList.remove('header-show');

            userlist.classList.add('chat-list-hide');
            setTimeout(function() {
                userlist.classList.add('chat-list-hide-comp');
            }, 400);
            userlist.classList.remove('chat-list-show');
        })
    }

    back.addEventListener('click', function() {
        location.reload(true);

        chatapp.classList.add('chat-app-hide');
        chatapp.style.opacity = 0;
        setTimeout(function() {
            chatapp.classList.add('chat-app-hide-comp');
            chatapp.style.opacity = 1;
        }, 400);
        chatapp.classList.remove('chat-app-show');

        header.classList.remove('header-hide');
        header.classList.add('header-show');
        header.classList.remove('header-hide-comp');


        userlist.classList.remove('chat-list-hide');
        userlist.classList.add('chat-list-show');
        userlist.classList.remove('chat-list-hide-comp');
    });

}

window.addEventListener("resize", () => {
    var chatbody = document.getElementById('chat-body');
    var settingoptn = document.getElementById('setting-optn');
    chatbody.style.height = (document.documentElement.clientHeight - 160) + "px";

    var x = window.matchMedia("(max-height:400px)");

    if (x.matches) {
        settingoptn.style.display = "none";
        chatbody.style.height = (document.documentElement.clientHeight - 160) + "px";
    }
    else{
        settingoptn.style.display = "block";
    }

});