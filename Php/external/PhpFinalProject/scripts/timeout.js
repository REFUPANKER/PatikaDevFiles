function repeatself() {
    jQuery.ajax("./managers/SessionTimeout.php", {
        method: "get",
        success: (e => {
            if (e.startsWith("-1")) {
                window.location.reload();
                return;
            }
            document.title = "What is Next | " + e;
            setTimeout(() => {
                repeatself();
            }, 1000);
        })
    })
    
}
repeatself();