<div class="d-flex justify-content-center align-items-center flex-column h-100">
    <div style="background-color: #151515;padding:0.5rem 2rem;border-radius:1rem 1rem 0 0;border:0.05rem solid white;border-bottom:none;">Create new NEXT</div>
    <div class="p-3 rounded rounded-3" style="display:flex;flex-direction: column;width:50%;background-color: #151515;border:0.05rem solid white;">
        Title
        <input id="nextTitle" style="font-size: 1.3rem;" maxlength="128">
        Content
        <textarea id="nextContent" maxlength="512" style="font-size:1.2rem;resize: none;height:25vh;margin-bottom:1rem;"></textarea>
        <button class="btn btn-dark" onclick="NextText()">N E X T</button>
    </div>

    <script>
        let shared = false;
        const tId = document.getElementById("nextTitle");
        const tContent = document.getElementById("nextContent");

        function NextText() {
            if (shared) {
                alert("ayo o_O you already shared this");
                return;
            }
            if (tId.value.replace(" ", "").length < 1) {
                alert("Fill all the fields");
                return;
            }
            if (tContent.value.replace(" ", "").length < 1) {
                alert("No content ? ok :/");
            }
            jQuery.ajax({
                type: "post",
                url: "./managers/nmgText.php",
                data: {
                    name: "next",
                    title: tId.value.toString(),
                    content: tContent.value.toString(),
                },
                success: function(obj, textstatus) {
                    if (obj != "null") {
                        alert("Converted to Next");
                        shared = true;
                        alert("Redirecting to home page (in 3 sec)");
                        setTimeout(() => {
                            window.open("./", "_self");
                        }, 3000);
                    }
                }
            });
        }
    </script>
</div>