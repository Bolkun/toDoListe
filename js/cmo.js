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

//Monsters
function showInfo(id) {
    var i = 'info'.concat(id);
    var s = 'stats'.concat(id);
    var a = 'atacks'.concat(id);
    document.getElementById(i).style.display = "block";
    document.getElementById(s).style.display = "none";
    document.getElementById(a).style.display = "none";
}

function showStats(id) {
    var i = 'info'.concat(id);
    var s = 'stats'.concat(id);
    var a = 'atacks'.concat(id);
    document.getElementById(i).style.display = "none";
    document.getElementById(s).style.display = "block";
    document.getElementById(a).style.display = "none";
}

function showAtacks(id) {
    var i = 'info'.concat(id);
    var s = 'stats'.concat(id);
    var a = 'atacks'.concat(id);
    document.getElementById(i).style.display = "none";
    document.getElementById(s).style.display = "none";
    document.getElementById(a).style.display = "block";
}

function takeOffItem(values) {
    var id = values[0];	//item_id
    $.ajax({
        type: 'POST',
        url: 'forms/item_off_res.php',
        data: 'item_id=' + id,
        error: takeOffItem_error,
        success: takeOffItem_success
    });
    $('#monster_content').load(document.URL + ' #monster_content');
    $('#item_content').load(document.URL + ' #item_content');
}

function takeOffItem_error(){
    alert("Something went wrong by taking item off!");
}

function takeOffItem_success(){
    alert("Item removed successfuly!");
}

function ajax_send_monster_ev(values) {/*m_id, Hp_Ev, amount(1,10,100)*/
    $.ajax({
        url: 'forms/monster_ev_res.php',
        type: 'POST',
        data: 'm_id=' + values[0] + '&stat=' + values[1] + '&amount=' + values[2],
        error: ajax_send_monster_ev_error,
        success: ajax_send_monster_ev_success
    });
    //m0
    $('#monster_td0').load(document.URL + ' #monster_td0');	//progress bar reload
    $('#tabs0').load(document.URL + ' #tabs0');					//content stats reload
    //m1
    $('#monster_td1').load(document.URL + ' #monster_td1');	//progress bar reload
    $('#tabs1').load(document.URL + ' #tabs1');					//content stats reload
    //m2
    $('#monster_td2').load(document.URL + ' #monster_td2');	//progress bar reload
    $('#tabs2').load(document.URL + ' #tabs2');					//content stats reload
    //m3
    $('#monster_td3').load(document.URL + ' #monster_td3');	//progress bar reload
    $('#tabs3').load(document.URL + ' #tabs3');					//content stats reload
    //m4
    $('#monster_td4').load(document.URL + ' #monster_td4');	//progress bar reload
    $('#tabs4').load(document.URL + ' #tabs4');					//content stats reload
    //m5
    $('#monster_td5').load(document.URL + ' #monster_td5');	//progress bar reload
    $('#tabs5').load(document.URL + ' #tabs5');					//content stats reload

    $('#doctorATable').load(document.URL + ' #doctorATable');
}

function ajax_send_monster_ev_error() {
    alert('Error by ev loading!');
}

function ajax_send_monster_ev_success() {
    alert("Ev was added!");
}

function ajax_make_start(values) {
    $.ajax({
        url: 'forms/monster_start_res.php',
        type: 'POST',
        data: 'm_id=' + values[0] + '&start=' + values[1],
        dataType: "text",
        error: ajax_make_start_error,
        success: ajax_make_start_success
    });
    $('#monster_content').load(document.URL + ' #monster_content');
    $('#forest_main').load(document.URL + ' #forest_main');
}

function ajax_make_start_error() {
    alert('Error by data loading!');
}

function ajax_make_start_success() {
    //alert("Your first pick is "+values[0]+"! Old start is "+values[1]);
    alert("Starter Changed!");
}

