document.addEventListener('DOMContentLoaded', function () {
    var sidebar = document.getElementById("main-sidebar");
    var panel = document.querySelector(".main-panel");
    var navButton = document.getElementById("nav-button");
    var CLASS_NAME = 'collapsed';

    // var isCollapsed = sessionStorage.getItem("isCollapsed");
    // if (isCollapsed) {
    //     collapseNav();
    // }


    navButton.addEventListener('click', onNavButtonClick);


    function onNavButtonClick() {
        if (sidebar.classList.contains(CLASS_NAME)) {
            expandNav();
        } else {
            collapseNav();
        }
    }

    function expandNav() {
        document.cookie = "SIDEBAR_COLLPASED=0";
        sidebar.classList.remove(CLASS_NAME);
        if (panel) panel.classList.remove('expand-panel');
        // sessionStorage.setItem("isCollapsed", false);
    }

    function collapseNav() {
        document.cookie = "SIDEBAR_COLLPASED=1";
        sidebar.classList.add(CLASS_NAME);
        if (panel) panel.classList.add('expand-panel');
        // sessionStorage.setItem("isCollapsed", true);
    }
});

