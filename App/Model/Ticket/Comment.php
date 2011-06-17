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
	    	$user = $github->getUserApi()->show($comment['user']);
			$comment['username'] = $user['name'];
			$comment['login'] = $user['login'];
			$comment['created'] = $comment['created_at'];
			$comment['content'] = $comment['body'];
			$comments[$key] = $comment;
		}
    
		/*
    	if(!isset($p_aParams['ticket_id'])) {
    		throw new PPI_Exception('Missing ticket_id');
    	}
    	$comments = $this->select()
    		->columns('c.*, u.first_name, u.last_name')
    		->from($this->_table . ' c')
    		->leftJoin('users u', 'c.user_id = u.id')
    		->where('c.ticket_id = ' . $this->quote($p_aParams['ticket_id']))
    		->order('c.created DESC')
    		->getList();
    	*/
		return $comments; 	
    }
}