function ajax_send_monster_atack() { /*m_id, slot(A1,A2,A3,A4), id(table), radio_name*/
    /*var tableRedraw = values[2];
    var radio_name = values[3];*/

    /*var atack_name = document.getElementsByName(radio_name);
    var atack_value;
    for(var i = 0; i < atack_name.length; i++){
        if(atack_name[i].checked){
            atack_value = atack_name[i].value;
        }
    }*/
    $.ajax({
        type: 'POST',
        url: 'forms/monster_atacks_res.php',
        data: /*'m_id='+values[0]+'&slot='+values[1]*/$('#changeMonster0Atack1').serialize(),
        success: function (response, textStatus, jqXHR) {
            alert("Atack changed successfuly!");
            //location.reload(true);	//refreshes the whole page in browser from server
            //$( "menu.php" ).load(window.location.href + " menu.php" );
        }
    });
    //$('#tabs').load(document.URL +  ' #tabs');
    //$('#monster0_atacks').load(document.URL +  ' #monster0_atacks');
    //$('#'+tableRedraw).load(document.URL +  ' #'+tableRedraw);
    //$('#atacks0').load(document.URL +  ' #atacks0');
    //$('#doctorA').load(document.URL +  ' #doctorA');
    //$('#'+tableRedraw).load(document.URL +  ' #'+tableRedraw);
    $('#pop_m1_a1').load(document.URL + ' #pop_m1_a1');
    $('#atack_list0').load(document.URL + ' #atack_list0');
    //$('#monster_content').load(document.URL +  ' #monster_content');
}

//Monster 0
function m1_a1() {
    document.getElementById('pop_m1_a1').style.display="block";
    document.getElementById('pop_m1_a2').style.display="none";
    document.getElementById('pop_m1_a3').style.display="none";
    document.getElementById('pop_m1_a4').style.display="none";
}
function m1_a2() {
    document.getElementById('pop_m1_a1').style.display="none";
    document.getElementById('pop_m1_a2').style.display="block";
    document.getElementById('pop_m1_a3').style.display="none";
    document.getElementById('pop_m1_a4').style.display="none";
}
function m1_a3() {
    document.getElementById('pop_m1_a1').style.display="none";
    document.getElementById('pop_m1_a2').style.display="none";
    document.getElementById('pop_m1_a3').style.display="block";
    document.getElementById('pop_m1_a4').style.display="none";
}
function m1_a4() {
    document.getElementById('pop_m1_a1').style.display="none";
    document.getElementById('pop_m1_a2').style.display="none";
    document.getElementById('pop_m1_a3').style.display="none";
    document.getElementById('pop_m1_a4').style.display="block";
}
function ChangeContent0(values) {	//values[40] == anz aktive monsters
    /*if(document.getElementById('div0').style.display == "none"){
        document.getElementById('div0').style.display="block";
        if(values[40] >= 2) document.getElementById('monster_td1').style.display="none";
        if(values[40] >= 3) document.getElementById('monster_td2').style.display="none";
        if(values[40] >= 4) document.getElementById('monster_td3').style.display="none";
        if(values[40] >= 5) document.getElementById('monster_td4').style.display="none";
        if(values[40] >= 6) document.getElementById('monster_td5').style.display="none";
    } else {
        document.getElementById('div0').style.display="none";
        if(values[40] >= 2) document.getElementById('monster_td1').style.display="block";
        if(values[40] >= 3) document.getElementById('monster_td2').style.display="block";
        if(values[40] >= 4) document.getElementById('monster_td3').style.display="block";
        if(values[40] >= 5) document.getElementById('monster_td4').style.display="block";
        if(values[40] >= 6) document.getElementById('monster_td5').style.display="block";
    }*/
    if(document.getElementById('div0').style.display == "none"){
        document.getElementById('div0').style.display="block";
        document.getElementById('monster_td0').style.display="block";
        document.getElementById('monster_td1').style.display="none";
        document.getElementById('monster_td2').style.display="none";
        document.getElementById('monster_td3').style.display="none";
        document.getElementById('monster_td4').style.display="none";
        document.getElementById('monster_td5').style.display="none";
    } else {
        document.getElementById('div0').style.display="none";
        document.getElementById('monster_td0').style.marginLeft="0px";
        document.getElementById('monster_td1').style.display="block";
        document.getElementById('monster_td2').style.display="block";
        document.getElementById('monster_td3').style.display="block";
        document.getElementById('monster_td4').style.display="block";
        document.getElementById('monster_td5').style.display="block";
    }

    if(values[35] == 1.1){	//har a
        document.getElementById('a_name').style.color="green";
        document.getElementById('a').style.color="green";
    } else if(values[35] == 0.9){
        document.getElementById('a_name').style.color="red";
        document.getElementById('a').style.color="red";
    }
    if(values[36] == 1.1){
        document.getElementById('d_name').style.color="green";
        document.getElementById('d').style.color="green";
    } else if(values[36] == 0.9){
        document.getElementById('d_name').style.color="red";
        document.getElementById('d').style.color="red";
    }
    if(values[37] == 1.1){
        document.getElementById('s_name').style.color="green";
        document.getElementById('s').style.color="green";
    } else if(values[37] == 0.9){
        document.getElementById('s_name').style.color="red";
        document.getElementById('s').style.color="red";
    }
    if(values[38] == 1.1){
        document.getElementById('sa_name').style.color="green";
        document.getElementById('sa').style.color="green";
    } else if(values[38] == 0.9){
        document.getElementById('sa_name').style.color="red";
        document.getElementById('sa').style.color="red";
    }
    if(values[39] == 1.1){
        document.getElementById('sd_name').style.color="green";
        document.getElementById('sd').style.color="green";
    } else if(values[39] == 0.9){
        document.getElementById('sd_name').style.color="red";
        document.getElementById('sd').style.color="red";
    }
}

