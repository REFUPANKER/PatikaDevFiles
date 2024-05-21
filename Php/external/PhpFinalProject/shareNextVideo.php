<div class="d-flex justify-content-center align-items-center flex-column h-100">
    <div style="background-color: #151515;padding:0.5rem 2rem;border-radius:1rem 1rem 0 0;border:0.05rem solid white;border-bottom:none;">Create NEXT : Video</div>
    <div class="p-3 rounded rounded-3 d-flex flex-column w-75 h-75" style="background-color: #151515;border:0.05rem solid white;">
        <div class="w-100 h-100 mb-2 d-flex flex-row">
            <div class="w-50 h-100 d-flex flex-column mr-1">
                Video
                <label for="nextVideo" class="btn btn-dark text-white" style="cursor:pointer;font-size: 1.3rem;">Select video</label>
                <input type="file" accept=".mp4,.avi,.mov" id="nextVideo" class="d-none">
                <video controls="allways-visible=true" class="w-100 h-100 p-0 m-0 rounded rounded-3" id="preview" alt="Video Preview" style="border: 1px solid white;object-fit:contain;object-position: top;"></video>
            </div>
            <div class="ml-1 w-50 h-100 d-flex flex-column">
                Title
                <input spellcheck="false" placeholder=">_" id="nextTitle" class="form-control bg-dark text-white" style="font-size: 1.3rem;" maxlength="128">
                Description
                <textarea spellcheck="false" placeholder="describe your video here" id="nextContent" maxlength="512" class="h-100 form-control bg-dark text-white" style="font-size:1.2rem;resize: none;height:25vh;"></textarea>
            </div>
        </div>
        <div class="d-flex flex-row justify-content-between">
            <button class="btn btn-dark w-100 mr-1" onclick="NextVideo()">N E X T</button>
            <a href="home.php" class="btn btn-warning">Cancel</a>
        </div>
    </div>
    <script>
        let shared = false;
        const tVideo = document.getElementById("nextVideo");
        const tTitle = document.getElementById("nextTitle");
        const tContent = document.getElementById("nextContent");
        const preview = document.getElementById("preview");
        let selectedVideo = "";
        tVideo.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const fileTypes = ['video/avi', 'video/mp4', 'video/mov'];
                if (!fileTypes.includes(file.type)) {
                    alert('Only mp4,avi,mov files are allowed');
                    tVideo.value = '';
                    return;
                }
                if (file.size > 64 * (1024 * 1024)) {
                    alert("image out of size limit (5mb)");
                    tVideo.value = '';
                    return;
                }
                if (tTitle.value.replace(" ", "").length < 1) { // >_ is default title value
                    tTitle.value=tVideo.files[0].name;
                }
                const reader = new FileReader();
                reader.onload = function(e) {
                    selectedVideo = e.target.result;
                    preview.src = `${e.target.result}`;
                };
                reader.readAsDataURL(file);
            }
        });

        function NextVideo() {
            if (shared) {
                alert("ayo o_O you already shared this");
                return;
            }
            if (selectedVideo.replace(" ", "").length < 1) {
                alert("Select video to share");
                return;
            }
            if (tTitle.value.replace(" ", "").length < 1) {
                alert("Title must be valid");
                return;
            }
            if (tContent.value.replace(" ", "").length < 1) {
                alert("No content ? ok :/");
            }
            jQuery.ajax({
                type: "post",
                url: "./managers/nmgVideo.php",
                data: {
                    name: "next",
                    title: tTitle.value.toString(),
                    descr: tContent.value.toString(),
                    video: selectedVideo,
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