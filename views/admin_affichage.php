<?php
/**
 * Panneau administration des options d'Affichages
 * @package OGSpy
 * @version 3.04b ($Rev: 7508 $)
 * @subpackage views
 * @author bobzer
 * @created 07/04/2007
 * @copyright Copyright &copy; 2007, https://ogsteam.eu/
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

if (!defined('IN_SPYOGAME')) {
    die("Hacking attempt");
}

if ($user_data["user_admin"] != 1 && $user_data["user_coadmin"] != 1) {
    redirection("index.php?action=message&amp;id_message=forbidden&amp;info");
}


//todo sortir requete de la vue
$mod_model = new \Ogsteam\Ogspy\Model\Mod_Model();
$tMods = $mod_model->find_by();

$galaxy_by_line_stat = $server_config['galaxy_by_line_stat'];
$system_by_line_stat = $server_config['system_by_line_stat'];
$enable_stat_view = $server_config['enable_stat_view'] == 1 ? "checked" : "";
$enable_members_view = $server_config['enable_members_view'] == 1 ? "checked" : "";
$galaxy_by_line_ally = $server_config['galaxy_by_line_ally'];
$system_by_line_ally = $server_config['system_by_line_ally'];
$nb_colonnes_ally = $server_config['nb_colonnes_ally'];
$enable_register_view = $server_config['enable_register_view'] == 1 ? "checked" : "";
$register_forum = $server_config['register_forum'];
$register_alliance = $server_config['register_alliance'];
$enable_portee_missil = $server_config['portee_missil'] == 1 ? "checked" : "";
$open_user = $server_config['open_user'];
$open_admin = $server_config['open_admin'];

$color_ally_n = $server_config['color_ally'];
$color_ally_e = explode("_", $color_ally_n);
var_dump($color_ally_n);
?>
<script language="JavaScript">
    var nb_colonnes_ally = <?php echo $nb_colonnes_ally; ?>;

    function View(color) {
        colors = color;
        <?php for ($i = 1; $i <= $nb_colonnes_ally; $i++) {
        echo "document.getElementById('ColorPreview$i').style.backgroundColor = colors;";
        } ?>
    }

    function Set(ally) {
        switch (ally) {
        <?php for ($i = 1; $i <= $nb_colonnes_ally; $i++) {
            echo "case $i:";
            echo "\tdocument.getElementById('color_ally[$i]').value = colors;";
            echo "\tbreak;\n";
        } ?>
        }
    }
    
    function set_colorAlly(html = false) {
        var colornames = getColorArr('names');
        var colorhexs  = getColorArr('hexs');
        var color_id1  = 'color_name_ally';
        var color_id2  = 'color_ally';
        var tab1 = colornames;
        var tab2 = colorhexs;
        if (html !== false) {
            var tmp   = color_id1;
            color_id1 = color_id2;
            color_id2 = tmp;
            tab2 = colornames;
            tab1 = colorhexs;
        }
        for (var i = 0 ; i < nb_colonnes_ally ; i++) {
            var c = document.getElementById(color_id1 + i).value;
            c = c.replace('#', '');
            for (j = 0; j < tab1.length; j++) {
              if (c.toLowerCase() == tab1[j].toLowerCase()) {
                var value_color = '#' + colorhexs[j];
                if (html !== false) {
                    value_color = colornames[j];
                }
                document.getElementById(color_id2 + i).value = value_color;
                break;
              }
            }
        }
    }
</script>
<form method="POST" action="index.php" name="view">
    <input type="hidden" name="action" value="set_server_view">
    <table width="100%">
        <tr>
            <td class="c_ogspy" colspan="2"><?php echo($lang['ADMIN_DISPLAY_GALAXY_TITLE']); ?></td>
        </tr>
        <tr>
            <th width="60%"><?php echo($lang['ADMIN_DISPLAY_GALAXY_MIPS']); ?><?php echo help("display_mips"); ?></th>
            <th><input name="enable_portee_missil" type="checkbox" value="1" <?php echo $enable_portee_missil; ?>
                       onClick="if (view.enable_portee_missil.checked == false)view.enable_portee_missil.checked=false;">
            </th>
        </tr>
        <tr>
            <td class="c_ogspy" colspan="2"><?php echo($lang['ADMIN_DISPLAY_STATS_TITLE']); ?></td>
        </tr>
        <tr>
            <th width="60%"><?php echo($lang['ADMIN_DISPLAY_STATS_MEMBER']); ?><?php echo help("member_stats"); ?></th>
            <th><input name="enable_stat_view" type="checkbox" value="1" <?php echo $enable_stat_view; ?>
                       onClick="if (view.enable_stat_view.checked == false)view.enable_members_view.checked=false;">
            </th>
        </tr>
        <tr>
            <th width="60%"><?php echo($lang['ADMIN_DISPLAY_STATS_CONNECTED']); ?><?php echo help("member_connected"); ?></th>
            <th><input name="enable_members_view" type="checkbox" value="1" <?php echo $enable_members_view; ?>
                       onClick="if (view.enable_stat_view.checked == false)view.enable_members_view.checked=false;">
            </th>
        </tr>
        <tr>
            <th><?php echo($lang['ADMIN_DISPLAY_STATS_GVIEW']); ?></th>
            <th><input name="galaxy_by_line_stat" type="text" size="5" maxlength="3"
                       value="<?php echo $galaxy_by_line_stat; ?>"></th>
        </tr>
        <tr>
            <th><?php echo($lang['ADMIN_DISPLAY_STATS_SVIEW']); ?></th>
            <th><input name="system_by_line_stat" type="text" size="5" maxlength="3"
                       value="<?php echo $system_by_line_stat; ?>"></th>
        </tr>
        <tr>
            <td class="c_ogspy" colspan="2"><?php echo($lang['ADMIN_DISPLAY_ALLY_TITLE']); ?></td>
        </tr>
        <tr>
            <th><?php echo($lang['ADMIN_DISPLAY_ALLY_COLUMS']); ?></th>
            <th><input name="nb_colonnes_ally" type="text" size="3" maxlength="20"
                       value="<?php echo $nb_colonnes_ally; ?>"></th>
        </tr>
<?php for ($i = 1; $i <= $nb_colonnes_ally; $i++) {
        $color_input = color_html_create_double_input('color_ally[' . $i . ']', $color_ally_e[$i - 1], array('size'=>15, 'maxlength'=>20));
?>
            <tr>
                <th>
                    <span style="color: <?php echo $color_ally_e[$i - 1]; ?>; "><?php echo($lang['ADMIN_DISPLAY_ALLY_COLOR']); ?><?php echo $i; ?></span>
                    <br/>

                    <div class="z"><i><?php echo($lang['ADMIN_DISPLAY_ALLY_COLORDESC']); ?></i></div>
                </th>
                <th><?php echo $color_input; ?></th>
            </tr>
<?php } ?>
        <tr>
            <th><?php echo($lang['ADMIN_DISPLAY_ALLY_GVIEW']); ?></th>
            <th><input name="galaxy_by_line_ally" type="text" size="5" maxlength="3"
                       value="<?php echo $galaxy_by_line_ally; ?>"></th>
        </tr>
        <tr>
            <th><?php echo($lang['ADMIN_DISPLAY_ALLY_SVIEW']); ?></th>
            <th><input name="system_by_line_ally" type="text" size="5" maxlength="3"
                       value="<?php echo $system_by_line_ally; ?>"></th>
        </tr>
        <tr>
            <td class="c_ogspy" colspan="2"><?php echo($lang['ADMIN_DISPLAY_LOGIN_TITLE']); ?></td>
        </tr>
        <tr>
            <th width="60%"><?php echo($lang['ADMIN_DISPLAY_LOGIN_REGISTER']); ?><?php echo help("member_registration"); ?></th>
            <th><input name="enable_register_view" type="checkbox" value="1" <?php echo $enable_register_view; ?>
                       onClick="if (view.enable_register_view.checked == false)view.enable_members_view.checked=false;">
            </th>
        </tr>
        <tr>
            <th width="60%"><?php echo($lang['ADMIN_DISPLAY_LOGIN_ALLYNAME']); ?><?php echo help("ally_name"); ?></th>
            <th><input type="text" size="60" name="register_alliance" value="<?php echo $register_alliance; ?>"></th>
        </tr>
        <tr>
            <th width="60%"><?php echo($lang['ADMIN_DISPLAY_LOGIN_FORUM']); ?><?php echo help("forum_link"); ?></th>
            <th><input type="text" size="60" name="register_forum" value="<?php echo $register_forum; ?>"></th>
        </tr>
        <tr>
            <th width="60%"><?php echo($lang['ADMIN_DISPLAY_LOGIN_MODULE']); ?><?php echo help("first_displayed_module"); ?></th>
            <th><select name="open_user">
                    <option>------</option>
                    <?php if ($open_user == "./views/profile.php") {
                        echo '<option selected value="./views/profile.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_PROFILE'] . '</option>';
                    } else {
                        echo '<option value="./views/profile.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_PROFILE'] . '</option>';
                    }

                    if ($open_user == "./views/home.php") {
                        echo '<option selected value="./views/home.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_ACCOUNT'] . '</option>';
                    } else {
                        echo '<option value="./views/home.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_ACCOUNT'] . '</option>';
                    }

                    if ($open_user == "./views/galaxy.php") {
                        echo '<option selected value="./views/galaxy.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_GALAXY'] . '</option>';
                    } else {
                        echo '<option value="./views/galaxy.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_GALAXY'] . '</option>';
                    }

                    if ($open_user == "./views/cartography.php") {
                        echo '<option selected value="./views/cartography.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_ALLY'] . '</option>';
                    } else {
                        echo '<option value="./views/cartography.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_ALLY'] . '</option>';
                    }

                    if ($open_user == "./views/search.php") {
                        echo '<option selected value="./views/search.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_SEARCH'] . '</option>';
                    } else {
                        echo '<option value="./views/search.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_SEARCH'] . '</option>';
                    }

                    if ($open_user == "./views/ranking.php") {
                        echo '<option selected value="./views/ranking.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_RANKINGS'] . '</option>';
                    } else {
                        echo '<option value="./views/ranking.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_RANKINGS'] . '</option>';
                    }

                    if ($open_user == "./views/statistic.php") {
                        echo '<option selected value="./views/statistic.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_STATS'] . '</option>';
                    } else {
                        echo '<option value="./views/statistic.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_STATS'] . '</option>';
                    }

                    if ($open_user == "./views/galaxy_obsolete.php") {
                        echo '<option selected value="./views/galaxy_obsolete.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_TOBEUPDATED'] . '</option>';
                    } else {
                        echo '<option value="./views/galaxy_obsolete.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_TOBEUPDATED'] . '</option>';
                    }
                    ?>
                    <option>------</option>
                    <?php foreach ($tMods as $mod) : ?>
                        <?php if ($mod["admin_only"] == 0) : ?>
                            <?php if ($open_admin == "./mod/" . $mod['root'] . "/" . $mod['link'] . "") : ?>
                                <?php echo "<option selected value='./mod/" . $mod['root'] . "/" . $mod['link'] . "'>" . $mod["title"] . "</option>\n	"; ?>
                            <?php else : ?>
                                <?php echo "<option value='./mod/" . $mod['root'] . "/" . $mod['link'] . "'>" . $mod["title"] . "</option>\n	"; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select></th>
        </tr>
        <tr>
            <th width="60%"><?php echo($lang['ADMIN_DISPLAY_LOGIN_ADMINMODULE']); ?><?php echo help("first_displayed_module_admin"); ?></th>
            <th><select name="open_admin">
                    <option>------</option>
                    <?php if ($open_admin == "./views/admin.php") {
                        echo '<option selected value="./views/admin.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_ADMIN'] . '</option>';
                    } else {
                        echo '<option value="./views/admin.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_ADMIN'] . '</option>';
                    }

                    if ($open_admin == "./views/profile.php") {
                        echo '<option selected value="./views/profile.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_PROFILE'] . '</option>';
                    } else {
                        echo '<option value="./views/profile.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_PROFILE'] . '</option>';
                    }

                    if ($open_admin == "./views/home.php") {
                        echo '<option selected value="./views/home.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_ACCOUNT'] . '</option>';
                    } else {
                        echo '<option value="./views/home.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_ACCOUNT'] . '</option>';
                    }

                    if ($open_admin == "./views/galaxy.php") {
                        echo '<option selected value="./views/galaxy.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_GALAXY'] . '</option>';
                    } else {
                        echo '<option value="./views/galaxy.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_GALAXY'] . '</option>';
                    }

                    if ($open_admin == "./views/cartography.php") {
                        echo '<option selected value="./views/cartography.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_ALLY'] . '</option>';
                    } else {
                        echo '<option value="./views/cartography.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_ALLY'] . '</option>';
                    }

                    if ($open_admin == "./views/search.php") {
                        echo '<option selected value="./views/search.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_SEARCH'] . '</option>';
                    } else {
                        echo '<option value="./views/search.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_SEARCH'] . '</option>';
                    }

                    if ($open_admin == "./views/ranking.php") {
                        echo '<option selected value="./views/ranking.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_RANKINGS'] . '</option>';
                    } else {
                        echo '<option value="./views/ranking.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_RANKINGS'] . '</option>';
                    }

                    if ($open_admin == "./views/statistic.php") {
                        echo '<option selected value="./views/statistic.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_STATS'] . '</option>';
                    } else {
                        echo '<option value="./views/statistic.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_STATS'] . '</option>';
                    }
                    if ($open_admin == "./views/galaxy_obsolete.php") {
                        echo '<option selected value="./views/galaxy_obsolete.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_TOBEUPDATED'] . '</option>';
                    } else {
                        echo '<option value="./views/galaxy_obsolete.php">' . $lang['ADMIN_DISPLAY_LOGIN_MODULE_TOBEUPDATED'] . '</option>';
                    }
                    ?>
                    <!-- mod non admin (0) / admin (1)  -->
                    <?php foreach (array(0, 1) as $isadmin): ?>
                        <option>------</option>
                        <?php foreach ($tMods as $mod) : ?>
                            <?php if ($mod["admin_only"] == $isadmin) : ?>
                                <?php if ($open_admin == "./mod/" . $mod['root'] . "/" . $mod['link'] . "") : ?>
                                    <?php echo "<option selected value='./mod/" . $mod['root'] . "/" . $mod['link'] . "'>" . $mod["title"] . "</option>\n	"; ?>
                                <?php else : ?>
                                    <?php echo "<option value='./mod/" . $mod['root'] . "/" . $mod['link'] . "'>" . $mod["title"] . "</option>\n	"; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </select></th>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th colspan="2"><input type="submit" value="<?php echo($lang['ADMIN_DISPLAY_SUBMIT']); ?>">&nbsp;<input
                        type="reset" value="<?php echo($lang['ADMIN_DISPLAY_RESET']); ?>"></th>
        </tr>
    </table>
</form>
