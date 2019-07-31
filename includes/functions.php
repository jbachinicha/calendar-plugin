<?php
if (!defined('ABSPATH')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	die();
}

/*WordPress Menus API.*/
function add_new_menu_items()
{
    //add a new menu item. This is a top level menu item i.e., this menu item can have sub menus
    add_menu_page(
        "Events Apps Calendar", //Required. Text in browser title bar when the page associated with this menu item is displayed.
        "Events Apps Calendar", //Required. Text to be displayed in the menu.
        "manage_options", //Required. The required capability of users to access this menu item.
        "events-options", //Required. A unique identifier to identify this menu item.
        "events_setting_page", //Optional. This callback outputs the content of the page associated with this menu item.
        "dashicons-smiley", //Optional. The URL to the menu item icon.
        100 //Optional. Position of the menu item in the menu.
    );
}
 
function events_setting_page(){
    ?>
        <div class="wrap">
        <!-- <span class="dashicons dashicons-smiley"></span> -->
        <h1>Events Apps Calendar</h1>
        
        <?php
            $active_tab = "welcome-options";
            if(isset($_GET["tab"]))
            {
                if($_GET["tab"] == "welcome-options")
                {
                    $active_tab = "welcome-options";
                }
                else if($_GET["tab"] == "shortcode-options")
                {
                    $active_tab = "shortcode-options";
                }
                else if($_GET["tab"] == "documentation-options")
                {
                    $active_tab = "documentation-options";
                }
                else
                {
                    $active_tab = "copyright-options";
                }
            }
        ?>

        <!-- wordpress provides the styling for tabs. -->
        <h2 class="nav-tab-wrapper">
                <!-- when tab buttons are clicked we jump back to the same page but with a new parameter that represents the clicked tab. accordingly we make it active -->
                <a href="?page=events-options&tab=welcome-options" class="nav-tab <?php if($active_tab == 'welcome-options'){echo 'nav-tab-active';} ?> "><?php _e('Welcome', 'sandbox'); ?></a>

                <a href="?page=events-options&tab=shortcode-options" class="nav-tab <?php if($active_tab == 'shortcode-options'){echo 'nav-tab-active';} ?>"><?php _e('Shortcode List', 'sandbox'); ?></a>

                <a href="?page=events-options&tab=documentation-options" class="nav-tab <?php if($active_tab == 'documentation-options'){echo 'nav-tab-active';} ?>"><?php _e('Documentation', 'sandbox'); ?></a>

                <a href="?page=events-options&tab=copyright-options" class="nav-tab <?php if($active_tab == 'copyright-options'){echo 'nav-tab-active';} ?>"><?php _e('Copyright', 'sandbox'); ?></a>
            </h2>

            <form method="post" action="options.php">
                <?php
               
                    settings_fields("header_section");
                   
                    do_settings_sections("events-options");
               
                    // submit_button();
                   
                ?>         
            </form>
        </div>
    <?php
}

//this action callback is triggered when wordpress is ready to add new items to menu.
add_action("admin_menu", "add_new_menu_items");

/*WordPress Settings API Demo*/
function display_options(){
    //here we display the sections and options in the settings page based on the active tab
    if(isset($_GET["tab"]))
    {
        if($_GET["tab"] == "welcome-options")
        {
            add_settings_section("header_section", "Welcome", "display_header_options_content", "events-options");
            add_settings_field("header_cal", "", "display_static_calendar", "events-options", "header_section");
            register_setting("header_section","header_cal");
        }
        elseif($_GET["tab"] == "shortcode-options")
        {
            add_settings_section("header_section", "Shortcode List", "display_header_shortcode_content", "events-options");
            add_settings_section( "shortcode_code", "", "display_shortcode_list", "events-options" );
        }
        elseif($_GET["tab"] == "documentation-options")
        {
            add_settings_section("header_section", "Documentation", "display_documentation_content", "events-options");
            add_settings_section( "documentation_code", "", "display_documentation_txt", "events-options" );
        }
        else
        {
            add_settings_section( "settings_code", "", "display_copyright_txt", "events-options" );
        }
    }
    else
    {
        add_settings_section("header_section", "Welcome", "display_header_options_content", "events-options");
        add_settings_field("header_cal", "", "display_static_calendar", "events-options", "header_section");
        register_setting("header_section","header_cal");
    }
    
}

function display_header_options_content(){echo "Welcome user!";}
function display_header_shortcode_content(){echo "Below are shortcodes used in this plugin.";}
function display_documentation_content(){echo "test.";}

