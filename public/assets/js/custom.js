function toggleRightSidebar(e) {
    e.stopPropagation();
    document.querySelector('body').classList.toggle('customize-box');
    toggleNewUpdate();
}
$(document).ready(function() {
    $("#resetRightSidebar").click(function(e) {
        $(this).closest('form').find("input[type=text], textarea").val("");
        document.querySelector('body').classList.toggle('customize-box');
    });
});

function toggleNewUpdate() {
    $('.action').text($('.action').text() == "New" ? "Update" : "New");
}