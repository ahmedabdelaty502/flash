// jQuery(document).ready(function ($)
// {

    document.querySelectorAll(".panel").forEach(function (singlePanel)
    {
        singlePanel.addEventListener("mouseenter", function (e)
        {
            e.target.parentElement
                .querySelector(".panel.active")
                .classList.remove("active");
            e.target.classList.add("active");
        });
    });
// }