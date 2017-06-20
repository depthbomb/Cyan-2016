<?php

	require_once("../includes/initializer.php");

	if(isset($_GET["connect"]))
	{
		header("Location: steam://connect/66.150.188.17:27015");
	}
	elseif(isset($_GET["motd"]))
	{
		$smarty->assign("body_class","motd");
		$smarty->assign("classic_nav",false);
		$smarty->assign("slim_hero",false);
		$smarty->assign("top_ad",false);
		$smarty->assign("bot_ad",false);
		$smarty->display(ROOT."/templates/deploy/motd.tpl");
	}
	elseif(isset($_GET["adblock"]))
	{
		$smarty->assign("slim_hero",true);
		$smarty->assign("body_class","adblock has-navbars");
		$smarty->assign("hide_hero",false);
		$smarty->assign("top_ad",true);
		$smarty->assign("bot_ad",true);
		$smarty->display(ROOT."/templates/deploy/adblock.tpl");
	}
	elseif(isset($_GET["discord"]))
	{
		$smarty->assign("slim_hero",true);
		$smarty->assign("body_class","discord has-navbars");
		$smarty->assign("hide_hero",false);
		$smarty->assign("top_ad",true);
		$smarty->assign("bot_ad",true);
		$smarty->display(ROOT."/templates/deploy/discord.tpl");
	}
	elseif(isset($_GET["donate-success"]))
	{
		$smarty->assign("status_type","success");
		$smarty->assign("status_title","Thank you!");
		$smarty->assign("status_description","You have successfully donated to our server! Your donor perks will be active in 15 to 45 minutes. If your perks are still not working then please submit a ticket on the website.");
		$smarty->display(ROOT."/templates/deploy/status.page.tpl");
	}
	elseif(isset($_GET["donate-fail"]))
	{
		$smarty->assign("status_type","danger");
		$smarty->assign("status_title","Transaction not complete");
		$smarty->assign("status_description","It appears that your donation was not successful. This error might not be correct so please allow 15 to 45 minutes to see if your perks do activate. If not then you should attempt to cancel the transaction on your side and open a ticket on the site.");
		$smarty->display(ROOT."/templates/deploy/status.page.tpl");
	}
	else
	{
		if($is_banned)
		{
			header("Location: http://google.com/");
		}
		else
		{
			$smarty->assign("body_class","home has-navbars");
			$smarty->assign("classic_nav",false);
			$smarty->assign("slim_hero",false);
			$smarty->assign("top_ad",true);
			$smarty->assign("bot_ad",true);
			$smarty->assign("staff_array",$staff);

			$smarty->display(ROOT."/templates/deploy/index.tpl");
		}
	}

?>