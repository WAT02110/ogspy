<?php
/**
 * Main menu
 * @package OGSpy
 * @version 3.04b ($Rev: 7508 $)
 * @subpackage views
 * @author Kyser
 * @created 15/12/2005
 * @copyright Copyright &copy; 2007, https://ogsteam.eu/
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

if (!defined('IN_SPYOGAME')) {
    die("Hacking attempt");
}

?>
<table border="0" cellpadding="0" cellspacing="0">
    <tr align="center">
        <td>
            <b><?php echo($lang['MENU_SERVER_TIME']); ?></b><br/>
            <span id="datetime"><?php echo($lang['MENU_WAITING']); ?></span>
        </td>
    </tr>

    <tr>
        <td>
            <div><a href="index.php" class="menu">
            <img src="./skin/OGSpy_skin/transpa.gif" width="166" height="65" border="0"/></a></div>
        </td>
    </tr>

    <?php

    if ($server_config["server_active"] == 0) {
        echo "<tr>\n";
        echo "\t" . "<td><div align='center'><font color='red'><b><blink>" . $lang['MENU_SERVER_OFFLINE'] . "</blink></b></font></div></td>\n";
        echo "</tr>\n";
    }

    ?>
    <tr>
        <td>
            <div style="text-align:left;">

                <ul class="menu" id="menu">
                    <?php
                    if ($user_data["user_admin"] == 1 || $user_data["user_coadmin"] == 1 || $user_data["management_user"] == 1) {
                        echo "<li><a href='index.php?action=administration' class='menu_items'>" . $lang['MENU_ADMIN'] . "</a></li>";
                    }
                    ?>
                    <li><a href='index.php?action=profile' class='menu_items'><?php echo($lang['MENU_PROFILE']); ?></a>
                    </li>
                    <img src="./skin/OGSpy_skin/transpa.gif" width="166" height="19">
                    <li><a href='index.php?action=home' class='menu_items'><?php echo($lang['MENU_HOME']); ?></a></li>
                    <li><a href='index.php?action=galaxy' class='menu_items'><?php echo($lang['MENU_GALAXY']); ?></a>
                    </li>
                    <li><a href='index.php?action=cartography'
                           class='menu_items'><?php echo($lang['MENU_ALLIANCES']); ?></a></li>
                    <li><a href='index.php?action=search' class='menu_items'><?php echo($lang['MENU_RESEARCH']); ?></a>
                    </li>
                    <li><a href='index.php?action=ranking' class='menu_items'><?php echo($lang['MENU_RANKINGS']); ?></a>
                    </li>
                    <img src="./skin/OGSpy_skin/transpa.gif" width="166" height="19">
                    <li><a href='index.php?action=statistic'
                           class='menu_items'><?php echo($lang['MENU_UPDATE_STATUS']); ?></a></li>
                    <li><p class='menu_items'><?php echo($lang['MENU_MODULES']); ?></p>
                        <ul class='menu_mods'>
                            <?php
                            //todo sortir requete de la vue
                            $mod_model = new \Ogsteam\Ogspy\Model\Mod_Model();
                            $tMods = $mod_model->find_by(array("active" => "1"), array("position" => 'ASC', "title" => 'ASC'));
                            ?>
                            <!-- mod non admin -->
                            <?php foreach ($tMods as $mod) : ?>
                                <?php if ($mod['admin_only'] == 0) : ?>
                                    <?php echo '<span>&nbsp;&nbsp;- <a class=\'menu_mods\' href="index.php?action=' . $mod['action'] . '">' . $mod['menu'] . '</a></span>' . '<br>'; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <!-- mod admin -->
                            <?php if ($user_data["user_admin"] == 1 || $user_data["user_coadmin"] == 1) : ?>
                                <img src="./skin/OGSpy_skin/transpa.gif" width="166" height="19">
                                <?php foreach ($tMods as $mod) : ?>
                                    <?php if ($mod['admin_only'] == 1) : ?>
                                        <?php echo '<span>&nbsp;&nbsp;- <a class=\'menu_mods\' href="index.php?action=' . $mod['action'] . '">' . $mod['menu'] . '</a></span>' . '<br>'; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <img src="./skin/OGSpy_skin/transpa.gif" width="166" height="19">
                    <?php
                    if ($server_config["url_forum"] != "") {
                        echo "<li><a href='" . $server_config["url_forum"] . "' class='menu_items'>" . $lang['MENU_FORUM'] . "</a></li>";
                    }
                    ?>
                    <img src="./skin/OGSpy_skin/transpa.gif" width="166" height="19">
                    <li><a href="index.php?action=about" class='menu_items'><?php echo($lang['MENU_ABOUT']); ?></a></li>
                    <img src="./skin/OGSpy_skin/transpa.gif" width="166" height="19">
                    <li><a href='index.php?action=logout' class='menu_items'><?php echo($lang['MENU_LOGOUT']); ?></a>
                    </li>
                </ul>

            </div><!---->
        </td>


    </tr>

</table>

<!--<script>$( "#menu" ).menu();</script> (Encore pas mal de travail pour mettre ce menu en place) -->
