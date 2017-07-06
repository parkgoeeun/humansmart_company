<?php

	Class traingleLove
	{

		// for Request
		public $A, $B, $C, $D;

		// for Response
		public $challenge, $content, $title, $comment, $loverSex;
		public $loveMessage, $coupleLoveContent, $detailFriendly, $detailPassion, $detailCommitment;

		// for Response
		// public $loveSize, $loveMatch, $lovePoint, $detailFriendly, $detailPassion, $detailCommitment

		public $shareMessage1, $shareMessage2, $shareMessage3, $shareImage, $traingleImage;

		public function __construct($friendly, $passion, $commitment, $sex) {

			$this->A = round($friendly/15, 1);
			$this->B = round($passion/15, 1);
			$this->C = round($commitment/15, 1);

			$makeAverage = ((($this->A*$this->B) + ($this->B*$this->C) + ($this->A*$this->C))*(sin(2/3*M_PI)/2));
			$this->D = round($makeAverage, 1);

			(string) $this->challenge = '';
			(string) $this->content = '';
			(string) $this->title = '';
			(string) $this->loverSex = $sex;

			(string) $this->loveMessage = '';
			(string) $this->coupleLoveContent = '';
			(string) $this->detailFriendly = '';
			(string) $this->detailPassion = '';
			(string) $this->detailCommitment = '';

		}

		public function soloLove($loverName) {

			if ((($this->A <= 3) && ($this->B <= 3) && ($this->C <= 3)) || (($this->A <= 3 && $this->B <= 3) || ($this->B <= 3 && $this->C <= 3) || ($this->D < 11.7))) {

				(string) $this->challenge = "사랑의 부재";
				(string) $this->content = "사랑이라고 말 할 수 없을 것 같아요....<br/><br/>사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요.<br/>열정은 연인에게서 육체적 매력, 성적 몰입을 느끼는 것을 말해요.<br/>상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 것이 결심이에요.<br/><br/>" . $loverName . "님은 친밀감, 헌신(결심), 열정이 모두 낮아서<br/>사랑의 범주에 속하지 않아요…..<br/>일반적인 대인관계에서 흔히 볼 수 있는 감정일 가능성이 높아요.";

				if ($this->loverSex == 'M') {

					(string) $this->title = "사랑이 뭔가요…?";
					$this->comment = array("");

					$this->shareMessage1 = "/정체를 알 수 없는 지나가는 행인1";
					$this->shareMessage2 = ": 사랑이 뭔가요…?";
					$this->shareMessage3 = "/사랑의 부재";

					$this->shareImage = "058";

				} else if ($this->loverSex == 'F') {
				
					(string) $this->title = "사랑이 뭔가요…?";
					$this->comment = array("");

					$this->shareMessage1 = "/정체를 알 수 없는 지나가는 행인1";
					$this->shareMessage2 = ": 사랑이 뭔가요…?";
					$this->shareMessage3 = "/사랑의 부재";

					$this->shareImage = "058";

				}

				$this->traingleImage = '02';

			} else if ((($this->A - $this->B) < 2) && (($this->A - $this->C) < 2) && (($this->A - $this->B) >= 0) && (($this->A - $this->C) >= 0)) {

				if ((($this->A - $this->B) < 1) && (($this->A - $this->C) < 1) && ($this->D > 89.5)) {

					(string) $this->challenge = "완벽한 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 친밀감, 헌신(결심), 열정이 모두 높게 나타나고 있어요. ‘완벽한 사랑’이란 성숙한 사랑의 유형 중에서도 3 가지 요소가 모두 높고 균형잡인 경우에만 볼 수 있는 결과랍니다.<br/><br/>친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력과 성적 몰입을 강하게 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요. ";
					
					if ($this->loverSex == 'M') {
						
						(string) $this->title = "사랑에 평생을 바쳐도 모자란 사랑꾼<br/>응팔 봉블리, 김정봉의";
						$this->comment = array(
							"이 3가지 요소가 모두 균형 있게 높다는 것은 " . $loverName . "님께서 굉장히 성숙한 사랑을 하고 있다는 것을 뜻해요. " . $loverName . "님의 연인은 정말 행복하실 것 같아요. 하지만 ‘완벽한 사랑’이란 이루기보다 지키기가 더 어려운 법이에요. 사랑하는 사람 또는 사랑 받는 사람의 상황에 따라 조금씩 달라질 수도 있어요. 하지만 이미 사랑하는 방법에 대해 잘 알고 계신 것 같으니 앞으로도 이 사랑을 유지하기 위해 좋은 방향으로 노력하시면 될 것 같습니다.",
						);

						$this->shareMessage1 = "「응답하라 1988」의/’김정봉’";
						$this->shareMessage2 = ": 사랑에 평생을 바쳐도 모자란 사랑꾼";
						$this->shareMessage3 = "/완벽한 사랑";

						$this->shareImage = "011";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "일도 사랑도 완벽한 여자<br/>오마이비너스 강주은의";
						$this->comment = array(
							"이 3가지 요소가 모두 균형 있게 높다는 것은 " . $loverName . "님께서 굉장히 성숙한 사랑을 하고 있다는 것을 뜻해요. " . $loverName . "님의 연인은 정말 행복하실 것 같아요. 하지만 ‘완벽한 사랑’이란 이루기보다 지키기가 더 어려운 법이에요. 사랑하는 사람 또는 사랑 받는 사람의 상황에 따라 조금씩 달라질 수도 있어요. 하지만 이미 사랑하는 방법에 대해 잘 알고 계신 것 같으니 앞으로도 이 사랑을 유지하기 위해 좋은 방향으로 노력하시면 될 것 같습니다. ",
						);

						$this->shareMessage1 = "「오 마이 비너스」의/’강주은’";
						$this->shareMessage2 = ": 일도 사랑도 완벽한 여자";
						$this->shareMessage3 = "/완벽한 사랑";

						$this->shareImage = "020";

					}

					$this->traingleImage = '01';

				} else if ((($this->A - $this->B) < 1) && (($this->A - $this->C) < 1) && ($this->D <= 89.5) && ($this->D > 46.8)) {

					(string) $this->challenge = "성숙한 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "은 친밀감, 헌신(결심), 열정이 모두 균형 있게 나타나고 있어요. 친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력과 성적 몰입을 강하게 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요.";
					
					$this->comment = array(
						"‘성숙한 사랑’이란 위 3가지 요소가 모두 높고 균형 잡힌 경우에만 볼 수 있는 결과랍니다. 이 3가지 요소의 균형이 잘 맞는 다는 것은 " . $loverName . "께서 굉장히 성숙한 방향의 사랑을 하고 있다는 것을 뜻해요. 어느모로 보나 모두가 바라는 이상적인 모습의 사랑을 하고 계신 것이죠. 이대로 감정의 크기를 키워 나가신다면 모든 것인 완벽해서 꿈의 사랑이라고 불리는 완벽한 사랑도 가능 하실 것 같습니다. 그렇게 된다면 " . $loverName . "과 " . $loverName . "의 연인은 정말 행복하실 거에요. 이미 사랑하는 방법에 대해 잘 알고 계신 것 같으니 앞으로도 이 사랑을 유지하기 위해 좋은 방향으로 노력하시면 될 것 같습니다. ",
					);

					if ($this->loverSex == 'M') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"매사에 곧고 올바른 남자<br/>태양의 후예, 유시진의",
								"shareImage"=>"045",
								"shareMessage1"=>"「태양의 후예」의/’유시진’",
								"shareMessage2"=>": 매사에 곧고 올바른 남자",
								"shareMessage3"=>"/성숙한 사랑",
							),
							"2"=>array(
								"title"=>"여리면서도 강한 승부사<br/>응팔, 최택의",
								"shareImage"=>"047",
								"shareMessage1"=>"「응답하라 1988」의/’최택’",
								"shareMessage2"=>": 여리면서도 강한 승부사",
								"shareMessage3"=>"/성숙한 사랑",
							),
							"3"=>array(
								"title"=>"과묵하고 진지한 의지할 수 있는 남자<br/>태양의 후예, 서대영의",
								"shareImage"=>"050",
								"shareMessage1"=>"「태양의 후예」의/’서대영’",
								"shareMessage2"=>": 과묵하고 진지한 의지할 수 있는 남자",
								"shareMessage3"=>"/성숙한 사랑",
							),
						);

					} else if ($this->loverSex == 'F') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"털털하고 과감한 여자<br/>태양의 후예 강모연의",
								"shareImage"=>"051",
								"shareMessage1"=>"「태양의 후예」의/’강모연’",
								"shareMessage2"=>": 털털하고 과감한 여자",
								"shareMessage3"=>"/성숙한 사랑",
							),
							"2"=>array(
								"title"=>"까칠하고 앙칼지지만 속마음은 따뜻한 여자<br/>응답하라 1988 성보라의",
								"shareImage"=>"049",
								"shareMessage1"=>"「응답하라 1988」의/’성보라’",
								"shareMessage2"=>": 까칠하고 앙칼지지만 속마음은 따뜻한 여자",
								"shareMessage3"=>"/성숙한 사랑",
							),
							"3"=>array(
								"title"=>"언제나 밝고 긍정에너지가 넘치는 매력녀<br/>킬미힐미 오리진의",
								"shareImage"=>"048",
								"shareMessage1"=>"「킬미힐미」의/’오리진’",
								"shareMessage2"=>": 언제나 밝고 긍정 에너지가 넘치는 매력녀",
								"shareMessage3"=>"/성숙한 사랑",
							),
						);

					}
					
					if (($this->D > 76.5) && ($this->D <= 89.5)) {

						if (($this->D > 83) && ($this->D <= 89.5)) {
							$randNumber = '1';
						} else if (($this->D > 80) && ($this->D < 83)) {
							$randNumber = '2';
						} else {
							$randNumber = '3';
						}

					} else if (($this->D > 63.5) && ($this->D < 76.5)) {
						
						if (($this->D > 72) && ($this->D < 76.5)) {
							$randNumber = '1';
						} else if (($this->D > 68) && ($this->D < 72)) {
							$randNumber = '2';
						} else {
							$randNumber = '3';
						}

					} else if (($this->D > 46.8) && ($this->D < 63.5)) {
						
						if (($this->D > 55) && ($this->D < 63.5)) {
							$randNumber = '1';
						} else if (($this->D > 46.8) && ($this->D < 55)) {
							$randNumber = '2';
						} else {
							$randNumber = '3';
						}

					} else {
						$randNumber = rand(1, 3);
					}

					(string) $this->title = $randomCharacter[$randNumber]['title'];
					$this->shareMessage1 = $randomCharacter[$randNumber]['shareMessage1'];
					$this->shareMessage2 = $randomCharacter[$randNumber]['shareMessage2'];
					$this->shareMessage3 = $randomCharacter[$randNumber]['shareMessage3'];

					$this->shareImage = $randomCharacter[$randNumber]['shareImage'];

					$this->traingleImage = '28';

	 			} else if ((($this->A - $this->B) < 1) && (($this->A - $this->C) < 1) && ($this->D <= 46.8)) {

	 				(string) $this->challenge = "성숙한 모양의 작은 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "은 친밀감, 헌신(결심), 열정이 모두 균형 있게 나타나고 있어요. 친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력과 성적 몰입을 강하게 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요";

					$this->comment = array(
						"‘성숙한 사랑’이란 3 가지 요소가 모두 높고 균형 잡힌 경우에만 볼 수 있는 결과랍니다. 하지만 " . $loverName . "의 사랑은 세 요소가 균형을 이루지만 전체적인 크기가 다소 부족해요. 보통 오래된 커플에서 많이 보이는 유형이기도 합니다.  다행히 이 3가지 요소의 균형이 잘 맞는 다는 것은 " . $loverName . "께서 성숙한 방향의 사랑을 하고 있다는 것을 뜻해요. 다소 전체적인 요소가 부족한 면이 있지만 이대로 감정의 크기를 키워 나가신다면 더 성숙한 사랑을 하실 수 있을 거에요. 그렇게 된다면 " . $loverName . "과 " . $loverName . "의 연인은 행복과 사랑이 더 돈독해지실 거에요. 이미 사랑하는 방법에 대해 잘 알고 계신 것 같으니 앞으로도 이 사랑을 유지하기 위해 좋은 방향으로 노력하시면 될 것 같습니다.",
					);

					if ($this->loverSex == 'M') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"순수함의 절정! 행동파 뇌순남<br/>응팔, 성노을의",
								"shareImage"=>"055",
								"shareMessage1"=>"「응답하라 1988」의/‘성노을’",
								"shareMessage2"=>": 순수함의 절정! 행동파 뇌순남",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"2"=>array(
								"title"=>"곰같이 우직한 마음 따뜻한 남자<br/>응팔, 최무성의",
								"shareImage"=>"053",
								"shareMessage1"=>"「응답하라 1988」의/’최무성’",
								"shareMessage2"=>": 곰같이 우직한 마음 따뜻한 남자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"3"=>array(
								"title"=>"당차고 끈기 있는 남자<br/>미생, 장그래의",
								"shareImage"=>"052",
								"shareMessage1"=>"「미생」의/’장그래’",
								"shareMessage2"=>": 당차고 끈기 있는 남자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
						);

					} else if ($this->loverSex == 'F') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"까칠하고 도도한 순정파<br/>태양의 후예, 윤명주의",
								"shareImage"=>"054",
								"shareMessage1"=>"「태양의 후예」의/’윤명주’",
								"shareMessage2"=>": 까칠하고 도도한 순정파",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"2"=>array(
								"title"=>"호탕한 츤데레<br/>응팔, 라미란의",
								"shareImage"=>"056",
								"shareMessage1"=>"「응답하라 1988」의/’라미란’",
								"shareMessage2"=>": 호탕한 츤데레",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"3"=>array(
								"title"=>"책임감 넘치는 야무진 여자<br/>미생, 안영이의",
								"shareImage"=>"057",
								"shareMessage1"=>"「미생」의/’안영이’",
								"shareMessage2"=>": 책임감 넘치는 야무진 여자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
						);

					}

					if (($this->D > 36.3) && ($this->D < 46.8)) {
						$randNumber = '1';
					} else if (($this->D > 25.8) && ($this->D < 36.3)) {
						$randNumber = '2';
					} else if (($this->D > 11.7) && ($this->D < 25.8)) {
						$randNumber = '3';
					} else {
						$randNumber = rand(1, 3);
					}

					(string) $this->title = $randomCharacter[$randNumber]['title'];
					$this->shareMessage1 = $randomCharacter[$randNumber]['shareMessage1'];
					$this->shareMessage2 = $randomCharacter[$randNumber]['shareMessage2'];
					$this->shareMessage3 = $randomCharacter[$randNumber]['shareMessage3'];

					$this->shareImage = $randomCharacter[$randNumber]['shareImage'];
					$this->traingleImage = '09';

				} else if ((($this->A - $this->B) < 1) && (($this->A - $this->C) >= 1) && ($this->D > 46.8)) {
					
					(string) $this->challenge = "헌신이 아쉬운 성숙한 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 친밀감, 헌신(결심), 열정이 모두 높게 나타나고 있어요. ‘성숙한 사랑’이라 할 수 있습니다.<br/>친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력, 성적 몰입을 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요. ";

					if ($this->loverSex == 'M') {
						
						(string) $this->title = "틱틱 대지만 그 마음은 따뜻한 츤데레<br/>응팔 덕선 아빠 성동일의";
						$this->comment = array(
							"" . $loverName . "님은 그 중 헌신(결심)이 친밀감과 열정 보다 다소 낮게 나타나고 있어요. 이 세 가지 요소가 모두 높게 균형을 이루는 사랑을 ‘완벽한 사랑’이라고 해요. 완벽한 사랑으로 나아가기 위해 " . $loverName . "님께서는 연인과의 장기적인 사랑을 위한 결심을 다져보시면 좋을 것 같아요. 하지만 ‘완벽한 사랑’이란 존재하기도 힘들 뿐더러 지키기도 어려워요. " . $loverName . "님께선 이미 세 가지 요소가 모두 높은 성숙한 사랑을 하고 계시기 때문에 앞으로도 이 사랑을 유지하기 위해 긍정적인 방향으로 노력해주시면 될 것 같아요.",
						);

						$this->shareMessage1 = "「응답하라 1988」의/’성동일’";
						$this->shareMessage2 = ": 틱틱 대지만 그 마음은 따뜻한 츤데레";
						$this->shareMessage3 = "헌신이 아쉬운/성숙한 사랑";

						$this->shareImage = "030";

					} else if ($this->loverSex == 'F') {
					
						(string) $this->title = "순정적이지만 섹시한 반전 매력을 지닌<br/>나의 PS파트너 윤정의";
						$this->comment = array(
							"" . $loverName . "님은 그 중 헌신(결심)이 친밀감과 열정 보다 다소 낮게 나타나고 있어요. 이 세 가지 요소가 모두 높게 균형을 이루는 사랑을 ‘완벽한 사랑’이라고 해요. 완벽한 사랑으로 나아가기 위해 " . $loverName . "님께서는 연인과의 장기적인 사랑을 위한 결심을 다져보시면 좋을 것 같아요. 하지만 ‘완벽한 사랑’이란 존재하기도 힘들 뿐더러 지키기도 어려워요. " . $loverName . "님께선 이미 세 가지 요소가 모두 높은 성숙한 사랑을 하고 계시기 때문에 앞으로도 이 사랑을 유지하기 위해 긍정적인 방향으로 노력해주시면 될 것 같아요. ",
						);

						$this->shareMessage1 = "「나의 ps파트너」의/’윤정’";
						$this->shareMessage2 = ": 순정적이지만 섹시한 반전 매력녀";
						$this->shareMessage3 = "헌신이 아쉬운/성숙한 사랑";

						$this->shareImage = "008";

					}

					$this->traingleImage = '07';

	 			} else if ((($this->A - $this->B) < 1) && (($this->A - $this->C) >= 1) && ($this->D <= 46.8)) {
					
	 				(string) $this->challenge = "성숙한 모양의 작은 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "은 친밀감, 헌신(결심), 열정이 모두 균형 있게 나타나고 있어요. 친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력과 성적 몰입을 강하게 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요";

					$this->comment = array(
						"‘성숙한 사랑’이란 3 가지 요소가 모두 높고 균형 잡힌 경우에만 볼 수 있는 결과랍니다. 하지만 " . $loverName . "의 사랑은 세 요소가 균형을 이루지만 전체적인 크기가 다소 부족해요. 보통 오래된 커플에서 많이 보이는 유형이기도 합니다.  다행히 이 3가지 요소의 균형이 잘 맞는 다는 것은 " . $loverName . "께서 성숙한 방향의 사랑을 하고 있다는 것을 뜻해요. 다소 전체적인 요소가 부족한 면이 있지만 이대로 감정의 크기를 키워 나가신다면 더 성숙한 사랑을 하실 수 있을 거에요. 그렇게 된다면 " . $loverName . "과 " . $loverName . "의 연인은 행복과 사랑이 더 돈독해지실 거에요. 이미 사랑하는 방법에 대해 잘 알고 계신 것 같으니 앞으로도 이 사랑을 유지하기 위해 좋은 방향으로 노력하시면 될 것 같습니다.",
					);

					if ($this->loverSex == 'M') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"순수함의 절정! 행동파 뇌순남<br/>응팔, 성노을의",
								"shareImage"=>"055",
								"shareMessage1"=>"「응답하라 1988」의/‘성노을’",
								"shareMessage2"=>": 순수함의 절정! 행동파 뇌순남",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"2"=>array(
								"title"=>"곰같이 우직한 마음 따뜻한 남자<br/>응팔, 최무성의",
								"shareImage"=>"053",
								"shareMessage1"=>"「응답하라 1988」의/’최무성’",
								"shareMessage2"=>": 곰같이 우직한 마음 따뜻한 남자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"3"=>array(
								"title"=>"당차고 끈기 있는 남자<br/>미생, 장그래의",
								"shareImage"=>"052",
								"shareMessage1"=>"「미생」의/’장그래’",
								"shareMessage2"=>": 당차고 끈기 있는 남자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
						);

					} else if ($this->loverSex == 'F') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"까칠하고 도도한 순정파<br/>태양의 후예, 윤명주의",
								"shareImage"=>"054",
								"shareMessage1"=>"「태양의 후예」의/’윤명주’",
								"shareMessage2"=>": 까칠하고 도도한 순정파",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"2"=>array(
								"title"=>"호탕한 츤데레<br/>응팔, 라미란의",
								"shareImage"=>"056",
								"shareMessage1"=>"「응답하라 1988」의/’라미란’",
								"shareMessage2"=>": 호탕한 츤데레",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"3"=>array(
								"title"=>"책임감 넘치는 야무진 여자<br/>미생, 안영이의",
								"shareImage"=>"057",
								"shareMessage1"=>"「미생」의/’안영이’",
								"shareMessage2"=>": 책임감 넘치는 야무진 여자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
						);

					}

					if (($this->D > 36.3) && ($this->D < 46.8)) {
						$randNumber = '1';
					} else if (($this->D > 25.8) && ($this->D < 36.3)) {
						$randNumber = '2';
					} else if (($this->D > 11.7) && ($this->D < 25.8)) {
						$randNumber = '3';
					} else {
						$randNumber = rand(1, 3);
					}

					(string) $this->title = $randomCharacter[$randNumber]['title'];
					$this->shareMessage1 = $randomCharacter[$randNumber]['shareMessage1'];
					$this->shareMessage2 = $randomCharacter[$randNumber]['shareMessage2'];
					$this->shareMessage3 = $randomCharacter[$randNumber]['shareMessage3'];

					$this->shareImage = $randomCharacter[$randNumber]['shareImage'];
					$this->traingleImage = '09';

	 			} else if ((($this->A - $this->B) >= 1) && (($this->A - $this->C) < 1) && ($this->D > 46.8)) {
					
					(string) $this->challenge = "열정이 아쉬운 성숙한 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 친밀감, 헌신(결심), 열정이 모두 높게 나타나고 있어요. ‘성숙한 사랑’이라 할 수 있습니다.<br/><br/>친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력, 성적 몰입을 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "엉뚱한 장난꾸러기, 하지만 밤에는 2% 부족?<br/>응팔 정환 아빠 김성균의";
						$this->comment = array(
							"" . $loverName . "님은 그 중 열정이 친밀감과 헌신(결심) 보다 다소 낮게 나타나고 있어요. 이 세 가지 요소가 모두 높게 균형을 이루는 사랑을 ‘완벽한 사랑’이라고 해요. 완벽한 사랑으로 나아가기 위해 " . $loverName . "님께서는 사랑하는 감정을 아끼지 말고 적극적으로 표현해보세요. 하지만 ‘완벽한 사랑’이란 존재하기도 힘들 뿐더러 지키기도 어려워요. " . $loverName . "님께선 이미 세 가지 요소가 모두 높은 성숙한 사랑을 하고 계시기 때문에 앞으로도 이 사랑을 유지하기 위해 긍정적인 방향으로 노력해주시면 될 것 같아요.",
						);

						$this->shareMessage1 = "「응답하라 1988」의/’김성균’";
						$this->shareMessage2 = ": 엉뚱한 장난꾸러기, 하지만 밤에는 2% 부족?";
						$this->shareMessage3 = "열정이 아쉬운/성숙한 사랑";

						$this->shareImage = "025";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "내숭 없이 귀엽고 쾌활한<br/>응팔 성덕선의";
						$this->comment = array(
							"" . $loverName . "님은 그 중 열정이 친밀감과 헌신(결심) 보다 다소 낮게 나타나고 있어요. 이 세 가지 요소가 모두 높게 균형을 이루는 사랑을 ‘완벽한 사랑’이라고 해요. 완벽한 사랑으로 나아가기 위해 " . $loverName . "님께서는 사랑하는 감정을 아끼지 말고 적극적으로 표현해보세요. 하지만 ‘완벽한 사랑’이란 존재하기도 힘들 뿐더러 지키기도 어려워요. " . $loverName . "님께선 이미 세 가지 요소가 모두 높은 성숙한 사랑을 하고 계시기 때문에 앞으로도 이 사랑을 유지하기 위해 긍정적인 방향으로 노력해주시면 될 것 같아요.",
						);

						$this->shareMessage1 = "「응답하라 1988」의/’성덕선’";
						$this->shareMessage2 = ": 내숭 없이 귀엽고 쾌활한 소녀";
						$this->shareMessage3 = "열정이 아쉬운/성숙한 사랑";

						$this->shareImage = "029";

					}

					$this->traingleImage = '03';

	 			} else if ((($this->A - $this->B) >= 1) && (($this->A - $this->C) < 1) && ($this->D <= 46.8)) {
					
	 				(string) $this->challenge = "성숙한 모양의 작은 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "은 친밀감, 헌신(결심), 열정이 모두 균형 있게 나타나고 있어요. 친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력과 성적 몰입을 강하게 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요";

					$this->comment = array(
						"‘성숙한 사랑’이란 3 가지 요소가 모두 높고 균형 잡힌 경우에만 볼 수 있는 결과랍니다. 하지만 " . $loverName . "의 사랑은 세 요소가 균형을 이루지만 전체적인 크기가 다소 부족해요. 보통 오래된 커플에서 많이 보이는 유형이기도 합니다.  다행히 이 3가지 요소의 균형이 잘 맞는 다는 것은 " . $loverName . "께서 성숙한 방향의 사랑을 하고 있다는 것을 뜻해요. 다소 전체적인 요소가 부족한 면이 있지만 이대로 감정의 크기를 키워 나가신다면 더 성숙한 사랑을 하실 수 있을 거에요. 그렇게 된다면 " . $loverName . "과 " . $loverName . "의 연인은 행복과 사랑이 더 돈독해지실 거에요. 이미 사랑하는 방법에 대해 잘 알고 계신 것 같으니 앞으로도 이 사랑을 유지하기 위해 좋은 방향으로 노력하시면 될 것 같습니다.",
					);

					if ($this->loverSex == 'M') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"순수함의 절정! 행동파 뇌순남<br/>응팔, 성노을의",
								"shareImage"=>"055",
								"shareMessage1"=>"「응답하라 1988」의/‘성노을’",
								"shareMessage2"=>": 순수함의 절정! 행동파 뇌순남",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"2"=>array(
								"title"=>"곰같이 우직한 마음 따뜻한 남자<br/>응팔, 최무성의",
								"shareImage"=>"053",
								"shareMessage1"=>"「응답하라 1988」의/’최무성’",
								"shareMessage2"=>": 곰같이 우직한 마음 따뜻한 남자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"3"=>array(
								"title"=>"당차고 끈기 있는 남자<br/>미생, 장그래의",
								"shareImage"=>"052",
								"shareMessage1"=>"「미생」의/’장그래’",
								"shareMessage2"=>": 당차고 끈기 있는 남자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
						);

					} else if ($this->loverSex == 'F') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"까칠하고 도도한 순정파<br/>태양의 후예, 윤명주의",
								"shareImage"=>"054",
								"shareMessage1"=>"「태양의 후예」의/’윤명주’",
								"shareMessage2"=>": 까칠하고 도도한 순정파",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"2"=>array(
								"title"=>"호탕한 츤데레<br/>응팔, 라미란의",
								"shareImage"=>"056",
								"shareMessage1"=>"「응답하라 1988」의/’라미란’",
								"shareMessage2"=>": 호탕한 츤데레",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"3"=>array(
								"title"=>"책임감 넘치는 야무진 여자<br/>미생, 안영이의",
								"shareImage"=>"057",
								"shareMessage1"=>"「미생」의/’안영이’",
								"shareMessage2"=>": 책임감 넘치는 야무진 여자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
						);

					}

					// $randNumber = rand(1, 3);

					if (($this->D > 36.3) && ($this->D < 46.8)) {
						$randNumber = '1';
					} else if (($this->D > 25.8) && ($this->D < 36.3)) {
						$randNumber = '2';
					} else if (($this->D > 11.7) && ($this->D < 25.8)) {
						$randNumber = '3';
					}

					(string) $this->title = $randomCharacter[$randNumber]['title'];
					$this->shareMessage1 = $randomCharacter[$randNumber]['shareMessage1'];
					$this->shareMessage2 = $randomCharacter[$randNumber]['shareMessage2'];
					$this->shareMessage3 = $randomCharacter[$randNumber]['shareMessage3'];

					$this->shareImage = $randomCharacter[$randNumber]['shareImage'];
					$this->traingleImage = '09';

	 			} else if ((($this->A - $this->B) >= 1) && (($this->A - $this->C) >= 1) && ($this->D > 46.8)) {
					
					(string) $this->challenge = "친밀이 높은 성숙한 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 친밀감, 헌신(결심), 열정이 모두 높게 나타나고 있어 ‘성숙한 사랑’이라 할 수 있습니다.<br/><br/>친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력, 성적 몰입을 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "한 없이 다정다감한 속 깊은 남자<br/>응팔, 성선우의";
						$this->comment = array(
							"" . $loverName . "님은 그 중 친밀감이 열정과 헌신(결심)보다 다소 높게 나타나고 있어요. 이 세 가지 요소가 모두 높게 균형을 이루는 사랑을 ‘완벽한 사랑’이라고 해요. 완벽한 사랑으로 나아가기 위해  " . $loverName . "님께서는 사랑하는 감정을 아끼지 말고 적극적으로 표현해보세요. 또한 연인과의 장기적인 사랑을 위한 결심을 다져보시면 좋을 것 같아요. 하지만 ‘완벽한 사랑’이란 존재하기도 힘들 뿐더러 지키기도 어려워요. " . $loverName . "님께선 이미 세 가지 요소가 모두 높은 성숙한 사랑을 하고 계시기 때문에 앞으로도 이 사랑을 유지하기 위해 긍정적인 방향으로 노력해주시면 될 것 같아요.",
						);

						$this->shareMessage1 = "「응답하라 1988」의/’성선우’";
						$this->shareMessage2 = ": 한없이 다정다감한 속 깊은 남자";
						$this->shareMessage3 = "친밀감이 높은/성숙한 사랑";

						$this->shareImage = "026";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "시원시원하고 솔직한 행동파<br/>치인트, 장보라의";
						$this->comment = array(
							"" . $loverName . "님은 그 중 친밀감이 열정과 헌신(결심) 보다 다소 높게 나타나고 있어요. 이 세 가지 요소가 모두 높게 균형을 이루는 사랑을 ‘완벽한 사랑’이라고 해요. 완벽한 사랑으로 나아가기 위해  " . $loverName . "님께서는 사랑하는 감정을 아끼지 말고 적극적으로 표현해보세요. 또한 연인과의 장기적인 사랑을 위한 결심을 다져보시면 좋을 것 같아요. 하지만 ‘완벽한 사랑’이란 존재하기도 힘들 뿐더러 지키기도 어려워요. " . $loverName . "님께선 이미 세 가지 요소가 모두 높은 성숙한 사랑을 하고 계시기 때문에 앞으로도 이 사랑을 유지하기 위해 긍정적인 방향으로 노력해주시면 될 것 같아요",
						);

						$this->shareMessage1 = "「치즈 인 더 트랩」의/’장보라’";
						$this->shareMessage2 = ": 시원시원하고 솔직한 행동파";
						$this->shareMessage3 = "친밀감이 높은/성숙한 사랑";

						$this->shareImage = "033";

					}

					$this->traingleImage = '04';

	 			} else if ((($this->A - $this->B) >= 1) && (($this->A - $this->C) >= 1) && ($this->D <= 46.8)) {

	 				(string) $this->challenge = "성숙한 모양의 작은 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "은 친밀감, 헌신(결심), 열정이 모두 균형 있게 나타나고 있어요. 친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력과 성적 몰입을 강하게 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요";

					$this->comment = array(
						"‘성숙한 사랑’이란 3 가지 요소가 모두 높고 균형 잡힌 경우에만 볼 수 있는 결과랍니다. 하지만 " . $loverName . "의 사랑은 세 요소가 균형을 이루지만 전체적인 크기가 다소 부족해요. 보통 오래된 커플에서 많이 보이는 유형이기도 합니다.  다행히 이 3가지 요소의 균형이 잘 맞는 다는 것은 " . $loverName . "께서 성숙한 방향의 사랑을 하고 있다는 것을 뜻해요. 다소 전체적인 요소가 부족한 면이 있지만 이대로 감정의 크기를 키워 나가신다면 더 성숙한 사랑을 하실 수 있을 거에요. 그렇게 된다면 " . $loverName . "과 " . $loverName . "의 연인은 행복과 사랑이 더 돈독해지실 거에요. 이미 사랑하는 방법에 대해 잘 알고 계신 것 같으니 앞으로도 이 사랑을 유지하기 위해 좋은 방향으로 노력하시면 될 것 같습니다.",
					);

					if ($this->loverSex == 'M') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"순수함의 절정! 행동파 뇌순남<br/>응팔, 성노을의",
								"shareImage"=>"055",
								"shareMessage1"=>"「응답하라 1988」의/‘성노을’",
								"shareMessage2"=>": 순수함의 절정! 행동파 뇌순남",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"2"=>array(
								"title"=>"곰같이 우직한 마음 따뜻한 남자<br/>응팔, 최무성의",
								"shareImage"=>"053",
								"shareMessage1"=>"「응답하라 1988」의/’최무성’",
								"shareMessage2"=>": 곰같이 우직한 마음 따뜻한 남자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"3"=>array(
								"title"=>"당차고 끈기 있는 남자<br/>미생, 장그래의",
								"shareImage"=>"052",
								"shareMessage1"=>"「미생」의/’장그래’",
								"shareMessage2"=>": 당차고 끈기 있는 남자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
						);

					} else if ($this->loverSex == 'F') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"까칠하고 도도한 순정파<br/>태양의 후예, 윤명주의",
								"shareImage"=>"054",
								"shareMessage1"=>"「태양의 후예」의/’윤명주’",
								"shareMessage2"=>": 까칠하고 도도한 순정파",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"2"=>array(
								"title"=>"호탕한 츤데레<br/>응팔, 라미란의",
								"shareImage"=>"056",
								"shareMessage1"=>"「응답하라 1988」의/’라미란’",
								"shareMessage2"=>": 호탕한 츤데레",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"3"=>array(
								"title"=>"책임감 넘치는 야무진 여자<br/>미생, 안영이의",
								"shareImage"=>"057",
								"shareMessage1"=>"「미생」의/’안영이’",
								"shareMessage2"=>": 책임감 넘치는 야무진 여자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
						);

					}

					// $randNumber = rand(1, 3);

					if (($this->D > 36.3) && ($this->D < 46.8)) {
						$randNumber = '1';
					} else if (($this->D > 25.8) && ($this->D < 36.3)) {
						$randNumber = '2';
					} else if (($this->D > 11.7) && ($this->D < 25.8)) {
						$randNumber = '3';
					}

					(string) $this->title = $randomCharacter[$randNumber]['title'];
					$this->shareMessage1 = $randomCharacter[$randNumber]['shareMessage1'];
					$this->shareMessage2 = $randomCharacter[$randNumber]['shareMessage2'];
					$this->shareMessage3 = $randomCharacter[$randNumber]['shareMessage3'];

					$this->shareImage = $randomCharacter[$randNumber]['shareImage'];
					$this->traingleImage = '09';

	 			} else {

					(string) $this->challenge = "친밀 단계 오류";
					(string) $this->title = "";
					(string) $this->content = "";

	 			}

			} else if ((($this->B - $this->C) < 2) && (($this->B - $this->A) < 2) && (($this->B - $this->C) >= 0) && (($this->B - $this->A) >= 0)) {

				if ((($this->B - $this->C) < 1) && (($this->B - $this->A) < 1) && ($this->D > 89.5)) {

					(string) $this->challenge = "완벽한 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 친밀감, 헌신(결심), 열정이 모두 높게 나타나고 있어요. ‘완벽한 사랑’이란 성숙한 사랑의 유형 중에서도 3 가지 요소가 모두 높고 균형잡인 경우에만 볼 수 있는 결과랍니다.<br/><br/>친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력과 성적 몰입을 강하게 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요. ";

					if ($this->loverSex == 'M') {
						
						(string) $this->title = "사랑에 평생을 바쳐도 모자란 사랑꾼<br/>응팔 봉블리, 김정봉의";
						$this->comment = array(
							"이 3가지 요소가 모두 균형 있게 높다는 것은 " . $loverName . "님께서 굉장히 성숙한 사랑을 하고 있다는 것을 뜻해요. " . $loverName . "님의 연인은 정말 행복하실 것 같아요. 하지만 ‘완벽한 사랑’이란 이루기보다 지키기가 더 어려운 법이에요. 사랑하는 사람 또는 사랑 받는 사람의 상황에 따라 조금씩 달라질 수도 있어요. 하지만 이미 사랑하는 방법에 대해 잘 알고 계신 것 같으니 앞으로도 이 사랑을 유지하기 위해 좋은 방향으로 노력하시면 될 것 같습니다.",
						);

						$this->shareMessage1 = "「응답하라 1988」의/’김정봉’";
						$this->shareMessage2 = ": 사랑에 평생을 바쳐도 모자란 사랑꾼";
						$this->shareMessage3 = "/완벽한 사랑";

						$this->shareImage = "011";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "일도 사랑도 완벽한 여자<br/>오마이비너스, 강주은의";
						$this->comment = array(
							"이 3가지 요소가 모두 균형 있게 높다는 것은 " . $loverName . "님께서 굉장히 성숙한 사랑을 하고 있다는 것을 뜻해요. " . $loverName . "님의 연인은 정말 행복하실 것 같아요. 하지만 ‘완벽한 사랑’이란 이루기보다 지키기가 더 어려운 법이에요. 사랑하는 사람 또는 사랑 받는 사람의 상황에 따라 조금씩 달라질 수도 있어요. 하지만 이미 사랑하는 방법에 대해 잘 알고 계신 것 같으니 앞으로도 이 사랑을 유지하기 위해 좋은 방향으로 노력하시면 될 것 같습니다. ",
						);

						$this->shareMessage1 = "「오 마이 비너스」의/’강주은’";
						$this->shareMessage2 = ": 일도 사랑도 완벽한 여자";
						$this->shareMessage3 = "/완벽한 사랑";

						$this->shareImage = "020";

					}

					$this->traingleImage = '01';

	 			} else if ((($this->A - $this->B) < 1) && (($this->A - $this->C) < 1) && ($this->D <= 89.5) && ($this->D > 46.8)) {

					(string) $this->challenge = "성숙한 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "은 친밀감, 헌신(결심), 열정이 모두 균형 있게 나타나고 있어요. 친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력과 성적 몰입을 강하게 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요.";
					
					$this->comment = array(
						"‘성숙한 사랑’이란 위 3가지 요소가 모두 높고 균형 잡힌 경우에만 볼 수 있는 결과랍니다. 이 3가지 요소의 균형이 잘 맞는 다는 것은 " . $loverName . "께서 굉장히 성숙한 방향의 사랑을 하고 있다는 것을 뜻해요. 어느모로 보나 모두가 바라는 이상적인 모습의 사랑을 하고 계신 것이죠. 이대로 감정의 크기를 키워 나가신다면 모든 것인 완벽해서 꿈의 사랑이라고 불리는 완벽한 사랑도 가능 하실 것 같습니다. 그렇게 된다면 " . $loverName . "과 " . $loverName . "의 연인은 정말 행복하실 거에요. 이미 사랑하는 방법에 대해 잘 알고 계신 것 같으니 앞으로도 이 사랑을 유지하기 위해 좋은 방향으로 노력하시면 될 것 같습니다. ",
					);

					if ($this->loverSex == 'M') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"매사에 곧고 올바른 남자<br/>태양의 후예, 유시진의",
								"shareImage"=>"045",
								"shareMessage1"=>"「태양의 후예」의/’유시진’",
								"shareMessage2"=>": 매사에 곧고 올바른 남자",
								"shareMessage3"=>"/성숙한 사랑",
							),
							"2"=>array(
								"title"=>"여리면서도 강한 승부사<br/>응팔, 최택의",
								"shareImage"=>"047",
								"shareMessage1"=>"「응답하라 1988」의/’최택’",
								"shareMessage2"=>": 여리면서도 강한 승부사",
								"shareMessage3"=>"/성숙한 사랑",
							),
							"3"=>array(
								"title"=>"과묵하고 진지한 의지할 수 있는 남자<br/>태양의 후예, 서대영의",
								"shareImage"=>"050",
								"shareMessage1"=>"「태양의 후예」의/’서대영’",
								"shareMessage2"=>": 과묵하고 진지한 의지할 수 있는 남자",
								"shareMessage3"=>"/성숙한 사랑",
							),
						);

					} else if ($this->loverSex == 'F') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"털털하고 과감한 여자<br/>태양의 후예, 강모연의",
								"shareImage"=>"051",
								"shareMessage1"=>"「태양의 후예」의/’강모연’",
								"shareMessage2"=>": 털털하고 과감한 여자",
								"shareMessage3"=>"/성숙한 사랑",
							),
							"2"=>array(
								"title"=>"까칠하고 앙칼지지만 속마음은 따뜻한 여자<br/>응답하라 1988, 성보라의",
								"shareImage"=>"049",
								"shareMessage1"=>"「응답하라 1988」의/’성보라’",
								"shareMessage2"=>": 까칠하고 앙칼지지만 속마음은 따뜻한 여자",
								"shareMessage3"=>"/성숙한 사랑",
							),
							"3"=>array(
								"title"=>"언제나 밝고 긍정에너지가 넘치는 매력녀<br/>킬미힐미, 오리진의",
								"shareImage"=>"048",
								"shareMessage1"=>"「킬미힐미」의/’오리진’",
								"shareMessage2"=>": 언제나 밝고 긍정 에너지가 넘치는 매력녀",
								"shareMessage3"=>"/성숙한 사랑",
							),
						);

					}

					if (($this->D > 76.5) && ($this->D <= 89.5)) {

						if (($this->D > 83) && ($this->D <= 89.5)) {
							$randNumber = '1';
						} else if (($this->D > 80) && ($this->D < 83)) {
							$randNumber = '2';
						} else {
							$randNumber = '3';
						}

					} else if (($this->D > 63.5) && ($this->D < 76.5)) {
						
						if (($this->D > 72) && ($this->D < 76.5)) {
							$randNumber = '1';
						} else if (($this->D > 68) && ($this->D < 72)) {
							$randNumber = '2';
						} else {
							$randNumber = '3';
						}

					} else if (($this->D > 46.8) && ($this->D < 63.5)) {
						
						if (($this->D > 55) && ($this->D < 63.5)) {
							$randNumber = '1';
						} else if (($this->D > 46.8) && ($this->D < 55)) {
							$randNumber = '2';
						} else {
							$randNumber = '3';
						}

					} else {
						$randNumber = rand(1, 3);
					}

					(string) $this->title = $randomCharacter[$randNumber]['title'];
					$this->shareMessage1 = $randomCharacter[$randNumber]['shareMessage1'];
					$this->shareMessage2 = $randomCharacter[$randNumber]['shareMessage2'];
					$this->shareMessage3 = $randomCharacter[$randNumber]['shareMessage3'];

					$this->shareImage = $randomCharacter[$randNumber]['shareImage'];
					$this->traingleImage = '28';

	 			} else if ((($this->B - $this->C) < 1) && (($this->B - $this->A) < 1) && ($this->D <= 46.8)) {
					
	 				(string) $this->challenge = "성숙한 모양의 작은 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "은 친밀감, 헌신(결심), 열정이 모두 균형 있게 나타나고 있어요. 친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력과 성적 몰입을 강하게 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요";

					$this->comment = array(
						"‘성숙한 사랑’이란 3 가지 요소가 모두 높고 균형 잡힌 경우에만 볼 수 있는 결과랍니다. 하지만 " . $loverName . "의 사랑은 세 요소가 균형을 이루지만 전체적인 크기가 다소 부족해요. 보통 오래된 커플에서 많이 보이는 유형이기도 합니다.  다행히 이 3가지 요소의 균형이 잘 맞는 다는 것은 " . $loverName . "께서 성숙한 방향의 사랑을 하고 있다는 것을 뜻해요. 다소 전체적인 요소가 부족한 면이 있지만 이대로 감정의 크기를 키워 나가신다면 더 성숙한 사랑을 하실 수 있을 거에요. 그렇게 된다면 " . $loverName . "과 " . $loverName . "의 연인은 행복과 사랑이 더 돈독해지실 거에요. 이미 사랑하는 방법에 대해 잘 알고 계신 것 같으니 앞으로도 이 사랑을 유지하기 위해 좋은 방향으로 노력하시면 될 것 같습니다.",
					);

					if ($this->loverSex == 'M') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"순수함의 절정! 행동파 뇌순남<br/>응팔, 성노을의",
								"shareImage"=>"055",
								"shareMessage1"=>"「응답하라 1988」의/‘성노을’",
								"shareMessage2"=>": 순수함의 절정! 행동파 뇌순남",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"2"=>array(
								"title"=>"곰같이 우직한 마음 따뜻한 남자<br/>응팔, 최무성의",
								"shareImage"=>"053",
								"shareMessage1"=>"「응답하라 1988」의/’최무성’",
								"shareMessage2"=>": 곰같이 우직한 마음 따뜻한 남자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"3"=>array(
								"title"=>"당차고 끈기 있는 남자<br/>미생, 장그래의",
								"shareImage"=>"052",
								"shareMessage1"=>"「미생」의/’장그래’",
								"shareMessage2"=>": 당차고 끈기 있는 남자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
						);

					} else if ($this->loverSex == 'F') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"까칠하고 도도한 순정파<br/>태양의 후예, 윤명주의",
								"shareImage"=>"054",
								"shareMessage1"=>"「태양의 후예」의/’윤명주’",
								"shareMessage2"=>": 까칠하고 도도한 순정파",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"2"=>array(
								"title"=>"호탕한 츤데레<br/>응팔, 라미란의",
								"shareImage"=>"056",
								"shareMessage1"=>"「응답하라 1988」의/’라미란’",
								"shareMessage2"=>": 호탕한 츤데레",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"3"=>array(
								"title"=>"책임감 넘치는 야무진 여자<br/>미생, 안영이의",
								"shareImage"=>"057",
								"shareMessage1"=>"「미생」의/’안영이’",
								"shareMessage2"=>": 책임감 넘치는 야무진 여자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
						);

					}

					// $randNumber = rand(1, 3);

					if (($this->D > 36.3) && ($this->D < 46.8)) {
						$randNumber = '1';
					} else if (($this->D > 25.8) && ($this->D < 36.3)) {
						$randNumber = '2';
					} else if (($this->D > 11.7) && ($this->D < 25.8)) {
						$randNumber = '3';
					} else {
						$randNumber = rand(1, 3);
					}

					(string) $this->title = $randomCharacter[$randNumber]['title'];
					$this->shareMessage1 = $randomCharacter[$randNumber]['shareMessage1'];
					$this->shareMessage2 = $randomCharacter[$randNumber]['shareMessage2'];
					$this->shareMessage3 = $randomCharacter[$randNumber]['shareMessage3'];

					$this->shareImage = $randomCharacter[$randNumber]['shareImage'];
					$this->traingleImage = '09';

	 			} else if ((($this->B - $this->C) >= 1) && (($this->B - $this->A) < 1) && ($this->D > 46.8)) {
					
					(string) $this->challenge = "헌신이 아쉬운 성숙한 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 친밀감, 헌신(결심), 열정이 모두 높게 나타나고 있어요. ‘성숙한 사랑’이라 할 수 있습니다.<br/>친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력, 성적 몰입을 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요. ";

					if ($this->loverSex == 'M') {

						(string) $this->title = "틱틱 대지만 그 마음은 따뜻한 츤데레<br/>응팔 덕선 아빠, 성동일의";
						$this->comment = array(
							"" . $loverName . "님은 그 중 헌신(결심)이 친밀감과 열정 보다 다소 낮게 나타나고 있어요. 이 세 가지 요소가 모두 높게 균형을 이루는 사랑을 ‘완벽한 사랑’이라고 해요. 완벽한 사랑으로 나아가기 위해 " . $loverName . "님께서는 연인과의 장기적인 사랑을 위한 결심을 다져보시면 좋을 것 같아요. 하지만 ‘완벽한 사랑’이란 존재하기도 힘들 뿐더러 지키기도 어려워요. " . $loverName . "님께선 이미 세 가지 요소가 모두 높은 성숙한 사랑을 하고 계시기 때문에 앞으로도 이 사랑을 유지하기 위해 긍정적인 방향으로 노력해주시면 될 것 같아요.",
						);

						$this->shareMessage1 = "「응답하라 1988」의/’성동일’";
						$this->shareMessage2 = ": 틱틱 대지만 그 마음은 따뜻한 츤데레";
						$this->shareMessage3 = "헌신이 아쉬운/성숙한 사랑";

						$this->shareImage = "030";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "순정적이지만 섹시한 반전 매력을 지닌<br/>나의 PS파트너, 윤정의";
						$this->comment = array(
							"" . $loverName . "님은 그 중 헌신(결심)이 친밀감과 열정 보다 다소 낮게 나타나고 있어요. 이 세 가지 요소가 모두 높게 균형을 이루는 사랑을 ‘완벽한 사랑’이라고 해요. 완벽한 사랑으로 나아가기 위해 " . $loverName . "님께서는 연인과의 장기적인 사랑을 위한 결심을 다져보시면 좋을 것 같아요. 하지만 ‘완벽한 사랑’이란 존재하기도 힘들 뿐더러 지키기도 어려워요. " . $loverName . "님께선 이미 세 가지 요소가 모두 높은 성숙한 사랑을 하고 계시기 때문에 앞으로도 이 사랑을 유지하기 위해 긍정적인 방향으로 노력해주시면 될 것 같아요. ",
						);

						$this->shareMessage1 = "「나의 ps파트너」의/’윤정’";
						$this->shareMessage2 = ": 순정적이지만 섹시한 반전 매력녀";
						$this->shareMessage3 = "헌신이 아쉬운/성숙한 사랑";

						$this->shareImage = "008";

					}

					$this->traingleImage = '07';

	 			} else if ((($this->B - $this->C) >= 1) && (($this->B - $this->A) < 1) && ($this->D <= 46.8)) {

	 				(string) $this->challenge = "성숙한 모양의 작은 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "은 친밀감, 헌신(결심), 열정이 모두 균형 있게 나타나고 있어요. 친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력과 성적 몰입을 강하게 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요";

					$this->comment = array(
						"‘성숙한 사랑’이란 3 가지 요소가 모두 높고 균형 잡힌 경우에만 볼 수 있는 결과랍니다. 하지만 " . $loverName . "의 사랑은 세 요소가 균형을 이루지만 전체적인 크기가 다소 부족해요. 보통 오래된 커플에서 많이 보이는 유형이기도 합니다.  다행히 이 3가지 요소의 균형이 잘 맞는 다는 것은 " . $loverName . "께서 성숙한 방향의 사랑을 하고 있다는 것을 뜻해요. 다소 전체적인 요소가 부족한 면이 있지만 이대로 감정의 크기를 키워 나가신다면 더 성숙한 사랑을 하실 수 있을 거에요. 그렇게 된다면 " . $loverName . "과 " . $loverName . "의 연인은 행복과 사랑이 더 돈독해지실 거에요. 이미 사랑하는 방법에 대해 잘 알고 계신 것 같으니 앞으로도 이 사랑을 유지하기 위해 좋은 방향으로 노력하시면 될 것 같습니다.",
					);

					if ($this->loverSex == 'M') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"순수함의 절정! 행동파 뇌순남<br/>응팔, 성노을의",
								"shareImage"=>"055",
								"shareMessage1"=>"「응답하라 1988」의/‘성노을’",
								"shareMessage2"=>": 순수함의 절정! 행동파 뇌순남",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"2"=>array(
								"title"=>"곰같이 우직한 마음 따뜻한 남자<br/>응팔, 최무성의",
								"shareImage"=>"053",
								"shareMessage1"=>"「응답하라 1988」의/’최무성’",
								"shareMessage2"=>": 곰같이 우직한 마음 따뜻한 남자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"3"=>array(
								"title"=>"당차고 끈기 있는 남자<br/>미생, 장그래의",
								"shareImage"=>"052",
								"shareMessage1"=>"「미생」의/’장그래’",
								"shareMessage2"=>": 당차고 끈기 있는 남자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
						);

					} else if ($this->loverSex == 'F') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"까칠하고 도도한 순정파<br/>태양의 후예, 윤명주의",
								"shareImage"=>"054",
								"shareMessage1"=>"「태양의 후예」의/’윤명주’",
								"shareMessage2"=>": 까칠하고 도도한 순정파",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"2"=>array(
								"title"=>"호탕한 츤데레<br/>응팔, 라미란의",
								"shareImage"=>"056",
								"shareMessage1"=>"「응답하라 1988」의/’라미란’",
								"shareMessage2"=>": 호탕한 츤데레",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"3"=>array(
								"title"=>"책임감 넘치는 야무진 여자<br/>미생, 안영이의",
								"shareImage"=>"057",
								"shareMessage1"=>"「미생」의/’안영이’",
								"shareMessage2"=>": 책임감 넘치는 야무진 여자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
						);

					}

					// $randNumber = rand(1, 3);

					if (($this->D > 36.3) && ($this->D < 46.8)) {
						$randNumber = '1';
					} else if (($this->D > 25.8) && ($this->D < 36.3)) {
						$randNumber = '2';
					} else if (($this->D > 11.7) && ($this->D < 25.8)) {
						$randNumber = '3';
					} else {
						$randNumber = rand(1, 3);
					}

					(string) $this->title = $randomCharacter[$randNumber]['title'];
					$this->shareMessage1 = $randomCharacter[$randNumber]['shareMessage1'];
					$this->shareMessage2 = $randomCharacter[$randNumber]['shareMessage2'];
					$this->shareMessage3 = $randomCharacter[$randNumber]['shareMessage3'];

					$this->shareImage = $randomCharacter[$randNumber]['shareImage'];
					$this->traingleImage = '09';

	 			} else if ((($this->B - $this->C) < 1) && (($this->B - $this->A) >= 1) && ($this->D > 46.8)) {
					
					(string) $this->challenge = "친밀이 아쉬운 성숙한 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 친밀감, 헌신(결심), 열정이 모두 높게 나타나고 있어요. ‘성숙한 사랑’이라 할 수 있습니다.<br/><br/>친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력, 성적 몰입을 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요. ";

					if ($this->loverSex == 'M') {

						(string) $this->title = "카리스마 넘치는 귀여운 남자<br/>오 나의 귀신님, 강선우의";
						$this->comment = array(
							"" . $loverName . "님은 그 중 친밀감이 열정과 헌신(결심) 보다 다소 낮게 나타나고 있어요. 이 세 가지 요소가 모두 높게 균형을 이루는 사랑을 ‘완벽한 사랑’이라고 해요. 완벽한 사랑으로 나아가기 위해 " . $loverName . "님께서는 상대방과 더 많이 소통하고 정신적으로 지지해 주시면 좋을 것 같아요. 하지만 ‘완벽한 사랑’이란 존재하기도 힘들 뿐더러 지키기도 어려워요. " . $loverName . "님께선 이미 세 가지 요소가 모두 높은 성숙한 사랑을 하고 계시기 때문에 앞으로도 이 사랑을 유지하기 위해 긍정적인 방향으로 노력해주시면 될 것 같아요. ",
						);

						$this->shareMessage1 = "「오 나의 귀신님」의/’강선우’";
						$this->shareMessage2 = ": 카리스마 넘치는 귀여운 남자";
						$this->shareMessage3 = "친밀감이 아쉬운/성숙한 사랑";

						$this->shareImage = "018";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "속마음이 시끄럽고 고민이 많아 사랑에도 조심스러운 여자<br/>치인트, 홍설의";
						$this->comment = array(
							"" . $loverName . "님은 그 중 친밀감이 열정과 헌신(결심) 보다 다소 낮게 나타나고 있어요. 이 세 가지 요소가 모두 높게 균형을 이루는 사랑을 ‘완벽한 사랑’이라고 해요. 완벽한 사랑으로 나아가기 위해 " . $loverName . "님께서는 상대방과 더 많이 소통하고 정신적으로 지지해 주시면 좋을 것 같아요. 하지만 ‘완벽한 사랑’이란 존재하기도 힘들 뿐더러 지키기도 어려워요. " . $loverName . "님께선 이미 세 가지 요소가 모두 높은 성숙한 사랑을 하고 계시기 때문에 앞으로도 이 사랑을 유지하기 위해 긍정적인 방향으로 노력해주시면 될 것 같아요. ",
						);

						$this->shareMessage1 = "「치즈 인 더 트랩」의/’홍설’";
						$this->shareMessage2 = ": 속마음이 시끄럽고 고민이 많아 사랑에도 조심스러운 여자";
						$this->shareMessage3 = "친밀감이 아쉬운/성숙한 사랑";

						$this->shareImage = "034";

					}

					$this->traingleImage = '06';

	 			} else if ((($this->B - $this->C) < 1) && (($this->B - $this->A) >= 1) && ($this->D <= 46.8)) {

	 				(string) $this->challenge = "성숙한 모양의 작은 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "은 친밀감, 헌신(결심), 열정이 모두 균형 있게 나타나고 있어요. 친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력과 성적 몰입을 강하게 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요";

					$this->comment = array(
						"‘성숙한 사랑’이란 3 가지 요소가 모두 높고 균형 잡힌 경우에만 볼 수 있는 결과랍니다. 하지만 " . $loverName . "의 사랑은 세 요소가 균형을 이루지만 전체적인 크기가 다소 부족해요. 보통 오래된 커플에서 많이 보이는 유형이기도 합니다.  다행히 이 3가지 요소의 균형이 잘 맞는 다는 것은 " . $loverName . "께서 성숙한 방향의 사랑을 하고 있다는 것을 뜻해요. 다소 전체적인 요소가 부족한 면이 있지만 이대로 감정의 크기를 키워 나가신다면 더 성숙한 사랑을 하실 수 있을 거에요. 그렇게 된다면 " . $loverName . "과 " . $loverName . "의 연인은 행복과 사랑이 더 돈독해지실 거에요. 이미 사랑하는 방법에 대해 잘 알고 계신 것 같으니 앞으로도 이 사랑을 유지하기 위해 좋은 방향으로 노력하시면 될 것 같습니다.",
					);

					if ($this->loverSex == 'M') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"순수함의 절정! 행동파 뇌순남<br/>응팔, 성노을의",
								"shareImage"=>"055",
								"shareMessage1"=>"「응답하라 1988」의/‘성노을’",
								"shareMessage2"=>": 순수함의 절정! 행동파 뇌순남",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"2"=>array(
								"title"=>"곰같이 우직한 마음 따뜻한 남자<br/>응팔, 최무성의",
								"shareImage"=>"053",
								"shareMessage1"=>"「응답하라 1988」의/’최무성’",
								"shareMessage2"=>": 곰같이 우직한 마음 따뜻한 남자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"3"=>array(
								"title"=>"당차고 끈기 있는 남자<br/>미생, 장그래의",
								"shareImage"=>"052",
								"shareMessage1"=>"「미생」의/’장그래’",
								"shareMessage2"=>": 당차고 끈기 있는 남자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
						);

					} else if ($this->loverSex == 'F') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"까칠하고 도도한 순정파<br/>태양의 후예, 윤명주의",
								"shareImage"=>"054",
								"shareMessage1"=>"「태양의 후예」의/’윤명주’",
								"shareMessage2"=>": 까칠하고 도도한 순정파",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"2"=>array(
								"title"=>"호탕한 츤데레<br/>응팔, 라미란의",
								"shareImage"=>"056",
								"shareMessage1"=>"「응답하라 1988」의/’라미란’",
								"shareMessage2"=>": 호탕한 츤데레",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"3"=>array(
								"title"=>"책임감 넘치는 야무진 여자<br/>미생, 안영이의",
								"shareImage"=>"057",
								"shareMessage1"=>"「미생」의/’안영이’",
								"shareMessage2"=>": 책임감 넘치는 야무진 여자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
						);

					}

					// $randNumber = rand(1, 3);

					if (($this->D > 36.3) && ($this->D < 46.8)) {
						$randNumber = '1';
					} else if (($this->D > 25.8) && ($this->D < 36.3)) {
						$randNumber = '2';
					} else if (($this->D > 11.7) && ($this->D < 25.8)) {
						$randNumber = '3';
					} else {
						$randNumber = rand(1, 3);
					}

					(string) $this->title = $randomCharacter[$randNumber]['title'];
					$this->shareMessage1 = $randomCharacter[$randNumber]['shareMessage1'];
					$this->shareMessage2 = $randomCharacter[$randNumber]['shareMessage2'];
					$this->shareMessage3 = $randomCharacter[$randNumber]['shareMessage3'];

					$this->shareImage = $randomCharacter[$randNumber]['shareImage'];
					$this->traingleImage = '09';

	 			} else if ((($this->B - $this->C) >= 1) && (($this->B - $this->A) >= 1) && ($this->D > 46.8)) {
					
					(string) $this->challenge = "열정이 높은 성숙한 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 친밀감, 헌신(결심), 열정이 모두 높게 나타나고 있어요. ‘성숙한 사랑’이라 할 수 있습니다.<br/><br/>친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력, 성적 몰입을 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요. ";

					if ($this->loverSex == 'M') {

						(string) $this->title = "좋아하는 여자를 지켜주고 싶어하는 열정남<br/>마녀의 연애, 윤동하의";
						$this->comment = array(
							"" . $loverName . "님은 그 중 열정이 친밀감과 헌신(결심) 보다 다소 높게 나타나고 있어요. 이 세 가지 요소가 모두 높게 균형을 이루는 사랑을 ‘완벽한 사랑’이라고 해요. 완벽한 사랑으로 나아가기 위해  " . $loverName . "님께서는 상대방과 더 많이 소통하고 정신적으로 지지해 주세요. 또한 연인과의 장기적인 사랑을 위한 결심을 다져보시면 좋을 것 같아요. 하지만 ‘완벽한 사랑’이란 존재하기도 힘들 뿐더러 지키기도 어려워요. " . $loverName . "님께선 이미 세 가지 요소가 모두 높은 성숙한 사랑을 하고 계시기 때문에 앞으로도 이 사랑을 유지하기 위해 긍정적인 방향으로 노력해주시면 될 것 같아요. ",
						);

						$this->shareMessage1 = "「마녀의 연애」의/’윤동하’";
						$this->shareMessage2 = ": 좋아하는 여자를 지켜주고 싶어하는 열정남 ";
						$this->shareMessage3 = "열정이 높은/성숙한 사랑";

						$this->shareImage = "010";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "씩씩하고 꿋꿋한 내면이 강한 여자<br/>커피 프린스, 고은찬의";
						$this->comment = array(
							"" . $loverName . "님은 그 중 열정이 친밀감과 헌신(결심) 보다 다소 높게 나타나고 있어요. 이 세 가지 요소가 모두 높게 균형을 이루는 사랑을 ‘완벽한 사랑’이라고 해요. 완벽한 사랑으로 나아가기 위해  " . $loverName . "님께서는 상대방과 더 많이 소통하고 정신적으로 지지해 주세요. 또한 연인과의 장기적인 사랑을 위한 결심을 다져보시면 좋을 것 같아요. 하지만 ‘완벽한 사랑’이란 존재하기도 힘들 뿐더러 지키기도 어려워요. " . $loverName . "님께선 이미 세 가지 요소가 모두 높은 성숙한 사랑을 하고 계시기 때문에 앞으로도 이 사랑을 유지하기 위해 긍정적인 방향으로 노력해주시면 될 것 같아요. ",
						);

						$this->shareMessage1 = "「커피프린스」의/’고은찬’";
						$this->shareMessage2 = ": 씩씩하고 꿋꿋한 내면이 강한 여자";
						$this->shareMessage3 = "열정이 높은/성숙한 사랑";

						$this->shareImage = "035";

					}

					$this->traingleImage = '05';

	 			} else if ((($this->B - $this->C) >= 1) && (($this->B - $this->A) >= 1) && ($this->D <= 46.8)) {

	 				(string) $this->challenge = "성숙한 모양의 작은 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "은 친밀감, 헌신(결심), 열정이 모두 균형 있게 나타나고 있어요. 친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력과 성적 몰입을 강하게 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요";

					$this->comment = array(
						"‘성숙한 사랑’이란 3 가지 요소가 모두 높고 균형 잡힌 경우에만 볼 수 있는 결과랍니다. 하지만 " . $loverName . "의 사랑은 세 요소가 균형을 이루지만 전체적인 크기가 다소 부족해요. 보통 오래된 커플에서 많이 보이는 유형이기도 합니다.  다행히 이 3가지 요소의 균형이 잘 맞는 다는 것은 " . $loverName . "께서 성숙한 방향의 사랑을 하고 있다는 것을 뜻해요. 다소 전체적인 요소가 부족한 면이 있지만 이대로 감정의 크기를 키워 나가신다면 더 성숙한 사랑을 하실 수 있을 거에요. 그렇게 된다면 " . $loverName . "과 " . $loverName . "의 연인은 행복과 사랑이 더 돈독해지실 거에요. 이미 사랑하는 방법에 대해 잘 알고 계신 것 같으니 앞으로도 이 사랑을 유지하기 위해 좋은 방향으로 노력하시면 될 것 같습니다.",
					);

					if ($this->loverSex == 'M') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"순수함의 절정! 행동파 뇌순남<br/>응팔, 성노을의",
								"shareImage"=>"055",
								"shareMessage1"=>"「응답하라 1988」의/‘성노을’",
								"shareMessage2"=>": 순수함의 절정! 행동파 뇌순남",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"2"=>array(
								"title"=>"곰같이 우직한 마음 따뜻한 남자<br/>응팔, 최무성의",
								"shareImage"=>"053",
								"shareMessage1"=>"「응답하라 1988」의/’최무성’",
								"shareMessage2"=>": 곰같이 우직한 마음 따뜻한 남자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"3"=>array(
								"title"=>"당차고 끈기 있는 남자<br/>미생, 장그래의",
								"shareImage"=>"052",
								"shareMessage1"=>"「미생」의/’장그래’",
								"shareMessage2"=>": 당차고 끈기 있는 남자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
						);

					} else if ($this->loverSex == 'F') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"까칠하고 도도한 순정파<br/>태양의 후예, 윤명주의",
								"shareImage"=>"054",
								"shareMessage1"=>"「태양의 후예」의/’윤명주’",
								"shareMessage2"=>": 까칠하고 도도한 순정파",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"2"=>array(
								"title"=>"호탕한 츤데레<br/>응팔, 라미란의",
								"shareImage"=>"056",
								"shareMessage1"=>"「응답하라 1988」의/’라미란’",
								"shareMessage2"=>": 호탕한 츤데레",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"3"=>array(
								"title"=>"책임감 넘치는 야무진 여자<br/>미생, 안영이의",
								"shareImage"=>"057",
								"shareMessage1"=>"「미생」의/’안영이’",
								"shareMessage2"=>": 책임감 넘치는 야무진 여자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
						);

					}

					// $randNumber = rand(1, 3);

					if (($this->D > 36.3) && ($this->D < 46.8)) {
						$randNumber = '1';
					} else if (($this->D > 25.8) && ($this->D < 36.3)) {
						$randNumber = '2';
					} else if (($this->D > 11.7) && ($this->D < 25.8)) {
						$randNumber = '3';
					} else {
						$randNumber = rand(1, 3);
					}

					(string) $this->title = $randomCharacter[$randNumber]['title'];
					$this->shareMessage1 = $randomCharacter[$randNumber]['shareMessage1'];
					$this->shareMessage2 = $randomCharacter[$randNumber]['shareMessage2'];
					$this->shareMessage3 = $randomCharacter[$randNumber]['shareMessage3'];

					$this->shareImage = $randomCharacter[$randNumber]['shareImage'];
					$this->traingleImage = '09';

	 			} else {

					(string) $this->challenge = "열정 단계 오류";
					(string) $this->title = "";
					(string) $this->content = "";

	 			}

			} else if ((($this->C - $this->B) < 2) && (($this->C - $this->A) < 2) && (($this->C - $this->B) >= 0) && (($this->C - $this->A) >= 0)) {

				if ((($this->C - $this->B) < 1) && (($this->C - $this->A) < 1) && ($this->D > 89.5)) {
					
					(string) $this->challenge = "완벽한 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 친밀감, 헌신(결심), 열정이 모두 높게 나타나고 있어요. ‘완벽한 사랑’이란 성숙한 사랑의 유형 중에서도 3 가지 요소가 모두 높고 균형잡인 경우에만 볼 수 있는 결과랍니다.<br/><br/>친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력과 성적 몰입을 강하게 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요. ";

					if ($this->loverSex == 'M') {
						
						(string) $this->title = "사랑에 평생을 바쳐도 모자란 사랑꾼<br/>응팔 봉블리, 김정봉의";
						$this->comment = array(
							"이 3가지 요소가 모두 균형 있게 높다는 것은 " . $loverName . "님께서 굉장히 성숙한 사랑을 하고 있다는 것을 뜻해요. " . $loverName . "님의 연인은 정말 행복하실 것 같아요. 하지만 ‘완벽한 사랑’이란 이루기보다 지키기가 더 어려운 법이에요. 사랑하는 사람 또는 사랑 받는 사람의 상황에 따라 조금씩 달라질 수도 있어요. 하지만 이미 사랑하는 방법에 대해 잘 알고 계신 것 같으니 앞으로도 이 사랑을 유지하기 위해 좋은 방향으로 노력하시면 될 것 같습니다.",
						);

						$this->shareMessage1 = "「응답하라 1988」의/’김정봉’";
						$this->shareMessage2 = ": 사랑에 평생을 바쳐도 모자란 사랑꾼";
						$this->shareMessage3 = "/완벽한 사랑";

						$this->shareImage = "011";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "일도 사랑도 완벽한 여자<br/>오마이비너스, 강주은의";
						$this->comment = array(
							"이 3가지 요소가 모두 균형 있게 높다는 것은 " . $loverName . "님께서 굉장히 성숙한 사랑을 하고 있다는 것을 뜻해요. " . $loverName . "님의 연인은 정말 행복하실 것 같아요. 하지만 ‘완벽한 사랑’이란 이루기보다 지키기가 더 어려운 법이에요. 사랑하는 사람 또는 사랑 받는 사람의 상황에 따라 조금씩 달라질 수도 있어요. 하지만 이미 사랑하는 방법에 대해 잘 알고 계신 것 같으니 앞으로도 이 사랑을 유지하기 위해 좋은 방향으로 노력하시면 될 것 같습니다. ",
						);

						$this->shareMessage1 = "「오 마이 비너스」의/’강주은’";
						$this->shareMessage2 = ": 일도 사랑도 완벽한 여자";
						$this->shareMessage3 = "/완벽한 사랑";

						$this->shareImage = "020";

					}

					$this->traingleImage = '01';

	 			} else if ((($this->A - $this->B) < 1) && (($this->A - $this->C) < 1) && ($this->D <= 89.5) && ($this->D > 46.8)) {

					(string) $this->challenge = "성숙한 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "은 친밀감, 헌신(결심), 열정이 모두 균형 있게 나타나고 있어요. 친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력과 성적 몰입을 강하게 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요.";
					
					$this->comment = array(
						"‘성숙한 사랑’이란 위 3가지 요소가 모두 높고 균형 잡힌 경우에만 볼 수 있는 결과랍니다. 이 3가지 요소의 균형이 잘 맞는 다는 것은 " . $loverName . "께서 굉장히 성숙한 방향의 사랑을 하고 있다는 것을 뜻해요. 어느모로 보나 모두가 바라는 이상적인 모습의 사랑을 하고 계신 것이죠. 이대로 감정의 크기를 키워 나가신다면 모든 것인 완벽해서 꿈의 사랑이라고 불리는 완벽한 사랑도 가능 하실 것 같습니다. 그렇게 된다면 " . $loverName . "과 " . $loverName . "의 연인은 정말 행복하실 거에요. 이미 사랑하는 방법에 대해 잘 알고 계신 것 같으니 앞으로도 이 사랑을 유지하기 위해 좋은 방향으로 노력하시면 될 것 같습니다. ",
					);

					if ($this->loverSex == 'M') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"매사에 곧고 올바른 남자<br/>태양의 후예, 유시진의",
								"shareImage"=>"045",
								"shareMessage1"=>"「태양의 후예」의/’유시진’",
								"shareMessage2"=>": 매사에 곧고 올바른 남자",
								"shareMessage3"=>"/성숙한 사랑",
							),
							"2"=>array(
								"title"=>"여리면서도 강한 승부사<br/>응팔, 최택의",
								"shareImage"=>"047",
								"shareMessage1"=>"「응답하라 1988」의/’최택’",
								"shareMessage2"=>": 여리면서도 강한 승부사",
								"shareMessage3"=>"/성숙한 사랑",
							),
							"3"=>array(
								"title"=>"과묵하고 진지한 의지할 수 있는 남자<br/>태양의 후예, 서대영의",
								"shareImage"=>"050",
								"shareMessage1"=>"「태양의 후예」의/’서대영’",
								"shareMessage2"=>": 과묵하고 진지한 의지할 수 있는 남자",
								"shareMessage3"=>"/성숙한 사랑",
							),
						);

					} else if ($this->loverSex == 'F') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"털털하고 과감한 여자<br/>태양의 후예, 강모연의",
								"shareImage"=>"051",
								"shareMessage1"=>"「태양의 후예」의/’강모연’",
								"shareMessage2"=>": 털털하고 과감한 여자",
								"shareMessage3"=>"/성숙한 사랑",
							),
							"2"=>array(
								"title"=>"까칠하고 앙칼지지만 속마음은 따뜻한 여자<br/>응답하라 1988, 성보라의",
								"shareImage"=>"049",
								"shareMessage1"=>"「응답하라 1988」의/’성보라’",
								"shareMessage2"=>": 까칠하고 앙칼지지만 속마음은 따뜻한 여자",
								"shareMessage3"=>"/성숙한 사랑",
							),
							"3"=>array(
								"title"=>"언제나 밝고 긍정에너지가 넘치는 매력녀<br/>킬미힐미, 오리진의",
								"shareImage"=>"048",
								"shareMessage1"=>"「킬미힐미」의/’오리진’",
								"shareMessage2"=>": 언제나 밝고 긍정 에너지가 넘치는 매력녀",
								"shareMessage3"=>"/성숙한 사랑",
							),
						);

					}

					if (($this->D > 76.5) && ($this->D <= 89.5)) {

						if (($this->D > 83) && ($this->D <= 89.5)) {
							$randNumber = '1';
						} else if (($this->D > 80) && ($this->D < 83)) {
							$randNumber = '2';
						} else {
							$randNumber = '3';
						}

					} else if (($this->D > 63.5) && ($this->D < 76.5)) {
						
						if (($this->D > 72) && ($this->D < 76.5)) {
							$randNumber = '1';
						} else if (($this->D > 68) && ($this->D < 72)) {
							$randNumber = '2';
						} else {
							$randNumber = '3';
						}

					} else if (($this->D > 46.8) && ($this->D < 63.5)) {
						
						if (($this->D > 55) && ($this->D < 63.5)) {
							$randNumber = '1';
						} else if (($this->D > 46.8) && ($this->D < 55)) {
							$randNumber = '2';
						} else {
							$randNumber = '3';
						}

					} else {
						$randNumber = rand(1, 3);
					}

					(string) $this->title = $randomCharacter[$randNumber]['title'];
					$this->shareMessage1 = $randomCharacter[$randNumber]['shareMessage1'];
					$this->shareMessage2 = $randomCharacter[$randNumber]['shareMessage2'];
					$this->shareMessage3 = $randomCharacter[$randNumber]['shareMessage3'];

					$this->shareImage = $randomCharacter[$randNumber]['shareImage'];
					$this->traingleImage = '28';

	 			} else if ((($this->C - $this->B) < 1) && (($this->C - $this->A) < 1) && ($this->D <= 46.8)) {

	 				(string) $this->challenge = "성숙한 모양의 작은 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "은 친밀감, 헌신(결심), 열정이 모두 균형 있게 나타나고 있어요. 친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력과 성적 몰입을 강하게 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요";

					$this->comment = array(
						"‘성숙한 사랑’이란 3 가지 요소가 모두 높고 균형 잡힌 경우에만 볼 수 있는 결과랍니다. 하지만 " . $loverName . "의 사랑은 세 요소가 균형을 이루지만 전체적인 크기가 다소 부족해요. 보통 오래된 커플에서 많이 보이는 유형이기도 합니다.  다행히 이 3가지 요소의 균형이 잘 맞는 다는 것은 " . $loverName . "께서 성숙한 방향의 사랑을 하고 있다는 것을 뜻해요. 다소 전체적인 요소가 부족한 면이 있지만 이대로 감정의 크기를 키워 나가신다면 더 성숙한 사랑을 하실 수 있을 거에요. 그렇게 된다면 " . $loverName . "과 " . $loverName . "의 연인은 행복과 사랑이 더 돈독해지실 거에요. 이미 사랑하는 방법에 대해 잘 알고 계신 것 같으니 앞으로도 이 사랑을 유지하기 위해 좋은 방향으로 노력하시면 될 것 같습니다.",
					);

					if ($this->loverSex == 'M') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"순수함의 절정! 행동파 뇌순남<br/>응팔, 성노을의",
								"shareImage"=>"055",
								"shareMessage1"=>"「응답하라 1988」의/‘성노을’",
								"shareMessage2"=>": 순수함의 절정! 행동파 뇌순남",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"2"=>array(
								"title"=>"곰같이 우직한 마음 따뜻한 남자<br/>응팔, 최무성의",
								"shareImage"=>"053",
								"shareMessage1"=>"「응답하라 1988」의/’최무성’",
								"shareMessage2"=>": 곰같이 우직한 마음 따뜻한 남자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"3"=>array(
								"title"=>"당차고 끈기 있는 남자<br/>미생, 장그래의",
								"shareImage"=>"052",
								"shareMessage1"=>"「미생」의/’장그래’",
								"shareMessage2"=>": 당차고 끈기 있는 남자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
						);

					} else if ($this->loverSex == 'F') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"까칠하고 도도한 순정파<br/>태양의 후예, 윤명주의",
								"shareImage"=>"054",
								"shareMessage1"=>"「태양의 후예」의/’윤명주’",
								"shareMessage2"=>": 까칠하고 도도한 순정파",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"2"=>array(
								"title"=>"호탕한 츤데레<br/>응팔, 라미란의",
								"shareImage"=>"056",
								"shareMessage1"=>"「응답하라 1988」의/’라미란’",
								"shareMessage2"=>": 호탕한 츤데레",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"3"=>array(
								"title"=>"책임감 넘치는 야무진 여자<br/>미생, 안영이의",
								"shareImage"=>"057",
								"shareMessage1"=>"「미생」의/’안영이’",
								"shareMessage2"=>": 책임감 넘치는 야무진 여자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
						);

					}

					// $randNumber = rand(1, 3);

					if (($this->D > 36.3) && ($this->D < 46.8)) {
						$randNumber = '1';
					} else if (($this->D > 25.8) && ($this->D < 36.3)) {
						$randNumber = '2';
					} else if (($this->D > 11.7) && ($this->D < 25.8)) {
						$randNumber = '3';
					} else {
						$randNumber = rand(1, 3);
					}

					(string) $this->title = $randomCharacter[$randNumber]['title'];
					$this->shareMessage1 = $randomCharacter[$randNumber]['shareMessage1'];
					$this->shareMessage2 = $randomCharacter[$randNumber]['shareMessage2'];
					$this->shareMessage3 = $randomCharacter[$randNumber]['shareMessage3'];

					$this->shareImage = $randomCharacter[$randNumber]['shareImage'];
					$this->traingleImage = '09';

	 			} else if ((($this->C - $this->B) >= 1) && (($this->C - $this->A) < 1) && ($this->D > 46.8)) {
					
					(string) $this->challenge = "열정이 아쉬운 성숙한 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 친밀감, 헌신(결심), 열정이 모두 높게 나타나고 있어요. ‘성숙한 사랑’이라 할 수 있습니다.<br/><br/>친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력, 성적 몰입을 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "엉뚱한 장난꾸러기, 하지만 밤에는 2% 부족?<br/>응팔 정환 아빠 김성균의";
						$this->comment = array(
							"" . $loverName . "님은 그 중 열정이 친밀감과 헌신(결심) 보다 다소 낮게 나타나고 있어요. 이 세 가지 요소가 모두 높게 균형을 이루는 사랑을 ‘완벽한 사랑’이라고 해요. 완벽한 사랑으로 나아가기 위해 " . $loverName . "님께서는 사랑하는 감정을 아끼지 말고 적극적으로 표현해보세요. 하지만 ‘완벽한 사랑’이란 존재하기도 힘들 뿐더러 지키기도 어려워요. " . $loverName . "님께선 이미 세 가지 요소가 모두 높은 성숙한 사랑을 하고 계시기 때문에 앞으로도 이 사랑을 유지하기 위해 긍정적인 방향으로 노력해주시면 될 것 같아요.",
						);

						$this->shareMessage1 = "「응답하라 1988」의/’김성균’";
						$this->shareMessage2 = ": 엉뚱한 장난꾸러기, 하지만 밤에는 2% 부족?";
						$this->shareMessage3 = "열정이 아쉬운/성숙한 사랑";

						$this->shareImage = "025";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "내숭 없이 귀엽고 쾌활한<br/>응팔, 성덕선의";
						$this->comment = array(
							"" . $loverName . "님은 그 중 열정이 친밀감과 헌신(결심) 보다 다소 낮게 나타나고 있어요. 이 세 가지 요소가 모두 높게 균형을 이루는 사랑을 ‘완벽한 사랑’이라고 해요. 완벽한 사랑으로 나아가기 위해 " . $loverName . "님께서는 사랑하는 감정을 아끼지 말고 적극적으로 표현해보세요. 하지만 ‘완벽한 사랑’이란 존재하기도 힘들 뿐더러 지키기도 어려워요. " . $loverName . "님께선 이미 세 가지 요소가 모두 높은 성숙한 사랑을 하고 계시기 때문에 앞으로도 이 사랑을 유지하기 위해 긍정적인 방향으로 노력해주시면 될 것 같아요.",
						);

						$this->shareMessage1 = "「응답하라 1988」의/’성덕선’";
						$this->shareMessage2 = ": 내숭 없이 귀엽고 쾌활한 소녀";
						$this->shareMessage3 = "열정이 아쉬운/성숙한 사랑";

						$this->shareImage = "029";

					}

					$this->traingleImage = '03';

	 			} else if ((($this->C - $this->B) >= 1) && (($this->C - $this->A) < 1) && ($this->D <= 46.8)) {

	 				(string) $this->challenge = "성숙한 모양의 작은 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "은 친밀감, 헌신(결심), 열정이 모두 균형 있게 나타나고 있어요. 친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력과 성적 몰입을 강하게 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요";

					$this->comment = array(
						"‘성숙한 사랑’이란 3 가지 요소가 모두 높고 균형 잡힌 경우에만 볼 수 있는 결과랍니다. 하지만 " . $loverName . "의 사랑은 세 요소가 균형을 이루지만 전체적인 크기가 다소 부족해요. 보통 오래된 커플에서 많이 보이는 유형이기도 합니다.  다행히 이 3가지 요소의 균형이 잘 맞는 다는 것은 " . $loverName . "께서 성숙한 방향의 사랑을 하고 있다는 것을 뜻해요. 다소 전체적인 요소가 부족한 면이 있지만 이대로 감정의 크기를 키워 나가신다면 더 성숙한 사랑을 하실 수 있을 거에요. 그렇게 된다면 " . $loverName . "과 " . $loverName . "의 연인은 행복과 사랑이 더 돈독해지실 거에요. 이미 사랑하는 방법에 대해 잘 알고 계신 것 같으니 앞으로도 이 사랑을 유지하기 위해 좋은 방향으로 노력하시면 될 것 같습니다.",
					);

					if ($this->loverSex == 'M') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"순수함의 절정! 행동파 뇌순남<br/>응팔, 성노을의",
								"shareImage"=>"055",
								"shareMessage1"=>"「응답하라 1988」의/‘성노을’",
								"shareMessage2"=>": 순수함의 절정! 행동파 뇌순남",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"2"=>array(
								"title"=>"곰같이 우직한 마음 따뜻한 남자<br/>응팔, 최무성의",
								"shareImage"=>"053",
								"shareMessage1"=>"「응답하라 1988」의/’최무성’",
								"shareMessage2"=>": 곰같이 우직한 마음 따뜻한 남자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"3"=>array(
								"title"=>"당차고 끈기 있는 남자<br/>미생, 장그래의",
								"shareImage"=>"052",
								"shareMessage1"=>"「미생」의/’장그래’",
								"shareMessage2"=>": 당차고 끈기 있는 남자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
						);

					} else if ($this->loverSex == 'F') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"까칠하고 도도한 순정파<br/>태양의 후예, 윤명주의",
								"shareImage"=>"054",
								"shareMessage1"=>"「태양의 후예」의/’윤명주’",
								"shareMessage2"=>": 까칠하고 도도한 순정파",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"2"=>array(
								"title"=>"호탕한 츤데레<br/>응팔, 라미란의",
								"shareImage"=>"056",
								"shareMessage1"=>"「응답하라 1988」의/’라미란’",
								"shareMessage2"=>": 호탕한 츤데레",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"3"=>array(
								"title"=>"책임감 넘치는 야무진 여자<br/>미생, 안영이의",
								"shareImage"=>"057",
								"shareMessage1"=>"「미생」의/’안영이’",
								"shareMessage2"=>": 책임감 넘치는 야무진 여자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
						);

					}

					// $randNumber = rand(1, 3);

					if (($this->D > 36.3) && ($this->D < 46.8)) {
						$randNumber = '1';
					} else if (($this->D > 25.8) && ($this->D < 36.3)) {
						$randNumber = '2';
					} else if (($this->D > 11.7) && ($this->D < 25.8)) {
						$randNumber = '3';
					} else {
						$randNumber = rand(1, 3);
					}

					(string) $this->title = $randomCharacter[$randNumber]['title'];
					$this->shareMessage1 = $randomCharacter[$randNumber]['shareMessage1'];
					$this->shareMessage2 = $randomCharacter[$randNumber]['shareMessage2'];
					$this->shareMessage3 = $randomCharacter[$randNumber]['shareMessage3'];

					$this->shareImage = $randomCharacter[$randNumber]['shareImage'];
					$this->traingleImage = '09';

	 			} else if ((($this->C - $this->B) < 1) && (($this->C - $this->A) >= 1) && ($this->D > 46.8)) {
					
					(string) $this->challenge = "친밀이 아쉬운 성숙한 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 친밀감, 헌신(결심), 열정이 모두 높게 나타나고 있어요. ‘성숙한 사랑’이라 할 수 있습니다.<br/><br/>친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력, 성적 몰입을 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요. ";

					if ($this->loverSex == 'M') {

						(string) $this->title = "카리스마 넘치는 귀여운 남자<br/>오 나의 귀신님, 강선우의";
						$this->comment = array(
							"" . $loverName . "님은 그 중 친밀감이 열정과 헌신(결심) 보다 다소 낮게 나타나고 있어요. 이 세 가지 요소가 모두 높게 균형을 이루는 사랑을 ‘완벽한 사랑’이라고 해요. 완벽한 사랑으로 나아가기 위해 " . $loverName . "님께서는 상대방과 더 많이 소통하고 정신적으로 지지해 주시면 좋을 것 같아요. 하지만 ‘완벽한 사랑’이란 존재하기도 힘들 뿐더러 지키기도 어려워요. " . $loverName . "님께선 이미 세 가지 요소가 모두 높은 성숙한 사랑을 하고 계시기 때문에 앞으로도 이 사랑을 유지하기 위해 긍정적인 방향으로 노력해주시면 될 것 같아요. ",
						);

						$this->shareMessage1 = "「오 나의 귀신님」의/’강선우’";
						$this->shareMessage2 = ": 카리스마 넘치는 귀여운 남자";
						$this->shareMessage3 = "친밀감이 아쉬운/성숙한 사랑";

						$this->shareImage = "018";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "속마음이 시끄럽고 고민이 많아 사랑에도 조심스러운 여자<br/>치인트, 홍설의";
						$this->comment = array(
							"" . $loverName . "님은 그 중 친밀감이 열정과 헌신(결심) 보다 다소 낮게 나타나고 있어요. 이 세 가지 요소가 모두 높게 균형을 이루는 사랑을 ‘완벽한 사랑’이라고 해요. 완벽한 사랑으로 나아가기 위해 " . $loverName . "님께서는 상대방과 더 많이 소통하고 정신적으로 지지해 주시면 좋을 것 같아요. 하지만 ‘완벽한 사랑’이란 존재하기도 힘들 뿐더러 지키기도 어려워요. " . $loverName . "님께선 이미 세 가지 요소가 모두 높은 성숙한 사랑을 하고 계시기 때문에 앞으로도 이 사랑을 유지하기 위해 긍정적인 방향으로 노력해주시면 될 것 같아요. ",
						);

						$this->shareMessage1 = "「치즈 인 더 트랩」의/’홍설’";
						$this->shareMessage2 = ": 속마음이 시끄럽고 고민이 많아 사랑에도 조심스러운 여자";
						$this->shareMessage3 = "친밀감이 아쉬운/성숙한 사랑";

						$this->shareImage = "034";

					}

					$this->traingleImage = '06';

	 			} else if ((($this->C - $this->B) < 1) && (($this->C - $this->A) >= 1) && ($this->D <= 46.8)) {

	 				(string) $this->challenge = "성숙한 모양의 작은 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "은 친밀감, 헌신(결심), 열정이 모두 균형 있게 나타나고 있어요. 친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력과 성적 몰입을 강하게 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요";

					$this->comment = array(
						"‘성숙한 사랑’이란 3 가지 요소가 모두 높고 균형 잡힌 경우에만 볼 수 있는 결과랍니다. 하지만 " . $loverName . "의 사랑은 세 요소가 균형을 이루지만 전체적인 크기가 다소 부족해요. 보통 오래된 커플에서 많이 보이는 유형이기도 합니다.  다행히 이 3가지 요소의 균형이 잘 맞는 다는 것은 " . $loverName . "께서 성숙한 방향의 사랑을 하고 있다는 것을 뜻해요. 다소 전체적인 요소가 부족한 면이 있지만 이대로 감정의 크기를 키워 나가신다면 더 성숙한 사랑을 하실 수 있을 거에요. 그렇게 된다면 " . $loverName . "과 " . $loverName . "의 연인은 행복과 사랑이 더 돈독해지실 거에요. 이미 사랑하는 방법에 대해 잘 알고 계신 것 같으니 앞으로도 이 사랑을 유지하기 위해 좋은 방향으로 노력하시면 될 것 같습니다.",
					);

					if ($this->loverSex == 'M') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"순수함의 절정! 행동파 뇌순남<br/>응팔, 성노을의",
								"shareImage"=>"055",
								"shareMessage1"=>"「응답하라 1988」의/‘성노을’",
								"shareMessage2"=>": 순수함의 절정! 행동파 뇌순남",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"2"=>array(
								"title"=>"곰같이 우직한 마음 따뜻한 남자<br/>응팔, 최무성의",
								"shareImage"=>"053",
								"shareMessage1"=>"「응답하라 1988」의/’최무성’",
								"shareMessage2"=>": 곰같이 우직한 마음 따뜻한 남자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"3"=>array(
								"title"=>"당차고 끈기 있는 남자<br/>미생, 장그래의",
								"shareImage"=>"052",
								"shareMessage1"=>"「미생」의/’장그래’",
								"shareMessage2"=>": 당차고 끈기 있는 남자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
						);

					} else if ($this->loverSex == 'F') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"까칠하고 도도한 순정파<br/>태양의 후예, 윤명주의",
								"shareImage"=>"054",
								"shareMessage1"=>"「태양의 후예」의/’윤명주’",
								"shareMessage2"=>": 까칠하고 도도한 순정파",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"2"=>array(
								"title"=>"호탕한 츤데레<br/>응팔, 라미란의",
								"shareImage"=>"056",
								"shareMessage1"=>"「응답하라 1988」의/’라미란’",
								"shareMessage2"=>": 호탕한 츤데레",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"3"=>array(
								"title"=>"책임감 넘치는 야무진 여자<br/>미생, 안영이의",
								"shareImage"=>"057",
								"shareMessage1"=>"「미생」의/’안영이’",
								"shareMessage2"=>": 책임감 넘치는 야무진 여자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
						);

					}

					// $randNumber = rand(1, 3);

					if (($this->D > 36.3) && ($this->D < 46.8)) {
						$randNumber = '1';
					} else if (($this->D > 25.8) && ($this->D < 36.3)) {
						$randNumber = '2';
					} else if (($this->D > 11.7) && ($this->D < 25.8)) {
						$randNumber = '3';
					} else {
						$randNumber = rand(1, 3);
					}

					(string) $this->title = $randomCharacter[$randNumber]['title'];
					$this->shareMessage1 = $randomCharacter[$randNumber]['shareMessage1'];
					$this->shareMessage2 = $randomCharacter[$randNumber]['shareMessage2'];
					$this->shareMessage3 = $randomCharacter[$randNumber]['shareMessage3'];

					$this->shareImage = $randomCharacter[$randNumber]['shareImage'];
					$this->traingleImage = '09';

	 			} else if ((($this->C - $this->B) >= 1) && (($this->C - $this->A) >= 1) && ($this->D > 46.8)) {
					
					(string) $this->challenge = "헌신이 높은 성숙한 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 친밀감, 헌신(결심), 열정이 모두 높게 나타나고 있어요. ‘성숙한 사랑’이라 할 수 있습니다.<br/><br/>친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력, 성적 몰입을 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "한 여자만 바라보는 순정파<br/>별에서 온 그대, 이휘경의";
						$this->comment = array(
							"" . $loverName . "님은 그 중 헌신(결심)이 친밀감과 열정 보다 다소 높게 나타나고 있어요. 이 세 가지 요소가 모두 높게 균형을 이루는 사랑을 ‘완벽한 사랑’이라고 해요. 완벽한 사랑으로 나아가기 위해 " . $loverName . "님께서는 상대방과 더 많이 소통하고 정신적으로 지지해 주세요. 또한 사랑하는 감정을 아끼지 말고 적극적으로 표현해보세요. 하지만 ‘완벽한 사랑’이란 존재하기도 힘들 뿐더러 지키기도 어려워요. " . $loverName . "님께선 이미 세 가지 요소가 모두 높은 성숙한 사랑을 하고 계시기 때문에 앞으로도 이 사랑을 유지하기 위해 긍정적인 방향으로 노력해주시면 될 것 같아요",
						);

						$this->shareMessage1 = "「별에서 온 그대」의/’이휘경’";
						$this->shareMessage2 = ": 한 여자만 바라보는 순정파";
						$this->shareMessage3 = "헌신이 높은/성숙한 사랑";

						$this->shareImage = "013";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "정 많고 눈물 많은 흥부자<br/>응팔, 선우엄마의";
						$this->comment = array(
							"" . $loverName . "님은 그 중 헌신(결심)이 친밀감과 열정 보다 다소 높게 나타나고 있어요. 이 세 가지 요소가 모두 높게 균형을 이루는 사랑을 ‘완벽한 사랑’이라고 해요. 완벽한 사랑으로 나아가기 위해 " . $loverName . "님께서는 상대방과 더 많이 소통하고 정신적으로 지지해 주세요. 또한 사랑하는 감정을 아끼지 말고 적극적으로 표현해보세요. 하지만 ‘완벽한 사랑’이란 존재하기도 힘들 뿐더러 지키기도 어려워요. " . $loverName . "님께선 이미 세 가지 요소가 모두 높은 성숙한 사랑을 하고 계시기 때문에 앞으로도 이 사랑을 유지하기 위해 긍정적인 방향으로 노력해주시면 될 것 같아요. ",
						);

						$this->shareMessage1 = "「응답하라 1988」의/’김선영’";
						$this->shareMessage2 = ": 정 많고 눈물 많은 흥부자";
						$this->shareMessage3 = "헌신이 높은/성숙한 사랑";

						$this->shareImage = "024";

					}

					$this->traingleImage = '08';

	 			} else if ((($this->C - $this->B) >= 1) && (($this->C - $this->A) >= 1) && ($this->D <= 46.8)) {

	 				(string) $this->challenge = "성숙한 모양의 작은 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "은 친밀감, 헌신(결심), 열정이 모두 균형 있게 나타나고 있어요. 친밀감이란 연인을 이해하고 서로 많은 것을 공유하고 있는 듯한 느낌을 말해요. 친밀감이 높을 경우 서로 정서적 지지를 해주고 있다는 것을 뜻하기도 하지요. 열정은 연인에게서 육체적 매력과 성적 몰입을 강하게 느끼는 것을 말해요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 마음이 결심이에요";

					$this->comment = array(
						"‘성숙한 사랑’이란 3 가지 요소가 모두 높고 균형 잡힌 경우에만 볼 수 있는 결과랍니다. 하지만 " . $loverName . "의 사랑은 세 요소가 균형을 이루지만 전체적인 크기가 다소 부족해요. 보통 오래된 커플에서 많이 보이는 유형이기도 합니다.  다행히 이 3가지 요소의 균형이 잘 맞는 다는 것은 " . $loverName . "께서 성숙한 방향의 사랑을 하고 있다는 것을 뜻해요. 다소 전체적인 요소가 부족한 면이 있지만 이대로 감정의 크기를 키워 나가신다면 더 성숙한 사랑을 하실 수 있을 거에요. 그렇게 된다면 " . $loverName . "과 " . $loverName . "의 연인은 행복과 사랑이 더 돈독해지실 거에요. 이미 사랑하는 방법에 대해 잘 알고 계신 것 같으니 앞으로도 이 사랑을 유지하기 위해 좋은 방향으로 노력하시면 될 것 같습니다.",
					);

					if ($this->loverSex == 'M') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"순수함의 절정! 행동파 뇌순남<br/>응팔, 성노을의",
								"shareImage"=>"055",
								"shareMessage1"=>"「응답하라 1988」의/‘성노을’",
								"shareMessage2"=>": 순수함의 절정! 행동파 뇌순남",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"2"=>array(
								"title"=>"곰같이 우직한 마음 따뜻한 남자<br/>응팔, 최무성의",
								"shareImage"=>"053",
								"shareMessage1"=>"「응답하라 1988」의/’최무성’",
								"shareMessage2"=>": 곰같이 우직한 마음 따뜻한 남자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"3"=>array(
								"title"=>"당차고 끈기 있는 남자<br/>미생, 장그래의",
								"shareImage"=>"052",
								"shareMessage1"=>"「미생」의/’장그래’",
								"shareMessage2"=>": 당차고 끈기 있는 남자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
						);

					} else if ($this->loverSex == 'F') {

						$randomCharacter = array(
							"1"=>array(
								"title"=>"까칠하고 도도한 순정파<br/>태양의 후예, 윤명주의",
								"shareImage"=>"054",
								"shareMessage1"=>"「태양의 후예」의/’윤명주’",
								"shareMessage2"=>": 까칠하고 도도한 순정파",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"2"=>array(
								"title"=>"호탕한 츤데레<br/>응팔, 라미란의",
								"shareImage"=>"056",
								"shareMessage1"=>"「응답하라 1988」의/’라미란’",
								"shareMessage2"=>": 호탕한 츤데레",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
							"3"=>array(
								"title"=>"책임감 넘치는 야무진 여자<br/>미생, 안영이의",
								"shareImage"=>"057",
								"shareMessage1"=>"「미생」의/’안영이’",
								"shareMessage2"=>": 책임감 넘치는 야무진 여자",
								"shareMessage3"=>"성숙한 모양의/작은 사랑",
							),
						);

					}

					// $randNumber = rand(1, 3);

					if (($this->D > 36.3) && ($this->D < 46.8)) {
						$randNumber = '1';
					} else if (($this->D > 25.8) && ($this->D < 36.3)) {
						$randNumber = '2';
					} else if (($this->D > 11.7) && ($this->D < 25.8)) {
						$randNumber = '3';
					} else {
						$randNumber = rand(1, 3);
					}

					(string) $this->title = $randomCharacter[$randNumber]['title'];
					$this->shareMessage1 = $randomCharacter[$randNumber]['shareMessage1'];
					$this->shareMessage2 = $randomCharacter[$randNumber]['shareMessage2'];
					$this->shareMessage3 = $randomCharacter[$randNumber]['shareMessage3'];

					$this->shareImage = $randomCharacter[$randNumber]['shareImage'];
					$this->traingleImage = '09';
					
	 			} else {

					(string) $this->challenge = "헌신 단계 오류";
					(string) $this->title = "";
					(string) $this->content = "";

	 			}

			} else if ((($this->A - $this->B) >= 2) && (($this->A - $this->C) >= 2)) {

				if (($this->B <= 3) && ($this->C > 3)) {

					(string) $this->challenge = "열정이 없는 친구 같은 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 친밀감이 가장 높고 열정이 다소 부족한 ‘열정이 없는 친구 같은 사랑’에 속하시네요. 친밀감은 사랑하는 사람과 함께 있을 때 아주 중요한 감정으로 연인과 서로 편안한 감정을 가지며 상대방과 가깝고 연결되어 있는 느낌을 말해요. 서로 이해하는 마음으로 정서적 지지를 주고 받으며 친밀한 의사소통이 잘 이루어지는 것이지요. 친밀감이 가장 높은 " . $loverName . "님은 사랑하는 사람에게서 친구들과의 관계에서 느낄 수 있는 편안한 감정을 느낄 거에요.<br/><br/>" . $loverName . "님의 경우 상대와의 사랑을 오래 지속하고자 하는 헌신(결심)은 있으나 연인에게서 육체적 매력이나 성적 몰입은 약하게 느끼고 있는 것 같아요. 오래된 연인에게서 자주 볼 수 있는 사랑의 형태라고도 할 수 있어요. " . $loverName . "님의 마음을 좀더 적극적으로 표현하는 것이 사랑을 키우는데 도움이 될 거에요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "찌질한 구남친의 표본<br/>연애의 발견, 강태하의";
						$this->comment = array(
							"연인에게 꽃 선물을 해보시는 건 어떠세요? 기념일이 아닌 평범한 날에 불쑥 건네는 꽃 한 송이는 두 분의 사랑을 더 열정적이게 만들어 줄 거에요. 또 연인의 머리를 자주 쓰다듬거나 포옹할 때 머리를 감싸 안아주는 가벼운 스킨십을 늘려보세요. 여자친구가 겉으로 표현하지 않더라도 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요. ",
							"연인에게 꽃 선물을 해보시는 건 어떠세요? 기념일이 아닌 평범한 날에 불쑥 건네는 꽃 한 송이는 두 분의 사랑을 더 열정적이게 만들어 줄 거에요. 여자친구와 함께 운동을 하는 건 어떠세요? 같이 운동하다 보면 서로 의외의 섹시한 모습을 알 수 있을지도 몰라요. 단, 자신의 힘을 과시하거나 운동에 너무 심취하기 보다 여자친구분과 같이 하는 운동을 하며 세심히 챙겨주시면 좋을 것 같아요",
							"연인만을 위한 작은 선물을 해보세요. 은 선물은 평소에도 계속 상대방을 생각하고 있다는 것을 보여줄 수 있어요. 여자친구와 함께 운동을 해보는 건 어떠세요? 같이 운동하다 보면 서로 의외의 섹시한 모습을 알 수 있을지도 몰라요. 단, 자신의 힘을 과시하거나 운동에 너무 심취하기 보다 여자친구분과 같이 하는 운동을 하며 세심히 챙겨주시면 좋을 것 같아요.",
							"연인만을 위한 작은 선물을 해보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 상대방을 생각하고 있다는 것을 보여줄 수 있어요. 또 연인의 머리를 자주 쓰다듬거나 포옹할 때 머리를 감싸 안아주는 가벼운 스킨십을 늘려보세요. 여자친구가 겉으로 표현하지 않더라도 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요. ",
							"연인의 머리를 자주 쓰다듬거나 포옹할 때 머리를 감싸 안아주는 가벼운 스킨십을 늘려보세요. 여자친구가 겉으로 표현하지 않더라도 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요. 여자친구와 함께 운동을 하는 건 어떠세요? 같이 운동하다 보면 서로 의외의 섹시한 모습을 알 수 있을지도 몰라요. 단, 자신의 힘을 과시하거나 운동에 너무 심취하기 보다 여자친구분과 같이 하는 운동을 하며 세심히 챙겨주시면 좋을 것 같아요.",
						);

						$this->shareMessage1 = "「연애의 발견」의/’강태하’";
						$this->shareMessage2 = ": 찌질한 구남친의 표본";
						$this->shareMessage3 = "열정이 없는/친구 같은 사랑";

						$this->shareImage = "016";

					} else if ($this->loverSex == 'M') {

						(string) $this->title = "밀당의 고수도 오랜 사랑엔 어쩔 수 없다.<br/>연애의 발견, 한여름의";
						$this->comment = array(
							"남자친구를먼저 다가가 안기거나 손을 잡는 등 가벼운 스킨십을 해 보시는 건 어떠세요? 여자분이 먼저 하는 스킨십에 남자친구는 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요. 또 남자친구만을 위한 작은 선물을 해 보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 남자친구를 생각하고 있다는 것을 보여줄 수 있어요.",
							"먼저 다가가 안기거나 손을 잡는 등 가벼운 스킨십을 해 보시는 건 어떠세요? 여자분이 먼저 하는 스킨십에 남자친구는 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요. 남자친구와 함께 운동을 하는 건 어떠세요? 땀 흘리는 쌩얼을 보여주기 두렵다구요? 같이 운동하다 보면 의외의 섹시한 모습을 보여줄 수 있을지도 몰라요. 요즘은 헬스장에서도 커플이 같이 하는 운동이 많으니 시도해 봐요~",
							"남자친구만을 위한 작은 선물을 해 보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 남자친구를 생각하고 있다는 것을 보여줄 수 있어요. 남자친구와 함께 운동을 하는 건 어떠세요? 땀 흘리는 쌩얼을 보여주기 두렵다구요? 같이 운동하다 보면 의외의 섹시한 모습을 보여줄 수 있을지도 몰라요. 요즘은 헬스장에서도 커플이 같이 하는 운동이 많으니 시도해 봐요~ ",
						);

						$this->shareMessage1 = "「연애의 발견」의/’한여름’";
						$this->shareMessage2 = ": 오랜 사랑에 흔들리는 밀당의 고수";
						$this->shareMessage3 = "열정이 없는/친구 같은 사랑";

						$this->shareImage = "017";

					}

					$this->traingleImage = '11';

	 			} else if (($this->B > 3) && ($this->C <= 3)) {

					(string) $this->challenge = "헌신이 없는 친구 같은 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 친밀감이 가장 높고 헌신이 다소 부족한 ‘헌신이 없는 친구 같은 사랑’에 속하시네요. 친밀감은 사랑하는 사람과 함께 있을 때 아주 중요한 감정으로 연인과 서로 편안한 감정을 가지며 상대방과 가깝고 연결되어 있는 느낌을 말해요. 서로 이해하는 마음으로 정서적 지지를 주고 받으며 친밀한 의사소통이 잘 이루어지는 것이지요. 친밀감이 가장 높은 " . $loverName . "님은 사랑하는 사람에게서 친구들과의 관계에서 느낄 수 있는 편안한 감정을 느낄 거에요.<br/><br/>" . $loverName . "님의 경우 열정은 있으나 상대방이 잘 살 수 있도록 도와주고자 하는 헌신과 연인과의 사랑을 오래 지속하고 싶어하는 결심이 다소 낮은 편이에요. 지금의 사랑을 장기적으로 지속하고 싶다는 결심이 좀더 필요하신 것 같아요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "내 것 같지 않은 섹시한 남자<br/>식사를 합시다2, 구대영의";
						$this->comment = array(
							"연인에게 평소에 말하기 부끄러웠던 마음을 편지에 담아 표현해 보세요. 평소 몰랐던 마음을 연인이 알게 된다면 더 감동받으실 거에요. 또 연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"연인에게 평소에 말하기 부끄러웠던 마음을 편지에 담아 표현해 보세요. 평소 몰랐던 마음을 연인이 알게 된다면 더 감동받으실 거에요. 또 커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"커플 스냅사진을 찍어보는 건 어떠세요? 비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 두 분에게 좋은 기억들이 되어줄 거에요. 또 연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
						);

						$this->shareMessage1 = "「식샤를 합시다2」의/’구대영’";
						$this->shareMessage2 = ": 내 것 같지 않은 섹시한 남자";
						$this->shareMessage3 = "헌신이 없는/친구 같은 사랑";
						
						$this->shareImage = "014";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "삶도 사랑도 자유를 추구하는 여자<br/>포레스트 검프, 제니의";
						$this->comment = array(
							"남자친구를 위해 직접 데이트 코스를 계획 해 보세요. 이번에는 평소에 남자친구가 가보고 싶었던 곳, 먹고 싶었던 곳들을 체크해서 데려가 준다면 남자친구분께서 정말 감동받으실 거에요. 또 연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"남자친구를 위해 직접 데이트 코스를 계획 해 보세요. 이번에는 평소에 남자친구가 가보고 싶었던 곳, 먹고 싶었던 곳들을 체크해서 데려가 준다면 남자친구분께서 정말 감동받으실 거에요. 커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요",
							"남자친구를 위해 직접 데이트 코스를 계획 해 보세요. 이번에는 평소에 남자친구가 가보고 싶었던 곳, 먹고 싶었던 곳들을 체크해서 데려가 준다면 남자친구분께서 정말 감동받으실 거에요. 연인에게 평소에 말하기 부끄러웠던 마음을 편지에 담아 표현해 보세요. 평소 몰랐던 마음을 연인이 알게 된다면  " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"연인에게 평소에 말하기 부끄러웠던 마음을 편지에 담아 표현해 보세요. 평소 몰랐던 마음을 연인이 알게 된다면 더 감동받으실 거에요. 또 연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요",
							"커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 두 분에게 좋은 기억들이 되어줄 거에요. 또 연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요",
						);

						$this->shareMessage1 = "「포레스트 검프」의/’제니’";
						$this->shareMessage2 = ": 삶도 사랑도 자유를 추구하는 여자";
						$this->shareMessage3 = "헌신이 없는/친구 같은 사랑";

						$this->shareImage = "039";

					}

					$this->traingleImage = '12';

	 			} else {

					(string) $this->challenge = "친구 같은 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 친밀감이 가장 높은 ‘친구 같은 사랑’에 속하시네요.<br/>친밀감은 사랑하는 사람과 함께 있을 때 아주 중요한 감정으로 연인과 서로 편안한 감정을 가지며 상대방과 가깝고 연결되어 있는 느낌을 말해요. 서로 이해하는 마음으로 정서적 지지를 주고 받으며 친밀한 의사소통이 잘 이루어지는 것이지요.<br/><br/>친밀감이 가장 높은 " . $loverName . "님은 사랑하는 사람에게서 친구들과의 관계에서 느낄 수 있는 편안한 감정을 느낄 거에요. 그래서 연인 또한 " . $loverName . "님에게서 친밀하고 공유되어 있는 친구 같은 편안함을 느낄 수 있어요. 하지만 열정과 헌신이 상대적으로 낮기에 상대방이 낭만적이거나 헌신적인 사랑을 느끼기엔 부족할 수 있어요. 더 성숙한 사랑으로 가기 위해 연인에게 사랑하는 감정을 더 적극적으로 표현해 보시면 어떨까요?";

					if ($this->loverSex == 'M') {
						
						(string) $this->title = "사랑도 솔직 엉뚱하게 하는 남자<br/>피노키오, 최달포의";
						$this->comment = array(
							"연인에게 꽃 선물을 해보시는 건 어떠세요? 기념일이 아닌 평범한 날에 불쑥 건네는 꽃 한 송이는 두 분의 사랑을 더 열정적이게 만들어 줄 거에요. 또 평소에 말하기 부끄러웠던 마음을 편지에 담아 표현해 보세요. 평소 몰랐던 마음을 연인이 알게 된다면 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요",
							"연인에게 꽃 선물을 해보시는 건 어떠세요? 기념일이 아닌 평범한 날에 불쑥 건네는 꽃 한 송이는 두 분의 사랑을 더 열정적이게 만들어 줄 거에요.  또 연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"연인만을 위한 작은 선물을 해보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 상대방을 생각하고 있다는 것을 보여줄 수 있어요. 또 평소에 말하기 부끄러웠던 마음을 편지에 담아 표현해 보세요. 평소 몰랐던 마음을 연인이 알게 된다면 더 감동 받아 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요",
							"연인의 머리를 자주 쓰다듬거나 포옹할 때 머리를 감싸 안아주는 가벼운 스킨십을 늘려보세요. 여자친구가 겉으로 표현하지 않더라도 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요. 또 평소에 말하기 부끄러웠던 마음을 편지에 담아 표현해 보세요. 평소 몰랐던 마음을 연인이 알게 된다면 더 감동 받아 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요",
							"연인만을 위한 작은 선물을 해보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 상대방을 생각하고 있다는 것을 보여줄 수 있어요. 또 연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"연인의 머리를 자주 쓰다듬거나 포옹할 때 머리를 감싸 안아주는 가벼운 스킨십을 늘려보세요. 여자친구가 겉으로 표현하지 않더라도 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요. 또 연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
						);

						$this->shareMessage1 = "「피노키오」의/’최달포’";
						$this->shareMessage2 = ": 사랑도 솔직 엉뚱하게 하는 남자";
						$this->shareMessage3 = "/친구 같은 사랑";

						$this->shareImage = "044";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "반전 매력 가득한 여지녀<br/>오늘의 연애, 현우의’";
						$this->comment = array(
							"먼저 다가가 안기거나 손을 잡는 등 가벼운 스킨십을 해 보시는 것은 어떠세요? 여자분이 먼저 하는 스킨십에 남자친구는 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요. 또 남자친구를 위해 직접 데이트 코스를 계획 해 보세요 이번에는 평소에 남자친구가 가보고 싶었던 곳, 먹고 싶었던 곳들을 체크해서 데려가 준다면 " . $loverName . "님의 사랑이 오래 지속되게 해줄 거에요.",
							"남자친구만을 위한 작은 선물을 해 보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 남자친구를 생각하고 있다는 것을 보여줄 수 있어요. 또 남자친구를 위해 직접 데이트 코스를 계획 해 보세요 이번에는 평소에 남자친구가 가보고 싶었던 곳, 먹고 싶었던 곳들을 체크해서 데려가 준다면 " . $loverName . "님의 사랑이 오래 지속되게 해줄 거에요.",
							"남자친구와 함께 운동을 하는 건 어떠세요? 땀 흘리는 쌩얼을 보여주기 두렵다구요? 같이 운동하다 보면 의외의 섹시한 모습을 보여줄 수 있을지도 몰라요. 요즘은 헬스장에서도 커플이 같이 하는 운동이 많으니 시도해 봐요~ 또 남자친구를 위해 직접 데이트 코스를 계획 해 보세요 이번에는 평소에 남자친구가 가보고 싶었던 곳, 먹고 싶었던 곳들을 체크해서 데려가 준다면 " . $loverName . "님의 사랑이 오래 지속되게 해줄 거에요.",
							"먼저 다가가 안기거나 손을 잡는 등 가벼운 스킨십을 해 보시는건 어떠세요? 여자분이 먼저 하는 스킨십에 남자친구는 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요. 또 연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"남자친구만을 위한 작은 선물을 해 보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 남자친구를 생각하고 있다는 것을 보여줄 수 있어요.  또 연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"남자친구와 함께 운동을 하는 건 어떠세요? 땀 흘리는 쌩얼을 보여주기 두렵다구요? 같이 운동하다 보면 의외의 섹시한 모습을 보여줄 수 있을지도 몰라요. 요즘은 헬스장에서도 커플이 같이 하는 운동이 많으니 시도해 봐요~ 또 연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
						);

						$this->shareMessage1 = "「오늘의 연애」의/’현우’";
						$this->shareMessage2 = ": 반전 매력 가득한 여지녀";
						$this->shareMessage3 = "/친구 같은 사랑";

						$this->shareImage = "021";

					}

					$this->traingleImage = '10';

	 			}

			} else if ((($this->A - $this->B) >= 2) && (abs(($this->A - $this->C)) < 2)) {

				if ($this->B <= 3) {

					(string) $this->challenge = "열정이 없는 우애적 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 친밀과 헌신(결심)이 높은 ‘열정이 없는 우애적 사랑’에 속하시네요. ‘우애적 사랑’은 서로에게 편안한 마음을 갖고 이해하며 정서적 지지를 해 주는 친밀함이 높아 연인과 굉장히 가깝고 많은 것을 공유하고 있다는 느낌을 받고 계실 것 같아요.<br/><br/>단기적으로는 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 결심 또한 높아 보여요.<br/><br/>반면 연인에게서 육체적 매력, 성적 몰입을 느끼는 열정은 많이 부족해 보여요. 열정의 주된 원천인 육체적 매력이 약해지는 경우는 흔히 오래된 연인에게서 많이 보여지는 사랑의 유형이에요. 더 성숙한 사랑으로 가기 위해 연인에게 사랑하는 감정을 적극적으로 표현해 보시면 어떨까요?";

					if ($this->loverSex == 'M') {

						(string) $this->title = "사랑에 소극적이고 불안해 하는<br/>커피프린스, 최한성의";
						$this->comment = array(
							"연인에게 꽃 선물을 해보시는 건 어떠세요? 기념일이 아닌 평범한 날에 불쑥 건네는 꽃 한 송이는 두 분의 사랑을 더 열정적이게 만들어 줄 거에요. 또는 연인만을 위한 작은 선물을 해보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 상대방을 생각하고 있다는 것을 보여줄 수 있어요.",
							"연인만을 위한 작은 선물을 해보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 상대방을 생각하고 있다는 것을 보여줄 수 있어요. 또는 연인의 머리를 자주 쓰다듬거나 포옹할 때 머리를 감싸 안아주는 가벼운 스킨십을 늘려보세요. 여자친구가 겉으로 표현하지 않더라도 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요.",
							"연인만을 위한 작은 선물을 해보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 상대방을 생각하고 있다는 것을 보여줄 수 있어요. 또는 여자친구와 함께 운동을 하는 건 어떠세요? 같이 운동하다 보면 서로 의외의 섹시한 모습을 알 수 있을지도 몰라요. 단, 자신의 힘을 과시하거나 운동에 너무 심취하기 보다 여자친구분과 같이 하는 운동을 하며 세심하게 챙겨주세요.",
							"연인에게 꽃 선물을 해보시는 건 어떠세요? 기념일이 아닌 평범한 날에 불쑥 건네는 꽃 한 송이는 두 분의 사랑을 더 열정적이게 만들어 줄 거에요. 또는 연인의 머리를 자주 쓰다듬거나 포옹할 때 머리를 감싸 안아주는 가벼운 스킨십을 늘려보세요. 여자친구가 겉으로 표현하지 않더라도 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요.",
							"연인에게 꽃 선물을 해보시는 건 어떠세요? 기념일이 아닌 평범한 날에 불쑥 건네는 꽃 한 송이는 두 분의 사랑을 더 열정적이게 만들어 줄 거에요. 또는 여자친구와 함께 운동을 하는 건 어떠세요? 같이 운동하다 보면 서로 의외의 섹시한 모습을 알 수 있을지도 몰라요. 단, 자신의 힘을 과시하거나 운동에 너무 심취하기 보다 여자친구분과 같이 하는 운동을 하며 세심하게 챙겨주세요.",
						);

						$this->shareMessage1 = "「커피프린스」의/’최한성’";
						$this->shareMessage2 = ": 사랑에 소극적이고 불안해 하는 남자";
						$this->shareMessage3 = "열정이 없는/우애적 사랑";

						$this->shareImage = "036";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "사랑을 위해 죽음도 이겨낸 여자<br/>내 이름은 김삼순, 유희진의";
						$this->comment = array(
							"먼저 다가가 안기거나 손을 잡는 등 가벼운 스킨십을 해 보시는 건 어떠세요? 여자분이 먼저 하는 스킨십에 남자친구는 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요. 남자친구와 함께 운동을 하는 건 어떠세요? 땀 흘리는 쌩얼을 보여주기 두렵다구요? 같이 운동하다 보면 의외의 섹시한 모습을 보여줄 수 있을지도 몰라요.",
							"먼저 다가가 안기거나 손을 잡는 등 가벼운 스킨십을 해 보시는 건 어떠세요? 여자분이 먼저 하는 스킨십에 남자친구는 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요. 또는 남자친구만을 위한 작은 선물을 해 보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 남자친구를 생각하고 있다는 것을 보여줄 수 있어요.",
							"남자친구와 함께 운동을 하는 건 어떠세요? 땀 흘리는 쌩얼을 보여주기 두렵다구요? 같이 운동하다 보면 의외의 섹시한 모습을 보여줄 수 있을지도 몰라요. 또는 남자친구만을 위한 작은 선물을 해 보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 남자친구를 생각하고 있다는 것을 보여줄 수 있어요.",
						);

						$this->shareMessage1 = "「내 이름은 김삼순」의/’유희진’";
						$this->shareMessage2 = ": 사랑을 위해 죽음도 이겨낸 여자";
						$this->shareMessage3 = "열정이 없는/우애적 사랑";

						$this->shareImage = "009";

					}

					$this->traingleImage = '26';

	 			} else if (($this->B > 3) && ($this->D > 46.8)) {

					(string) $this->challenge = "우애적 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 친밀과 헌신(결심)이 높은 ‘우애적 사랑’에 속하시네요. ‘우애적 사랑’은 서로에게 편안한 마음을 갖고 이해하며 정서적 지지를 해 주는 친밀함이 높아 연인과 굉장히 가깝고 많은 것을 공유하고 있다는 느낌을 받고 계실 것 같아요.<br/><br/>단기적으로는 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 결심 또한 높아 상대적으로 견고한 사랑을 하고 계시는 것 같아요.<br/><br/>반면 친밀과 헌신에 비해 연인에게서 육체적 매력, 성적 몰입을 느끼는 열정은 다소 부족해 보여요. 더 성숙한 사랑으로 가기 위해 연인에게 사랑하는 감정을 더 적극적으로 표현 할 수 있는 방법이 무엇인지 고민해 보시면 좋을 것 같아요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "정 많고 책임감 있는 다혈질<br/>프로듀사, 라준모의";
						$this->comment = array(
							"연인에게 꽃 선물을 해보시는 건 어떠세요? 기념일이 아닌 평범한 날에 불쑥 건네는 꽃 한 송이는 두 분의 사랑을 더 열정적이게 만들어 줄 거에요.",
							"연인의 머리를 자주 쓰다듬거나 포옹할 때 머리를 감싸 안아주는 가벼운 스킨십을 늘려보세요. 여자친구가 겉으로 표현하지 않더라도 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요.",
							"연인만을 위한 작은 선물을 해보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 상대방을 생각하고 있다는 것을 보여줄 수 있어요.",
						);

						$this->shareMessage1 = "「프로듀사」의/’라준모’";
						$this->shareMessage2 = ": 정 많고 책임감 있는 다혈질";
						$this->shareMessage3 = "/우애적 사랑";

						$this->shareImage = "042";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "똑똑하고 도도하다가도 허당끼 가득한<br/>프로듀사, 탁예진의";
						$this->comment = array(
							"먼저 다가가 안기거나 손을 잡는 등 가벼운 스킨십을 해 보시는 건 어떠세요? 여자분이 먼저 하는 스킨십에 남자친구는 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요.",
							"남자친구와 함께 운동을 하는 건 어떠세요? 땀 흘리는 쌩얼을 보여주기 두렵다구요? 같이 운동하다 보면 의외의 섹시한 모습을 보여줄 수 있을지도 몰라요.",
							"남자친구만을 위한 작은 선물을 해 보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 남자친구를 생각하고 있다는 것을 보여줄 수 있어요.",
						);

						$this->shareMessage1 = "「프로듀사」의/’탁예진’";
						$this->shareMessage2 = ": 똑똑하고 도도하다가도 허당끼 가득한 매력녀";
						$this->shareMessage3 = "/우애적 사랑";

						$this->shareImage = "043";

					}

					$this->traingleImage = '23';

	 			} else if (($this->B > 3) && ($this->D <= 46.8)) {

					(string) $this->challenge = "사랑이 작은 우애적 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 친밀과 헌신(결심)이 높은 ‘우애적 사랑’에 속하시네요. ‘우애적 사랑’은 서로에게 편안한 마음을 갖고 이해하며 정서적 지지를 해 주는 친밀함이 높아 연인과 굉장히 가깝고 많은 것을 공유하고 있다는 느낌을 받고 계실 것 같아요.<br/><br/>단기적으로는 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 결심 또한 높아 상대적으로 견고한 사랑을 하고 계시는 것 같아요.<br/><br/>반면 친밀과 헌신에 비해 연인에게서 육체적 매력, 성적 몰입을 느끼는 열정은 다소 부족해 보여요. 마찬가지로 전반적인 사랑의 감정 역시 다소 부족한 것 같아요. 더 성숙한 사랑으로 가기 위해 사랑하는 감정을 더 키우고 연인에게 사랑하는 감정을 더 적극적으로 표현 할 수 있는 방법이 무엇인지 고민해 보시면 좋을 것 같아요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "정 많고 책임감 있는 다혈질<br/>프로듀사, 라준모보다 2% 부족한";
						$this->comment = array(
							"연인에게 꽃 선물을 해보시는 건 어떠세요? 기념일이 아닌 평범한 날에 불쑥 건네는 꽃 한 송이는 두 분의 사랑을 더 열정적이게 만들어 줄 거에요.",
							"연인의 머리를 자주 쓰다듬거나 포옹할 때 머리를 감싸 안아주는 가벼운 스킨십을 늘려보세요. 여자친구가 겉으로 표현하지 않더라도 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요.",
							"연인만을 위한 작은 선물을 해보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 상대방을 생각하고 있다는 것을 보여줄 수 있어요.",
						);

						$this->shareMessage1 = "「프로듀사」의/’2% 부족한 라준모’";
						$this->shareMessage2 = ": 정 많고 책임감 있는 다혈질";
						$this->shareMessage3 = "사랑이 작은/우애적 사랑";

						$this->shareImage = "042";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "똑똑하고 도도하다가도 허당끼 가득한<br/>프로듀사, 탁예진보다 2% 부족한";
						$this->comment = array(
							"먼저 다가가 안기거나 손을 잡는 등 가벼운 스킨십을 해 보시는 건 어떠세요? 여자분이 먼저 하는 스킨십에 남자친구는 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요. ",
							"남자친구와 함께 운동을 하는 건 어떠세요? 땀 흘리는 쌩얼을 보여주기 두렵다구요? 같이 운동하다 보면 의외의 섹시한 모습을 보여줄 수 있을지도 몰라요.",
							"남자친구만을 위한 작은 선물을 해 보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 남자친구를 생각하고 있다는 것을 보여줄 수 있어요.",
						);

						$this->shareMessage1 = "「프로듀사」의/’2% 부족한 탁예진’";
						$this->shareMessage2 = ": 똑똑하고 도도하다가도 허당끼 가득한 매력녀";
						$this->shareMessage3 = "사랑이 작은/우애적 사랑";

						$this->shareImage = "043";

					}

					$this->traingleImage = '24';

	 			}

			} else if ((($this->B - $this->A) >= 2) && (($this->B - $this->C) >= 2)) {

				if ($this->A <= 3) {

					(string) $this->challenge = "친밀이 없는 도취적 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 열정이 높고 친밀이 다소 낮은 ‘친밀감이 없는 도취적 사랑’에 속하시네요. 열정이 가장 높은 " . $loverName . "님은 사랑하는 관계에서 낭만과 육체적 매력, 성적 몰입과 같은 것들을 이끄는 욕망이 다른 요소 보다 높은 편이에요. 이런 타입은 상대에게 홀린 듯이 에너지를 많이 소모할 수 있고, 상대를 너무 이상화 시켜 사랑 받는 사람을 불편하게 할 수도 있어요. 상대를 이상화 할 경우 비 대칭적 사랑이 될 가능성이 있으며 사랑에 빠진 사람이 더 스트레스를 받을 수도 있어요.<br/><br/>사랑의 3요소 측면에서 볼 때 " . $loverName . "님은 연인과 서로 편안한 감정을 가지며 정서적 지지를 주고 받는 친밀감이 다소 낮은 편이에요. 연인과 서로를 이해하는 마음을 키워보시는 것이 장기적으로 " . $loverName . "님의 사랑에 도움이 될 거에요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "야심 가득한 남자<br/>프로듀사, 김홍순의";
						$this->comment = array(
							"여자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 또는 연인에게 꽃 선물을 해보세요. 기념일이 아닌 평범한 날에 불쑥 건네는 꽃 한 송이는 두 분의 사랑을 더 열정적이게 만들어 줄 거에요. ",
							"여자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 또는 연인만을 위한 작은 선물을 해보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 상대방을 생각하고 있다는 것을 보여줄 수 있어요. ",
							"여자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 또 연인의 머리를 자주 쓰다듬거나 포옹할 때 머리를 감싸 안아주는 가벼운 스킨십을 늘려보세요. 여자친구가 겉으로 표현하지 않더라도 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요. ",
						);

						$this->shareMessage1 = "「프로듀사」의/’김홍순’";
						$this->shareMessage2 = ": 야심 가득한 남자";
						$this->shareMessage3 = "친밀감이 없는/도취적 사랑";

						$this->shareImage = "041";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "순수한 표정 뒤에 도발적인 본능을 숨긴 여자<br/>그레이의 50가지 그림자, 아나스타샤의";
						$this->comment = array(
							"남자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 먼저 다가가 안기거나 손을 잡는 등 가벼운 스킨십을 해 보시는 건 어떠세요? 여자분이 먼저 하는 스킨십에 남자친구는 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요. ",
							"남자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 남자친구와 함께 운동을 하는 건 어떠세요? 땀 흘리는 쌩얼을 보여주기 두렵다구요? 같이 운동하다 보면 의외의 섹시한 모습을 보여줄 수 있을지도 몰라요.",
							"남자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 남자친구만을 위한 작은 선물을 해 보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 남자친구를 생각하고 있다는 것을 보여줄 수 있어요.",
						);

						$this->shareMessage1 = "「그레이의 50가지 그림자」의/’아나스타샤’";
						$this->shareMessage2 = ": 순수한 표정 뒤에 도발적인 본능을 숨긴 여자";
						$this->shareMessage3 = "친밀감이 없는/도취적 사랑";

						$this->shareImage = "007";

					}

					$this->traingleImage = '15';

	 			} else if ($this->C <= 3) {

					(string) $this->challenge = "헌신이 없는 도취적 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 열정이 높고 헌신이 다소 낮은 ‘헌신이 없는 도취적 사랑’에 속하시네요. 열정이 가장 높은 " . $loverName . "님은 사랑하는 관계에서 낭만과 육체적 매력, 성적 몰입과 같은 것들을 이끄는 욕망이 다른 요소 보다 높은 편이에요. 이런 타입은 상대에게 홀린 듯이 에너지를 많이 소모할 수 있고, 상대를 너무 이상화 시켜 사랑 받는 사람을 불편하게 할 수도 있어요. 상대를 이상화 할 경우 비 대칭적 사랑이 될 가능성이 있으며 사랑에 빠진 사람이 더 스트레스를 받을 수도 있어요.<br/><br/>" . $loverName . "님의 경우 상대방이 잘 살 수 있도록 도와주고자 하는 헌신과 연인과의 사랑을 오래 지속하고 싶어하는 결심이 다소 낮은 편이에요. 지금의 사랑을 장기적으로 지속하고 싶다는 결심이 좀더 필요하신 것 같아요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "귀여운 여심 저격수<br/>응팔, 도롱뇽의";
						$this->comment = array(
							"연인에게 평소에 말하기 부끄러웠던 마음을 편지에 담아 표현해 보세요. 평소 몰랐던 마음을 연인이 알게 된다면 더 감동받으실 거에요. 또 연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"연인에게 평소에 말하기 부끄러웠던 마음을 편지에 담아 표현해 보세요. 평소 몰랐던 마음을 연인이 알게 된다면 더 감동받으실 거에요. 또 연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 두 분에게 좋은 기억들이 되어줄 거에요. 또 연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
						);

						$this->shareMessage1 = "「응답하라 1988」의/’도롱뇽’";
						$this->shareMessage2 = ": 귀여운 여심 저격수";
						$this->shareMessage3 = "헌신이 없는/도취적 사랑";

						$this->shareImage = "028";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "섹시하면서도 우아한 커리어 우먼<br/>프로듀사, 고양미의";
						$this->comment = array(
							"남자친구를 위해 직접 데이트 코스를 계획 해 보세요. 이번에는 평소에 남자친구가 가보고 싶었던 곳, 먹고 싶었던 곳들을 체크해서 데려가 준다면 남자친구분께서 정말 감동받으실 거에요. 또 연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"남자친구를 위해 직접 데이트 코스를 계획 해 보세요. 이번에는 평소에 남자친구가 가보고 싶었던 곳, 먹고 싶었던 곳들을 체크해서 데려가 준다면 남자친구분께서 정말 감동받으실 거에요. 커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"남자친구를 위해 직접 데이트 코스를 계획 해 보세요. 이번에는 평소에 남자친구가 가보고 싶었던 곳, 먹고 싶었던 곳들을 체크해서 데려가 준다면 남자친구분께서 정말 감동받으실 거에요. 연인에게 평소에 말하기 부끄러웠던 마음을 편지에 담아 표현해 보세요. 평소 몰랐던 마음을 연인이 알게 된다면  " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"연인에게 평소에 말하기 부끄러웠던 마음을 편지에 담아 표현해 보세요. 평소 몰랐던 마음을 연인이 알게 된다면 더 감동받으실 거에요. 또 연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 두 분에게 좋은 기억들이 되어줄 거에요. 또 연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
						);

						$this->shareMessage1 = "「프로듀사」의/’고양미’";
						$this->shareMessage2 = ": 섹시하면서도 우아한 커리어우먼";
						$this->shareMessage3 = "헌신이 없는/도취적 사랑";

						$this->shareImage = "040";

					}

					$this->traingleImage = '13';

	 			} else {

					(string) $this->challenge = "도취적 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 열정이 높은 ‘도취적 사랑’에 속하시네요.열정이 가장 높은 " . $loverName . "님은 사랑하는 관계에서 낭만과 육체적 매력, 성적 몰입과 같은 것들을 이끄는 욕망이 다른 요소 보다 높은 편이에요. 이런 타입은 상대에게 홀린 듯이 에너지를 많이 소모할 수 있고, 상대를 너무 이상화 시켜 사랑 받는 사람을 불편하게 할 수도 있어요. 상대를 이상화 할 경우 비 대칭적 사랑이 될 가능성이 있으며 사랑에 빠진 사람이 더 스트레스를 받을 가능성도 있지요.<br/><br/>사랑의 3요소 측면에서 볼 때 " . $loverName . "님은 친밀감과 헌신(결심) 요소를 좀더 키우시면 좋을 것 같아요. 친밀감은 연인과 서로 편안한 감정을 가지며 정서적 지지를 주고 받는 것을 말해요. 헌신(결심)은 상대방이 잘 살 수 있도록 도와주고자 하는 마음과 연인과의 사랑을 오래 지속하고 싶어하는 약속이라고도 할 수 있어요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "거부할 수 없는 매력남<br/>그레이의 50가지 그림자, 그레이의";
						$this->comment = array(
							"연인과 취미를 공유해 보세요. 여자친구가 좋아하는 것들을 함께 하다 보면 아무리 작은 것일지라도 연인을 알아가는데 도움이 될 거에요. 또 연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요. ",
							"연인과 취미를 공유해 보세요. 여자친구가 좋아하는 것들을 함께 하다 보면 아무리 작은 것일지라도 연인을 알아가는데 도움이 될 거에요. 또 커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"연인과 취미를 공유해 보세요. 여자친구가 좋아하는 것들을 함께 하다 보면 아무리 작은 것일지라도 연인을 알아가는데 도움이 될 거에요. 또 평소에 말하기 부끄러웠던 마음을 편지에 담아 표현해 보세요. 평소 몰랐던 마음을 연인이 알게 된다면 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
						);

						$this->shareMessage1 = "「그레이의 50가지 그림자」의/’그레이’";
						$this->shareMessage2 = ": 거부할 수 없는 매력남";
						$this->shareMessage3 = "/도취적 사랑";

						$this->shareImage = "006";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "불꽃 같은 여자<br/>커피 프린스, 한유주의";
						$this->comment = array(
							"평소에 말하기 부끄러웠던 마음을 편지에 담아  표현해 보세요. 평소 몰랐던 마음을 연인이 알게 된다면 정말 감동 받으실 거에요. 남자친구의 취미를 공유해 보는 것은 어떠세요? 남자친구가 좋아하는 것들을 같이 하다 보면 서로를 알아가고 배려하는데 큰 도움이 될 거에요.",
							"남자친구를 위해 직접 데이트 코스를 계획 해 보세요 이번에는 평소에 남자친구가 가보고 싶었던 곳, 먹고 싶었던 곳들을 체크해서 데려가 준다면 " . $loverName . "님의 사랑이 오래 지속되게 해줄 거에요. 남자친구의 취미를 공유해 보는 것은 어떠세요? 남자친구가 좋아하는 것들을 같이 하다 보면 서로를 알아가고 배려하는데 큰 도움이 될 거에요.",
							"연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.<br/>남자친구의 취미를 공유해 보는 것은 어떠세요? 남자친구가 좋아하는 것들을 같이 하다 보면 서로를 알아가고 배려하는데 큰 도움이 될 거에요.",
							"커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요. 남자친구의 취미를 공유해 보는 것은 어떠세요? 남자친구가 좋아하는 것들을 같이 하다 보면 서로를 알아가고 배려하는데 큰 도움이 될 거에요.",
						);

						$this->shareMessage1 = "「커피 프린스」의/’한유주’";
						$this->shareMessage2 = ": 불꽃 같은 여자";
						$this->shareMessage3 = "/도취적 사랑";

						$this->shareImage = "037";

					}

					$this->traingleImage = '14';

	 			}

			} else if ((($this->B - $this->A) >= 2) && (abs(($this->B - $this->C)) < 2)) {

				if ($this->A <= 3) {

					(string) $this->challenge = "친밀감이 없는 얼빠진 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 헌신(결심)과 열정이 높고 친밀이 부족한 ‘친밀감이 없는 얼빠진 사랑’에 속하시네요.<br/>" . $loverName . "님은 연인에게서 육체적 매력, 성적 몰입을 느끼는 열정이 높아 낭만적인 관계일 가능성이 높아요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 결심 또한 강하게 나타나네요.<br/><br/>반면 친밀감이 낮아 상대와 많은 것을 공유하고 있지 않은 듯한 느낌 또는 서로를 이해하지 못하고 있다는 느낌을 받고 있을 수도 있어요. " . $loverName . "님은 연인과 성숙한 사랑으로 가기 위해 연인을 존중하고 편안한 마음을 갖는 것이 좋을 것 같아요. 상대를 이해하며 정서적 지지를 해 줄 수 있도록 노력이 조금 필요할 것 같네요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "사랑을 갈망하는 폭군<br/>왕의 남자, 연산군의";
						$this->comment = array(
							"여자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 또 같이 요리를 하거나 뭔가를 만들어 보는 등 연인과 함께하는 시간을 늘려보세요.",
							"여자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 같이 운동을 해보셔도 좋을 것 같아요. 평소에 잘 꾸민 멋진 모습만을 보여주기 보다 연인과 일상을 함께 하는 시간을 늘리면 서로를 더 잘 알 수 있는 기회가 될 거에요.",
						);

						$this->shareMessage1 = "「왕의 남자」의/’연산군’";
						$this->shareMessage2 = ": 사랑을 갈망하는 폭군";
						$this->shareMessage3 = "친밀감이 없는/얼빠진 사랑";

						$this->shareImage = "022";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "즉흥적인 단순파<br/>그녀는 예뻤다, 민하리의";
						$this->comment = array(
							"남자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 같이 운동을 해보셔도 좋을 것 같아요. 평소에 잘 꾸민 멋진 모습만을 보여주기 보다 연인과 일상을 함께 하는 시간을 늘리면 서로를 더 잘 알 수 있는 기회가 될 거에요.",
							"남자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 또 같이 요리를 하거나 뭔가를 만들어 보는 등 연인과 함께하는 시간을 늘려보아요.",
						);

						$this->shareMessage1 = "「그녀는 예뻤다」의/’민하리’";
						$this->shareMessage2 = ": 즉흥적인 단순파 ";
						$this->shareMessage3 = "친밀감 없는/얼빠진 사랑";

						$this->shareImage = "005";

					}

					$this->traingleImage = '27';

	 			} else if (($this->C > 3) && ($this->D > 46.8)) {

					(string) $this->challenge = "얼빠진 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 헌신(결심)과 열정이 높은 ‘얼빠진 사랑’에 속하시네요.<br/>" . $loverName . "님은 연인에게서 육체적 매력, 성적 몰입을 느끼는 열정이 높아 낭만적인 관계일 가능성이 높아요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 결심 또한 높아 보여요.<br/><br/>반면 친밀감이 다소 낮아 상대와 함께 하는 느낌이나 서로를 이해하는 느낌이 조금 부족하다고 느껴질 수도 있어요. " . $loverName . "님은 연인과 성숙한 사랑으로 가기 위해 서로에게 좀더 편안한 마음을 갖고 이해하며 정서적 지지를 해 주는 것이 좋을 것 같아요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "소심하지만 운명적 사랑을 꿈꾸는 순수남<br/>500일의 썸머, 탐의";
						$this->comment = array(
							"연인과 취미를 공유해 보는 것은 어떠세요? 서로에 대해 잘 알고 있다고 생각하더라도 항상 새로운 모습이 더 있기 마련이지요. 여자친구가 좋아하는 것들을 함께 하다 보면 작은 것들이라도 연인을 알아가는데 의외로 도움이 될 거에요.",
						);

						$this->shareMessage1 = "「500일의 썸머」의/’탐’";
						$this->shareMessage2 = ": 운명적 사랑을 꿈꾸는 순수남";
						$this->shareMessage3 = "/얼빠진 사랑";

						$this->shareImage = "002";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "사랑보다는 집착에 가까운 자기감정에 서툰 여자<br/>별에서 온 그대, 유세미의";
						$this->comment = array(
							"연인과 취미를 공유해 보는 것은 어떠세요? 서로에 대해 잘 알고 있다고 생각하더라도 항상 새로운 모습이 더 있기 마련이지요. 남자친구가 좋아하는 것들을 함께 하다 보면 작은 것들이라도 연인을 알아가는데 의외로 도움이 될 거에요.",
						);

						$this->shareMessage1 = "「별에서 온 그대」의/’유세미’";
						$this->shareMessage2 = ": 사랑보다는 집착에 가까운 자기감정에 서툰 여자";
						$this->shareMessage3 = "/얼빠진 사랑";

						$this->shareImage = "012";

					}

					$this->traingleImage = '19';

	 			} else if (($this->C > 3) && ($this->D <= 46.8)) {

					(string) $this->challenge = "사랑이 작은 얼빠진 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 헌신(결심)과 열정이 높은 ‘얼빠진 사랑’에 속하시네요.<br/>" . $loverName . "님은 연인에게서 육체적 매력, 성적 몰입을 느끼는 열정이 높아 낭만적인 관계일 가능성이 높아요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 결심 또한 높아 보여요.<br/><br/>반면 친밀감이 다소 낮고 사랑하는 감정의 크기가 다소 작아 상대와 함께 하는 느낌이나 서로를 이해하는 느낌이 조금 부족하다고 느껴질 수도 있어요. " . $loverName . "님은 연인과 성숙한 사랑으로 가기 위해 서로에 대한 감정을 키우는 한편, 좀더 편안한 마음을 갖고 이해하며 정서적 지지를 해 주는 것이 좋을 것 같아요. ";

					if ($this->loverSex == 'M') {

						(string) $this->title = "운명적 사랑을 꿈꾸는 순수남<br/>500일의 썸머, 탐보다 2% 부족한";
						$this->comment = array(
							"연인과 취미를 공유해 보는 것은 어떠세요? 서로에 대해 잘 알고 있다고 생각하더라도 항상 새로운 모습이 더 있기 마련이지요. 여자친구가 좋아하는 것들을 함께 하다 보면 작은 것들이라도 연인을 알아가는데 의외로 도움이 될 거에요.",
						);

						$this->shareMessage1 = "「500일의 썸머」의/’2% 부족한 탐’";
						$this->shareMessage2 = ": 운명적 사랑을 꿈꾸는 순수남";
						$this->shareMessage3 = "사랑이 작은/얼빠진 사랑";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "사랑보다는 집착에 가까운 자기감정에 서툰 여자<br/>별에서 온 그대, 유세미보다 2% 부족한";
						$this->comment = array(
							"연인과 취미를 공유해 보는 것은 어떠세요? 서로에 대해 잘 알고 있다고 생각하더라도 항상 새로운 모습이 더 있기 마련이지요. 남자친구가 좋아하는 것들을 함께 하다 보면 작은 것들이라도 연인을 알아가는데 의외로 도움이 될 거에요.",
						);

						$this->shareMessage1 = "「별에서 온 그대」의/’2% 부족한 유세미’";
						$this->shareMessage2 = ": 사랑보다는 집착에 가까운 자기감정에 서툰 여자";
						$this->shareMessage3 = "사랑이 작은/얼빠진 사랑";

						$this->shareImage = "012";

					}

					$this->traingleImage = '20';

	 			}

			} else if ((($this->C - $this->A) >= 2) && (($this->C -  $this->B) >= 2)) {

				if ($this->C <= 3) {

					(string) $this->challenge = "친밀감이 없는 공허한 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 헌신(결심)이 가장 높고 친밀이 다소 부족한 ‘친밀감이 없는 공허한 사랑’에 속하시네요. 헌신(결심)이 가장 높은 " . $loverName . "님은 단기적으로는 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 결심이 다른 요소보다 다소 높은 편이네요. 상대를 사랑하고 헌신하겠다고 결심하는 사랑은 무조건적인 배려에 사랑을 받는 사람이 부담감을 느낄 수도 있어요. 사랑을 주는 사람 또한 연인의 기쁨이 행복의 기준이기에 그 대상이 사라질 경우 큰 허탈감을 느끼기 쉬워요.<br/><br/>" . $loverName . "님은 연인과 성숙한 사랑으로 가기 위해 서로에게 편안한 마음을 갖고 이해하며 정서적 지지를 해 주는 것이 필요해요";

					if ($this->loverSex == 'M') {

						(string) $this->title = "소심하지만 용기 있는 순정남<br/>왕좌의 게임, 샘웰 탈리의";
						$this->comment = array(
							"여자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 또 같이 요리를 하거나 뭔가를 만들어 보는 등 연인과 함께하는 시간을 늘려보아요.",
							"여자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 같이 운동을 해보셔도 좋을 것 같아요. 평소에 잘 꾸민 멋진 모습만을 보여주기 보다 연인과 일상을 함께 하는 시간을 늘리면 서로를 더 잘 알 수 있는 기회가 될 거에요.",
						);

						$this->shareMessage1 = "「왕좌의 게임」의/’샘웰 탈리’";
						$this->shareMessage2 = ": 소심하지만 용기 있는 순정남";
						$this->shareMessage3 = "친밀감이 없는/공허한 사랑";

						$this->shareImage = "023";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "베일에 쌓인 듯한 신비한 매력녀<br/>인간중독, 종가흔의";
						$this->comment = array(
							"남자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 같이 운동을 해보셔도 좋을 것 같아요. 평소에 잘 꾸민 멋진 모습만을 보여주기 보다 연인과 일상을 함께 하는 시간을 늘리면 서로를 더 잘 알 수 있는 기회가 될 거에요.",
							"남자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 또 같이 요리를 하거나 뭔가를 만들어 보는 등 연인과 함께하는 시간을 늘려보아요.",
						);

						$this->shareMessage1 = "「인간중독」의/’종가흔’";
						$this->shareMessage2 = ": 베일에 쌓인 듯한 매력녀";
						$this->shareMessage3 = "친밀감이 없는/공허한 사랑";

						$this->shareImage = "031";

					}

					$this->traingleImage = '16';

	 			} else if ($this->B <= 3) {

					(string) $this->challenge = "열정이 없는 공허한 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 헌신(결심)이 가장 높고 열정이 다소 부족한 ‘열정이 없는 공허한 사랑’에 속하시네요.<br/>헌신(결심)이 가장 높은 " . $loverName . "님은 단기적으로는 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 결심이 다른 요소보다 다소 높은 편이네요. 연인과의 감정 몰입이나 육체적 매력을 다소 약하게 느끼고 있는 것 같아요. 상대를 사랑하고 헌신하겠다고 결심하는 사랑은 무조건적인 배려에 사랑을 받는 사람이 부담감을 느낄 수도 있어요. 사랑을 주는 사람 또한 연인의 기쁨이 행복의 기준이기에 그 대상이 사라질 경우 큰 허탈감을 느끼기 쉬워요.<br/><br/>" . $loverName . "님은 연인과 성숙한 사랑으로 가기 위해 연인에게 사랑하는 감정을 더 적극적으로 표현하는 것이 좋을 것 같아요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "하나의 목표만을 위해 달려가는 우직한 남자<br/>포레스트 검프, 검프의";
						$this->comment = array(
							"연인에게 꽃 선물을 해보시는 건 어떠세요? 기념일이 아닌 평범한 날에 불쑥 건네는 꽃 한 송이는 두 분의 사랑을 더 열정적이게 만들어 줄 거에요. 또는 연인만을 위한 작은 선물을 해보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 상대방을 생각하고 있다는 것을 보여줄 수 있어요.",
							"연인만을 위한 작은 선물을 해보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 상대방을 생각하고 있다는 것을 보여줄 수 있어요. 또는 연인의 머리를 자주 쓰다듬거나 포옹할 때 머리를 감싸 안아주는 가벼운 스킨십을 늘려보세요. 여자친구가 겉으로 표현하지 않더라도 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요.",
							"연인만을 위한 작은 선물을 해보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 상대방을 생각하고 있다는 것을 보여줄 수 있어요. 또는 여자친구와 함께 운동을 하는 건 어떠세요? 같이 운동하다 보면 서로 의외의 섹시한 모습을 알 수 있을지도 몰라요. 단, 자신의 힘을 과시하거나 운동에 너무 심취하기 보다 여자친구분과 같이 하는 운동을 하며 세심하게 챙겨주세요.",
							"연인에게 꽃 선물을 해보시는 건 어떠세요? 기념일이 아닌 평범한 날에 불쑥 건네는 꽃 한 송이는 두 분의 사랑을 더 열정적이게 만들어 줄 거에요. 또는 연인의 머리를 자주 쓰다듬거나 포옹할 때 머리를 감싸 안아주는 가벼운 스킨십을 늘려보세요. 여자친구가 겉으로 표현하지 않더라도 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요.",
							"연인에게 꽃 선물을 해보시는 건 어떠세요? 기념일이 아닌 평범한 날에 불쑥 건네는 꽃 한 송이는 두 분의 사랑을 더 열정적이게 만들어 줄 거에요. 또는 여자친구와 함께 운동을 하는 건 어떠세요? 같이 운동하다 보면 서로 의외의 섹시한 모습을 알 수 있을지도 몰라요. 단, 자신의 힘을 과시하거나 운동에 너무 심취하기 보다 여자친구분과 같이 하는 운동을 하며 세심하게 챙겨주세요.",
						);

						$this->shareMessage1 = "「포레스트 검프」의/’검프’";
						$this->shareMessage2 = ": 하나의 목표만을 위해 달려가는 우직한 남자";
						$this->shareMessage3 = "열정이 없는/공허한 사랑";

						$this->shareImage = "038";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "연애가 세상에서 가장 힘든 여자<br/>식샤를 합시다2, 백수지의";
						$this->comment = array(
							"먼저 다가가 안기거나 손을 잡는 등 가벼운 스킨십을 해 보시는 건 어떠세요? 여자분이 먼저 하는 스킨십에 남자친구는 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요.<br/>남자친구와 함께 운동을 하는 건 어떠세요? 땀 흘리는 쌩얼을 보여주기 두렵다구요? 같이 운동하다 보면 의외의 섹시한 모습을 보여줄 수 있을지도 몰라요.",
							"먼저 다가가 안기거나 손을 잡는 등 가벼운 스킨십을 해 보시는 건 어떠세요? 여자분이 먼저 하는 스킨십에 남자친구는 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요. 또는 남자친구만을 위한 작은 선물을 해 보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 남자친구를 생각하고 있다는 것을 보여줄 수 있어요.",
							"남자친구와 함께 운동을 하는 건 어떠세요? 땀 흘리는 쌩얼을 보여주기 두렵다구요? 같이 운동하다 보면 의외의 섹시한 모습을 보여줄 수 있을지도 몰라요. 또는 남자친구만을 위한 작은 선물을 해 보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 남자친구를 생각하고 있다는 것을 보여줄 수 있어요.",
						);

						$this->shareMessage1 = "「식샤를 합시다2」의/’백수지’";
						$this->shareMessage2 = ": 연애가 세상에서 가장 힘든 여자";
						$this->shareMessage3 = "열정이 없는/공허한 사랑";

						$this->shareImage = "015";

					}

					$this->traingleImage = '18';

	 			} else {

					(string) $this->challenge = "공허한 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 헌신(결심)이 가장 높은 ‘공허한 사랑’에 속하시네요.<br/>헌신(결심)이 가장 높은 " . $loverName . "님은 단기적으로는 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 결심이 다른 요소보다 다소 높은 편이네요. 이러한 사랑은 정체된 관계에서 주로 나타나 연인과의 감정 몰입이나 육체적 매력 또는 서로 이해하고 정서적으로 지지되고 있는 느낌을 다소 약하게 받고 있는 것 같아요. 상대를 사랑하고 헌신하겠다고 결심하는 사랑은 무조건적인 배려에 사랑을 받는 사람이 부담감을 느낄 수도 있어요. 사랑을 주는 사람 또한 연인의 기쁨이 행복의 기준이기에 그 대상이 사라질 경우 큰 허탈감을 느끼기 쉬워요.<br/><br/>" . $loverName . "님은 연인과 편안하고 존경하는 마음으로 서로를 이해하는 마음을 키우시는 것이 좋아요. 또 성숙한 사랑으로 가기 위해 연인에게 사랑하는 감정을 더 적극적으로 표현해 보시면 어떨까요?";

					if ($this->loverSex == 'M') {

						(string) $this->title = "가슴 아픈 순정남<br/>응팔, 김정환의";
						$this->comment = array(
							"여자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 또는 연인에게 꽃 선물을 해보세요. 기념일이 아닌 평범한 날에 불쑥 건네는 꽃 한 송이는 두 분의 사랑을 더 열정적이게 만들어 줄 거에요. ",
							"여자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 또는 연인만을 위한 작은 선물을 해보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 상대방을 생각하고 있다는 것을 보여줄 수 있어요. ",
							"여자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 또 연인의 머리를 자주 쓰다듬거나 포옹할 때 머리를 감싸 안아주는 가벼운 스킨십을 늘려보세요. 여자친구가 겉으로 표현하지 않더라도 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요. ",
						);

						$this->shareMessage1 = "「응답하라 1988」의/’김정환’";
						$this->shareMessage2 = ": 가슴 아픈 순정남";
						$this->shareMessage3 = "/공허한 사랑";

						$this->shareImage = "027";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "사랑을 갈구하는 여자<br/>검사외전, 김하나의";
						$this->comment = array(
							"남자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 먼저 다가가 안기거나 손을 잡는 등 가벼운 스킨십을 해 보시는 건 어떠세요? 여자분이 먼저 하는 스킨십에 남자친구는 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요. ",
							"남자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 남자친구와 함께 운동을 하는 건 어떠세요? 땀 흘리는 쌩얼을 보여주기 두렵다구요? 같이 운동하다 보면 의외의 섹시한 모습을 보여줄 수 있을지도 몰라요.",
							"남자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 남자친구만을 위한 작은 선물을 해 보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 남자친구를 생각하고 있다는 것을 보여줄 수 있어요.",
						);

						$this->shareMessage1 = "「검사외전」의/’김하나’";
						$this->shareMessage2 = ": 사랑을 갈구하는 여자";
						$this->shareMessage3 = "/공허한 사랑";

						$this->shareImage = "004";

					}

					$this->traingleImage = '17';

	 			}

			} else if ((($this->B - $this->C) >= 2) && (abs(($this->B - $this->A)) < 2)) {

				if ($this->C <= 3) {

					(string) $this->challenge = "헌신이 없는 낭만적 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 열정과 친밀이 높지만 헌신이 많이 부족한 ‘낭만적 사랑’에 속하시네요. ‘낭만적 사랑’은 서로에게 편안한 마음을 갖고 이해하며 정서적 지지를 해주는 친밀함이 높아 연인과 굉장히 가깝고 많은 것을 공유하고 있다는 느낌을 받고 계실 것 같아요.<br/><br/>연인에게서 육체적 매력, 성적 몰입을 느끼는 열정 또한 높아 낭만적인 관계일 가능성이 높아요. 반면 친밀과 열정에 비해 헌신(결심)부분이 크게 부족해 연인과 지속적으로 오래 사랑할 것 같지 않다는 느낌을 받고 있을 수도 있어요. 이 경우 지속적인 만남에 대한 준비를 하려 하지 않을 가능성이 있어요.<br/><br/>결과적으로 " . $loverName . "님은 더 성숙한 사랑을 위해 헌신(결심) 부분에 조금 더 많이 노력하신다면 좋을 것 같습니다. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신과 연인과의 사랑을 오래 지속하고 싶어하는 결심이 필요해요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "'힘들면 얘기해 밥 사줄께' 제대로 나쁜 남자<br/>건축학개론, 재욱의";
						$this->comment = array(
							"평소에 말하기 부끄러웠던 마음을 편지에 담아 표현해 보세요. 평소 몰랐던 마음을 연인이 알게 된다면 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요. 또는 연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"평소에 말하기 부끄러웠던 마음을 편지에 담아 표현해 보세요. 평소 몰랐던 마음을 연인이 알게 된다면 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요. 또는 커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감은 관계를 탄탄하게 유지시켜주는 좋은 추억이 될 거에요. 또는 커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
						);

						$this->shareMessage1 = "「건축학개론」의/’재욱’";
						$this->shareMessage2 = ": '힘들면 얘기해 밥 사줄께' 제대로 나쁜 남자";
						$this->shareMessage3 = "헌신이 없는/낭만적 사랑";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "상처받는 것이 두려워 운명을 믿지 않는 여자<br/>500일의 썸머, 썸머의";
						$this->comment = array(
							"연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감은 관계를 탄탄하게 유지시켜주는 좋은 추억이 될 거에요. 또는 남자친구를 위해 직접 데이트 코스를 계획 해 보세요 이번에는 평소에 남자친구가 가보고 싶었던 곳, 먹고 싶었던 곳들을 체크해서 데려가 준다면 " . $loverName . "님의 사랑이 오래 지속되게 해줄 거에요",
							"커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 관계를 탄탄하게 유지시켜줄 거에요. 또는 남자친구를 위해 직접 데이트 코스를 계획 해 보세요 이번에는 평소에 남자친구가 가보고 싶었던 곳, 먹고 싶었던 곳들을 체크해서 데려가 준다면 " . $loverName . "님의 사랑이 오래 지속되게 해줄 거에요.",
							"커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 관계를 탄탄하게 유지시켜줄 거에요. 또는 연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
						);

						$this->shareMessage1 = "「500일의 썸머」의/’썸머’";
						$this->shareMessage2 = ": 상처받는 것이 두려워 운명을 믿지 않는 여자";
						$this->shareMessage3 = "헌신이 없는/낭만적 사랑";

					}

					$this->traingleImage = '25';

	 			} else if (($this->C > 3) && ($this->D > 46.8)) {

					(string) $this->challenge = "낭만적 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 열정과 친밀이 높은 ‘낭만적 사랑’에 속하시네요.<br/>‘낭만적 사랑’은 서로에게 편안한 마음을 갖고 이해하며 정서적 지지를 해주는 친밀함이 높아 연인과 굉장히 가깝고 많은 것을 공유하고 있다는 느낌을 받고 계실 것 같아요.<br/><br/>연인에게서 육체적 매력, 성적 몰입을 느끼는 열정 또한 높아 낭만적인 관계일 가능성이 높아요. 반면 친밀과 열정에 비해 헌신(결심)부분이 다소 부족해 연인과 지속적으로 오래 사랑할 것 같지 않다는 느낌을 받고 있을 수도 있어요. 이 경우 지속적인 만남에 대해 조금은 모호하게 생각하고 계실 수도 있을 것 같네요.<br/><br/>결과적으로 " . $loverName . "님은 더 성숙한 사랑을 위해 상대방이 잘 살 수 있도록 도와주고자 하는 헌신과 연인과의 사랑을 오래 지속하고 싶어하는 결심에 대해 조금 더 고민해 보시면 좋을 것 같아요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "단순무식 다혈질이지만 좋아하는 여자에겐 따뜻한 스윗가이<br/>치인트, 백인호의";
						$this->comment = array(
							"연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요. ",
							"평소에 말하기 부끄러웠던 마음을 편지에 담아 표현해 보세요. 평소 몰랐던 마음을 연인이 알게 된다면 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요. ",
							"연인과 함께 커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
						);

						$this->shareMessage1 = "「치즈 인 더 트랩」의/’백인호’";
						$this->shareMessage2 = ": 단순무식, 다혈질이지만 좋아하는 여자에게는 따뜻한 스윗 가이";
						$this->shareMessage3 = "/낭만적 사랑";

						$this->shareImage = "032";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "뜨거운 하룻밤이 목표인 천덕꾸러기<br/>오 나의 귀신님, 순애의";
						$this->comment = array(
							"연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감은 관계를 탄탄하게 유지시켜주는 좋은 추억이 될 거에요.",
							"연인과 함께 커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 관계를 탄탄하게 유지시켜줄 거에요.",
							"남자친구를 위해 직접 데이트 코스를 계획 해 보는 건 어떠세요? 이번에는 평소에 남자친구가 가보고 싶었던 곳, 먹고 싶었던 곳들을 체크해서 데려가 준다면 " . $loverName . "님의 사랑이 오래 지속되게 해줄 거에요.",
						);

						$this->shareMessage1 = "「오 나의 귀신님」의/’순애’";
						$this->shareMessage2 = ": 뜨거운 하룻밤이 목표인 천덕꾸러기";
						$this->shareMessage3 = "/낭만적 사랑";

						$this->shareImage = "019";

					}

					$this->traingleImage = '21';

	 			} else if (($this->C > 3) && ($this->D <= 46.8)) {

					(string) $this->challenge = "사랑이 작은 낭만적 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 열정과 친밀이 높은 ‘낭만적 사랑’에 속하시네요.<br/>‘낭만적 사랑’은 서로에게 편안한 마음을 갖고 이해하며 정서적 지지를 해주는 친밀함이 높아 연인과 굉장히 가깝고 많은 것을 공유하고 있다는 느낌을 받고 계실 것 같아요. 연인에게서 육체적 매력, 성적 몰입을 느끼는 열정 또한 높아 낭만적인 관계일 가능성이 높아요.<br/><br/>반면 친밀과 열정에 비해 헌신(결심)부분이 다소 부족해 연인과 지속적으로 오래 사랑할 것 같지 않다는 느낌을 받고 있을 수도 있어요. 이 경우 지속적인 만남에 대해 조금은 모호하게 생각하고 계실 수도 있을 것 같네요. 그런데 " . $loverName . "님은 낭만적 사랑의 유형에 속하시지만 사랑의 크기가 다소 작은 편이시네요.  그렇기 때문에 전반적인 감정의 크기를 키우는 것에도 노력을 기울이시는 게 좋을 것 같습니다.<br/><br/>결과적으로 " . $loverName . "님은 더 성숙한 사랑을 위해 상대방이 잘 살 수 있도록 도와주고자 하는 헌신과 연인과의 사랑을 오래 지속하고 싶어하는 결심에 대해 조금 더 고민해보는 한편 연인에 대한 감정의 크기를 키우기 위한 방법도 생각해 보시면 좋을 것 같아요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "단순무식 다혈질이지만 좋아하는 여자에겐 따뜻한 스윗가이,<br/>치인트, 백인호보다 2% 부족한";
						$this->comment = array(
							"연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"평소에 말하기 부끄러웠던 마음을 편지에 담아 표현해 보세요. 평소 몰랐던 마음을 연인이 알게 된다면 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"연인과 함께 커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
						);

						$this->shareMessage1 = "「치즈 인 더 트랩」의/’2% 부족한 백인호’";
						$this->shareMessage2 = ": 단순무식, 다혈질이지만 좋아하는 여자에게는 따뜻한 스윗 가이";
						$this->shareMessage3 = "사랑이 작은/낭만적 사랑";

						$this->shareImage = "032";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "뜨거운 하룻밤이 목표인 천덕꾸러기<br/>오 나의 귀신님, 순애보다 2% 부족한";
						$this->comment = array(
							"연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감은 관계를 탄탄하게 유지시켜주는 좋은 추억이 될 거에요. ",
							"연인과 함께 커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 관계를 탄탄하게 유지시켜줄 거에요.",
							"남자친구를 위해 직접 데이트 코스를 계획 해 보는 건 어떠세요? 이번에는 평소에 남자친구가 가보고 싶었던 곳, 먹고 싶었던 곳들을 체크해서 데려가 준다면 " . $loverName . "님의 사랑이 오래 지속되게 해줄 거에요.",
						);

						$this->shareMessage1 = "「오 나의 귀신님」의/’2% 부족한 순애’";
						$this->shareMessage2 = ": 뜨거운 하룻밤이 목표인 천덕꾸러기";
						$this->shareMessage3 = "사랑이 작은/낭만적 사랑";

						$this->shareImage = "019";
					}

					$this->traingleImage = '22';

	 			}

			} else if ((($this->A - $this->B) < 2) && (($this->A - $this->C) >= 2)) {

				if ($this->C > 3) {

					(string) $this->challenge = "낭만적 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 열정과 친밀이 높은 ‘낭만적 사랑’에 속하시네요.<br/>‘낭만적 사랑’은 서로에게 편안한 마음을 갖고 이해하며 정서적 지지를 해주는 친밀함이 높아 연인과 굉장히 가깝고 많은 것을 공유하고 있다는 느낌을 받고 계실 것 같아요.<br/><br/>연인에게서 육체적 매력, 성적 몰입을 느끼는 열정 또한 높아 낭만적인 관계일 가능성이 높아요. 반면 친밀과 열정에 비해 헌신(결심)부분이 다소 부족해 연인과 지속적으로 오래 사랑할 것 같지 않다는 느낌을 받고 있을 수도 있어요. 이 경우 지속적인 만남에 대해 조금은 모호하게 생각하고 계실 수도 있을 것 같네요.<br/><br/>결과적으로 " . $loverName . "님은 더 성숙한 사랑을 위해 상대방이 잘 살 수 있도록 도와주고자 하는 헌신과 연인과의 사랑을 오래 지속하고 싶어하는 결심에 대해 조금 더 고민해 보시면 좋을 것 같아요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "단순무식 다혈질이지만 좋아하는 여자에겐 따뜻한 스윗가이<br/>치인트, 백인호의";
						$this->comment = array(
							"연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요. ",
							"평소에 말하기 부끄러웠던 마음을 편지에 담아 표현해 보세요. 평소 몰랐던 마음을 연인이 알게 된다면 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요. ",
							"연인과 함께 커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
						);

						$this->shareMessage1 = "「치즈 인 더 트랩」의/’백인호’";
						$this->shareMessage2 = ": 단순무식, 다혈질이지만 좋아하는 여자에게는 따뜻한 스윗 가이";
						$this->shareMessage3 = "/낭만적 사랑";

						$this->shareImage = "032";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "뜨거운 하룻밤이 목표인 천덕꾸러기<br/>오 나의 귀신님, 순애의";
						$this->comment = array(
							"연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감은 관계를 탄탄하게 유지시켜주는 좋은 추억이 될 거에요.",
							"연인과 함께 커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 관계를 탄탄하게 유지시켜줄 거에요.",
							"남자친구를 위해 직접 데이트 코스를 계획 해 보는 건 어떠세요? 이번에는 평소에 남자친구가 가보고 싶었던 곳, 먹고 싶었던 곳들을 체크해서 데려가 준다면 " . $loverName . "님의 사랑이 오래 지속되게 해줄 거에요.",
						);

						$this->shareMessage1 = "「오 나의 귀신님」의/’순애’";
						$this->shareMessage2 = ": 뜨거운 하룻밤이 목표인 천덕꾸러기";
						$this->shareMessage3 = "/낭만적 사랑";

						$this->shareImage = "019";

					}

					$this->traingleImage = '21';

	 			} else if (($this->C <= 3) && ($this->A > 6) && ($this->B > 6)) {

					(string) $this->challenge = "헌신이 없는 낭만적 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 열정과 친밀이 높지만 헌신이 많이 부족한 ‘낭만적 사랑’에 속하시네요. ‘낭만적 사랑’은 서로에게 편안한 마음을 갖고 이해하며 정서적 지지를 해주는 친밀함이 높아 연인과 굉장히 가깝고 많은 것을 공유하고 있다는 느낌을 받고 계실 것 같아요.<br/><br/>연인에게서 육체적 매력, 성적 몰입을 느끼는 열정 또한 높아 낭만적인 관계일 가능성이 높아요. 반면 친밀과 열정에 비해 헌신(결심)부분이 크게 부족해 연인과 지속적으로 오래 사랑할 것 같지 않다는 느낌을 받고 있을 수도 있어요. 이 경우 지속적인 만남에 대한 준비를 하려 하지 않을 가능성이 있어요.<br/><br/>결과적으로 " . $loverName . "님은 더 성숙한 사랑을 위해 헌신(결심) 부분에 조금 더 많이 노력하신다면 좋을 것 같습니다. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신과 연인과의 사랑을 오래 지속하고 싶어하는 결심이 필요해요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "'힘들면 얘기해 밥 사줄께' 제대로 나쁜 남자<br/>건축학개론, 재욱의";
						$this->comment = array(
							"평소에 말하기 부끄러웠던 마음을 편지에 담아 표현해 보세요. 평소 몰랐던 마음을 연인이 알게 된다면 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요. 또는 연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"평소에 말하기 부끄러웠던 마음을 편지에 담아 표현해 보세요. 평소 몰랐던 마음을 연인이 알게 된다면 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요. 또는 커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감은 관계를 탄탄하게 유지시켜주는 좋은 추억이 될 거에요. 또는 커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
						);

						$this->shareMessage1 = "「건축학개론」의/’재욱’";
						$this->shareMessage2 = ": '힘들면 얘기해 밥 사줄께' 제대로 나쁜 남자";
						$this->shareMessage3 = "헌신이 없는/낭만적 사랑";

						$this->shareImage = "003";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "상처받는 것이 두려워 운명을 믿지 않는 여자<br/>500일의 썸머, 썸머의";
						$this->comment = array(
							"연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감은 관계를 탄탄하게 유지시켜주는 좋은 추억이 될 거에요. 또는 남자친구를 위해 직접 데이트 코스를 계획 해 보세요 이번에는 평소에 남자친구가 가보고 싶었던 곳, 먹고 싶었던 곳들을 체크해서 데려가 준다면 " . $loverName . "님의 사랑이 오래 지속되게 해줄 거에요",
							"커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 관계를 탄탄하게 유지시켜줄 거에요. 또는 남자친구를 위해 직접 데이트 코스를 계획 해 보세요 이번에는 평소에 남자친구가 가보고 싶었던 곳, 먹고 싶었던 곳들을 체크해서 데려가 준다면 " . $loverName . "님의 사랑이 오래 지속되게 해줄 거에요.",
							"커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 관계를 탄탄하게 유지시켜줄 거에요. 또는 연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
						);

						$this->shareMessage1 = "「500일의 썸머」의/’썸머’";
						$this->shareMessage2 = ": 상처받는 것이 두려워 운명을 믿지 않는 여자";
						$this->shareMessage3 = "헌신이 없는/낭만적 사랑";

						$this->shareImage = "001";

					}

					$this->traingleImage = '25';

	 			} else {

					(string) $this->challenge = "사랑이 작은 낭만적 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 열정과 친밀이 높은 ‘낭만적 사랑’에 속하시네요.<br/>‘낭만적 사랑’은 서로에게 편안한 마음을 갖고 이해하며 정서적 지지를 해주는 친밀함이 높아 연인과 굉장히 가깝고 많은 것을 공유하고 있다는 느낌을 받고 계실 것 같아요. 연인에게서 육체적 매력, 성적 몰입을 느끼는 열정 또한 높아 낭만적인 관계일 가능성이 높아요.<br/><br/>반면 친밀과 열정에 비해 헌신(결심)부분이 다소 부족해 연인과 지속적으로 오래 사랑할 것 같지 않다는 느낌을 받고 있을 수도 있어요. 이 경우 지속적인 만남에 대해 조금은 모호하게 생각하고 계실 수도 있을 것 같네요. 그런데 " . $loverName . "님은 낭만적 사랑의 유형에 속하시지만 사랑의 크기가 다소 작은 편이시네요.  그렇기 때문에 전반적인 감정의 크기를 키우는 것에도 노력을 기울이시는 게 좋을 것 같습니다.<br/><br/>결과적으로 " . $loverName . "님은 더 성숙한 사랑을 위해 상대방이 잘 살 수 있도록 도와주고자 하는 헌신과 연인과의 사랑을 오래 지속하고 싶어하는 결심에 대해 조금 더 고민해보는 한편 연인에 대한 감정의 크기를 키우기 위한 방법도 생각해 보시면 좋을 것 같아요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "단순무식 다혈질이지만 좋아하는 여자에겐 따뜻한 스윗가이,<br/>치인트, 백인호보다 2% 부족한";
						$this->comment = array(
							"연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"평소에 말하기 부끄러웠던 마음을 편지에 담아 표현해 보세요. 평소 몰랐던 마음을 연인이 알게 된다면 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"연인과 함께 커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
						);

						$this->shareMessage1 = "「치즈 인 더 트랩」의/’2% 부족한 백인호’";
						$this->shareMessage2 = ": 단순무식, 다혈질이지만 좋아하는 여자에게는 따뜻한 스윗 가이";
						$this->shareMessage3 = "2% 부족한/낭만적 사랑";

						$this->shareImage = "032";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "뜨거운 하룻밤이 목표인 천덕꾸러기<br/>오 나의 귀신님, 순애보다 2% 부족한";
						$this->comment = array(
							"연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감은 관계를 탄탄하게 유지시켜주는 좋은 추억이 될 거에요. ",
							"연인과 함께 커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 관계를 탄탄하게 유지시켜줄 거에요.",
							"남자친구를 위해 직접 데이트 코스를 계획 해 보는 건 어떠세요? 이번에는 평소에 남자친구가 가보고 싶었던 곳, 먹고 싶었던 곳들을 체크해서 데려가 준다면 " . $loverName . "님의 사랑이 오래 지속되게 해줄 거에요.",
						);

						$this->shareMessage1 = "「오 나의 귀신님」의/’2% 부족한 순애’";
						$this->shareMessage2 = ": 뜨거운 하룻밤이 목표인 천덕꾸러기";
						$this->shareMessage3 = "사랑이 작은/낭만적 사랑";

						$this->shareImage = "019";

					}

					$this->traingleImage = '22';

	 			}

			} else if ((abs(($this->A - $this->B)) < 2) && (($this->A - $this->C) < 2)) {

				if ($this->C > 3) {

					(string) $this->challenge = "낭만적 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 열정과 친밀이 높은 ‘낭만적 사랑’에 속하시네요.<br/>‘낭만적 사랑’은 서로에게 편안한 마음을 갖고 이해하며 정서적 지지를 해주는 친밀함이 높아 연인과 굉장히 가깝고 많은 것을 공유하고 있다는 느낌을 받고 계실 것 같아요.<br/><br/>연인에게서 육체적 매력, 성적 몰입을 느끼는 열정 또한 높아 낭만적인 관계일 가능성이 높아요. 반면 친밀과 열정에 비해 헌신(결심)부분이 다소 부족해 연인과 지속적으로 오래 사랑할 것 같지 않다는 느낌을 받고 있을 수도 있어요. 이 경우 지속적인 만남에 대해 조금은 모호하게 생각하고 계실 수도 있을 것 같네요.<br/><br/>결과적으로 " . $loverName . "님은 더 성숙한 사랑을 위해 상대방이 잘 살 수 있도록 도와주고자 하는 헌신과 연인과의 사랑을 오래 지속하고 싶어하는 결심에 대해 조금 더 고민해 보시면 좋을 것 같아요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "단순무식 다혈질이지만 좋아하는 여자에겐 따뜻한 스윗가이<br/>치인트, 백인호의";
						$this->comment = array(
							"연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요. ",
							"평소에 말하기 부끄러웠던 마음을 편지에 담아 표현해 보세요. 평소 몰랐던 마음을 연인이 알게 된다면 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요. ",
							"연인과 함께 커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
						);

						$this->shareMessage1 = "「치즈 인 더 트랩」의/’백인호’";
						$this->shareMessage2 = ": 단순무식, 다혈질이지만 좋아하는 여자에게는 따뜻한 스윗 가이";
						$this->shareMessage3 = "/낭만적 사랑";

						$this->shareImage = "032";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "뜨거운 하룻밤이 목표인 천덕꾸러기<br/>오 나의 귀신님, 순애의";
						$this->comment = array(
							"연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감은 관계를 탄탄하게 유지시켜주는 좋은 추억이 될 거에요.",
							"연인과 함께 커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 관계를 탄탄하게 유지시켜줄 거에요.",
							"남자친구를 위해 직접 데이트 코스를 계획 해 보는 건 어떠세요? 이번에는 평소에 남자친구가 가보고 싶었던 곳, 먹고 싶었던 곳들을 체크해서 데려가 준다면 " . $loverName . "님의 사랑이 오래 지속되게 해줄 거에요.",
						);

						$this->shareMessage1 = "「오 나의 귀신님」의/’순애’";
						$this->shareMessage2 = ": 뜨거운 하룻밤이 목표인 천덕꾸러기";
						$this->shareMessage3 = "/낭만적 사랑";

						$this->shareImage = "019";

					}

					$this->traingleImage = '21';

	 			} else if (($this->C <= 3) && ($this->A > 6) && ($this->B > 6)) {

					(string) $this->challenge = "헌신이 없는 낭만적 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 열정과 친밀이 높지만 헌신이 많이 부족한 ‘낭만적 사랑’에 속하시네요. ‘낭만적 사랑’은 서로에게 편안한 마음을 갖고 이해하며 정서적 지지를 해주는 친밀함이 높아 연인과 굉장히 가깝고 많은 것을 공유하고 있다는 느낌을 받고 계실 것 같아요.<br/><br/>연인에게서 육체적 매력, 성적 몰입을 느끼는 열정 또한 높아 낭만적인 관계일 가능성이 높아요. 반면 친밀과 열정에 비해 헌신(결심)부분이 크게 부족해 연인과 지속적으로 오래 사랑할 것 같지 않다는 느낌을 받고 있을 수도 있어요. 이 경우 지속적인 만남에 대한 준비를 하려 하지 않을 가능성이 있어요.<br/><br/>결과적으로 " . $loverName . "님은 더 성숙한 사랑을 위해 헌신(결심) 부분에 조금 더 많이 노력하신다면 좋을 것 같습니다. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신과 연인과의 사랑을 오래 지속하고 싶어하는 결심이 필요해요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "'힘들면 얘기해 밥 사줄께' 제대로 나쁜 남자<br/>건축학개론, 재욱의";
						$this->comment = array(
							"평소에 말하기 부끄러웠던 마음을 편지에 담아 표현해 보세요. 평소 몰랐던 마음을 연인이 알게 된다면 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요. 또는 연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"평소에 말하기 부끄러웠던 마음을 편지에 담아 표현해 보세요. 평소 몰랐던 마음을 연인이 알게 된다면 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요. 또는 커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감은 관계를 탄탄하게 유지시켜주는 좋은 추억이 될 거에요. 또는 커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
						);

						$this->shareMessage1 = "「건축학개론」의/’재욱’";
						$this->shareMessage2 = ": '힘들면 얘기해 밥 사줄께' 제대로 나쁜 남자";
						$this->shareMessage3 = "헌신이 없는/낭만적 사랑";

						$this->shareImage = "003";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "상처받는 것이 두려워 운명을 믿지 않는 여자<br/>500일의 썸머, 썸머의";
						$this->comment = array(
							"연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감은 관계를 탄탄하게 유지시켜주는 좋은 추억이 될 거에요. 또는 남자친구를 위해 직접 데이트 코스를 계획 해 보세요 이번에는 평소에 남자친구가 가보고 싶었던 곳, 먹고 싶었던 곳들을 체크해서 데려가 준다면 " . $loverName . "님의 사랑이 오래 지속되게 해줄 거에요",
							"커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 관계를 탄탄하게 유지시켜줄 거에요. 또는 남자친구를 위해 직접 데이트 코스를 계획 해 보세요 이번에는 평소에 남자친구가 가보고 싶었던 곳, 먹고 싶었던 곳들을 체크해서 데려가 준다면 " . $loverName . "님의 사랑이 오래 지속되게 해줄 거에요.",
							"커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 관계를 탄탄하게 유지시켜줄 거에요. 또는 연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
						);

						$this->shareMessage1 = "「500일의 썸머」의/’썸머’";
						$this->shareMessage2 = ": 상처받는 것이 두려워 운명을 믿지 않는 여자";
						$this->shareMessage3 = "헌신이 없는/낭만적 사랑";

						$this->shareImage = "001";

					}

					$this->traingleImage = '25';

	 			} else {

					(string) $this->challenge = "사랑이 작은 낭만적 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 열정과 친밀이 높은 ‘낭만적 사랑’에 속하시네요.<br/>‘낭만적 사랑’은 서로에게 편안한 마음을 갖고 이해하며 정서적 지지를 해주는 친밀함이 높아 연인과 굉장히 가깝고 많은 것을 공유하고 있다는 느낌을 받고 계실 것 같아요. 연인에게서 육체적 매력, 성적 몰입을 느끼는 열정 또한 높아 낭만적인 관계일 가능성이 높아요.<br/><br/>반면 친밀과 열정에 비해 헌신(결심)부분이 다소 부족해 연인과 지속적으로 오래 사랑할 것 같지 않다는 느낌을 받고 있을 수도 있어요. 이 경우 지속적인 만남에 대해 조금은 모호하게 생각하고 계실 수도 있을 것 같네요. 그런데 " . $loverName . "님은 낭만적 사랑의 유형에 속하시지만 사랑의 크기가 다소 작은 편이시네요.  그렇기 때문에 전반적인 감정의 크기를 키우는 것에도 노력을 기울이시는 게 좋을 것 같습니다.<br/><br/>결과적으로 " . $loverName . "님은 더 성숙한 사랑을 위해 상대방이 잘 살 수 있도록 도와주고자 하는 헌신과 연인과의 사랑을 오래 지속하고 싶어하는 결심에 대해 조금 더 고민해보는 한편 연인에 대한 감정의 크기를 키우기 위한 방법도 생각해 보시면 좋을 것 같아요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "단순무식 다혈질이지만 좋아하는 여자에겐 따뜻한 스윗가이,<br/>치인트, 백인호보다 2% 부족한";
						$this->comment = array(
							"연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감과 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"평소에 말하기 부끄러웠던 마음을 편지에 담아 표현해 보세요. 평소 몰랐던 마음을 연인이 알게 된다면 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
							"연인과 함께 커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 " . $loverName . "님의 사랑을 오래 지속할 수 있도록 해줄 거에요.",
						);

						$this->shareMessage1 = "「치즈 인 더 트랩」의/’2% 부족한 백인호’";
						$this->shareMessage2 = ": 단순무식, 다혈질이지만 좋아하는 여자에게는 따뜻한 스윗 가이";
						$this->shareMessage3 = "사랑이 작은/낭만적 사랑";

						$this->shareImage = "032";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "뜨거운 하룻밤이 목표인 천덕꾸러기<br/>오 나의 귀신님, 순애보다 2% 부족한";
						$this->comment = array(
							"연인과 하고 싶은 일 리스트를 만들어 하나하나 이뤄보시는 것은 어떠세요? 목표가 크지 않아도 이뤄갈 때마다 느껴지는 성취감은 관계를 탄탄하게 유지시켜주는 좋은 추억이 될 거에요. ",
							"연인과 함께 커플 스냅사진을 찍어보는 건 어떠세요?  비싸고 화려한 사진이 아니어도 연인과 함께 소소하게 만든 추억들은 관계를 탄탄하게 유지시켜줄 거에요.",
							"남자친구를 위해 직접 데이트 코스를 계획 해 보는 건 어떠세요? 이번에는 평소에 남자친구가 가보고 싶었던 곳, 먹고 싶었던 곳들을 체크해서 데려가 준다면 " . $loverName . "님의 사랑이 오래 지속되게 해줄 거에요.",
						);

						$this->shareMessage1 = "「오 나의 귀신님」의/’2% 부족한 순애’";
						$this->shareMessage2 = ": 뜨거운 하룻밤이 목표인 천덕꾸러기";
						$this->shareMessage3 = "사랑이 작은/낭만적 사랑";

						$this->shareImage = "019";

					}

					$this->traingleImage = '22';

	 			}

			} else if ((($this->B - $this->C) < 2) && (($this->B - $this->A) >= 2)) {

				if ($this->A > 3) {
					
					(string) $this->challenge = "얼빠진 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 헌신(결심)과 열정이 높은 ‘얼빠진 사랑’에 속하시네요.<br/>" . $loverName . "님은 연인에게서 육체적 매력, 성적 몰입을 느끼는 열정이 높아 낭만적인 관계일 가능성이 높아요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 결심 또한 높아 보여요.<br/><br/>반면 친밀감이 다소 낮아 상대와 함께 하는 느낌이나 서로를 이해하는 느낌이 조금 부족하다고 느껴질 수도 있어요. " . $loverName . "님은 연인과 성숙한 사랑으로 가기 위해 서로에게 좀더 편안한 마음을 갖고 이해하며 정서적 지지를 해 주는 것이 좋을 것 같아요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "소심하지만 운명적 사랑을 꿈꾸는 순수남<br/>500일의 썸머, 탐의";
						$this->comment = array(
							"연인과 취미를 공유해 보는 것은 어떠세요? 서로에 대해 잘 알고 있다고 생각하더라도 항상 새로운 모습이 더 있기 마련이지요. 여자친구가 좋아하는 것들을 함께 하다 보면 작은 것들이라도 연인을 알아가는데 의외로 도움이 될 거에요.",
						);

						$this->shareMessage1 = "「500일의 썸머」의/’탐’";
						$this->shareMessage2 = ": 운명적 사랑을 꿈꾸는 순수남";
						$this->shareMessage3 = "/얼빠진 사랑";

						$this->shareImage = "002";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "사랑보다는 집착에 가까운 자기감정에 서툰 여자<br/>별에서 온 그대, 유세미의";
						$this->comment = array(
							"연인과 취미를 공유해 보는 것은 어떠세요? 서로에 대해 잘 알고 있다고 생각하더라도 항상 새로운 모습이 더 있기 마련이지요. 남자친구가 좋아하는 것들을 함께 하다 보면 작은 것들이라도 연인을 알아가는데 의외로 도움이 될 거에요.",
						);

						$this->shareMessage1 = "「별에서 온 그대」의/’유세미’";
						$this->shareMessage2 = ": 사랑보다는 집착에 가까운 자기감정에 서툰 여자";
						$this->shareMessage3 = "/얼빠진 사랑";

						$this->shareImage = "012";

					}

					$this->traingleImage = '19';

	 			} else if (($this->A <= 3) && ($this->C > 6) && ($this->B > 6)) {
					
					(string) $this->challenge = "친밀감이 없는 얼빠진 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 헌신(결심)과 열정이 높고 친밀이 부족한 ‘친밀감이 없는 얼빠진 사랑’에 속하시네요.<br/>" . $loverName . "님은 연인에게서 육체적 매력, 성적 몰입을 느끼는 열정이 높아 낭만적인 관계일 가능성이 높아요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 결심 또한 강하게 나타나네요.<br/><br/>반면 친밀감이 낮아 상대와 많은 것을 공유하고 있지 않은 듯한 느낌 또는 서로를 이해하지 못하고 있다는 느낌을 받고 있을 수도 있어요. " . $loverName . "님은 연인과 성숙한 사랑으로 가기 위해 연인을 존중하고 편안한 마음을 갖는 것이 좋을 것 같아요. 상대를 이해하며 정서적 지지를 해 줄 수 있도록 노력이 조금 필요할 것 같네요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "사랑을 갈망하는 폭군<br/>왕의 남자, 연산군의";
						$this->comment = array(
							"여자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 또 같이 요리를 하거나 뭔가를 만들어 보는 등 연인과 함께하는 시간을 늘려보세요.",
							"여자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 같이 운동을 해보셔도 좋을 것 같아요. 평소에 잘 꾸민 멋진 모습만을 보여주기 보다 연인과 일상을 함께 하는 시간을 늘리면 서로를 더 잘 알 수 있는 기회가 될 거에요.",
						);

						$this->shareMessage1 = "「왕의 남자」의/’연산군’";
						$this->shareMessage2 = ": 사랑을 갈망하는 폭군";
						$this->shareMessage3 = "친밀감이 없는/얼빠진 사랑";

						$this->shareImage = "022";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "즉흥적인 단순파<br/>그녀는 예뻤다, 민하리의";
						$this->comment = array(
							"남자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 같이 운동을 해보셔도 좋을 것 같아요. 평소에 잘 꾸민 멋진 모습만을 보여주기 보다 연인과 일상을 함께 하는 시간을 늘리면 서로를 더 잘 알 수 있는 기회가 될 거에요.",
							"남자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 또 같이 요리를 하거나 뭔가를 만들어 보는 등 연인과 함께하는 시간을 늘려보아요.",
						);

						$this->shareMessage1 = "「그녀는 예뻤다」의/’민하리’";
						$this->shareMessage2 = ": 즉흥적인 단순파 ";
						$this->shareMessage3 = "친밀감 없는/얼빠진 사랑";

						$this->shareImage = "005";

					}

					$this->traingleImage = '27';

	 			} else {
					
					(string) $this->challenge = "사랑이 작은 얼빠진 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 헌신(결심)과 열정이 높은 ‘얼빠진 사랑’에 속하시네요.<br/>" . $loverName . "님은 연인에게서 육체적 매력, 성적 몰입을 느끼는 열정이 높아 낭만적인 관계일 가능성이 높아요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 결심 또한 높아 보여요.<br/><br/>반면 친밀감이 다소 낮고 사랑하는 감정의 크기가 다소 작아 상대와 함께 하는 느낌이나 서로를 이해하는 느낌이 조금 부족하다고 느껴질 수도 있어요. " . $loverName . "님은 연인과 성숙한 사랑으로 가기 위해 서로에 대한 감정을 키우는 한편, 좀더 편안한 마음을 갖고 이해하며 정서적 지지를 해 주는 것이 좋을 것 같아요. ";

					if ($this->loverSex == 'M') {

						(string) $this->title = "운명적 사랑을 꿈꾸는 순수남<br/>500일의 썸머, 탐보다 2% 부족한";
						$this->comment = array(
							"연인과 취미를 공유해 보는 것은 어떠세요? 서로에 대해 잘 알고 있다고 생각하더라도 항상 새로운 모습이 더 있기 마련이지요. 여자친구가 좋아하는 것들을 함께 하다 보면 작은 것들이라도 연인을 알아가는데 의외로 도움이 될 거에요.",
						);

						$this->shareMessage1 = "「500일의 썸머」의/’2% 부족한 탐’";
						$this->shareMessage2 = ": 운명적 사랑을 꿈꾸는 순수남";
						$this->shareMessage3 = "사랑이 작은/얼빠진 사랑";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "사랑보다는 집착에 가까운 자기감정에 서툰 여자<br/>별에서 온 그대, 유세미보다 2% 부족한";
						$this->comment = array(
							"연인과 취미를 공유해 보는 것은 어떠세요? 서로에 대해 잘 알고 있다고 생각하더라도 항상 새로운 모습이 더 있기 마련이지요. 남자친구가 좋아하는 것들을 함께 하다 보면 작은 것들이라도 연인을 알아가는데 의외로 도움이 될 거에요.",
						);

						$this->shareMessage1 = "「별에서 온 그대」의/’2% 부족한 유세미’";
						$this->shareMessage2 = ": 사랑보다는 집착에 가까운 자기감정에 서툰 여자";
						$this->shareMessage3 = "사랑이 작은/얼빠진 사랑";

						$this->shareImage = "012";

					}

					$this->traingleImage = '20';

	 			}

			} else if ((abs(($this->B - $this->C)) < 2) && (($this->B - $this->A) < 2)) {
				
				if ($this->A > 3) {
					
					(string) $this->challenge = "얼빠진 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 헌신(결심)과 열정이 높은 ‘얼빠진 사랑’에 속하시네요.<br/>" . $loverName . "님은 연인에게서 육체적 매력, 성적 몰입을 느끼는 열정이 높아 낭만적인 관계일 가능성이 높아요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 결심 또한 높아 보여요.<br/><br/>반면 친밀감이 다소 낮아 상대와 함께 하는 느낌이나 서로를 이해하는 느낌이 조금 부족하다고 느껴질 수도 있어요. " . $loverName . "님은 연인과 성숙한 사랑으로 가기 위해 서로에게 좀더 편안한 마음을 갖고 이해하며 정서적 지지를 해 주는 것이 좋을 것 같아요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "소심하지만 운명적 사랑을 꿈꾸는 순수남<br/>500일의 썸머, 탐의 ";
						$this->comment = array(
							"연인과 취미를 공유해 보는 것은 어떠세요? 서로에 대해 잘 알고 있다고 생각하더라도 항상 새로운 모습이 더 있기 마련이지요. 여자친구가 좋아하는 것들을 함께 하다 보면 작은 것들이라도 연인을 알아가는데 의외로 도움이 될 거에요.",
						);

						$this->shareMessage1 = "「500일의 썸머」의/’탐’";
						$this->shareMessage2 = ": 운명적 사랑을 꿈꾸는 순수남";
						$this->shareMessage3 = "/얼빠진 사랑";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "사랑보다는 집착에 가까운 자기감정에 서툰 여자<br/>별에서 온 그대, 유세미의";
						$this->comment = array(
							"연인과 취미를 공유해 보는 것은 어떠세요? 서로에 대해 잘 알고 있다고 생각하더라도 항상 새로운 모습이 더 있기 마련이지요. 남자친구가 좋아하는 것들을 함께 하다 보면 작은 것들이라도 연인을 알아가는데 의외로 도움이 될 거에요.",
						);

						$this->shareMessage1 = "「별에서 온 그대」의/’유세미’";
						$this->shareMessage2 = ": 사랑보다는 집착에 가까운 자기감정에 서툰 여자";
						$this->shareMessage3 = "/얼빠진 사랑";

						$this->shareImage = "012";

					}

					$this->traingleImage = '19';

	 			} else if (($this->A <= 3) && ($this->C > 6) && ($this->B > 6)) {
					
					(string) $this->challenge = "친밀감이 없는 얼빠진 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 헌신(결심)과 열정이 높고 친밀이 부족한 ‘친밀감이 없는 얼빠진 사랑’에 속하시네요.<br/>" . $loverName . "님은 연인에게서 육체적 매력, 성적 몰입을 느끼는 열정이 높아 낭만적인 관계일 가능성이 높아요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 결심 또한 강하게 나타나네요.<br/><br/>반면 친밀감이 낮아 상대와 많은 것을 공유하고 있지 않은 듯한 느낌 또는 서로를 이해하지 못하고 있다는 느낌을 받고 있을 수도 있어요. " . $loverName . "님은 연인과 성숙한 사랑으로 가기 위해 연인을 존중하고 편안한 마음을 갖는 것이 좋을 것 같아요. 상대를 이해하며 정서적 지지를 해 줄 수 있도록 노력이 조금 필요할 것 같네요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "사랑을 갈망하는 폭군<br/>왕의 남자, 연산군의";
						$this->comment = array(
							"여자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 또 같이 요리를 하거나 뭔가를 만들어 보는 등 연인과 함께하는 시간을 늘려보세요.",
							"여자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 같이 운동을 해보셔도 좋을 것 같아요. 평소에 잘 꾸민 멋진 모습만을 보여주기 보다 연인과 일상을 함께 하는 시간을 늘리면 서로를 더 잘 알 수 있는 기회가 될 거에요.",
						);

						$this->shareMessage1 = "「왕의 남자」의/’연산군’";
						$this->shareMessage2 = ": 사랑을 갈망하는 폭군";
						$this->shareMessage3 = "친밀감이 없는/얼빠진 사랑";

						$this->shareImage = "022";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "즉흥적인 단순파<br/>그녀는 예뻤다, 민하리의";
						$this->comment = array(
							"남자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 같이 운동을 해보셔도 좋을 것 같아요. 평소에 잘 꾸민 멋진 모습만을 보여주기 보다 연인과 일상을 함께 하는 시간을 늘리면 서로를 더 잘 알 수 있는 기회가 될 거에요.",
							"남자친구의 취미를 공유해 보는 것은 어떠세요? 연인이 좋아하는 것을 알아가다 보면 아무리 작은 것일지라도 서로를 이해하는데 도움이 될 거에요. 또 같이 요리를 하거나 뭔가를 만들어 보는 등 연인과 함께하는 시간을 늘려보아요.",
						);

						$this->shareMessage1 = "「그녀는 예뻤다」의/’민하리’";
						$this->shareMessage2 = ": 즉흥적인 단순파 ";
						$this->shareMessage3 = "친밀감 없는/얼빠진 사랑";

						$this->shareImage = "005";

					}

					$this->traingleImage = '27';

	 			} else {
					
					(string) $this->challenge = "사랑이 작은 얼빠진 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 헌신(결심)과 열정이 높은 ‘얼빠진 사랑’에 속하시네요.<br/>" . $loverName . "님은 연인에게서 육체적 매력, 성적 몰입을 느끼는 열정이 높아 낭만적인 관계일 가능성이 높아요. 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 결심 또한 높아 보여요.<br/><br/>반면 친밀감이 다소 낮고 사랑하는 감정의 크기가 다소 작아 상대와 함께 하는 느낌이나 서로를 이해하는 느낌이 조금 부족하다고 느껴질 수도 있어요. " . $loverName . "님은 연인과 성숙한 사랑으로 가기 위해 서로에 대한 감정을 키우는 한편, 좀더 편안한 마음을 갖고 이해하며 정서적 지지를 해 주는 것이 좋을 것 같아요. ";

					if ($this->loverSex == 'M') {

						(string) $this->title = "운명적 사랑을 꿈꾸는 순수남<br/>500일의 썸머, 탐보다 2% 부족한";
						$this->comment = array(
							"연인과 취미를 공유해 보는 것은 어떠세요? 서로에 대해 잘 알고 있다고 생각하더라도 항상 새로운 모습이 더 있기 마련이지요. 여자친구가 좋아하는 것들을 함께 하다 보면 작은 것들이라도 연인을 알아가는데 의외로 도움이 될 거에요.",
						);

						$this->shareMessage1 = "「500일의 썸머」의/’2% 부족한 탐’";
						$this->shareMessage2 = ": 운명적 사랑을 꿈꾸는 순수남";
						$this->shareMessage3 = "사랑이 작은/얼빠진 사랑";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "사랑보다는 집착에 가까운 자기감정에 서툰 여자<br/>별에서 온 그대, 유세미보다 2% 부족한";
						$this->comment = array(
							"연인과 취미를 공유해 보는 것은 어떠세요? 서로에 대해 잘 알고 있다고 생각하더라도 항상 새로운 모습이 더 있기 마련이지요. 남자친구가 좋아하는 것들을 함께 하다 보면 작은 것들이라도 연인을 알아가는데 의외로 도움이 될 거에요.",
						);

						$this->shareMessage1 = "「별에서 온 그대」의/’2% 부족한 유세미’";
						$this->shareMessage2 = ": 사랑보다는 집착에 가까운 자기감정에 서툰 여자";
						$this->shareMessage3 = "사랑이 작은/얼빠진 사랑";

						$this->shareImage = "012";

					}

					$this->traingleImage = '20';

	 			}
			
			} else if ((abs(($this->C - $this->A)) < 2) && (($this->C -  $this->B) >= 2)) {

				if ($this->B > 3) {

					(string) $this->challenge = "우애적 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 친밀과 헌신(결심)이 높은 ‘우애적 사랑’에 속하시네요. ‘우애적 사랑’은 서로에게 편안한 마음을 갖고 이해하며 정서적 지지를 해 주는 친밀함이 높아 연인과 굉장히 가깝고 많은 것을 공유하고 있다는 느낌을 받고 계실 것 같아요.<br/><br/>단기적으로는 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 결심 또한 높아 상대적으로 견고한 사랑을 하고 계시는 것 같아요.<br/><br/>반면 친밀과 헌신에 비해 연인에게서 육체적 매력, 성적 몰입을 느끼는 열정은 다소 부족해 보여요. 더 성숙한 사랑으로 가기 위해 연인에게 사랑하는 감정을 더 적극적으로 표현 할 수 있는 방법이 무엇인지 고민해 보시면 좋을 것 같아요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "정 많고 책임감 있는 다혈질<br/>프로듀사, 라준모의";
						$this->comment = array(
							"연인에게 꽃 선물을 해보시는 건 어떠세요? 기념일이 아닌 평범한 날에 불쑥 건네는 꽃 한 송이는 두 분의 사랑을 더 열정적이게 만들어 줄 거에요.",
							"연인의 머리를 자주 쓰다듬거나 포옹할 때 머리를 감싸 안아주는 가벼운 스킨십을 늘려보세요. 여자친구가 겉으로 표현하지 않더라도 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요.",
							"연인만을 위한 작은 선물을 해보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 상대방을 생각하고 있다는 것을 보여줄 수 있어요.",
						);

						$this->shareMessage1 = "「프로듀사」의/’라준모’";
						$this->shareMessage2 = ": 정 많고 책임감 있는 다혈질";
						$this->shareMessage3 = "/우애적 사랑";

						$this->shareImage = "042";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "똑똑하고 도도하다가도 허당끼 가득한<br/>프로듀사, 탁예진의";
						$this->comment = array(
							"먼저 다가가 안기거나 손을 잡는 등 가벼운 스킨십을 해 보시는 건 어떠세요? 여자분이 먼저 하는 스킨십에 남자친구는 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요.",
							"남자친구와 함께 운동을 하는 건 어떠세요? 땀 흘리는 쌩얼을 보여주기 두렵다구요? 같이 운동하다 보면 의외의 섹시한 모습을 보여줄 수 있을지도 몰라요.",
							"남자친구만을 위한 작은 선물을 해 보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 남자친구를 생각하고 있다는 것을 보여줄 수 있어요.",
						);

						$this->shareMessage1 = "「프로듀사」의/’탁예진’";
						$this->shareMessage2 = ": 똑똑하고 도도하다가도 허당끼 가득한 매력녀";
						$this->shareMessage3 = "/우애적 사랑";

						$this->shareImage = "043";

					}

					$this->traingleImage = '23';

	 			} else if (($this->B <= 3) && ($this->C > 6) && ($this->A > 6)) {

					(string) $this->challenge = "열정이 없는 우애적 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 친밀과 헌신(결심)이 높은 ‘열정이 없는 우애적 사랑’에 속하시네요. ‘우애적 사랑’은 서로에게 편안한 마음을 갖고 이해하며 정서적 지지를 해 주는 친밀함이 높아 연인과 굉장히 가깝고 많은 것을 공유하고 있다는 느낌을 받고 계실 것 같아요.<br/><br/>단기적으로는 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 결심 또한 높아 보여요.<br/><br/>반면 연인에게서 육체적 매력, 성적 몰입을 느끼는 열정은 많이 부족해 보여요. 열정의 주된 원천인 육체적 매력이 약해지는 경우는 흔히 오래된 연인에게서 많이 보여지는 사랑의 유형이에요. 더 성숙한 사랑으로 가기 위해 연인에게 사랑하는 감정을 적극적으로 표현해 보시면 어떨까요?";

					if ($this->loverSex == 'M') {

						(string) $this->title = "사랑에 소극적이고 불안해 하는<br/>커피프린스, 최한성의";
						$this->comment = array(
							"연인에게 꽃 선물을 해보시는 건 어떠세요? 기념일이 아닌 평범한 날에 불쑥 건네는 꽃 한 송이는 두 분의 사랑을 더 열정적이게 만들어 줄 거에요. 또는 연인만을 위한 작은 선물을 해보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 상대방을 생각하고 있다는 것을 보여줄 수 있어요.",
							"연인만을 위한 작은 선물을 해보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 상대방을 생각하고 있다는 것을 보여줄 수 있어요. 또는 연인의 머리를 자주 쓰다듬거나 포옹할 때 머리를 감싸 안아주는 가벼운 스킨십을 늘려보세요. 여자친구가 겉으로 표현하지 않더라도 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요.",
							"연인만을 위한 작은 선물을 해보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 상대방을 생각하고 있다는 것을 보여줄 수 있어요. 또는 여자친구와 함께 운동을 하는 건 어떠세요? 같이 운동하다 보면 서로 의외의 섹시한 모습을 알 수 있을지도 몰라요. 단, 자신의 힘을 과시하거나 운동에 너무 심취하기 보다 여자친구분과 같이 하는 운동을 하며 세심하게 챙겨주세요.",
							"연인에게 꽃 선물을 해보시는 건 어떠세요? 기념일이 아닌 평범한 날에 불쑥 건네는 꽃 한 송이는 두 분의 사랑을 더 열정적이게 만들어 줄 거에요. 또는 연인의 머리를 자주 쓰다듬거나 포옹할 때 머리를 감싸 안아주는 가벼운 스킨십을 늘려보세요. 여자친구가 겉으로 표현하지 않더라도 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요.",
							"연인에게 꽃 선물을 해보시는 건 어떠세요? 기념일이 아닌 평범한 날에 불쑥 건네는 꽃 한 송이는 두 분의 사랑을 더 열정적이게 만들어 줄 거에요. 또는 여자친구와 함께 운동을 하는 건 어떠세요? 같이 운동하다 보면 서로 의외의 섹시한 모습을 알 수 있을지도 몰라요. 단, 자신의 힘을 과시하거나 운동에 너무 심취하기 보다 여자친구분과 같이 하는 운동을 하며 세심하게 챙겨주세요.",
						);

						$this->shareMessage1 = "「커피프린스」의/’최한성’";
						$this->shareMessage2 = ": 사랑에 소극적이고 불안해 하는 남자";
						$this->shareMessage3 = "열정이 없는/우애적 사랑";

						$this->shareImage = "036";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "사랑을 위해 죽음도 이겨낸 여자<br/>내 이름은 김삼순, 유희진의";
						$this->comment = array(
							"먼저 다가가 안기거나 손을 잡는 등 가벼운 스킨십을 해 보시는 건 어떠세요? 여자분이 먼저 하는 스킨십에 남자친구는 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요. 남자친구와 함께 운동을 하는 건 어떠세요? 땀 흘리는 쌩얼을 보여주기 두렵다구요? 같이 운동하다 보면 의외의 섹시한 모습을 보여줄 수 있을지도 몰라요.",
							"먼저 다가가 안기거나 손을 잡는 등 가벼운 스킨십을 해 보시는 건 어떠세요? 여자분이 먼저 하는 스킨십에 남자친구는 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요. 또는 남자친구만을 위한 작은 선물을 해 보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 남자친구를 생각하고 있다는 것을 보여줄 수 있어요.",
							"남자친구와 함께 운동을 하는 건 어떠세요? 땀 흘리는 쌩얼을 보여주기 두렵다구요? 같이 운동하다 보면 의외의 섹시한 모습을 보여줄 수 있을지도 몰라요. 또는 남자친구만을 위한 작은 선물을 해 보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 남자친구를 생각하고 있다는 것을 보여줄 수 있어요.",
						);

						$this->shareMessage1 = "「내 이름은 김삼순」의/’유희진’";
						$this->shareMessage2 = ": 사랑을 위해 죽음도 이겨낸 여자";
						$this->shareMessage3 = "열정이 없는/우애적 사랑";

						$this->shareImage = "009";

					}

					$this->traingleImage = '26';

	 			} else {

					(string) $this->challenge = "사랑이 작은 우애적 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 친밀과 헌신(결심)이 높은 ‘우애적 사랑’에 속하시네요. ‘우애적 사랑’은 서로에게 편안한 마음을 갖고 이해하며 정서적 지지를 해 주는 친밀함이 높아 연인과 굉장히 가깝고 많은 것을 공유하고 있다는 느낌을 받고 계실 것 같아요.<br/><br/>단기적으로는 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 결심 또한 높아 상대적으로 견고한 사랑을 하고 계시는 것 같아요.<br/><br/>반면 친밀과 헌신에 비해 연인에게서 육체적 매력, 성적 몰입을 느끼는 열정은 다소 부족해 보여요. 마찬가지로 전반적인 사랑의 감정 역시 다소 부족한 것 같아요. 더 성숙한 사랑으로 가기 위해 사랑하는 감정을 더 키우고 연인에게 사랑하는 감정을 더 적극적으로 표현 할 수 있는 방법이 무엇인지 고민해 보시면 좋을 것 같아요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "정 많고 책임감 있는 다혈질<br/>프로듀사, 라준모보다 2% 부족한";
						$this->comment = array(
							"연인에게 꽃 선물을 해보시는 건 어떠세요? 기념일이 아닌 평범한 날에 불쑥 건네는 꽃 한 송이는 두 분의 사랑을 더 열정적이게 만들어 줄 거에요.",
							"연인의 머리를 자주 쓰다듬거나 포옹할 때 머리를 감싸 안아주는 가벼운 스킨십을 늘려보세요. 여자친구가 겉으로 표현하지 않더라도 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요.",
							"연인만을 위한 작은 선물을 해보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 상대방을 생각하고 있다는 것을 보여줄 수 있어요.",
						);

						$this->shareMessage1 = "「프로듀사」의/’2% 부족한 라준모’";
						$this->shareMessage2 = ": 정 많고 책임감 있는 다혈질";
						$this->shareMessage3 = "사랑이 작은/우애적 사랑";

						$this->shareImage = "042";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "똑똑하고 도도하다가도 허당끼 가득한<br/>프로듀사, 탁예진보다 2% 부족한";
						$this->comment = array(
							"먼저 다가가 안기거나 손을 잡는 등 가벼운 스킨십을 해 보시는 건 어떠세요? 여자분이 먼저 하는 스킨십에 남자친구는 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요. ",
							"남자친구와 함께 운동을 하는 건 어떠세요? 땀 흘리는 쌩얼을 보여주기 두렵다구요? 같이 운동하다 보면 의외의 섹시한 모습을 보여줄 수 있을지도 몰라요.",
							"남자친구만을 위한 작은 선물을 해 보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 남자친구를 생각하고 있다는 것을 보여줄 수 있어요.",
						);

						$this->shareMessage1 = "「프로듀사」의/’2% 부족한 탁예진’";
						$this->shareMessage2 = ": 똑똑하고 도도하다가도 허당끼 가득한 매력녀";
						$this->shareMessage3 = "사랑이 작은/우애적 사랑";

						$this->shareImage = "043";

					}

					$this->traingleImage = '24';

	 			}

			} else if ((abs(($this->C - $this->A)) < 2) && (($this->C -  $this->B) < 2)) {

				if ($this->B > 3) {

					(string) $this->challenge = "우애적 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 친밀과 헌신(결심)이 높은 ‘우애적 사랑’에 속하시네요. ‘우애적 사랑’은 서로에게 편안한 마음을 갖고 이해하며 정서적 지지를 해 주는 친밀함이 높아 연인과 굉장히 가깝고 많은 것을 공유하고 있다는 느낌을 받고 계실 것 같아요.<br/><br/>단기적으로는 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 결심 또한 높아 상대적으로 견고한 사랑을 하고 계시는 것 같아요.<br/><br/>반면 친밀과 헌신에 비해 연인에게서 육체적 매력, 성적 몰입을 느끼는 열정은 다소 부족해 보여요. 더 성숙한 사랑으로 가기 위해 연인에게 사랑하는 감정을 더 적극적으로 표현 할 수 있는 방법이 무엇인지 고민해 보시면 좋을 것 같아요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "정 많고 책임감 있는 다혈질<br/>프로듀사, 라준모의";
						$this->comment = array(
							"연인에게 꽃 선물을 해보시는 건 어떠세요? 기념일이 아닌 평범한 날에 불쑥 건네는 꽃 한 송이는 두 분의 사랑을 더 열정적이게 만들어 줄 거에요.",
							"연인의 머리를 자주 쓰다듬거나 포옹할 때 머리를 감싸 안아주는 가벼운 스킨십을 늘려보세요. 여자친구가 겉으로 표현하지 않더라도 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요.",
							"연인만을 위한 작은 선물을 해보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 상대방을 생각하고 있다는 것을 보여줄 수 있어요.",
						);

						$this->shareMessage1 = "「프로듀사」의/’라준모’";
						$this->shareMessage2 = ": 정 많고 책임감 있는 다혈질";
						$this->shareMessage3 = "/우애적 사랑";

						$this->shareImage = "042";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "똑똑하고 도도하다가도 허당끼 가득한<br/>프로듀사, 탁예진의";
						$this->comment = array(
							"먼저 다가가 안기거나 손을 잡는 등 가벼운 스킨십을 해 보시는 건 어떠세요? 여자분이 먼저 하는 스킨십에 남자친구는 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요.",
							"남자친구와 함께 운동을 하는 건 어떠세요? 땀 흘리는 쌩얼을 보여주기 두렵다구요? 같이 운동하다 보면 의외의 섹시한 모습을 보여줄 수 있을지도 몰라요.",
							"남자친구만을 위한 작은 선물을 해 보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 남자친구를 생각하고 있다는 것을 보여줄 수 있어요.",
						);

						$this->shareMessage1 = "「프로듀사」의/’탁예진’";
						$this->shareMessage2 = ": 똑똑하고 도도하다가도 허당끼 가득한 매력녀";
						$this->shareMessage3 = "/우애적 사랑";

						$this->shareImage = "043";

					}

					$this->traingleImage = '23';

	 			} else if (($this->B <= 3) && ($this->C > 6) && ($this->A > 6)) {

					(string) $this->challenge = "열정이 없는 우애적 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 친밀과 헌신(결심)이 높은 ‘열정이 없는 우애적 사랑’에 속하시네요. ‘우애적 사랑’은 서로에게 편안한 마음을 갖고 이해하며 정서적 지지를 해 주는 친밀함이 높아 연인과 굉장히 가깝고 많은 것을 공유하고 있다는 느낌을 받고 계실 것 같아요.<br/><br/>단기적으로는 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 결심 또한 높아 보여요.<br/><br/>반면 연인에게서 육체적 매력, 성적 몰입을 느끼는 열정은 많이 부족해 보여요. 열정의 주된 원천인 육체적 매력이 약해지는 경우는 흔히 오래된 연인에게서 많이 보여지는 사랑의 유형이에요. 더 성숙한 사랑으로 가기 위해 연인에게 사랑하는 감정을 적극적으로 표현해 보시면 어떨까요?";

					if ($this->loverSex == 'M') {

						(string) $this->title = "사랑에 소극적이고 불안해 하는<br/>커피프린스, 최한성의";
						$this->comment = array(
							"연인에게 꽃 선물을 해보시는 건 어떠세요? 기념일이 아닌 평범한 날에 불쑥 건네는 꽃 한 송이는 두 분의 사랑을 더 열정적이게 만들어 줄 거에요. 또는 연인만을 위한 작은 선물을 해보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 상대방을 생각하고 있다는 것을 보여줄 수 있어요.",
							"연인만을 위한 작은 선물을 해보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 상대방을 생각하고 있다는 것을 보여줄 수 있어요. 또는 연인의 머리를 자주 쓰다듬거나 포옹할 때 머리를 감싸 안아주는 가벼운 스킨십을 늘려보세요. 여자친구가 겉으로 표현하지 않더라도 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요.",
							"연인만을 위한 작은 선물을 해보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 상대방을 생각하고 있다는 것을 보여줄 수 있어요. 또는 여자친구와 함께 운동을 하는 건 어떠세요? 같이 운동하다 보면 서로 의외의 섹시한 모습을 알 수 있을지도 몰라요. 단, 자신의 힘을 과시하거나 운동에 너무 심취하기 보다 여자친구분과 같이 하는 운동을 하며 세심하게 챙겨주세요.",
							"연인에게 꽃 선물을 해보시는 건 어떠세요? 기념일이 아닌 평범한 날에 불쑥 건네는 꽃 한 송이는 두 분의 사랑을 더 열정적이게 만들어 줄 거에요. 또는 연인의 머리를 자주 쓰다듬거나 포옹할 때 머리를 감싸 안아주는 가벼운 스킨십을 늘려보세요. 여자친구가 겉으로 표현하지 않더라도 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요.",
							"연인에게 꽃 선물을 해보시는 건 어떠세요? 기념일이 아닌 평범한 날에 불쑥 건네는 꽃 한 송이는 두 분의 사랑을 더 열정적이게 만들어 줄 거에요. 또는 여자친구와 함께 운동을 하는 건 어떠세요? 같이 운동하다 보면 서로 의외의 섹시한 모습을 알 수 있을지도 몰라요. 단, 자신의 힘을 과시하거나 운동에 너무 심취하기 보다 여자친구분과 같이 하는 운동을 하며 세심하게 챙겨주세요.",

						);

						$this->shareMessage1 = "「커피프린스」의/’최한성’";
						$this->shareMessage2 = ": 사랑에 소극적이고 불안해 하는 남자";
						$this->shareMessage3 = "열정이 없는/우애적 사랑";

						$this->shareImage = "036";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "사랑을 위해 죽음도 이겨낸 여자<br/>내 이름은 김삼순, 유희진의";
						$this->comment = array(
							"먼저 다가가 안기거나 손을 잡는 등 가벼운 스킨십을 해 보시는 건 어떠세요? 여자분이 먼저 하는 스킨십에 남자친구는 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요. 남자친구와 함께 운동을 하는 건 어떠세요? 땀 흘리는 쌩얼을 보여주기 두렵다구요? 같이 운동하다 보면 의외의 섹시한 모습을 보여줄 수 있을지도 몰라요.",
							"먼저 다가가 안기거나 손을 잡는 등 가벼운 스킨십을 해 보시는 건 어떠세요? 여자분이 먼저 하는 스킨십에 남자친구는 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요. 또는 남자친구만을 위한 작은 선물을 해 보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 남자친구를 생각하고 있다는 것을 보여줄 수 있어요.",
							"남자친구와 함께 운동을 하는 건 어떠세요? 땀 흘리는 쌩얼을 보여주기 두렵다구요? 같이 운동하다 보면 의외의 섹시한 모습을 보여줄 수 있을지도 몰라요. 또는 남자친구만을 위한 작은 선물을 해 보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 남자친구를 생각하고 있다는 것을 보여줄 수 있어요.",
						);

						$this->shareMessage1 = "「내 이름은 김삼순」의/’유희진’";
						$this->shareMessage2 = ": 사랑을 위해 죽음도 이겨낸 여자";
						$this->shareMessage3 = "열정이 없는/우애적 사랑";

						$this->shareImage = "009";

					}

					$this->traingleImage = '26';

	 			} else {

					(string) $this->challenge = "사랑이 작은 우애적 사랑";
					(string) $this->content = "사랑의 3요소는 친밀감, 헌신(결심), 열정 3가지가 있어요.<br/>그 중 " . $loverName . "님은 친밀과 헌신(결심)이 높은 ‘우애적 사랑’에 속하시네요. ‘우애적 사랑’은 서로에게 편안한 마음을 갖고 이해하며 정서적 지지를 해 주는 친밀함이 높아 연인과 굉장히 가깝고 많은 것을 공유하고 있다는 느낌을 받고 계실 것 같아요.<br/><br/>단기적으로는 상대방이 잘 살 수 있도록 도와주고자 하는 헌신적인 마음과 연인과의 사랑을 오래 지속하고 싶은 결심 또한 높아 상대적으로 견고한 사랑을 하고 계시는 것 같아요.<br/><br/>반면 친밀과 헌신에 비해 연인에게서 육체적 매력, 성적 몰입을 느끼는 열정은 다소 부족해 보여요. 마찬가지로 전반적인 사랑의 감정 역시 다소 부족한 것 같아요. 더 성숙한 사랑으로 가기 위해 사랑하는 감정을 더 키우고 연인에게 사랑하는 감정을 더 적극적으로 표현 할 수 있는 방법이 무엇인지 고민해 보시면 좋을 것 같아요.";

					if ($this->loverSex == 'M') {

						(string) $this->title = "정 많고 책임감 있는 다혈질<br/>프로듀사, 라준모보다 2% 부족한";
						$this->comment = array(
							"연인에게 꽃 선물을 해보시는 건 어떠세요? 기념일이 아닌 평범한 날에 불쑥 건네는 꽃 한 송이는 두 분의 사랑을 더 열정적이게 만들어 줄 거에요.",
							"연인의 머리를 자주 쓰다듬거나 포옹할 때 머리를 감싸 안아주는 가벼운 스킨십을 늘려보세요. 여자친구가 겉으로 표현하지 않더라도 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요.",
							"연인만을 위한 작은 선물을 해보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 상대방을 생각하고 있다는 것을 보여줄 수 있어요.",
						);

						$this->shareMessage1 = "「프로듀사」의/’2% 부족한 라준모’";
						$this->shareMessage2 = ": 정 많고 책임감 있는 다혈질";
						$this->shareMessage3 = "사랑이 작은/우애적 사랑";

						$this->shareImage = "042";

					} else if ($this->loverSex == 'F') {

						(string) $this->title = "똑똑하고 도도하다가도 허당끼 가득한<br/>프로듀사, 탁예진보다 2% 부족한";
						$this->comment = array(
							"먼저 다가가 안기거나 손을 잡는 등 가벼운 스킨십을 해 보시는 건 어떠세요? 여자분이 먼저 하는 스킨십에 남자친구는 겉으로 표현하지 않더라도 속으론 굉장히 두근거려 할 거에요. ",
							"남자친구와 함께 운동을 하는 건 어떠세요? 땀 흘리는 쌩얼을 보여주기 두렵다구요? 같이 운동하다 보면 의외의 섹시한 모습을 보여줄 수 있을지도 몰라요.",
							"남자친구만을 위한 작은 선물을 해 보세요. 평범한 날에 건네는 작은 선물은 평소에도 계속 남자친구를 생각하고 있다는 것을 보여줄 수 있어요.",
						);

						$this->shareMessage1 = "「프로듀사」의/’2% 부족한 탁예진’";
						$this->shareMessage2 = ": 똑똑하고 도도하다가도 허당끼 가득한 매력녀";
						$this->shareMessage3 = "사랑이 작은/우애적 사랑";

						$this->shareImage = "043";

					}

					$this->traingleImage = '24';

	 			}

			} else {

				(string) $this->challenge = "이 결과값은 오류가 있다는 것입니다...예상치 못한 경우가 있다니... 충격...";
				(string) $this->title = "";
				(string) $this->content = "";

	 		}

		}

		public function coupleLove ($lovePoint, $loveMatch, $loveSize) {

			// (int) $lovePoint = $lovePoint;
			// (int) $loveMatch = $loveMatch;

			if (($lovePoint > 90) && ($lovePoint <= 100)) {

				$this->loveMessage = "우리 사랑은 이제 신의 영역..? <br/>넘사벽 커플 등극";

			} else if (($lovePoint > 80) && ($lovePoint <= 90)) {

				$this->loveMessage = "사랑이 제일 쉬웠어요~ <br/>우리는 넘나 완벽한 커플인 것?!";

			} else if (($lovePoint > 70) && ($lovePoint <= 80)) {

				$this->loveMessage = "티격태격하는 우리, <br/>하지만 내겐 너뿐이야♡";

			} else if (($lovePoint > 60) && ($lovePoint <= 70)) {

				$this->loveMessage = "투닥투닥하는 우리, <br/>돌아서면 알콩달콩♡";

			} else if (($lovePoint > 50) && ($lovePoint <= 60)) {

				$this->loveMessage = "오그라드는 건 질색, <br/>우리는 담백한 커플로 간다!";

			} else if (($lovePoint > 40) && ($lovePoint <= 50)) {

				$this->loveMessage = "콩깍지 따위 개나 주라지. <br/>우리는 자본주의보다 현실적인 커플!";

			} else if ($lovePoint <= 40) {

				$this->loveMessage = "?!..... <br/>우리는 혹시 커플이 아닐지 몰라....";

			}
			
			if ((80 < $loveMatch) && ($loveMatch <= 100)) {

				// 사랑의 크기가
				if (($loveSize > 83.1) && ($loveSize <= 105.2)) {

					$this->coupleLoveContent = "결과가 너무 좋아서 재미 없을 정도로 두 분이 너무 이상적인 관계를 맺고 있는 것으로 보이네요. 깨가 쏟아지는 그런 관계이실 것 같습니다. 서로에 대한 감정의 크기도 굉장히 크면서 서로가 생각하는 연인과의 관계의 깊이, 앞으로 관계 발전에 대한 기대감 추이가 매우 일치하고 있습니다. 각자가 상대방에게 쏟는 사랑만큼 그대로 사랑 받고 있는 것으로 보이며 서로에게 맞는 사람을 잘 만나신 것 같습니다. 상대방에 대한 배려와 이해도 역시 상당히 높을 것으로 기대됩니다. 하지만 이 관계를 계속 유지하기 위해서는 현재 서로에 대한 기대감을 계속 충족시켜주고 상대방이 어떤 관계를 원하는지 지속적으로 관심을 가지고 사랑을 주어야 합니다. 현 상황에 너무 만족하여 자신도 모르는 사이에 상대방에게 소홀해질 수 있으니 더 발전적인 관계를 위해 계속해서 연인에게 관심을 가져주시기 바랍니다.";

				} else if (($loveSize > 31.9) && ($loveSize <= 83.1)) {

					$this->coupleLoveContent = "다른 커플보다 달달한 관계를 맺고 계신 것 같네요! 어떤 의미에서는 가장 좋은 시기일 수 있습니다. 서로에 대한 감정의 크기도 적절하며 서로가 생각하는 관계의 깊이와 앞으로 관계 발전에 대한 기대감의 추이가 굉장히 일치하고 있습니다. 서로를 너무 과하게 사랑하지도 않으면서 남들보다 더 서로를 아끼고 부담을 주지 않는 그런 관계로 보입니다. 자신에게 꼭 맞는 좋은 사람을 만났다고 생각하셔도 될 것 같습니다.<br/>하지만 현재의 사랑에 너무 취해 연인에게 무심해지지 않게 조심하셔야 합니다. 소중한 사람일수록 더 관심을 많이 쏟고 배려하는 게 중요하다는 건 이미 아시겠지만! 이번 기회를 통해 서로에게 서운한 점은 없었는지 다시 한 번 돌아보며 더욱 아름다운 사랑을 가꾸어 나가시길 바랍니다.";

				} else if (($loveSize > 23.4) && ($loveSize <= 31.9)) {

					$this->coupleLoveContent = "두 분이서 꽁냥꽁냥하는 소소한 관계를 맺고 계신 것 같네요! 스스로의 인생에 충실하면서도 서로에게 큰 부담을 주지 않는 관계를 맺고 계신 것으로 보입니다. 다행히 두 분이 서로와의 관계의 깊이와 향후 관계 발전에 대한 기대감의 추이가 일치하여 크게 부딪히지 않으며 적절한 상황을 유지하고 있는 것 같습니다. 본인들에게 잘 맞는 연인을 만나신 것으로 보입니다. 주변의 상황에 크게 동요치 않으며 조용히 오랜 관계를 유지하는 커플로 너무 요란하게 사귀지도 너무 깊이 있는 관계를 맺고 있지도 않는 잔잔한 바다 같은 관계는 아니신가요? 오래된 커플, 혹은 친구 사이에 연인이 된 경우에서 주로 나타나는 유형으로서 앞으로의 관계에 더욱 관심을 쏟는 게 중요한 시기일 수 있습니다.";

				} else if (($loveSize > 10.4) && ($loveSize <= 23.4)) {

					$this->coupleLoveContent = "서로가 생각하는 관계의 깊이와 관계 발전에 대한 기대감이 일치하고 있지만 이런 상황이 지속될 경우 관계 유지에 어려움이 있을 수 있습니다. 서로가 연인에게 바라고 연인이 본인에게 기대하는 만큼 감정을 교류하며 관계를 맺고 있는 것으로 보이지만 장기적으로 봤을 때 사랑의 크기가 커지지 않는다면 상대방에 대한 애정이 점차 식어 갈 수도 있습니다. 개인 별 사랑의 삼각형 검사를 통해 각자의 사랑의 유형과 지금 상황을 확인해 보시고 관계를 더 발전적인 방향으로 이끌어 가고 싶을 경우 상담을 받아보시는 것도 추천해드리고 싶습니다. 하지만 상호간에 바라는 점이 상당히 일치한다는 점에서 앞으로 노력 여부에 따라 훨씬 깊은 관계로 발전할 여지가 충분히 있는 것으로 생각됩니다.";

				} else if ($loveSize <= 10.4) {

					$this->coupleLoveContent = "- 사랑의 크기가 너무 작아 측정이 불가능합니다. ";

				}

				$this->detailFriendly = "현재 두 분의 친밀감이 굉장히 일치하고 있습니다. 친밀감은 서로에게 느끼는 유대감이나 의지할 수 있다고 느끼는 마음을 의미합니다. 그런 친밀감의 일치율이 높다는 것은 앞으로 두 분이 관계를 이끌어가는 것에 있어 상당히 만족스러울 수 있다는 것을 암시합니다. 내가 원하는 만큼 상대방도 나를 원하고 내가 좋아하고 의지하는 만큼 상대방도 내게 의지한다는 것은 정말 축복받은 일입니다. 다만 친밀감은 시간이 흐름에 따라 조금씩 증가하다가 어느 순간 급격히 증가하고 다시 천천히 증가하다가 이내 쇠퇴하는 변화의 추이를 보이기 때문에 향후 두 분이 서로에 대한 감정이 식었다고 느낄 가능성이 있습니다. 하지만 성공적인 관계의 경우 겉으로 보이는 친밀감이 감소하는 것처럼 보이더라도 보이지 않는 잠재적 친밀감은 계속 증가하거나 그대로 유지되고 있을 가능성이 큽니다. 하지만 안타깝게도 이러한 잠재적 친밀감은 관계를 유지하고 있을 때는 잘 느끼지 못하고 보이지도 않는 경우가 많습니다. 그렇기 때문에 만약 서로의 친밀감이 계속 떨어지고 있다고 느끼는 시기가 오더라도 정말로 서로에 대한 유대감과 의존성이 사라지고 있는 것인지 아니면 실제로는 아직도 많이 의지하고 유대감을 가지고 있는지 깊이 있게 생각해볼 필요가 있습니다.";
				$this->detailPassion = "두 분 사이의 사랑의 요소 중 열정 부분이 굉장히 높은 일치율을 보이고 있습니다. 서로에 대한 육체적 매력과 성적 욕구가 주된 열정의 요소지만 자아 존중감, 자아실현과 같은 욕구들 역시 열정의 요소 중 하나입니다. 그렇기에 서로에 대한 열정이 높다는 것은 상대방에게 육체적으로 강하게 끌린다는 것을 의미하면서도 서로에 대한 존중이 잘 이뤄지고 자신의 욕구를 잘 실현하고 계신다는 의미로 해석될 수도 있습니다. 열정은 서로에 대한 몰입감을 높여 친밀감과 결심/헌신적인 요소를 발전시킬 수 있는 계기를 만들어주기도 하는 만큼 현재 상태는 앞으로 관계를 이끌어가는 것에 있어 긍정적인 방향으로 이어질 수 있습니다.<br/>하지만 일반적으로 열정은 초반에 급속히 높아진 후 시간이 지나면서 서서히 관습화(당연시 여기게 되는 것)가 나타나게 됩니다. 그래서 상대와의 관계가 더 이상 자극적이지 않다고 느낄 수 있고 열정이 사라지기 시작할 때 실망감을 느끼고 공허함을 느낄 수 있습니다. 하지만 위에서 언급한 바와 같이 열정이 식으면서 친밀감과 결심/헌신적 요소의 증가로 이어지는 경우가 많기 때문에 더 많은 관심을 가지고 서로의 관계를 이어가려고 노력하는 것이 중요합니다.";
				$this->detailCommitment = "두 분의 결심/헌신 요소는 굉장히 많이 일치하고 있습니다. 단기적 관점에서 상대방을 사랑하겠다고 다짐하는 결심과 장기적 관점에서 관계를 이어가기 위해 노력하는 헌신이 결심/헌신 요소를 이루는데 이 두 부분에 있어 서로의 마음이 일치하고 있다는 것을 의미합니다.<br/>결심/헌신 요소는 시간이 경과함에 따라 관계의 성공 여부의 영향을 많이 받습니다. 성공적인 관계를 맺고 있는 경우 지금과 같이 상호간의 결심/헌신 요소가 일치하고 서로에 대한 사랑을 확신하면서도 장기적인 관계에 대해 확신을 가질 수 있습니다. 헌신이 장기간에 걸쳐 성숙되고 심화된다면 서로에 대한 믿음이 확고해져 열정이 줄어든 상황에서도 건강한 관계를 계속 유지할 수 있습니다. 하지만 단기간에 형성된 헌신일 경우에는 아직 어리고 얕기 때문에 다른 요소의 영향을 많이 받을 수 있으며 쉽게 흔들릴 수 있습니다. 그럼에도 현재 서로간의 결심/헌신에 대한 마음이 일치하고 있다는 것은 굉장히 긍정적이며 앞으로의 관계에도 밝은 청사진을 기대할 수 있을 것 같습니다.";

			} else if ((50 < $loveMatch) && ($loveMatch <= 80)) {

				// 사랑의 크기가
				if (($loveSize > 83.1) && ($loveSize <= 105.2)) {

					$this->coupleLoveContent = "좌충우돌, 서로 조금씩 부딪히면서도 금세 화해하고 서로를 너무 아끼고 계신 건 아닌가요? 서로가 생각하는 관계의 방향에 대해 평균 이상의 일치율을 보이면서도 연인에 대한 감정이 굉장히 큰 상태라고 판단됩니다. 미세하게 각자가 생각하고 느끼는 방향에서 차이를 느끼실 수 있지만 서로에 대한 감정만큼은 확실하니 서로 대화를 많이 하며 조금씩 더 좋은 방향으로 맞춰나가시면 좋을 것 같습니다. 개인별 사랑의 삼각형 검사 결과를 맞춰보시며 상대방은 나에 대해 어떻게 생각하고 있는지, 내가 연인에게 어떤 점을 더 잘해줄 수 있는지 생각해 보시는 것도 좋은 데이트가 되지 않을까 싶습니다. 연인에 대한 사랑이 확고한 만큼 서로 더 배려하며 용서해주며 알콩달콩 지내시고 계시지 않을까 예상해봅니다. 그래도 한편으로는 조금씩 다른 부분들이 섭섭할 수 있습니다. 그 큰 사랑의 감정으로 서로를 더 아끼고 배려하면 물론 금방 극복하겠지만 소중한 인연인 만큼 더욱 소중하게 서로를 대해주시길 바랍니다.";

				} else if (($loveSize > 31.9) && ($loveSize <= 83.1)) {

					$this->coupleLoveContent = "티격태격하면서도 남들이 부러워할 만큼 서로 사랑을 나누고 계신 것 같은데요? 남들보다 깊이 사랑하시면서도 서로의 감정에 대해 적당히 파악하고 계신 것 같습니다. 각자가 생각하고 느끼는 관계의 방향이 상대방과 다소 일치하지 않는 부분들이 보이지만 크게 문제가 될 정도는 전혀 아니니 걱정하지 않으셔도 될 것 같습니다. 더 발전적인 관계를 위해서 조금만 더 서로의 감정이 어떤지 확인하고 서로 맞춰 가신다면 정말 좋을 것 같습니다.<br/>이러한 유형은 관계를 막 시작하여 서로 맞춰가는 도중인 연인들이나 어느 정도 안정기에 든 커플들에게서 나타나기도 합니다. 하지만 서로에 대한 차이를 느끼지만 그것이 크게 엇나가지 않는 상황이기 때문에 오히려 관계가 훨씬 좋아질 수 있는 하나의 전환점이 될 수 있는 시기입니다. 그렇기 때문에 이 기회를 살려 관계를 지속하고 더 나은 방향으로 나아가기 위해서는 서로가 생각하는 바가 무엇인지 더 세심한 관심을 쏟고 노력을 하면 좋을 것 같습니다.";

				} else if (($loveSize > 23.4) && ($loveSize <= 31.9)) {

					$this->coupleLoveContent = "평범하면서도 무난한 유형의 사랑을 하고 계신 것 같습니다. 사람들은 종종 평범하거나 무난하다는 표현을 굉장히 부정적으로 받아들이고는 합니다. 하지만 사랑을 할 때 평범하고 무난하다는 것은 오히려 장기적으로 봤을 때 관계를 오래 유지하시는 경우가 많다는 것을 고려하면 좋은 의미로 해석될 수도 있습니다.<br/>물론 이전부터 지속적으로 연인간의 마찰이 많아지고 있다거나 사랑이 식어가고 있는 과정에 있었다면 별로 좋지 않은 상황일 수 있습니다. 그럴 경우 개인별 사랑의 삼각형을 서로 확인해보며 서로에게 어떤 점이 부족하고 어떤 점이 잘 맞는지를 파악하는 것도 하나의 방법이 될 수 있습니다.";

				} else if (($loveSize > 10.4) && ($loveSize <= 23.4)) {

					$this->coupleLoveContent = "서로에 대한 감정이 그렇게 큰 상태가 아닌 것으로 보여 혹시 관계에서 불안함을 느끼고 계시지는 않으실까 걱정이 됩니다. 이와 같은 유형은 사랑이 점차 식어가는 연인, 혹은 친구 사이에서 연인사이로 발전하여 서로에 대한 감정을 키워가는 과정에 있는 경우 많이 볼 수 있습니다. 서로에 대한 감정의 크기가 그렇게 크지 않아 서로에 대한 확신이나 안정감이 부족하여 한편으로는 관계가 불안하다고 느끼실 수도 있을 것 같습니다. 하지만 각자가 생각하는 상대방과의 관계에 대한 깊이나 방향이 상당히 일치하는 것으로 판단되기 때문에 조금씩 서로에 대한 감정을 키워나가기 쉽고 감정이 커지지 않더라도 서로 큰 트러블 없이 관계를 이어나가실 수 있을 것으로 보입니다. 또한 현 상황이 오히려 하나의 전환점이 될 수도 있기 때문에 너무 지금 이 순간에 얽메일 필요 없이 장기적인 관점에서 연인과의 관계를 이끌어 나가시는 것을 추천 드립니다.";

				} else if ($loveSize <= 10.4) {

					$this->coupleLoveContent = "- 사랑의 크기가 너무 작아 측정이 불가능합니다. $lovePoint, $loveMatch";

				}

				$this->detailFriendly = "현재 두 분의 친밀감의 일치율이 다소 일치하지 않고 있습니다. 하지만 친밀감의 성장 속도는 개인에 따라 상이하며 보이는 친밀감과 보이지 않는 친밀감이 일치하지 않는 경우가 많기 때문에 앞으로 상대방에 대해 스스로가 느끼는 친밀감에 대해 깊이 있게 관찰해 볼 필요가 있습니다. 보이지 않는 친밀감을 잠재적 친밀감이라 부르는데 불행히도 잠재적 친밀감은 겉으로 잘 드러나지 않기 때문에 실제로 서로를 어떻게 느끼고 있는지 파악하는데 다소 어려움이 있습니다. 이별하고 나서야 상대방의 존재가 본인에게 큰 역할을 했었다는 것을 뒤늦게 깨닫는 경우도 이런 이유 때문입니다. 지금 당장 친밀감이 다소 일치하지 않고 있다고는 하지만 실제로는 두 분의 잠재적 친밀감이 상당히 높을 수 있으므로 스스로의 내면을 들여다보며 진심을 제대로 파악해 볼 필요가 있을 것 같습니다.";
				$this->detailPassion = "두 분 사이의 사랑의 요소 중 열정 부분이 다소 상이함을 보이고 있습니다. 상호간의 열정이 불균형할 경우 열정이 높은 쪽이 열정이 낮은 쪽에게 더 애정을 가지고 적극적으로 다가가지만 열정이 낮은 쪽에서 기대하는 만큼의 반응을 보이지 않아 실망하고 스트레스를 받을 수 있습니다. 그렇기 때문에 열정이 크게 차이가 나지 않는 지금 서로의 생각이나 마음 상태에 대해 정확히 파악하고 미리 관계를 어떻게 이끌어 나갈지 고민해 보실 필요가 있습니다.<br/>관계를 시작 중이어서 서로에 대한 감정을 키워가고 계신다면 크게 걱정하실 필요가 없을 것 같습니다. 하지만 오래된 연인인 경우 열정이 줄어들어서 생길 수 있는 실망감, 허전함 등의 감정을 잘 관리하셔서 친밀감과 결심/헌신적인 요소를 더 키워나가신다면 장기적이고 건강한 관계를 유지하실 수 있을 것 같습니다.";
				$this->detailCommitment = "두 분의 결심/헌신 요소가 다소 일치하지 않고 있습니다. 단기적 관점에서 상대방을 사랑하겠다고 다짐하는 결심과 장기적 관점에서 관계를 이어가기 위해 노력하는 헌신이 결심/헌신 요소를 이루는데 이 두 부분에 있어 서로의 마음이 다소 맞지 않다는 것을 의미합니다.<br/>상대방과 관계를 맺기 시작하고 점점 사랑을 키워가고 있는 경우와 둘 중 한 명의 마음이 서서히 식어가고 있는 경우에 위와 같은 결과가 나오는 경향이 있습니다. 그렇기에 관계를 계속 유지하기 위해서는 지금이 가장 중요한 전환점일 수 있습니다.<br/>개인의 결심/헌신 요소의 크기는 시간이 지남에 따라 상당히 달라집니다. 특히, 관계의 성공 여부에 따라 그 격차가 크게 달라지는 경향이 있습니다. 관계의 성공은 단순히 결심/헌신 요소에 있어서만 노력을 한다고 되는 것이 아니기 때문에 친밀감을 키우면서도 더 열정적인 모습을 보여주어야 합니다. 하지만 열정의 경우 한 번 사그라들기 시작하면 다시 처음과 같은 수준으로 돌아가기 어렵기 때문에 친밀감을 위해 노력하며 결심/헌신 요소를 천천히 끌어 올려야 합니다. 주변 사람들에게 조언을 구하고 전문가에게 연애 상담을 받는 것을 추천 드리지만 가장 중요한 것은 본인과 관계를 가지고 있는 상대방의 말에 귀를 기울이고 마음을 쏟는 것입니다.";

			} else if ($loveMatch <= 50) {

				// 사랑의 크기가
				if (($loveSize > 83.1) && ($loveSize <= 105.2)) {

					$this->coupleLoveContent = "나올 수 없는 유형";

				} else if (($loveSize > 31.9) && ($loveSize <= 83.1)) {

					$this->coupleLoveContent = "혹시 아직도 연인 중 한 명이 상대방을 짝사랑하고 있는 건 아닐까요? 연인 중 한 분의 사랑이 다른 한 분에 비해 상당히 큰 것 같습니다. 그렇기 때문에 각자가 생각하는 연인에 대한 관계의 깊이, 방향, 관계 발전에 대한 기대감의 추이가 많이 다를 수 있습니다. 이러한 상태가 장기적으로 지속될 경우 감정이 큰 쪽은 큰대로 자신의 사랑을 보답 받지 못한다는 생각에 지치고 힘들어 할 수 있습니다. 반대로 감정이 작은 쪽은 자신에 대한 상대방의 감정이 너무 커서 고마움을 느끼면서도 부담감을 느껴 힘들어 할 수 있습니다. 연인이 된지 얼마 되지 않아 천천히 감정과 서로에 대한 관계를 이끌어 가고 있는 상황이라면 문제가 되지 않겠지만 혹시 이런 상황이 이미 장기적으로 이어진 상태라면 한 번쯤 관계의 방향을 다시 생각해보고 상담을 받아보시는 것을 추천 드립니다. 개인별 사랑의 삼각형을 비교해 보며 서로에게 부족한 점이나 더 좋은 점을 함께 고민해 보는 것도 하나의 좋은 방법이 될 수 있을 것 같습니다.";

				} else if (($loveSize > 23.4) && ($loveSize <= 31.9)) {

					$this->coupleLoveContent = "평범하고 무난하면서도 연인 중 한 분이 다른 분을 더욱 사랑하고 계신 것 같습니다. 하지만 서로가 생각하는 관계의 발전 방향이나 감정의 깊이에 대한 생각이 다소 달라 불만이 있으시진 않을까 걱정이 됩니다. 이제 막 연애를 시작하거나 관계를 맺기 시작했을 경우, 어쩌다가 갑자기 사귀게 된 경우 등에서 종종 보이는 유형이기도 합니다. 이런 경우 서로가 맞지 않는 부분들을 파악해 조금씩 맞춰나가는 것이 매우 중요합니다. 연인간의 깊이 있는 대화를 하며 좀 더 상대방의 생각이나 마음, 감정을 이해하고 공감하는 것도 매우 도움이 될 것 같습니다. 사랑의 3요소에 대한 각각의 결과를 보거나 각자의 사랑의 삼각형을 비교하며 부족한 부분이 무엇인지, 좋은 부분이 무엇인지 고민하여 보충해 나가는 것을 추천 드립니다.";

				} else if (($loveSize > 10.4) && ($loveSize <= 23.4)) {

					$this->coupleLoveContent = "연인 중 한 분이 다른 분을 더 좋아하시는 것 같습니다. 그렇기 때문에 사랑하는 감정이 더 큰 분께서 상대방이 자신을 좋아하지 않는 것은 아닐까 걱정을 하시고 불안하실 수 있습니다. 서로의 감정을 점점 키워나가거나 감정의 균형을 맞추면 자연스럽게 해결될 수 있는 문제로 보이지만 사랑하는 마음이 갑자기 커지지 않기 때문에 뭔가 관계의 발전을 꾀할 수 있는 계기를 마련해 보시는 것을 추천 드립니다. 서로가 생각하는 관계의 깊이나 앞으로 발전 방향에 대한 기대감이 달라 서운하실 수 있지만 각자가 생각하는 서로에 대한 기대감, 진심을 터놓고 얘기하고 공유하다 보면 조금씩 상대방의 기대와 만족감을 맞춰나가면서 관계가 더욱 발전적인 방향으로 발전할 수 있을 것 같습니다.";

				} else if ($loveSize <= 10.4) {

					$this->coupleLoveContent = "- 사랑의 크기가 너무 작아 측정이 불가능합니다.";

				}

				$this->detailFriendly = "현재 두 분의 친밀감의 일치율이 상당히 차이가 많이 나지만 이것이 서로에 대해 느끼는 친밀감이 실제로 낮다는 것을 의미하지는 않습니다. 친밀감은 시간이 흐름에 따라 조금씩 증가하다가 어느 순간 급격히 증가하고 다시 천천히 증가하다가 이내 쇠퇴하는 변화의 추이를 보입니다. 하지만 이것은 겉으로 드러나는 눈에 보이는 친밀감의 특징입니다. 두 사람이 정말로 진실된 관계를 맺었다면 겉으로 드러나는 친밀감이 감소하는 것처럼 보이더라도 보이지 않는 잠재적 친밀감은 계속 증가하거나 그대로 유지되고 있을 가능성이 큽니다. 하지만 안타깝게도 이러한 잠재적 친밀감은 관계를 유지하고 있을 때는 잘 느끼지 못하고 보이지도 않는 경우가 많습니다. 서로에게 의지하고 있다는 사실이나 유대감을 깨닫지 못하고 있다가 헤어지고 나서야 느끼는 경우가 많은 것이 바로 이런 이유 때문입니다. 그렇기 때문에 정말로 상대방에게 유대감을 느끼지 못하고 의지할 수 없는 것인지 아니면 친밀감이 낮은 것 같다고 추상적으로 느끼시는 건지 곰곰이 생각해볼 필요가 있습니다.";
				$this->detailPassion = "사랑의 각 요소 중 열정 부분이 약 50% 미만의 일치율을 보이고 있습니다. 상당히 낮은 수치로서 서로에 대한 열정이 불균형을 이루고 있는 것 같습니다. 연인간의 열정이 서로 비대칭을 이루게 되면 연인 중 열정이 높은 한 명이 다른 한 명에게 더 집착하고 더 적극적으로 관계를 이어가려는 경향을 보입니다. 하지만 다른 한 쪽의 열정이 높지 않기 때문에 열정이 많은 한 쪽이 스트레스를 많이 받고 힘들어 할 수 있습니다.<br/>일반적으로 열정은 초반에 급속히 높아진 후 시간이 지나면서 서서히 관습화(당연시 여기게 되는 것)가 나타나게 됩니다. 그래서 상대와의 관계가 더 이상 자극적이지 않다고 느낄 수 있습니다. 그래서 열정이 사라지기 시작할 때 실망하고 공허함을 느끼기도 합니다. 다행히 열정이 식어감에 따라 친밀/결심/헌신 요소가 발달하는 계기로 이어질 수 있기 때문에 줄어들어 가는 열정에 너무 실망하고 가슴 아파하지 말고 더 장기적이고 강하게 결속된 관계로 이어갈 수 있도록 더 관심을 많이 가지는 것이 필요할 때입니다.";
				$this->detailCommitment = "두 분의 결심/헌신 요소가 상당히 일치하지 않고 있습니다. 결심/헌신 요소는 앞으로의 관계에서 상대방을 사랑하겠다고 결심을 하는 것과 관계를 장기적으로 이어가겠다는 마음에서 비롯되는 헌신을 의미합니다.<br/>결심/헌신의 일치율이 상당히 낮다는 것은 이제 막 연애를 시작한 연인들, 갑자기 관계가 틀어져 상대에게 실망한 경우, 연인 관계의 마침표를 찍을 때가 된 경우에 많이 발견됩니다. 이런 경우는 두 가지 의미로 해석될 수 있는데, 첫 번째는 상대방에 대한 사랑에 확신과 결심이 서지 않았다는 의미이고 두 번째는 장기적인 관계까지는 생각하지 않는다는 의미일 수 있습니다. 하지만 장기적 관점에서 봤을 때 결심/헌신은 충분한 시간을 가지고 서서히 증가하는 경향이 있기 때문에 너무 성급히 두 분의 관계에 대한 어떤 결정을 내리는 것은 좋지 않을 수 있습니다. 조금 여유를 가지고 서로의 사랑과 미래에 대한 얘기를 나눠보시는 것이 관계에 큰 도움이 되기도 하니 스스로의 생각과 마음을 잘 생각하고 정리해보시기를 바랍니다.";

			} else {

				$this->detailFriendly = "";
				$this->detailPassion = "";
				$this->detailCommitment = "";

			}

		}

	}

?>