//Monster 1
function m2_a1() {
    document.getElementById('pop_m2_a1').style.display="block";
    document.getElementById('pop_m2_a2').style.display="none";
    document.getElementById('pop_m2_a3').style.display="none";
    document.getElementById('pop_m2_a4').style.display="none";
}
function m2_a2() {
    document.getElementById('pop_m2_a1').style.display="none";
    document.getElementById('pop_m2_a2').style.display="block";
    document.getElementById('pop_m2_a3').style.display="none";
    document.getElementById('pop_m2_a4').style.display="none";
}
function m2_a3() {
    document.getElementById('pop_m2_a1').style.display="none";
    document.getElementById('pop_m2_a2').style.display="none";
    document.getElementById('pop_m2_a3').style.display="block";
    document.getElementById('pop_m2_a4').style.display="none";
}
function m2_a4() {
    document.getElementById('pop_m2_a1').style.display="none";
    document.getElementById('pop_m2_a2').style.display="none";
    document.getElementById('pop_m2_a3').style.display="none";
    document.getElementById('pop_m2_a4').style.display="block";
}
function ChangeContent1(values) {
    if(document.getElementById('div1').style.display == "none"){
        document.getElementById('div1').style.display="block";
        document.getElementById('monster_td0').style.display="none";
        document.getElementById('monster_td1').style.marginLeft="-28px";
        document.getElementById('monster_td2').style.display="none";
        document.getElementById('monster_td3').style.display="none";
        document.getElementById('monster_td4').style.display="none";
        document.getElementById('monster_td5').style.display="none";
    } else {
        document.getElementById('div1').style.display="none";
        document.getElementById('monster_td0').style.display="block";
        document.getElementById('monster_td1').style.marginLeft="0px";
        document.getElementById('monster_td2').style.display="block";
        document.getElementById('monster_td3').style.display="block";
        document.getElementById('monster_td4').style.display="block";
        document.getElementById('monster_td5').style.display="block";
    }

    if(values[35] == 1.1){	//har a
        document.getElementById('a_name1').style.color="green";
        document.getElementById('a1').style.color="green";
    } else if(values[35] == 0.9){
        document.getElementById('a_name1').style.color="red";
        document.getElementById('a1').style.color="red";
    }
    if(values[36] == 1.1){
        document.getElementById('d_name1').style.color="green";
        document.getElementById('d1').style.color="green";
    } else if(values[36] == 0.9){
        document.getElementById('d_name1').style.color="red";
        document.getElementById('d1').style.color="red";
    }
    if(values[37] == 1.1){
        document.getElementById('s_name1').style.color="green";
        document.getElementById('s1').style.color="green";
    } else if(values[37] == 0.9){
        document.getElementById('s_name1').style.color="red";
        document.getElementById('s1').style.color="red";
    }
    if(values[38] == 1.1){
        document.getElementById('sa_name1').style.color="green";
        document.getElementById('sa1').style.color="green";
    } else if(values[38] == 0.9){
        document.getElementById('sa_name1').style.color="red";
        document.getElementById('sa1').style.color="red";
    }
    if(values[39] == 1.1){
        document.getElementById('sd_name1').style.color="green";
        document.getElementById('sd1').style.color="green";
    } else if(values[39] == 0.9){
        document.getElementById('sd_name1').style.color="red";
        document.getElementById('sd1').style.color="red";
    }
}

