<div class="d-flex justify-content-center align-items-center flex-column h-100">
    share post
    <div style="display:flex;flex-direction: column;width:50%;">
        <input id="nextTitle" style="font-size: 1.3rem;">
        <textarea id="nextContent" style="font-size:1.2rem;resize: none;height:25vh;"></textarea>
        <div>
            <h6>Categories</h6>
            <div id="categoriesHolder">

            </div>
        </div>
        <input id="nextCategories" onkeydown="AddCategory(event)">
        <button onclick="NextText()">N E X T</button>
    </div>

    <script>
        let shared = false;
        const tId = document.getElementById("nextTitle");
        const tContent = document.getElementById("nextContent");
        const tCategories = document.getElementById("categoriesHolder");
        const tCategory = document.getElementById("nextCategories");
        let categories = [];

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
                    categories:categories
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

        function AddCategory(e) {
            if (e.key == "Enter") {
                if (!categories.includes(tCategory.value)) {
                    if (categories.length > 10) {
                        alert("you can only add 10 categories");
                    } else {
                        if (tCategory.value.replace(" ", "").length > 0) {
                            categories.push(tCategory.value);
                            tCategories.innerHTML += "<button id=\"" + (categories.length + 1) + "\" onclick=\"removeCategory(" + (categories.length + 1) + ")\">" + tCategory.value + "</button>";
                            tCategory.value = "";
                        } else {
                            alert("type category");
                        }

                    }
                } else {
                    alert("category already exists");
                }
            }
        }

        function removeCategory(itemid) {
            let item = document.getElementById(itemid);
            let x = [];
            categories.forEach(e => {
                if (e != item.innerText) {
                    x.push(e);
                }
            })
            categories = x;
            item.parentElement.removeChild(item);
        }
    </script>
</div>