<?php
    $user->loadProfile();
?>
<div id='profile_content'>
    <h4 style='margin-top: -35px;'>Profile: <?php $user->getNickName(); ?></h4>
    <hr style='margin-top: -5px; border-top: 1px solid black;'>
    <img id='avatar' src='img/interface/<?php $user->getAvatar(); ?>'><br>
    <table id='profileTable'>
        <tr>
            <td style='color: <?php $user->getOnlineColor() ?>'><?php $user->getOnline(); ?> | <?php $user->getLocation(); ?></td>
        </tr>
        <tr>
            <td><?php $user->getSlots(); ?></td>
        </tr>
        <tr>
            <td><?php $user->getGruppe(); ?></td>
        </tr>
        <tr>
            <td>Collection: <?php $user->getMonsterCollection(); ?> / <?php $user->getTotalMonsterCollection(); ?></td>
        </tr>
        <tr>
            <td>Started: <?php $user->getCharacterBirthday(); ?></td>
        </tr>
        <tr>
            <td>
                <div id='results_profile'>
                    About me: <?php $user->getAbout(); ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <form method='POST' id='profile_form' action='javascript:void(null);' onsubmit='ajax_send_profile()'>
                    <input type='text' name='about_me' maxlength='250' placeholder='About me'
                           style='height: 30px; background-color: transparent; border-bottom: 1px solid black;border-top:none;border-left:none;border-right:none;'>
                    <!--max 250 chars-->
                    <input type='hidden' name='nick_name' value='<?php $user->getNickName(); ?>' readonly>
                    <input class="btn btn-info" type='submit' value='Save'>
                </form>
            </td>
        </tr>
    </table>
</div>