//Monster 2
function m3_a1() {
    document.getElementById('pop_m3_a1').style.display="block";
    document.getElementById('pop_m3_a2').style.display="none";
    document.getElementById('pop_m3_a3').style.display="none";
    document.getElementById('pop_m3_a4').style.display="none";
}
function m3_a2() {
    document.getElementById('pop_m3_a1').style.display="none";
    document.getElementById('pop_m3_a2').style.display="block";
    document.getElementById('pop_m3_a3').style.display="none";
    document.getElementById('pop_m3_a4').style.display="none";
}
function m3_a3() {
    document.getElementById('pop_m3_a1').style.display="none";
    document.getElementById('pop_m3_a2').style.display="none";
    document.getElementById('pop_m3_a3').style.display="block";
    document.getElementById('pop_m3_a4').style.display="none";
}
function m3_a4() {
    document.getElementById('pop_m3_a1').style.display="none";
    document.getElementById('pop_m3_a2').style.display="none";
    document.getElementById('pop_m3_a3').style.display="none";
    document.getElementById('pop_m3_a4').style.display="block";
}

function ChangeContent2(values) {
    if(document.getElementById('div2').style.display == "none"){
        document.getElementById('div2').style.display="block";
        document.getElementById('monster_td0').style.display="none";
        document.getElementById('monster_td1').style.display="none";
        document.getElementById('monster_td2').style.marginLeft="-56px";
        document.getElementById('monster_td3').style.display="none";
        document.getElementById('monster_td4').style.display="none";
        document.getElementById('monster_td5').style.display="none";
    } else {
        document.getElementById('div2').style.display="none";
        document.getElementById('monster_td0').style.display="block";
        document.getElementById('monster_td1').style.display="block";
        document.getElementById('monster_td2').style.marginLeft="0px";
        document.getElementById('monster_td3').style.display="block";
        document.getElementById('monster_td4').style.display="block";
        document.getElementById('monster_td5').style.display="block";
    }

    if(values[35] == 1.1){	//har a
        document.getElementById('a_name2').style.color="green";
        document.getElementById('a2').style.color="green";
    } else if(values[35] == 0.9){
        document.getElementById('a_name2').style.color="red";
        document.getElementById('a2').style.color="red";
    }
    if(values[36] == 1.1){
        document.getElementById('d_name2').style.color="green";
        document.getElementById('d2').style.color="green";
    } else if(values[36] == 0.9){
        document.getElementById('d_name2').style.color="red";
        document.getElementById('d2').style.color="red";
    }
    if(values[37] == 1.1){
        document.getElementById('s_name2').style.color="green";
        document.getElementById('s2').style.color="green";
    } else if(values[37] == 0.9){
        document.getElementById('s_name2').style.color="red";
        document.getElementById('s2').style.color="red";
    }
    if(values[38] == 1.1){
        document.getElementById('sa_name2').style.color="green";
        document.getElementById('sa2').style.color="green";
    } else if(values[38] == 0.9){
        document.getElementById('sa_name2').style.color="red";
        document.getElementById('sa2').style.color="red";
    }
    if(values[39] == 1.1){
        document.getElementById('sd_name2').style.color="green";
        document.getElementById('sd2').style.color="green";
    } else if(values[39] == 0.9){
        document.getElementById('sd_name2').style.color="red";
        document.getElementById('sd2').style.color="red";
    }
}

