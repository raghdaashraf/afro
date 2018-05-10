<!-- Begin Main Menu -->
<div class="ewMenu">
<?php $RootMenu = new cMenu(EW_MENUBAR_ID) ?>
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(19, $Language->MenuPhrase("19", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(20, $Language->MenuPhrase("20", "MenuText"), "cmsedit.php?id=6", 19, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(21, $Language->MenuPhrase("21", "MenuText"), "cmsedit.php?id=7", 19, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(5, $Language->MenuPhrase("5", "MenuText"), "sliderlist.php", 19, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(40, $Language->MenuPhrase("40", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(41, $Language->MenuPhrase("41", "MenuText"), "cmsedit.php?id=1", 40, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(42, $Language->MenuPhrase("42", "MenuText"), "cmsedit.php?id=2", 40, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(43, $Language->MenuPhrase("43", "MenuText"), "cmsedit.php?id=3", 40, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(44, $Language->MenuPhrase("44", "MenuText"), "cmsedit.php?id=4", 40, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(1, $Language->MenuPhrase("1", "MenuText"), "awardslist.php", 40, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(46, $Language->MenuPhrase("46", "MenuText"), "cmsedit.php?id=5", 40, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(10, $Language->MenuPhrase("10", "MenuText"), "mangment_teamlist.php", 40, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(47, $Language->MenuPhrase("47", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(7, $Language->MenuPhrase("7", "MenuText"), "serviceslist.php", 47, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(6, $Language->MenuPhrase("6", "MenuText"), "services_sublist.php?cmd=resetall", 47, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(3, $Language->MenuPhrase("3", "MenuText"), "success_storieslist.php?cmd=resetall", 47, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(48, $Language->MenuPhrase("48", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(8, $Language->MenuPhrase("8", "MenuText"), "partnerslist.php", 48, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(11, $Language->MenuPhrase("11", "MenuText"), "customerslist.php", 48, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(9, $Language->MenuPhrase("9", "MenuText"), "newslist.php", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(49, $Language->MenuPhrase("49", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(12, $Language->MenuPhrase("12", "MenuText"), "contact_uslist.php", 49, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(13, $Language->MenuPhrase("13", "MenuText"), "contact_maplist.php", 49, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(14, $Language->MenuPhrase("14", "MenuText"), "contact_formlist.php", 49, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(50, $Language->MenuPhrase("50", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(18, $Language->MenuPhrase("18", "MenuText"), "careerslist.php", 50, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(17, $Language->MenuPhrase("17", "MenuText"), "careers_formlist.php", 50, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(51, $Language->MenuPhrase("51", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(15, $Language->MenuPhrase("15", "MenuText"), "company_profilelist.php", 51, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(52, $Language->MenuPhrase("52", "MenuText"), "social_medialist.php", 51, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(53, $Language->MenuPhrase("53", "MenuText"), "pageslist.php", 51, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(-2, $Language->Phrase("ChangePwd"), "changepwd.php", -1, "", IsLoggedIn() && !IsSysAdmin());
$RootMenu->AddMenuItem(-1, $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
</div>
<!-- End Main Menu -->
