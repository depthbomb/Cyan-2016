<?php

	function get_user_meta($steamid, $item, $variant = null)
	{
		$user_con = new mysqli("HOST","USERNAME","PASSWORD","CACHE DATABASE");
		$user_query = "SELECT $item FROM `user_info` WHERE `steamid`='$steamid'";
		$result = $user_con->query($user_query);

		if($result)
		{
			while($res = $result->fetch_assoc())
			{
				if($item === "rank")
				{
					if(!$variant)
					{
						if(is_numeric($res["rank"]))
						{
							if($res["rank"] == 4)
							{
								return '<span class="label label-default">Bot</span>';
							}
							if($res["rank"] == 3)
							{
								return '<span class="label label-danger">Admin</span>';
							}
							elseif($res["rank"] == 2)
							{
								return '<span class="label label-info">Moderator</span>';
							}
							elseif($res["rank"] == 1)
							{
								return '<span class="label label-success">Donor</span>';
							}
							else
							{
								return null;
							}
						}
						else
						{
							return '<span class="label label-danger">Invalid Argument</span>';
						}
					}
					else
					{
						return $res["rank"];
					}
				}
				else
				{
					return $res[$item];
				}
			}
		}
		else
		{
			$user_con->error;
		}

		$user_con->close();
	}

?>