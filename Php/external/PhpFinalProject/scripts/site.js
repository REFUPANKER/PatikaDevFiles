//#region  POP UP PROFILE
function popupProfileClose(sender) {
    if (sender.target.id == "popupProfile") {
        document.getElementById("popupProfile").remove();
    }
}

function PopUpProfile(token) {
    jQuery.ajax("popupProfile.php", {
        method: "post",
        data: {
            token: token
        },
        success: (e => {
            document.body.innerHTML += e;
        })
    })
}
function PopUpProfileWithId(id) {
    jQuery.ajax("popupProfile.php", {
        method: "post",
        data: {
            userid:id
        },
        success: (e => {
            document.body.innerHTML += e;
        })
    })
}

function ChangeFollowState(followState, token) {
    jQuery.ajax("./popupProfile.php", {
        method: "post",
        data: { state: followState, token: token },
        success: (e => {
            document.getElementById("popupProfile").outerHTML=e;
        })
    })
}
//#endregion