/* Display functions */
function display_static_calendar(){
    ?>
        <div id="header_cal" name="header_cal">            
            <div class="calendar-wrapper">
                    <button id="btnPrev" type="button">Prev</button>
                    <button id="btnNext" type="button">Next</button>
                <div id="divCal"></div>
            </div>
        </div>
    <?php
}
function display_shortcode_list(){
    ?>
        <div id="shortcode_code">
            <ul class="bullet">
                <li><b>Display calendar:</b> [apps_cal_show_static_calendar]</li>
            </ul>
        </div>
    <?php
}

function display_documentation_txt(){
    ?>
        <div id="documentation_code">
            <ul class="bullet">
                <li><strong>» <a href="https://github.com/jbachinicha/calendar-plugin" target="_blank">GitHut</a></strong></li>
                <li><strong>» <a href="https://trello.com/b/6ORw2K8V/tutorial-board-start-here" target="_blank">Trello</a></strong></li>
            </ul>
        </div>
    <?php
}
function display_copyright_txt(){
    ?>
        <div id="settings_code">
            <h2>Events APPS Calendar</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tortor velit, fermentum in venenatis molestie, consequat non massa. Sed pharetra consectetur augue et dictum. Praesent fringilla purus eget elit commodo finibus. Suspendisse tempor urna lacus, et rhoncus nibh malesuada a. Nunc bibendum arcu sit amet leo cursus semper. Aenean tincidunt sapien et efficitur dignissim. Aliquam eu neque suscipit, fermentum mi non, pulvinar tortor. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis eleifend cursus ante, quis vestibulum massa consequat vel. </p>
            <p>Vivamus non ligula id elit cursus gravida. Quisque lectus nibh, maximus nec tempus vitae, pharetra id sem. Nunc efficitur non metus at molestie. Donec vitae dictum nisi. Donec at arcu lectus. Nunc egestas, risus sed sodales dapibus, nibh ipsum placerat ligula, eu facilisis massa lorem ac nisi. Morbi dictum varius dolor, et cursus nunc interdum id. </p>
            <p>In hac habitasse platea dictumst. Integer pulvinar commodo aliquet. Etiam sapien tortor, bibendum ac porttitor nec, lobortis luctus nisl. Cras lacinia vel turpis ut viverra. Pellentesque nec risus sed mi ultricies semper ut ut arcu. Quisque vitae fermentum lacus, lobortis semper arcu. Nullam fermentum aliquet odio. Donec in elit ornare, euismod tellus nec, volutpat sapien. Integer eu auctor urna. Etiam semper egestas lorem ac suscipit. Aenean venenatis rutrum augue porttitor eleifend. Mauris finibus suscipit dui, et pellentesque tellus interdum non. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut volutpat nisl a orci blandit, a porta quam accumsan.</p>
            <p>Vivamus felis dolor, posuere at nisl vitae, commodo molestie nisl. Mauris eu interdum dolor. Phasellus ultrices sit amet turpis in hendrerit. Nulla facilisi. Pellentesque semper tempus mattis. Vivamus nec bibendum ligula. Nullam facilisis sit amet libero vitae tincidunt. Suspendisse sem mi, maximus ac est ac, laoreet scelerisque tortor. Fusce euismod nisi in sodales rutrum. Curabitur porttitor lacus vel eros convallis, in pulvinar dolor consectetur. Fusce bibendum molestie mattis. Integer ut eros mattis, varius justo a, porta lectus. Pellentesque mollis ex lacus, id pulvinar odio scelerisque a. Pellentesque vestibulum, tellus eu ultrices interdum, ex odio vulputate lectus, quis euismod ligula lectus in libero. Suspendisse laoreet sem vitae porttitor elementum.</p>
            <p>Duis imperdiet ullamcorper tortor sit amet dignissim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed eu odio urna. In elementum tortor velit, vitae efficitur diam vehicula et. Cras ullamcorper magna et nisi imperdiet, et rhoncus quam pulvinar. Aenean quis elit lectus. Sed et ex ac sem egestas tincidunt. Donec egestas massa volutpat odio tempor, vitae ultricies est sagittis. Vivamus elementum, turpis a ornare fermentum, lorem dui commodo augue, a auctor ligula dolor id velit. Etiam vitae porta tortor. Pellentesque tincidunt ac nibh non luctus. Proin sed mi nisi. Ut bibendum a orci sed cursus. Morbi vel porta justo. Vivamus vehicula sagittis magna, eget porttitor est pellentesque a.</p>

            <strong>&copy; Copyright 2019</strong>
        </div>
    <?php
}
function display_logo_form_element(){
    ?>
        <input type="text" name="header_logo" id="header_logo" value="<?php echo get_option('header_logo'); ?>" />
    <?php
}
function display_settings_form_element(){
    ?>
        <input type="text" name="advertising_code" id="advertising_code" value="<?php echo get_option('advertising_code'); ?>" />
    <?php
}

add_action("admin_init", "display_options");