let alert_timeout;

function show_alert(time, msg) {
    clearTimeout(alert_timeout);
    const alert = document.getElementById("alert");
    const alert_content = document.getElementById("alert_content");

    alert_content.innerHTML = msg;
    alert.classList.add("active");
    alert_timeout = setTimeout(function(){
        alert.classList.remove("active");
    }, time);
}
document.getElementById("alert_close").addEventListener("click", function(e){
    e.preventDefault();
    
    clearTimeout(alert_timeout);
    document.getElementById("alert").classList.remove("active");
});

document.getElementById("vote_my_fave").addEventListener("click", function(e){
    e.preventDefault();

    navigator.clipboard.writeText("$ly Nosepass");
    show_alert(5000, '<strong>$ly Nosepass</strong> copied!<br/><br/>Paste the command in your Mudae channel.<br/>Thanks for like it!<br/><img width="40" src="petting_probopass.gif">');
});