//Monster 3
function m4_a1() {
    document.getElementById('pop_m4_a1').style.display="block";
    document.getElementById('pop_m4_a2').style.display="none";
    document.getElementById('pop_m4_a3').style.display="none";
    document.getElementById('pop_m4_a4').style.display="none";
}
function m4_a2() {
    document.getElementById('pop_m4_a1').style.display="none";
    document.getElementById('pop_m4_a2').style.display="block";
    document.getElementById('pop_m4_a3').style.display="none";
    document.getElementById('pop_m4_a4').style.display="none";
}
function m4_a3() {
    document.getElementById('pop_m4_a1').style.display="none";
    document.getElementById('pop_m4_a2').style.display="none";
    document.getElementById('pop_m4_a3').style.display="block";
    document.getElementById('pop_m4_a4').style.display="none";
}
function m4_a4() {
    document.getElementById('pop_m4_a1').style.display="none";
    document.getElementById('pop_m4_a2').style.display="none";
    document.getElementById('pop_m4_a3').style.display="none";
    document.getElementById('pop_m4_a4').style.display="block";
}
function ChangeContent3(values) {
    if(document.getElementById('div3').style.display == "none"){
        document.getElementById('div3').style.display="block";
        document.getElementById('monster_td0').style.display="none";
        document.getElementById('monster_td1').style.display="none";
        document.getElementById('monster_td2').style.display="none";
        document.getElementById('monster_td3').style.marginTop="-24px";
        document.getElementById('monster_td4').style.display="none";
        document.getElementById('monster_td5').style.display="none";
    } else {
        document.getElementById('div3').style.display="none";
        document.getElementById('monster_td0').style.display="block";
        document.getElementById('monster_td1').style.display="block";
        document.getElementById('monster_td2').style.display="block";
        document.getElementById('monster_td3').style.marginTop="0px";
        document.getElementById('monster_td4').style.display="block";
        document.getElementById('monster_td5').style.display="block";
    }

    if(values[35] == 1.1){	//har a
        document.getElementById('a_name3').style.color="green";
        document.getElementById('a3').style.color="green";
    } else if(values[35] == 0.9){
        document.getElementById('a_name3').style.color="red";
        document.getElementById('a3').style.color="red";
    }
    if(values[36] == 1.1){
        document.getElementById('d_name3').style.color="green";
        document.getElementById('d3').style.color="green";
    } else if(values[36] == 0.9){
        document.getElementById('d_name3').style.color="red";
        document.getElementById('d3').style.color="red";
    }
    if(values[37] == 1.1){
        document.getElementById('s_name3').style.color="green";
        document.getElementById('s3').style.color="green";
    } else if(values[37] == 0.9){
        document.getElementById('s_name3').style.color="red";
        document.getElementById('s3').style.color="red";
    }
    if(values[38] == 1.1){
        document.getElementById('sa_name3').style.color="green";
        document.getElementById('sa3').style.color="green";
    } else if(values[38] == 0.9){
        document.getElementById('sa_name3').style.color="red";
        document.getElementById('sa3').style.color="red";
    }
    if(values[39] == 1.1){
        document.getElementById('sd_name3').style.color="green";
        document.getElementById('sd3').style.color="green";
    } else if(values[39] == 0.9){
        document.getElementById('sd_name3').style.color="red";
        document.getElementById('sd3').style.color="red";
    }
}

