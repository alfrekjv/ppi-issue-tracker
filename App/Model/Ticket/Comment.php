<?php
class APP_Model_Ticket_Comment extends APP_Model_Application {
	protected $_table = 'ticket_comment';
	protected $_primary = 'id';

	function __construct() {
		parent::__construct($this->_table, $this->_primary);
	}

	function getComments(array $p_aParams = array()) {
		$github = new Github_Client();
		$comments = $github->getIssueApi()->getComments('dragoonis', isset($p_aParams['repo']) ? $p_aParams['repo'] : 'ppi-framework', $p_aParams['ticket_id']);

		foreach($comments as $key =>$comment) {
			$user                = $github->getUserApi()->show($comment['user']);
			$comment['username'] = isset($user['name']) ? $user['name'] : $user['login'];
			$comment['login']    = $user['login'];
			$comment['created']  = $comment['created_at'];

			if (extension_loaded('sundown')) {
				$sundown = new Sundown($comment['body'],array(
											"filter_html"=>true,
											"no_image"=>true,
											"no_links"=>true,
											"filter_styles"=>true,
											"safelink" => true,
											"generate_toc" => true,
											"hard_wrap" => true,
											"gh_blockcode" => true,
											"xhtml" => true,
											"autolink"=>true,
											"no_intraemphasis" => true,
											"tables" => true,
											"fenced_code" => true,
											"strikethrough" => true,
											"lax_htmlblock" => true,
											"space_header" => true,
									));

				$comment['content']  = $sundown->to_html();
			} else {
				$comment['content']  = $comment['body'];
			}

			$comment['id']       = $key;
			$comments[$key]      = $comment;
		}
		return $comments;
	}
}
