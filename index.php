<html>
    <head>
        <style type="text/css">
            * {
                box-sizing: border-box;
            }
            a {
                color: inherit;
                text-decoration: none;
            }
            ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
            }
            body {
                background:#222;
                color:white;
                font-family: "Arial";
            }
            .admin {
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                margin-bottom: 16px;
            }
            .admin textarea {
                width:50%;
                background:#343639;
                color:white;
                padding: 8px;
                resize: none;
                font-family: monospace;
                outline: none;
                border: 1px solid #999;
                border-radius: 5px;
                
            }
            .admin textarea:focus {
                outline-offset: 0px;
                border: 1px solid #fff;
            }
            button {
                display:inline-block;
                background:#343639;
                border-radius: 5px;
                padding: 8px;
                border: 1px solid #999;
                color:white;
            }
            .pic-list {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                grid-gap: 5px;
            }
            .pic-list li .pic-content {
                width: 238px;
                background:#2B2D31;
                border-radius: 5px;
                padding: 10px 20px 20px;
                margin: 0 auto;
            }
            .pic-list li .pic-index {
                margin-bottom: 8px;
                font-weight: 600;
            }
            .pic-list li img {
                width: 100%;
                display: block;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <div class="admin">
            <textarea id="character_textarea" class="character-textarea" rows="1" placeholder="[commands: $ims / $imsi-] Paste the command result (format: #. link) "></textarea>
            <button id="btn" href="#" class="btn" type="button">Confirm</button>
        </div>
        <ul id="pic_list" class="pic-list"></ul>
        
        <script type="text/javascript">
            const textarea = document.getElementById("character_textarea");
            const pic_list = document.getElementById("pic_list");
            document.getElementById("btn").addEventListener("click",function(e){
                e.preventDefault();

                var textarea_value = document.getElementById("character_textarea").value.trim();

                textarea.value = "";
                pic_list.innerHTML = "";
                
                var re = new RegExp("(?= \| | \· | \- |\. ).*(?=https:\/\/)", "g");
                
                textarea_value = textarea_value.split(/\r?\n|\r|\n/g)
                    .filter(s => s.match(re))
                    .map(s => {
                        let parts = s.split(re);

                        if(parts[1].includes("mudae.net")) {
                            let index_img = parts[1].split("~")[1];
                            let index = index_img.split(".")[0];
                            parts[1] = index.length > 8 ? "https://cdn.imgchest.com/files/" + index_img : "https://i.imgur.com/" + index_img;
                        }

                        return [
                            parts[0],
                            parts[1]
                        ];
                    })
                    .reduce((a, v) => ({ ...a, [v[0]]: v[1]}), {});

                for(let index in textarea_value) {
                    if(typeof index=="undefined") continue;
                    let li = document.createElement("li");
                    let pic_content = document.createElement("div");
                        pic_content.classList = "pic-content";

                    let pic_index = document.createElement("div");
                        pic_index.classList = "pic-index";
                        pic_index.innerText = index;
                    let img = document.createElement("img");
                        img.src = textarea_value[index];

                    li.appendChild(pic_content);
                    pic_content.appendChild(pic_index);
                    pic_content.appendChild(img);
                    pic_list.append(li);
                }
            });
        </script>
    </body>
</html>