//Monster 4
function m5_a1() {
    document.getElementById('pop_m5_a1').style.display="block";
    document.getElementById('pop_m5_a2').style.display="none";
    document.getElementById('pop_m5_a3').style.display="none";
    document.getElementById('pop_m5_a4').style.display="none";
}
function m5_a2() {
    document.getElementById('pop_m5_a1').style.display="none";
    document.getElementById('pop_m5_a2').style.display="block";
    document.getElementById('pop_m5_a3').style.display="none";
    document.getElementById('pop_m5_a4').style.display="none";
}
function m5_a3() {
    document.getElementById('pop_m5_a1').style.display="none";
    document.getElementById('pop_m5_a2').style.display="none";
    document.getElementById('pop_m5_a3').style.display="block";
    document.getElementById('pop_m5_a4').style.display="none";
}
function m5_a4() {
    document.getElementById('pop_m5_a1').style.display="none";
    document.getElementById('pop_m5_a2').style.display="none";
    document.getElementById('pop_m5_a3').style.display="none";
    document.getElementById('pop_m5_a4').style.display="block";
}
function ChangeContent4(values) {
    if(document.getElementById('div4').style.display == "none"){
        document.getElementById('div4').style.display="block";
        document.getElementById('monster_td0').style.display="none";
        document.getElementById('monster_td1').style.display="none";
        document.getElementById('monster_td2').style.display="none";
        document.getElementById('monster_td3').style.display="none";
        document.getElementById('monster_td4').style.marginTop="-24px";
        document.getElementById('monster_td4').style.marginLeft="-28px";
        document.getElementById('monster_td5').style.display="none";
    } else {
        document.getElementById('div4').style.display="none";
        document.getElementById('monster_td0').style.display="block";
        document.getElementById('monster_td1').style.display="block";
        document.getElementById('monster_td2').style.display="block";
        document.getElementById('monster_td3').style.display="block";
        document.getElementById('monster_td4').style.marginTop="0px";
        document.getElementById('monster_td4').style.marginLeft="0px";
        document.getElementById('monster_td5').style.display="block";
    }

    if(values[35] == 1.1){	//har a
        document.getElementById('a_name4').style.color="green";
        document.getElementById('a4').style.color="green";
    } else if(values[35] == 0.9){
        document.getElementById('a_name4').style.color="red";
        document.getElementById('a4').style.color="red";
    }
    if(values[36] == 1.1){
        document.getElementById('d_name4').style.color="green";
        document.getElementById('d4').style.color="green";
    } else if(values[36] == 0.9){
        document.getElementById('d_name4').style.color="red";
        document.getElementById('d4').style.color="red";
    }
    if(values[37] == 1.1){
        document.getElementById('s_name4').style.color="green";
        document.getElementById('s4').style.color="green";
    } else if(values[37] == 0.9){
        document.getElementById('s_name4').style.color="red";
        document.getElementById('s4').style.color="red";
    }
    if(values[38] == 1.1){
        document.getElementById('sa_name4').style.color="green";
        document.getElementById('sa4').style.color="green";
    } else if(values[38] == 0.9){
        document.getElementById('sa_name4').style.color="red";
        document.getElementById('sa4').style.color="red";
    }
    if(values[39] == 1.1){
        document.getElementById('sd_name4').style.color="green";
        document.getElementById('sd4').style.color="green";
    } else if(values[39] == 0.9){
        document.getElementById('sd_name4').style.color="red";
        document.getElementById('sd4').style.color="red";
    }
}

