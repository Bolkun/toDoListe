/* menu.php */
function profile() {
    document.getElementById('pop_profile').style.display='block';
    document.getElementById('pop_monsters').style.display='none';
    document.getElementById('pop_backpack').style.display='none';
    document.getElementById('pop_post').style.display='none';
    document.getElementById('pop_masters').style.display='none';
    document.getElementById('pop_clans').style.display='none';
    document.getElementById('pop_cardInfo').style.display='none';
}
function monsters() {
    document.getElementById('pop_profile').style.display='none';
    document.getElementById('pop_monsters').style.display='block';
    document.getElementById('pop_backpack').style.display='none';
    document.getElementById('pop_post').style.display='none';
    document.getElementById('pop_masters').style.display='none';
    document.getElementById('pop_clans').style.display='none';
    document.getElementById('pop_cardInfo').style.display='none';
}
function backpack() {
    document.getElementById('pop_profile').style.display='none';
    document.getElementById('pop_monsters').style.display='none';
    document.getElementById('pop_backpack').style.display='block';
    document.getElementById('pop_post').style.display='none';
    document.getElementById('pop_masters').style.display='none';
    document.getElementById('pop_clans').style.display='none';
    document.getElementById('pop_cardInfo').style.display='none';
}
function post() {
    document.getElementById('pop_profile').style.display='none';
    document.getElementById('pop_monsters').style.display='none';
    document.getElementById('pop_backpack').style.display='none';
    document.getElementById('pop_post').style.display='block';
    document.getElementById('pop_masters').style.display='none';
    document.getElementById('pop_clans').style.display='none';
    document.getElementById('pop_cardInfo').style.display='none';
}
function masters() {
    document.getElementById('pop_profile').style.display='none';
    document.getElementById('pop_monsters').style.display='none';
    document.getElementById('pop_backpack').style.display='none';
    document.getElementById('pop_post').style.display='none';
    document.getElementById('pop_masters').style.display='block';
    document.getElementById('pop_clans').style.display='none';
    document.getElementById('pop_cardInfo').style.display='none';
}
function clans() {
    document.getElementById('pop_profile').style.display='none';
    document.getElementById('pop_monsters').style.display='none';
    document.getElementById('pop_backpack').style.display='none';
    document.getElementById('pop_post').style.display='none';
    document.getElementById('pop_masters').style.display='none';
    document.getElementById('pop_clans').style.display='block';
    document.getElementById('pop_cardInfo').style.display='none';
}
function cardInfo() {
    document.getElementById('pop_profile').style.display='none';
    document.getElementById('pop_monsters').style.display='none';
    document.getElementById('pop_backpack').style.display='none';
    document.getElementById('pop_post').style.display='none';
    document.getElementById('pop_masters').style.display='none';
    document.getElementById('pop_clans').style.display='none';
    document.getElementById('pop_cardInfo').style.display='block';
}

//Profile
function ajax_send_profile() {
    var msg = $('#profile_form').serialize();
    $.ajax({
        type: 'POST',
        url: 'forms/profile_res.php',
        data: msg,
        success: function (data) {
            $('#results_profile').html(data);
        },
        error: function (xhr) {
            alert('Error response: ' + xhr.responseCode);
        }
    });
}

// Exit
function exit(nickname) {
    $.ajax({
        url: "forms/exit_res.php",
        type: "POST",
        data: "exit_res_nickname=" +nickname,
        dataType: "text",
        error: exit_error,
        success: exit_success(nickname)
    });
}
function exit_error() {
    alert('Error by data loading!');
}
function exit_success(nickname) {
    alert("See you next time ^_^ " +nickname +"!");
    top.location.href="index.php";
}