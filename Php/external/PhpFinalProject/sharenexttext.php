<div class="d-flex justify-content-center align-items-center flex-column h-100">
    <div style="background-color: #151515;padding:0.5rem 2rem;border-radius:1rem 1rem 0 0;border:0.05rem solid white;border-bottom:none;">Create NEXT : Text</div>
    <div class="p-3 rounded rounded-3" style="display:flex;flex-direction: column;width:50%;background-color: #151515;border:0.05rem solid white;">
        Title
        <input placeholder=">_" id="nextTitle" class="form-control bg-dark text-white" style="font-size: 1.3rem;" maxlength="128">
        Content
        <textarea placeholder="describe your title here" id="nextContent" maxlength="512" class="form-control bg-dark text-white" style="font-size:1.2rem;resize: none;height:25vh;margin-bottom:1rem;"></textarea>
        <div class="d-flex flex-row justify-content-between">
            <button class="btn btn-dark w-100 mr-1" onclick="NextText()">N E X T</button>
            <a href="home.php" class="btn btn-warning">Cancel</a>
        </div>
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
                        shared = true;
                        alert("Converted to Next\nRedirecting to home page");
                        window.open("./", "_self");
                    }
                }
            });
        }
    </script>
</div>