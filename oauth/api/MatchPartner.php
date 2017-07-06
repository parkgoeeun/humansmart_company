<?php
    /**
     * Copyright (c) 2017. 주식회사 휴마트컴퍼니. HumartCompany, Inc.
     */

    Class MatchPartner
    {
        // For Request-Response.
		public $partner1, $partner2, $partner3, $statusP1, $statusP2, $statusP3, $partnerGroupY, $partnerGroupN;

		function __construct()
		{
			// 상담사 정보.
			$this->partner1 = "";
			$this->partner2 = "";
			$this->partner3 = "";

			$this->partner = [];

			// 실시간 정보.
			$this->statusP1 = "";
			$this->statusP2 = "";
			$this->statusP3 = "";

			$this->partnerGroupY = "";
			$this->partnerGroupN = "";
		}

		function NormalMatch ($clientID, $paymentType)
		{
			global $conn_;

			if ($paymentType == 'pay') {
				$matchType = "((`status` = 'YY') || (`status` = 'YN') || (`status` = 'YC') || (`status` = 'C'))";
			} else if ($paymentType == 'free') {
				$matchType = "((`status` = 'YY') || (`status` = 'NY') || (`status` = 'CY') || (`status` = 'C'))";
			} else if ($paymentType == 'cop') {
				$matchType = "((`status` = 'YC') || (`status` = 'CY') || (`status` = 'CC') || (`status` = 'C'))";
			}

			if (($paymentType === 'pay') || ($paymentType === 'free')) {
				$getInfoOfClient_q = mysqli_query($conn_, "SELECT `name`, `sex`, `age`, `job`, `target`, `feel`, `characters`, `categorys` FROM `trost`.`mb_client` WHERE (`id` = '" . $clientID . "') ORDER BY `no` DESC LIMIT 1;");
				$getInfoOfClient = mysqli_fetch_array($getInfoOfClient_q);

				$getInfoOfPartner_q = mysqli_query($conn_, "SELECT `id`, `name`, `sex`, `mp_head_introduce` As `head_introduce`, `introduce`, `career`, `pic`, `work_mode`, `work_time`, `userStatus`, `recently_time`, `matchStyle`, `matchReview`, `mp_view_count` As `viewCount`, `mp_follow_count` As `followCount`, `matchCTarget` As `matchTarget`, `point` FROM `trost`.`mb_partner` WHERE " . $matchType . " ORDER BY `recently_time` ASC");

				while ($getInfoOfPartner = mysqli_fetch_array($getInfoOfPartner_q, MYSQLI_ASSOC))
				{
					$matchPartner[$getInfoOfPartner['id']] = $getInfoOfPartner;
					$partnerPoint[$getInfoOfPartner['id']] = $getInfoOfPartner['point'];
				}

				foreach ($matchPartner as $key => $value)
				{

					if ($getInfoOfClient['job'] != '') {

						$matchJobs = explode(',', $matchPartner[$key]['matchJob']);

						if (in_array($getInfoOfClient['job'], $matchJobs)) {
							$partnerPoint[$key] += 4;
						}

					}

					if ($getInfoOfClient['target'] != '') {

						$matchTargets = explode(',', $matchPartner[$key]['matchTarget']);

						if (in_array($getInfoOfClient['target'], $matchTargets)) {
							$partnerPoint[$key] += 4;
						}

					}

					if ($getInfoOfClient['feel'] != '') {

						$matchFeels = explode(',', $matchPartner[$key]['matchFeel']);
						$userFeels = explode(',', $getInfoOfClient['feel']);

						foreach ($userFeels as $userKey => $value) {
							if (in_array($value, $matchFeels)) {
								$partnerPoint[$key] += 4;
							}
						}
					}

					if ($getInfoOfClient['characters'] != '') {

						$matchCharacters = explode(',', $matchPartner[$key]['matchCharacters']);
						$userCharacters = explode(',', $getInfoOfClient['characters']);

						foreach ($userCharacters as $userKey => $value) {
							if (in_array($value, $matchCharacters)) {
								$partnerPoint[$key] += 4;
							}
						}

					}

					if ($paymentType == 'cop') {

						if ($getInfoOfClient['categorys'] != '') {

							$matchCategorys = explode(',', $matchPartner[$key]['matchCategorys']);
							$userCategorys = explode(',', $getInfoOfClient['categorys']);

							foreach ($userCategorys as $userKey => $value) {
								if (in_array($value, $matchCategorys)) {
									$partnerPoint[$key] += 6;
								}
							}

						}

					}

				}

				arsort($partnerPoint);

				(int) $i = 0;

				foreach ($partnerPoint as $key => $value)
				{

					if ($i == 0) {
						$partnerID_1 = $key;
					} else if ($i == 1) {
						$partnerID_2 = $key;
					} else if ($i == 2) {
						$partnerID_3 = $key;
						break;
					}

					$i++;

				}

				mysqli_query($conn_, "INSERT INTO `trost_counseling`.`matchPartner` (`type`, `payment`, `clientID`, `partner1`, `partner2`, `partner3`) VALUES ('unrealMatch', '" . $paymentType . "', '" . $clientID . "', '" . $partnerID_1 . "', '" . $partnerID_2 . "', '" . $partnerID_3 . "')");

				$r_getInfoOfPartner1 = mysqli_query($conn_, "SELECT `id`, `name`, `sex`, `mp_head_introduce` As `head_introduce`, `introduce`, `career`, `pic`, `work_mode`, `work_time`, `userStatus`, `recently_time`, `matchStyle`, `matchReview`, `mp_view_count` As `viewCount`, `mp_follow_count` As `followCount`, `matchCTarget` As `matchTarget`, `point` FROM `trost`.`mb_partner` WHERE (`id` = '" . $partnerID_1 . "') ORDER BY `no` DESC LIMIT 1;");
				$getInfoOfPartner1 = mysqli_fetch_array($r_getInfoOfPartner1, MYSQLI_ASSOC);

				$r_getInfoOfPartner2 = mysqli_query($conn_, "SELECT `id`, `name`, `sex`, `mp_head_introduce` As `head_introduce`, `introduce`, `career`, `pic`, `work_mode`, `work_time`, `userStatus`, `recently_time`, `matchStyle`, `matchReview`, `mp_view_count` As `viewCount`, `mp_follow_count` As `followCount`, `matchCTarget` As `matchTarget`, `point` FROM `trost`.`mb_partner` WHERE (`id` = '" . $partnerID_2 . "') ORDER BY `no` DESC LIMIT 1;");
				$getInfoOfPartner2 = mysqli_fetch_array($r_getInfoOfPartner2, MYSQLI_ASSOC);

				$r_getInfoOfPartner3 = mysqli_query($conn_, "SELECT `id`, `name`, `sex`, `mp_head_introduce` As `head_introduce`, `introduce`, `career`, `pic`, `work_mode`, `work_time`, `userStatus`, `recently_time`, `matchStyle`, `matchReview`, `mp_view_count` As `viewCount`, `mp_follow_count` As `followCount`, `matchCTarget` As `matchTarget`, `point` FROM `trost`.`mb_partner` WHERE (`id` = '" . $partnerID_3 . "') ORDER BY `no` DESC LIMIT 1;");
				$getInfoOfPartner3 = mysqli_fetch_array($r_getInfoOfPartner3, MYSQLI_ASSOC);

				$this->partner[] = $getInfoOfPartner1;
				$this->partner[] = $getInfoOfPartner2;
				$this->partner[] = $getInfoOfPartner3;
				
			} else {
				// 기업 내담자
				$getInfoOfCompany_q = mysqli_query($conn_, "SELECT `groupID` FROM `trost_company`.`clientInfo` WHERE (`trostID` = '" . $clientID . "') ORDER BY `no` DESC LIMIT 1;");
				$getInfoOfCompany = mysqli_fetch_array($getInfoOfCompany_q);

				if ($getInfoOfCompany['groupID'] === '농담') {
					$r_getInfoOfPartner = mysqli_query($conn_, "SELECT `id`, `name`, `sex`, `mp_head_introduce` As `head_introduce`, `introduce`, `career`, `pic`, `work_mode`, `work_time`, `userStatus`, `recently_time`, `matchStyle`, `matchReview`, `mp_view_count` As `viewCount`, `mp_follow_count` As `followCount`, `matchCTarget` As `matchTarget`, `point` FROM `trost`.`mb_partner` WHERE (`id` = 'in815816') ORDER BY `no` DESC LIMIT 1;");
					while ($getInfoOfPartner = mysqli_fetch_array($r_getInfoOfPartner, MYSQLI_ASSOC)) {
						$this->partner[] = $getInfoOfPartner;
					}
				} else if (($getInfoOfCompany['groupID'] === '근로') || ($getInfoOfCompany['groupID'] === '근로복지넷')) {
					$r_getInfoOfPartner = mysqli_query($conn_, "SELECT `id`, `name`, `sex`, `mp_head_introduce` As `head_introduce`, `introduce`, `career`, `pic`, `work_mode`, `work_time`, `userStatus`, `recently_time`, `matchStyle`, `matchReview`, `mp_view_count` As `viewCount`, `mp_follow_count` As `followCount`, `matchCTarget` As `matchTarget`, `point` FROM `trost`.`mb_partner` WHERE ((`name` = '김태훈') || (`name` = '김효린') || (`name` = '정현진')) ORDER BY `recently_time` DESC;");
					while ($getInfoOfPartner = mysqli_fetch_array($r_getInfoOfPartner, MYSQLI_ASSOC)) {
						$getInfoOfPartner['work_mode'] = 'texttime,facetime,voicetime';
						$this->partner[] = $getInfoOfPartner;
					}
				}
			}

		}

		function loadMatch ($clientID, $paymentType)
		{

			global $conn_;

			$getLoadInfoOfMatch_q = mysqli_query($conn_, "SELECT * FROM `trost_counseling`.`matchPartner` WHERE ((`clientID` = '" . $clientID . "') && (`payment` = '" . $paymentType . "') && (`type` = 'realMatch')) ORDER BY `no` DESC LIMIT 1;");
			$getLoadInfoOfMatch = mysqli_fetch_array($getLoadInfoOfMatch_q);

			if ($getLoadInfoOfMatch) {

				$r_getInfoOfPartner1 = mysqli_query($conn_, "SELECT `id`, `name`, `sex`, `mp_head_introduce` As `head_introduce`, `introduce`, `career`, `pic`, `work_mode`, `work_time`, `userStatus`, `recently_time`, `matchStyle`, `matchReview`, `mp_view_count` As `viewCount`, `mp_follow_count` As `followCount`, `matchCTarget` As `matchTarget`, `point` FROM `trost`.`mb_partner` WHERE (`id` = '" . $getLoadInfoOfMatch['partner1'] . "') ORDER BY `no` DESC LIMIT 1;");
				$getInfoOfPartner1 = mysqli_fetch_array($r_getInfoOfPartner1, MYSQLI_ASSOC);

				$r_getInfoOfPartner2 = mysqli_query($conn_, "SELECT `id`, `name`, `sex`, `mp_head_introduce` As `head_introduce`, `introduce`, `career`, `pic`, `work_mode`, `work_time`, `userStatus`, `recently_time`, `matchStyle`, `matchReview`, `mp_view_count` As `viewCount`, `mp_follow_count` As `followCount`, `matchCTarget` As `matchTarget`, `point` FROM `trost`.`mb_partner` WHERE (`id` = '" . $getLoadInfoOfMatch['partner2'] . "') ORDER BY `no` DESC LIMIT 1;");
				$getInfoOfPartner2 = mysqli_fetch_array($r_getInfoOfPartner2, MYSQLI_ASSOC);

				$r_getInfoOfPartner3 = mysqli_query($conn_, "SELECT `id`, `name`, `sex`, `mp_head_introduce` As `head_introduce`, `introduce`, `career`, `pic`, `work_mode`, `work_time`, `userStatus`, `recently_time`, `matchStyle`, `matchReview`, `mp_view_count` As `viewCount`, `mp_follow_count` As `followCount`, `matchCTarget` As `matchTarget`, `point` FROM `trost`.`mb_partner` WHERE (`id` = '" . $getLoadInfoOfMatch['partner3'] . "') ORDER BY `no` DESC LIMIT 1;");
				$getInfoOfPartner3 = mysqli_fetch_array($r_getInfoOfPartner3, MYSQLI_ASSOC);

				$this->partner[] = $getInfoOfPartner1;
				$this->partner[] = $getInfoOfPartner2;
				$this->partner[] = $getInfoOfPartner3;

			} else {

				if ($paymentType == 'pay') {
					$matchType = "((`status` = 'YY') || (`status` = 'YN') || (`status` = 'YC') || (`status` = 'C'))";
				} else if ($paymentType == 'free') {
					$matchType = "((`status` = 'YY') || (`status` = 'NY') || (`status` = 'CY') || (`status` = 'C'))";
				} else if ($paymentType == 'cop') {
					$matchType = "((`status` = 'YC') || (`status` = 'CY') || (`status` = 'CC') || (`status` = 'C'))";
				}

				if ($paymentType == 'cop') {

					$getInfoOfCompany_q = mysqli_query($conn_, "SELECT `groupID` FROM `trost_company`.`clientInfo` WHERE (`trostID` = '" . $clientID . "') ORDER BY `no` DESC LIMIT 1;");
					$getInfoOfCompany = mysqli_fetch_array($getInfoOfCompany_q);

					if ($getInfoOfCompany['groupID'] === '농담') {
						$r_getInfoOfPartner = mysqli_query($conn_, "SELECT `id`, `name`, `sex`, `mp_head_introduce` As `head_introduce`, `introduce`, `career`, `pic`, `work_mode`, `work_time`, `userStatus`, `recently_time`, `matchStyle`, `matchReview`, `mp_view_count` As `viewCount`, `mp_follow_count` As `followCount`, `matchCTarget` As `matchTarget`, `point` FROM `trost`.`mb_partner` WHERE (`id` = 'in815816') ORDER BY `no` DESC LIMIT 1;");
						while ($getInfoOfPartner = mysqli_fetch_array($r_getInfoOfPartner, MYSQLI_ASSOC)) {
							$this->partner[] = $getInfoOfPartner;
						}
					} else if (($getInfoOfCompany['groupID'] === '근로') || ($getInfoOfCompany['groupID'] === '근로복지넷')) {
						$r_getInfoOfPartner = mysqli_query($conn_, "SELECT `id`, `name`, `sex`, `mp_head_introduce` As `head_introduce`, `introduce`, `career`, `pic`, `work_mode`, `work_time`, `userStatus`, `recently_time`, `matchStyle`, `matchReview`, `mp_view_count` As `viewCount`, `mp_follow_count` As `followCount`, `matchCTarget` As `matchTarget`, `point` FROM `trost`.`mb_partner` WHERE ((`name` = '김태훈') || (`name` = '김효린') || (`name` = '정현진')) ORDER BY `recently_time` DESC;");
						while ($getInfoOfPartner = mysqli_fetch_array($r_getInfoOfPartner, MYSQLI_ASSOC)) {
							$getInfoOfPartner['work_mode'] = 'texttime,facetime,voicetime';
							$this->partner[] = $getInfoOfPartner;
						}
					}

				} else {

					$getInfoOfClient_q = mysqli_query($conn_, "SELECT `name`, `sex`, `age`, `job`, `target`, `feel`, `characters`, `categorys` FROM `trost`.`mb_client` WHERE (`id` = '" . $clientID . "') ORDER BY `no` DESC LIMIT 1;");
					$getInfoOfClient = mysqli_fetch_array($getInfoOfClient_q);

					$getInfoOfPartner_q = mysqli_query($conn_, "SELECT `id`, `matchJob`, `matchCTarget` As `matchTarget`, `matchFeel`, `matchCharacters`, `matchCategorys`, `point`, `matchStyle`, `matchReview`, `mp_view_count` As `viewCount`, `mp_follow_count` As `followCount`, `matchTarget` FROM `trost`.`mb_partner` WHERE " . $matchType . " ORDER BY `recently_time` DESC;");

					while ($getInfoOfPartner = mysqli_fetch_array($getInfoOfPartner_q, MYSQLI_ASSOC))
					{
						$matchPartner[$getInfoOfPartner['id']] = $getInfoOfPartner;
						$partnerPoint[$getInfoOfPartner['id']] = $getInfoOfPartner['point'];
					}

					foreach ($matchPartner as $key => $value)
					{

						if ($getInfoOfClient['job'] != '') {

							$matchJobs = explode(',', $matchPartner[$key]['matchJob']);

							if (in_array($getInfoOfClient['job'], $matchJobs)) {
								$partnerPoint[$key] += 4;
							}

						}

						if ($getInfoOfClient['target'] != '') {

							$matchTargets = explode(',', $matchPartner[$key]['matchTarget']);

							if (in_array($getInfoOfClient['target'], $matchTargets)) {
								$partnerPoint[$key] += 4;
							}

						}

						if ($getInfoOfClient['feel'] != '') {

							$matchFeels = explode(',', $matchPartner[$key]['matchFeel']);
							$userFeels = explode(',', $getInfoOfClient['feel']);

							foreach ($userFeels as $userKey => $value) {
								if (in_array($value, $matchFeels)) {
									$partnerPoint[$key] += 4;
								}
							}
						}

						if ($getInfoOfClient['characters'] != '') {

							$matchCharacters = explode(',', $matchPartner[$key]['matchCharacters']);
							$userCharacters = explode(',', $getInfoOfClient['characters']);

							foreach ($userCharacters as $userKey => $value) {
								if (in_array($value, $matchCharacters)) {
									$partnerPoint[$key] += 4;
								}
							}

						}

						if ($paymentType == 'cop') {

							if ($getInfoOfClient['categorys'] != '') {

								$matchCategorys = explode(',', $matchPartner[$key]['matchCategorys']);
								$userCategorys = explode(',', $getInfoOfClient['categorys']);

								foreach ($userCategorys as $userKey => $value) {
									if (in_array($value, $matchCategorys)) {
										$partnerPoint[$key] += 6;
									}
								}

							}

						}

					}

					arsort($partnerPoint);

					$i = 0;

					foreach ($partnerPoint as $key => $value) {
						if ($i == 0) {
							$partnerID_1 = $key;
						} else if ($i == 1) {
							$partnerID_2 = $key;
						} else if ($i == 2) {
							$partnerID_3 = $key;
							break;
						}

						$i++;
					}

					$r_getInfoOfPartner1 = mysqli_query($conn_, "SELECT `id`, `name`, `sex`, `mp_head_introduce` As `head_introduce`, `introduce`, `career`, `pic`, `work_mode`, `work_time`, `userStatus`, `recently_time`, `matchStyle`, `matchReview`, `mp_view_count` As `viewCount`, `mp_follow_count` As `followCount`, `matchCTarget` As `matchTarget`, `point` FROM `trost`.`mb_partner` WHERE (`id` = '" . $partnerID_1 . "') ORDER BY `no` DESC LIMIT 1;");
					$getInfoOfPartner1 = mysqli_fetch_array($r_getInfoOfPartner1, MYSQLI_ASSOC);

					$r_getInfoOfPartner2 = mysqli_query($conn_, "SELECT `id`, `name`, `sex`, `mp_head_introduce` As `head_introduce`, `introduce`, `career`, `pic`, `work_mode`, `work_time`, `userStatus`, `recently_time`, `matchStyle`, `matchReview`, `mp_view_count` As `viewCount`, `mp_follow_count` As `followCount`, `matchCTarget` As `matchTarget`, `point` FROM `trost`.`mb_partner` WHERE (`id` = '" . $partnerID_2 . "') ORDER BY `no` DESC LIMIT 1;");
					$getInfoOfPartner2 = mysqli_fetch_array($r_getInfoOfPartner2, MYSQLI_ASSOC);

					$r_getInfoOfPartner3 = mysqli_query($conn_, "SELECT `id`, `name`, `sex`, `mp_head_introduce` As `head_introduce`, `introduce`, `career`, `pic`, `work_mode`, `work_time`, `userStatus`, `recently_time`, `matchStyle`, `matchReview`, `mp_view_count` As `viewCount`, `mp_follow_count` As `followCount`, `matchCTarget` As `matchTarget`, `point` FROM `trost`.`mb_partner` WHERE (`id` = '" . $partnerID_3 . "') ORDER BY `no` DESC LIMIT 1;");
					$getInfoOfPartner3 = mysqli_fetch_array($r_getInfoOfPartner3, MYSQLI_ASSOC);

					$this->partner[] = $getInfoOfPartner1;
					$this->partner[] = $getInfoOfPartner2;
					$this->partner[] = $getInfoOfPartner3;

				}

			}

		}

		function allMatch ($clientID, $paymentType)
        {
			global $conn_;

			if ($paymentType == 'pay') {
				$matchType = "((`status` = 'YY') || (`status` = 'YN') || (`status` = 'YC') || (`status` = 'C'))";
			} else if ($paymentType == 'free') {
				$matchType = "((`status` = 'YY') || (`status` = 'NY') || (`status` = 'CY') || (`status` = 'C'))";
			} else if ($paymentType == 'cop') {
				$matchType = "((`status` = 'YC') || (`status` = 'CY') || (`status` = 'CC') || (`status` = 'C'))";
			} else {
				$matchType = "((`status` = 'YY') || (`status` = 'YN') || (`status` = 'YC') || (`status` = 'C'))";
			}

			if ($paymentType === 'cop') {

                (array) $getInfoOfPartner = [];
                (array) $partnerPoint = [];
                (array) $matchPartner = [];

				$getInfoOfCompany_q = mysqli_query($conn_, "SELECT `groupID` FROM `trost_company`.`clientInfo` WHERE (`trostID` = '" . $clientID . "') ORDER BY `no` DESC LIMIT 1;");
				$getInfoOfCompany = mysqli_fetch_array($getInfoOfCompany_q);

				if ($getInfoOfCompany['groupID'] === '농담') {
					$r_getInfoOfPartner = mysqli_query($conn_, "SELECT `no`, `point`, `id`, `name`, `sex`, `mp_head_introduce` As `head_introduce`, `introduce`, `career`, `pic`, `work_mode`, `work_time`, `userStatus`, `recently_time`, `matchStyle`, `matchReview`, `mp_view_count` As `viewCount`, `mp_follow_count` As `followCount`, `matchCTarget` As `matchTarget`, `point`, `matchExtraCategorys` FROM `trost`.`mb_partner` WHERE (`id` = 'in815816') ORDER BY `no` DESC LIMIT 1;");
				} else if (($getInfoOfCompany['groupID'] === '근로') || ($getInfoOfCompany['groupID'] === '근로복지넷')) {
					$r_getInfoOfPartner = mysqli_query($conn_, "SELECT `no`, `point`, `id`, `name`, `sex`, `mp_head_introduce` As `head_introduce`, `introduce`, `career`, `pic`, `work_mode`, `work_time`, `userStatus`, `recently_time`, `matchStyle`, `matchReview`, `mp_view_count` As `viewCount`, `mp_follow_count` As `followCount`, `matchCTarget` As `matchTarget`, `point`, `matchExtraCategorys` FROM `trost`.`mb_partner` WHERE ((`name` = '김태훈') || (`name` = '김효린') || (`name` = '정현진')) ORDER BY `recently_time` DESC;");
				}

                while ($getInfoOfPartner = mysqli_fetch_array($r_getInfoOfPartner, MYSQLI_ASSOC))
                {
                    if ($getInfoOfCompany['groupID'] === '농담') {
                        $getInfoOfPartner['work_mode'] = "texttime";
                    } else if (($getInfoOfCompany['groupID'] === '근로') || ($getInfoOfCompany['groupID'] === '근로복지넷')) {
                        $getInfoOfPartner['work_mode'] = "voicetime,facetime";
                    }

                    $isFollowed_q = mysqli_query($conn_, "SELECT `id` FROM `trost_history`.`PartnerFollow` WHERE ((`pf_client_id` = '" . $clientID . "') && (`pf_partner_id` = '" . $getInfoOfPartner['id'] . "')) ORDER BY `id` DESC LIMIT 1;");
                    $isFollowed = mysqli_fetch_array($isFollowed_q);

                    if ($isFollowed) {
                        $getInfoOfPartner['isFollowed'] = 'Y';
                    } else {
                        $getInfoOfPartner['isFollowed'] = 'N';
                    }

                    $getInfoOfPartner['rePaymentUser'] = $getInfoOfPartner['no'];
                    $getInfoOfPartner['matchPoint'] = 0;
                    $partnerPoint[$getInfoOfPartner['id']] = 0;

                    if ($getInfoOfClient['mc_extra_categorys']) {

                        (array) $partnerCategorys = [];
                        (array) $clientCategorys = [];

                        (int) $cValue = 0;
                        (int) $pValue5 = 0;
                        (int) $pValue4 = 0;
                        (int) $pValue3 = 0;
                        (int) $pValue2 = 0;
                        (int) $pValue1 = 0;

                        $partnerCategorys = json_decode($getInfoOfPartner['matchExtraCategorys'], true);
                        $clientCategorys = explode(",", $getInfoOfClient['mc_extra_categorys']);

                        foreach ($clientCategorys As $cKey => $cValue)
                        {
                            foreach ($partnerCategorys['5'] As $pKey5 => $pValue5)
                            {
                                if ($cValue === $pValue5) {
                                    $partnerPoint[$getInfoOfPartner['id']] += 5;
                                    $getInfoOfPartner['matchPoint'] += 5;
                                }
                            }
                            foreach ($partnerCategorys['4'] As $pKey4 => $pValue4)
                            {
                                if ($cValue === $pValue4) {
                                    $partnerPoint[$getInfoOfPartner['id']] += 4;
                                    $getInfoOfPartner['matchPoint'] += 4;
                                }
                            }
                            foreach ($partnerCategorys['3'] As $pKey3 => $pValue3)
                            {
                                if ($cValue === $pValue3) {
                                    $partnerPoint[$getInfoOfPartner['id']] += 3;
                                    $getInfoOfPartner['matchPoint'] += 3;
                                }
                            }
                            foreach ($partnerCategorys['2'] As $pKey2 => $pValue2)
                            {
                                if ($cValue === $pValue2) {
                                    $partnerPoint[$getInfoOfPartner['id']] += 2;
                                    $getInfoOfPartner['matchPoint'] += 2;
                                }
                            }
                            foreach ($partnerCategorys['1'] As $pKey1 => $pValue1)
                            {
                                if ($cValue === $pValue1) {
                                    $partnerPoint[$getInfoOfPartner['id']] += 1;
                                    $getInfoOfPartner['matchPoint'] += 1;
                                }
                            }

                        }

                    }

                    $partnerPoint[$getInfoOfPartner['id']] = $getInfoOfPartner['matchPoint'];
                    $matchPartner[$getInfoOfPartner['id']] = $getInfoOfPartner;
                }

                arsort($partnerPoint);

                foreach ($partnerPoint as $key => $value)
                {
                    $this->partner[] = $matchPartner[$key];
                }
                /**/

			} else {

                (array) $getInfoOfPartnerY = [];
                (array) $partnerPointY = [];
                (array) $matchPartnerY = [];
                (array) $getInfoOfPartnerN = [];
                (array) $partnerPointN = [];
                (array) $matchPartnerN = [];

                /*
                 * 고민 키워드 매칭
                 */
                $getInfoOfClient_q = mysqli_query($conn_, "SELECT `mc_extra_categorys` FROM `trost`.`mb_client` WHERE (`id` = '" . $clientID . "') ORDER BY `no` DESC LIMIT 1;");
                $getInfoOfClient = mysqli_fetch_array($getInfoOfClient_q);
                /**/

			    /*
			     * 상담사 정보 저장
			     */
				$getInfoOfPartnerY_q = mysqli_query($conn_, "SELECT `no`, `point`, `id`, `name`, `sex`, `mp_head_introduce` As `head_introduce`, `introduce`, `career`, `pic`, `work_mode`, `work_time`, `userStatus`, `recently_time`, `matchStyle`, `matchReview`, `mp_view_count` As `viewCount`, `mp_follow_count` As `followCount`, `matchCTarget` As `matchTarget`, `point`, `matchExtraCategorys` FROM `trost`.`mb_partner` WHERE (" . $matchType . " && (`userStatus` = 'Y')) ORDER BY `recently_time` DESC;");

				while ($getInfoOfPartnerY = mysqli_fetch_array($getInfoOfPartnerY_q, MYSQLI_ASSOC))
                {

				    $isFollowed_q = mysqli_query($conn_, "SELECT `id` FROM `trost_history`.`PartnerFollow` WHERE ((`pf_client_id` = '" . $clientID . "') && (`pf_partner_id` = '" . $getInfoOfPartnerY['id'] . "')) ORDER BY `id` DESC LIMIT 1;");
				    $isFollowed = mysqli_fetch_array($isFollowed_q);

				    if ($isFollowed) {
				        $getInfoOfPartnerY['isFollowed'] = 'Y';
                    } else {
                        $getInfoOfPartnerY['isFollowed'] = 'N';
                    }

                    $getInfoOfPartnerY['rePaymentUser'] = $getInfoOfPartnerY['no'];
				    $getInfoOfPartnerY['matchPoint'] = 0;
                    $partnerPointY[$getInfoOfPartnerY['id']] = 0;

				    if ($getInfoOfClient['mc_extra_categorys']) {

                        (array) $partnerCategorys = [];
                        (array) $clientCategorys = [];

                        (int) $cValue = 0;
                        (int) $pValue5 = 0;
                        (int) $pValue4 = 0;
                        (int) $pValue3 = 0;
                        (int) $pValue2 = 0;
                        (int) $pValue1 = 0;

                        $partnerCategorys = json_decode($getInfoOfPartnerY['matchExtraCategorys'], true);
                        $clientCategorys = explode(",", $getInfoOfClient['mc_extra_categorys']);

                        foreach ($clientCategorys As $cKey => $cValue)
                        {
                            foreach ($partnerCategorys['5'] As $pKey5 => $pValue5)
                            {
                                if ($cValue === $pValue5) {
                                    $partnerPointY[$getInfoOfPartnerY['id']] += 5;
                                    $getInfoOfPartnerY['matchPoint'] += 5;
                                }
                            }
                            foreach ($partnerCategorys['4'] As $pKey4 => $pValue4)
                            {
                                if ($cValue === $pValue4) {
                                    $partnerPointY[$getInfoOfPartnerY['id']] += 4;
                                    $getInfoOfPartnerY['matchPoint'] += 4;
                                }
                            }
                            foreach ($partnerCategorys['3'] As $pKey3 => $pValue3)
                            {
                                if ($cValue === $pValue3) {
                                    $partnerPointY[$getInfoOfPartnerY['id']] += 3;
                                    $getInfoOfPartnerY['matchPoint'] += 3;
                                }
                            }
                            foreach ($partnerCategorys['2'] As $pKey2 => $pValue2)
                            {
                                if ($cValue === $pValue2) {
                                    $partnerPointY[$getInfoOfPartnerY['id']] += 2;
                                    $getInfoOfPartnerY['matchPoint'] += 2;
                                }
                            }
                            foreach ($partnerCategorys['1'] As $pKey1 => $pValue1)
                            {
                                if ($cValue === $pValue1) {
                                    $partnerPointY[$getInfoOfPartnerY['id']] += 1;
                                    $getInfoOfPartnerY['matchPoint'] += 1;
                                }
                            }

                        }

                    }

                    $partnerPointY[$getInfoOfPartnerY['id']] = $getInfoOfPartnerY['matchPoint'];
                    $matchPartnerY[$getInfoOfPartnerY['id']] = $getInfoOfPartnerY;
				}

                arsort($partnerPointY);

                foreach ($partnerPointY as $key => $value)
                {
                    $this->partner[] = $matchPartnerY[$key];
                }

				$getInfoOfPartnerN_q = mysqli_query($conn_, "SELECT `no`, `point`, `id`, `name`, `sex`, `mp_head_introduce` As `head_introduce`, `introduce`, `career`, `pic`, `work_mode`, `work_time`, `userStatus`, `recently_time`, `matchStyle`, `matchReview`, `mp_view_count` As `viewCount`, `mp_follow_count` As `followCount`, `matchCTarget` As `matchTarget`, `point`, `matchExtraCategorys` FROM `trost`.`mb_partner` WHERE (" . $matchType . " && (`userStatus` = 'N')) ORDER BY `recently_time` DESC;");

				while ($getInfoOfPartnerN = mysqli_fetch_array($getInfoOfPartnerN_q, MYSQLI_ASSOC))
                {
				    $isFollowed_q = mysqli_query($conn_, "SELECT `id` FROM `trost_history`.`PartnerFollow` WHERE ((`pf_client_id` = '" . $clientID . "') && (`pf_partner_id` = '" . $getInfoOfPartnerN['id'] . "')) ORDER BY `id` DESC LIMIT 1;");
				    $isFollowed = mysqli_fetch_array($isFollowed_q);

				    if ($isFollowed) {
				        $getInfoOfPartnerN['isFollowed'] = 'Y';
                    } else {
                        $getInfoOfPartnerN['isFollowed'] = 'N';
                    }

                    $getInfoOfPartnerN['rePaymentUser'] = $getInfoOfPartnerN['no'];
                    $getInfoOfPartnerN['matchPoint'] = 0;
                    $partnerPointN[$getInfoOfPartnerN['id']] = 0;

                    if ($getInfoOfClient['mc_extra_categorys']) {

                        (array) $partnerCategorys = [];
                        (array) $clientCategorys = [];

                        (int) $cValue = 0;
                        (int) $pValue5 = 0;
                        (int) $pValue4 = 0;
                        (int) $pValue3 = 0;
                        (int) $pValue2 = 0;
                        (int) $pValue1 = 0;

                        $partnerCategorys = json_decode($getInfoOfPartnerN['matchExtraCategorys'], true);
                        $clientCategorys = explode(",", $getInfoOfClient['mc_extra_categorys']);

                        foreach ($clientCategorys As $cKey => $cValue)
                        {
                            foreach ($partnerCategorys['5'] As $pKey5 => $pValue5)
                            {
                                if ($cValue === $pValue5) {
                                    $partnerPointN[$getInfoOfPartnerN['id']] += 5;
                                    $getInfoOfPartnerN['matchPoint'] += 5;
                                }
                            }
                            foreach ($partnerCategorys['4'] As $pKey4 => $pValue4)
                            {
                                if ($cValue === $pValue4) {
                                    $partnerPointN[$getInfoOfPartnerN['id']] += 4;
                                    $getInfoOfPartnerN['matchPoint'] += 4;
                                }
                            }
                            foreach ($partnerCategorys['3'] As $pKey3 => $pValue3)
                            {
                                if ($cValue === $pValue3) {
                                    $partnerPointN[$getInfoOfPartnerN['id']] += 3;
                                    $getInfoOfPartnerN['matchPoint'] += 3;
                                }
                            }
                            foreach ($partnerCategorys['2'] As $pKey2 => $pValue2)
                            {
                                if ($cValue === $pValue2) {
                                    $partnerPointN[$getInfoOfPartnerN['id']] += 2;
                                    $getInfoOfPartnerN['matchPoint'] += 2;
                                }
                            }
                            foreach ($partnerCategorys['1'] As $pKey1 => $pValue1)
                            {
                                if ($cValue === $pValue1) {
                                    $partnerPointN[$getInfoOfPartnerN['id']] += 1;
                                    $getInfoOfPartnerN['matchPoint'] += 1;
                                }
                            }

                        }

                    }

                    $partnerPointN[$getInfoOfPartnerN['id']] = $getInfoOfPartnerN['matchPoint'];
                    $matchPartnerN[$getInfoOfPartnerN['id']] = $getInfoOfPartnerN;
				}

                arsort($partnerPointN);

                foreach ($partnerPointN as $key => $value)
                {
                    $this->partner[] = $matchPartnerN[$key];
                }
				/**/

			}

		}

		function allLowMatch ($paymentType) {

			global $conn_;

			if ($paymentType == 'pay') {
				$matchType = "((`status` = 'YY') || (`status` = 'YN') || (`status` = 'YC') || (`status` = 'C'))";
			} else if ($paymentType == 'free') {
				$matchType = "((`status` = 'YY') || (`status` = 'NY') || (`status` = 'CY') || (`status` = 'C'))";
			} else if ($paymentType == 'cop') {
				$matchType = "((`status` = 'YC') || (`status` = 'CY') || (`status` = 'CC') || (`status` = 'C'))";
			} else {
				$matchType = "((`status` = 'YY') || (`status` = 'YN') || (`status` = 'YC') || (`status` = 'C'))";
			}

			if ($paymentType === 'cop') {
				$getInfoOfCompany_q = mysqli_query($conn_, "SELECT `groupID` FROM `trost_company`.`clientInfo` WHERE (`trostID` = '" . $clientID . "') ORDER BY `no` DESC LIMIT 1;");
				$getInfoOfCompany = mysqli_fetch_array($getInfoOfCompany_q);

				if ($getInfoOfCompany['groupID'] === '농담') {
					$r_getInfoOfPartner = mysqli_query($conn_, "SELECT `id`, `name`, `sex`, `mp_head_introduce` As `head_introduce`, `introduce`, `career`, `pic`, `work_mode`, `work_time`, `userStatus`, `recently_time`, `matchStyle`, `matchReview`, `mp_view_count` As `viewCount`, `mp_follow_count` As `followCount`, `matchCTarget` As `matchTarget`, `point` FROM `trost`.`mb_partner` WHERE (`id` = 'in815816') ORDER BY `no` DESC LIMIT 1;");
					while ($getInfoOfPartner = mysqli_fetch_array($r_getInfoOfPartner, MYSQLI_ASSOC)) {
						$this->partner[] = $getInfoOfPartner;
					}
				} else if (($getInfoOfCompany['groupID'] === '근로') || ($getInfoOfCompany['groupID'] === '근로복지넷')) {
					$r_getInfoOfPartner = mysqli_query($conn_, "SELECT `id`, `name`, `sex`, `mp_head_introduce` As `head_introduce`, `introduce`, `career`, `pic`, `work_mode`, `work_time`, `userStatus`, `recently_time`, `matchStyle`, `matchReview`, `mp_view_count` As `viewCount`, `mp_follow_count` As `followCount`, `matchCTarget` As `matchTarget`, `point` FROM `trost`.`mb_partner` WHERE ((`name` = '김태훈') || (`name` = '김효린') || (`name` = '정현진')) ORDER BY `no` DESC;");
					while ($getInfoOfPartner = mysqli_fetch_array($r_getInfoOfPartner, MYSQLI_ASSOC)) {
						$getInfoOfPartner['work_mode'] = 'texttime,facetime,voicetime';
						$this->partner[] = $getInfoOfPartner;
					}
				}
			} else {
				$getInfoOfPartner_q = mysqli_query($conn_, "SELECT `no`, `id`, `name`, `sex`, `mp_head_introduce` As `head_introduce`, `introduce`, `career`, `pic`, `work_mode`, `work_time`, `userStatus`, `recently_time`, `matchStyle`, `matchReview`, `mp_view_count` As `viewCount`, `mp_follow_count` As `followCount`, `matchCTarget` As `matchTarget`, `point` FROM `trost`.`mb_partner` WHERE (" . $matchType . " && (`userStatus` = 'Y')) ORDER BY `name` ASC");

				while ($getInfoOfPartner = mysqli_fetch_array($getInfoOfPartner_q, MYSQLI_ASSOC)) {

					$getPointOfPartner_q = mysqli_query($conn_, "SELECT count(*) FROM `trost_counseling`.`counseling_log` WHERE ((`payment` = 'Y') && (`partner` = '" . $getInfoOfPartner['id'] . "'))");
					$getPointOfPartner = mysqli_fetch_array($getPointOfPartner_q);

					$isFollowed_q = mysqli_query($conn_, "SELECT `id` FROM `trost_history`.`PartnerFollow` WHERE ((`pf_client_id` = '" . $clientID . "') && (`pf_partner_id` = '" . $getInfoOfPartner['id'] . "')) ORDER BY `id` DESC LIMIT 1;");
                    $isFollowed = mysqli_fetch_array($isFollowed_q);

                    if ($isFollowed) {
                        $getInfoOfPartner['isFollowed'] = 'Y';
                    } else {
                        $getInfoOfPartner['isFollowed'] = 'N';
                    }

                    $getInfoOfPartner['rePaymentUser'] = $getInfoOfPartner['no'];

					$matchPartner[$getInfoOfPartner['id']] = $getInfoOfPartner;
					$partnerPoint[$getInfoOfPartner['id']] = $getPointOfPartner['0'];
				}

				$getInfoOfPartner_q = mysqli_query($conn_, "SELECT `no`, `id`, `name`, `sex`, `mp_head_introduce` As `head_introduce`, `introduce`, `career`, `pic`, `work_mode`, `work_time`, `userStatus`, `recently_time`, `matchStyle`, `matchReview`, `mp_view_count` As `viewCount`, `mp_follow_count` As `followCount`, `matchCTarget` As `matchTarget`, `point` FROM `trost`.`mb_partner` WHERE (" . $matchType . " && (`userStatus` = 'N')) ORDER BY `name` ASC");

				while ($getInfoOfPartner = mysqli_fetch_array($getInfoOfPartner_q, MYSQLI_ASSOC)) {

					$getPointOfPartner_q = mysqli_query($conn_, "SELECT count(*) FROM `trost_counseling`.`counseling_log` WHERE ((`payment` = 'Y') && (`partner` = '" . $getInfoOfPartner['id'] . "'))");
					$getPointOfPartner = mysqli_fetch_array($getPointOfPartner_q);

                    $isFollowed_q = mysqli_query($conn_, "SELECT `id` FROM `trost_history`.`PartnerFollow` WHERE ((`pf_client_id` = '" . $clientID . "') && (`pf_partner_id` = '" . $getInfoOfPartner['id'] . "')) ORDER BY `id` DESC LIMIT 1;");
                    $isFollowed = mysqli_fetch_array($isFollowed_q);

                    if ($isFollowed) {
                        $getInfoOfPartner['isFollowed'] = 'Y';
                    } else {
                        $getInfoOfPartner['isFollowed'] = 'N';
                    }

                    $getInfoOfPartner['rePaymentUser'] = $getInfoOfPartner['no'];

					$matchPartner[$getInfoOfPartner['id']] = $getInfoOfPartner;
					$partnerPoint[$getInfoOfPartner['id']] = $getPointOfPartner['0'];
				}

				asort($partnerPoint);

				foreach ($partnerPoint as $key => $value) {
					$this->partner[] = $matchPartner[$key];
				}
			}

		}

		function recommandPartner ($clientID, $partners)
		{

			global $conn_;

			(string) $toDate = date("Y-m-d A h:i");

			$getInfoOfClient_q = mysqli_query($conn_, "SELECT `no`, (SELECT `name` FROM `trost`.`mb_client` WHERE (`id` = '" . $clientID . "') ORDER BY `no` DESC LIMIT 1) As `clientName`, (SELECT `checkRecommend` FROM `trost`.`mb_client` WHERE (`id` = '" . $clientID . "') ORDER BY `no` DESC LIMIT 1) As `clientCheckRecommend` FROM `trost_counseling`.`counseling_log` WHERE (`client` = '" . $clientID . "') ORDER BY `no` DESC LIMIT 1;");
			$getInfoOfClient = mysqli_fetch_array($getInfoOfClient_q);

			if ($getInfoOfClient) {

				if ($getInfoOfClient['clientCheckRecommend'] === 'Y') {

					$getPartnerID_q = mysqli_query($conn_, "SELECT `partner1`, `partner2`, `partner3` FROM `trost_counseling`.`matchPartner` WHERE ((`payment` = 'pay') && (`clientID` = '" . $clientID . "') && (`type` = 'realMatch')) ORDER BY `no` DESC LIMIT 1;");
					$getPartnerID = mysqli_fetch_array($getPartnerID_q);

					$getOriginalPartners = [
						$getPartnerID['partner1'],
						$getPartnerID['partner2'],
						$getPartnerID['partner3'],
					];

					(int) $j = 0;

					// $countPartner = count($partners) - 1;

					// if ($countPartner == '2') {
					//
					// } else if ($countPartner == '1') {
					//
					// } else if ($countPartner == '0') {
					//
					// }

					for ((int) $i = 0; $i<3; $i++) {

						if (!empty($partners[$i])){
							// if (!in_array($partners[$i], $getOriginalPartners)) {

								(int) $b = 0;

								for ((int) $a = (2 - $i); $a>0; $a--) {
									$b = $a - 1;
									$getOriginalPartners[$a] = $getOriginalPartners[$b];
								}

								$getOriginalPartners[$j] = $partners[$i];

							// } else {
							// 	$key = array_search($partners[$i], $getOriginalPartners);
							//
							// 	if ($key == '2') {
							//
							// 		(int) $b = 0;
							//
							// 		for ((int) $a = 2; $a>0; $a--) {
							// 			$b = $a - 1;
							// 			$getOriginalPartners[$a] = $getOriginalPartners[$b];
							// 		}
							//
							// 		$getOriginalPartners[$j] = $partners[$i];
							//
							// 	}
							// }
						}

						$j++;
					}

					mysqli_query($conn_, "UPDATE `trost_counseling`.`matchPartner` SET `partner1` = '" . $getOriginalPartners[0] . "' WHERE ((`clientID` = '" . $clientID . "') && (`payment` = 'pay') && (`type` = 'realMatch')) ORDER BY `no` DESC LIMIT 1;");
					mysqli_query($conn_, "UPDATE `trost_counseling`.`matchPartner` SET `partner2` = '" . $getOriginalPartners[1] . "' WHERE ((`clientID` = '" . $clientID . "') && (`payment` = 'pay') && (`type` = 'realMatch')) ORDER BY `no` DESC LIMIT 1;");
					mysqli_query($conn_, "UPDATE `trost_counseling`.`matchPartner` SET `partner3` = '" . $getOriginalPartners[2] . "' WHERE ((`clientID` = '" . $clientID . "') && (`payment` = 'pay') && (`type` = 'realMatch')) ORDER BY `no` DESC LIMIT 1;");

							// $i++;
						// }
						// else {
						// 	$i++;
						// }
					// }

					// }
					// else {
					//
					// 	if (!empty($partners[0])) {
					// 		mysqli_query($conn_, "UPDATE `trost_counseling`.`matchPartner` SET `partner1` = '" . $partners[0] . "' WHERE ((`clientID` = '" . $clientID . "') && (`payment` = 'pay') && (`type` = 'realMatch')) ORDER BY `no` DESC LIMIT 1;");
					// 	}
					//
					// 	if (!empty($partners[1])) {
					// 		mysqli_query($conn_, "UPDATE `trost_counseling`.`matchPartner` SET `partner2` = '" . $partners[1] . "' WHERE ((`clientID` = '" . $clientID . "') && (`payment` = 'pay') && (`type` = 'realMatch')) ORDER BY `no` DESC LIMIT 1;");
					// 	}
					//
					// 	if (!empty($partners[2])) {
					// 		mysqli_query($conn_, "UPDATE `trost_counseling`.`matchPartner` SET `partner3` = '" . $partners[2] . "' WHERE ((`clientID` = '" . $clientID . "') && (`payment` = 'pay') && (`type` = 'realMatch')) ORDER BY `no` DESC LIMIT 1;");
					// 	}
					//
					// }

				} else {

					mysqli_query($conn_, "UPDATE `trost`.`mb_client` SET `checkRecommend` = 'Y' WHERE (`id` = '" . $clientID . "') ORDER BY `no` DESC LIMIT 1;");

					// 시스템 메세지 작성.
					$getNumberOfRecentlyNo_q = mysqli_query($conn_, "SELECT `no` FROM `trost_counseling`.`log_counseling` WHERE (`no_log` = '" . $getInfoOfClient['no'] . "') ORDER BY `no` DESC LIMIT 1;");
					$getNumberOfRecentlyNo = mysqli_fetch_array($getNumberOfRecentlyNo_q);

					(int) $recently_no = $getNumberOfRecentlyNo['no'] + 1;
					mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $recently_no . "', '" . $getInfoOfClient['no'] . "', '" . $toDate . "', '$getInfoOfClient[name] 님의 상담사 추천이 완료되었습니다. 추천된 상담사는 상담사 선택 버튼을 통해 확인하실 수 있습니다.\n트로스트 웹을 이용하고 계실 경우 결제하기 버튼을 통해 확인하실 수 있습니다.', 'trost', 'mobile')");

					// 푸시 발송.
					$reservationPush = New Push("cordpartner01", $clientID);
					$reservationPush->reservationPushForClient($getInfoOfClient['no'], $recently_no, "$getInfoOfClient[name] 님의 상담사 추천이 완료되었습니다.", "$getInfoOfClient[name] 님의 상담사 추천이 완료되었습니다.", "");

					// 상담사 추천 작성.
					mysqli_query($conn_, "INSERT INTO `trost_counseling`.`matchPartner` (`type`, `payment`, `clientID`, `partner1`, `partner2`, `partner3`) VALUES ('realMatch', 'pay', '" . $clientID . "', '" . $partnrs[0] . "', '" . $partnrs[1] . "', '" . $partnrs[2] . "')");
					// mysqli_query($conn_, "INSERT INTO `trost_counseling`.`matchPartner` (`type`, `payment`, `clientID`, `partner1`, `partner2`, `partner3`) VALUES ('realMatch', 'free', '" . $clientID . "', '" . $partnrs[0] . "', '" . $partnrs[1] . "', '" . $partnrs[2] . "')");

				}

			}

		}

		function getInfoOfPartner ($clientID, $partnerID)
		{
            global $conn_;

            $r_getInfoOfPartner = mysqli_query($conn_, "SELECT `id`, `name`, `sex`, `mp_head_introduce` As `head_introduce`, `introduce`, `career`, `pic`, `work_mode`, `work_time`, `userStatus`, `recently_time`, `matchCTarget` As `matchTarget`, `matchStyle`, `matchReview`, `mp_view_count` As `viewCount`, `mp_follow_count` As `followCount`, `point` FROM `trost`.`mb_partner` WHERE (`id` = '" . $partnerID . "') ORDER BY `no` DESC LIMIT 1;");
            $getInfoOfPartner = mysqli_fetch_array($r_getInfoOfPartner, MYSQLI_ASSOC);

            if ($getInfoOfPartner) {

                (string) $toDate = date("Y-m-d");

                /*
                 * 상담사 조회 관리.
                 */
                $newView = $getInfoOfPartner['viewCount'] + 1;
                mysqli_query($conn_, "UPDATE `trost`.`mb_partner` SET `mp_view_count` = '" . $newView . "' WHERE (`id` = '" . $partnerID . "') ORDER BY `no` DESC LIMIT 1;");
                /**/

                $getReview_q = mysqli_query($conn_, "SELECT `date`, `id`, `content` FROM `trost`.`review` WHERE ((`type` = 'AfterFinish') && (`partnerID` = '" . $partnerID . "') && (`status` = 'Y')) ORDER BY `no` DESC;");
                $getReview = mysqli_fetch_array($getReview_q, MYSQLI_ASSOC);

                $getInfoOfPartner['recentlyReview'] = $getReview;
                $getInfoOfPartner['viewCount'] = ($getInfoOfPartner['viewCount'] + 1);
                $getInfoOfPartner['followCount'] = $getInfoOfPartner['followCount'];
                $getInfoOfPartner['isFollowed'] = 'N';

                if ($getInfoOfPartner['userStatus'] === 'Y') {
                    $getInfoOfPartner['matchReview'] = '최초 응답이 빠른 상담사입니다.';
                }

                /*
                 * 상담사 찜.
                 */
                $r_isFollowPartner = mysqli_query($conn_, "SELECT `id` FROM `trost_history`.`PartnerFollow` WHERE ((`pf_client_id` = '" . $clientID . "') && (`pf_partner_id` = '" . $partnerID . "')) ORDER BY `id` DESC LIMIT 1;");
                $isFollowPartner = mysqli_fetch_array($r_isFollowPartner);

                if ($isFollowPartner) {
                    $getInfoOfPartner['isFollowed'] = 'Y';
                }
                /**/

                /*
                 * 상담사 결제 여부.
                 */
                $r_isPaymentStatus = mysqli_query($conn_, "SELECT `partner`, `paymethod` FROM `trost`.`payment` WHERE ((`buyer` = '" . $clientID . "') && (`date_t` >= '" . $toDate . "') && (`itemCount` != '0')) ORDER BY `no` DESC LIMIT 1;");
                $isPaymentStatus = mysqli_fetch_array($r_isPaymentStatus);

                if ($isPaymentStatus) {

                    $getInfoOfCounseling_q = mysqli_query($conn_, "SELECT `partner` FROM `trost_counseling`.`counseling_log` WHERE ((`client` = '" . $clientID . "') && (`payment` = 'Y')) ORDER BY `no` DESC LIMIT 1;");
                    $getInfoOfCounseling = mysqli_fetch_array($getInfoOfCounseling_q);

                    if ($getInfoOfCounseling) {

                        if ($getInfoOfCounseling['partner'] === 'cordpartner01') {
                            $getInfoOfPartner['isPaymentStatus'] = "N";
                        } else {
//                            if ($isPaymentStatus['paymethod'] === 'cop') {
//                                $getInfoOfPartner['isPaymentStatus'] = "N";
//                            } else {
                                $getInfoOfPartner['isPaymentStatus'] = "Y/" . $getInfoOfCounseling['partner'];
//                            }
                        }

                    } else {
                        $getInfoOfPartner['isPaymentStatus'] = "N";
                    }


                } else {
                    $getInfoOfPartner['isPaymentStatus'] = 'N';
                }
                /**/

                if (!$getInfoOfPartner['recentlyReview']) {

                    $getInfoOfPartner['recentlyReview'] = [
                        "date" => "2017-03-08 PM 05:26",
                        "id" => "1624814591180947",
                        "content" => "열심히 귀기울여주시고 문제의 핵심을 짚어주셔서 고민을 해결하는데 큰도움이 되었습니다! 감사합니다."
                    ];

                }

                $getInfoOfPartner['recentlyReview']['id'] = mb_substr($getInfoOfPartner['recentlyReview']['id'], 0, 4);
                $getInfoOfPartner['recentlyReview']['id'] = $getInfoOfPartner['recentlyReview']['id'] . "....";

                mysqli_query($conn_, "INSERT INTO `trost_history`.`PartnerViewHistory` (`pvh_client_id`, `pvh_partner_id`) VALUES ('" . $clientID . "', '" . $partnerID . "');");

                $this->partner = $getInfoOfPartner;

			}
		}

        function loadFollowPartner ($clientID)
        {
            global $conn_;

            (array) $isFollowPartner = [];

            $getFollowPartner_q = mysqli_query($conn_, "SELECT `pf_partner_id` FROM `trost_history`.`PartnerFollow` WHERE (`pf_client_id` = '" . $clientID . "') ORDER BY `id` DESC;");

            while ($getFollowPartner = mysqli_fetch_array($getFollowPartner_q))
            {
                $r_getInfoOfPartner = mysqli_query($conn_, "SELECT `id`, `name`, `sex`, `mp_head_introduce` As `head_introduce`, `introduce`, `career`, `pic`, `work_mode`, `work_time`, `userStatus`, `recently_time`, `matchCTarget` As `matchTarget`, `matchStyle`, `matchReview`, `mp_view_count` As `viewCount`, `mp_follow_count` As `followCount`, `point` FROM `trost`.`mb_partner` WHERE (`id` = '" . $getFollowPartner['pf_partner_id'] . "') ORDER BY `no` DESC LIMIT 1;");
                $getInfoOfPartner = mysqli_fetch_array($r_getInfoOfPartner, MYSQLI_ASSOC);

                if ($getInfoOfPartner) {
                    $isFollowPartner[] = $getInfoOfPartner;
                }
            }

            $this->partner = $isFollowPartner;

            return 0;
        }

	}