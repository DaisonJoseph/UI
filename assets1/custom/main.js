document.addEventListener('DOMContentLoaded', function () {
    var sidebar = document.getElementById("main-sidebar");
    var navItem = document.getElementsByClassName("nav-item");
    var CLASS_NAME1 = 'active';


    navButton.addEventListener('click', onNavButtonClick);


    function onNavButtonClick() {
        if (sidebar.classList.contains(CLASS_NAME1)) {
            expandNav();
        } else {
            collapseNav();
        }
    }

    function expandNav() {
        document.cookie = "SIDEBAR_COLLPASED=0";
        sidebar.classList.remove(CLASS_NAME1);
        sidebar.classList.remove(CLASS_NAME2);
        // if (panel) panel.classList.remove('expand-panel');
        // sessionStorage.setItem("isCollapsed", false);
    }

    function collapseNav() {
        // document.cookie = "SIDEBAR_COLLPASED=1";
        sidebar.classList.add(CLASS_NAME1);
        sidebar.classList.add(CLASS_NAME2);
        // if (panel) panel.classList.add('expand-panel');
        // sessionStorage.setItem("isCollapsed", true);
    }
});

