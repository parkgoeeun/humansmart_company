<?php
	/*
	* Copyright (C) 2016 휴마트컴퍼니, Inc. All rights reserved.
	*/

	Class Authorization
	{

		function __construct()
		{
			// global $conn_;
		}

		function ApiAuth ($AccessKey)
		{
			global $conn_;

			if ($AccessKey) {

				/*
				* $AuthKey[0] - ClientID
				* $AuthKey[1] - SecretKey
				*/
				$AuthStr = base64_decode($AccessKey);
				$AuthKey = explode('##', $AuthStr);
				/**/

				if ($AuthKey[1] == 'f0e7531b76cce6ee59fee812ee550ff5a12vs39201123ascxaqwrtrser') {

					// 계정 유효 체크.
					$getInfoOfClient_q = mysqli_query($conn_, "SELECT `no` FROM `trost`.`mb_client` WHERE (`id` = '" . $AuthKey[0] . "') ORDER BY `no` DESC LIMIT 1");
					$getInfoOfClient = mysqli_fetch_array($getInfoOfClient_q);

					if ($getInfoOfClient) {

						$result = [
							"auth-status" => true,
							"ACCESS-TYPE" => true,
							"result" => "Y"
						];

					} else {

						$result = [
							"auth-status" => false,
							"ACCESS-TYPE" => "Not-Auth",
							"result" => "N",
							"message" => "잘못된 접근입니다, 다시 로그인 부탁드립니다."
						];

					}

				} else {

					$result = [
						"auth-status" => false,
						"ACCESS-TYPE" => "Not-Auth",
						"result" => "N",
						"message" => "잘못된 접근입니다, 다시 로그인 부탁드립니다."
					];

				}

			} else {

				$result = [
					"auth-status" => false,
					"ACCESS-TYPE" => "Not-Auth",
					"result" => "N",
					"message" => "잘못된 접근입니다, 다시 로그인 부탁드립니다."
				];

			}

			return $result;

		}

	}