//Monster 5
function m6_a1() {
    document.getElementById('pop_m6_a1').style.display="block";
    document.getElementById('pop_m6_a2').style.display="none";
    document.getElementById('pop_m6_a3').style.display="none";
    document.getElementById('pop_m6_a4').style.display="none";
}
function m6_a2() {
    document.getElementById('pop_m6_a1').style.display="none";
    document.getElementById('pop_m6_a2').style.display="block";
    document.getElementById('pop_m6_a3').style.display="none";
    document.getElementById('pop_m6_a4').style.display="none";
}
function m6_a3() {
    document.getElementById('pop_m6_a1').style.display="none";
    document.getElementById('pop_m6_a2').style.display="none";
    document.getElementById('pop_m6_a3').style.display="block";
    document.getElementById('pop_m6_a4').style.display="none";
}
function m6_a4() {
    document.getElementById('pop_m6_a1').style.display="none";
    document.getElementById('pop_m6_a2').style.display="none";
    document.getElementById('pop_m6_a3').style.display="none";
    document.getElementById('pop_m6_a4').style.display="block";
}
function ChangeContent5(values) {
    if(document.getElementById('div5').style.display == "none"){
        document.getElementById('div5').style.display="block";
        document.getElementById('monster_td0').style.display="none";
        document.getElementById('monster_td1').style.display="none";
        document.getElementById('monster_td2').style.display="none";
        document.getElementById('monster_td3').style.display="none";
        document.getElementById('monster_td4').style.display="none";
        document.getElementById('monster_td5').style.marginTop="-24px";
        document.getElementById('monster_td5').style.marginLeft="-56px";
    } else {
        document.getElementById('div5').style.display="none";
        document.getElementById('monster_td0').style.display="block";
        document.getElementById('monster_td1').style.display="block";
        document.getElementById('monster_td2').style.display="block";
        document.getElementById('monster_td3').style.display="block";
        document.getElementById('monster_td4').style.display="block";
        document.getElementById('monster_td5').style.marginTop="0px";
        document.getElementById('monster_td5').style.marginLeft="0px";
    }

    if(values[35] == 1.1){	//har a
        document.getElementById('a_name5').style.color="green";
        document.getElementById('a5').style.color="green";
    } else if(values[35] == 0.9){
        document.getElementById('a_name5').style.color="red";
        document.getElementById('a5').style.color="red";
    }
    if(values[36] == 1.1){
        document.getElementById('d_name5').style.color="green";
        document.getElementById('d5').style.color="green";
    } else if(values[36] == 0.9){
        document.getElementById('d_name5').style.color="red";
        document.getElementById('d5').style.color="red";
    }
    if(values[37] == 1.1){
        document.getElementById('s_name5').style.color="green";
        document.getElementById('s5').style.color="green";
    } else if(values[37] == 0.9){
        document.getElementById('s_name5').style.color="red";
        document.getElementById('s5').style.color="red";
    }
    if(values[38] == 1.1){
        document.getElementById('sa_name5').style.color="green";
        document.getElementById('sa5').style.color="green";
    } else if(values[38] == 0.9){
        document.getElementById('sa_name5').style.color="red";
        document.getElementById('sa5').style.color="red";
    }
    if(values[39] == 1.1){
        document.getElementById('sd_name5').style.color="green";
        document.getElementById('sd5').style.color="green";
    } else if(values[39] == 0.9){
        document.getElementById('sd_name5').style.color="red";
        document.getElementById('sd5').style.color="red";
    }
}
/**backpack.php**/
function ajax_send_item() {
    var id = document.getElementById("i_id").value;
    var monster_id = document.getElementById("monster_choice").value;
    $.ajax({
        type: 'POST',
        url: 'forms/item_res.php',
        data: 'item_id='+id+'&mon_id='+monster_id,
        error: ajax_send_item_error,
        success: ajax_send_item_success
    });
    $('#item_content').load(document.URL +  ' #item_content');
    $('#monster_content').load(document.URL +  ' #monster_content');
}

function ajax_send_item_error() {
    alert('Error by using an Item');
}

function ajax_send_item_success() {
    alert( "Item used successfuly!" );
}

function changeItemContent(values) {/*goal, name, amount, desc, image, it_id*/
    if (values[0] == 0) {
        //alert(values[0]);
        //amount format
        var amount = values[2];
        var amountStr = amount.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        //собирание и крафтинг
        document.getElementById("name_value").innerHTML = values[1]; 	//name
        document.getElementById("img").style.display="block";
        document.getElementById("img").src = "img/item/" +values[4];	//image
        document.getElementById("amount").innerHTML = "x" +amountStr;	//value
        document.getElementById("desc").innerHTML = values[3];			//desc
        document.getElementById("i_id").value = values[5];				//it_id
        document.getElementById('forma').style.display="none";
    }
    else {
        //использоапниe на монстра
        document.getElementById("name_value").innerHTML = values[1]; 	//name
        document.getElementById("img").style.display="block";
        document.getElementById("img").src = "img/item/" +values[4];	//image
        document.getElementById("amount").innerHTML = "x" +values[2];	//value
        document.getElementById("desc").innerHTML = values[3];			//desc
        document.getElementById("i_id").value = values[5];				//it_id
        document.getElementById('forma').style.display="block";
    }
}